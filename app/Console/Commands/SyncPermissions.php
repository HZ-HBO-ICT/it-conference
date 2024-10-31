<?php

namespace App\Console\Commands;

use App\Actions\Permissions\ReadPermissionConfig;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\Yaml\Yaml;

class SyncPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:sync-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronizes the permissions';
    protected ReadPermissionConfig $readPermissionConfig;

    private $newRoles = [];
    private $newPermissions = [];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->readPermissionConfig = new ReadPermissionConfig();
        $config = $this->readPermissionConfig->execute('config/permissions/permissions.yml');
        if (!$config) {
            $this->error("Aborting...");
            return 1;
        }

        $this->syncRoles($config['roles']);
        $this->syncPermissions($config['permissions']);

        if (count($this->newRoles) > 0) {
            $this->info('The added roles: ' . implode(', ', $this->newRoles));
        }
        if (count($this->newPermissions) > 0) {
            $this->info('The added permissions: ' . implode(', ', $this->newPermissions));
        }

        return 0;
    }

    /**
     * Synchronizes all the role data
     *
     * @param array|string $input
     * @return void
     */
    private function syncRoles(array|string $input)
    {
        if (is_array($input)) {
            $role_data = $this->prepareRoles($input);
        } else {
            // When string is given, assume it is just one role name
            $role_data = [
                ['name' => $input]
            ];
        }
        foreach ($role_data as $role) {
            try {
                Role::findByName($role['name']);
            } catch (RoleDoesNotExist) {
                $this->newRoles[] = $role['name'];
            }

            Role::updateOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
        // Delete the roles that are not in the config
        $names_array = array_map(fn($item) => $item['name'], $role_data);
        Role::whereNotIn('name', $names_array)->delete();
    }

    /**
     * Prepares the roles. It allows for declaring a role as a single item or
     * with attributes. It converts it into a structure:
     * ```
     * [
     *     'name' => $name
     * ]
     * ```
     *
     * @param array $roles
     * @return array|array[]
     */
    private function prepareRoles(array $roles)
    {
        return array_map(
            fn($role) => is_array($role) ? $role : ['name' => $role],
            $roles
        );
    }

    /**
     * Synchronizes the permissions.
     *
     * @param array $permissions
     * @return void
     */
    private function syncPermissions(array $permissions)
    {
        $permissions = $this->convertPermissionList($permissions);
        foreach ($permissions as $item) {
            $roles = $item['roles'];
            unset($item['roles']);

            try {
                Permission::findByName($item['name']);
            } catch (PermissionDoesNotExist) {
                $this->newPermissions[] = $item['name'];
            }

            $permission = Permission::updateOrCreate(
                ['name' => $item['name']],
                $item
            );
            try {
                $permission->syncRoles($roles);
            } catch (RoleDoesNotExist $exception) {
                $this->error($exception->getMessage());
            }
        }
        // Delete the permissions that are not in the config
        $names_array = array_map(fn($item) => $item['name'], $permissions);
        Permission::whereNotIn('name', $names_array)->delete();
    }

    /**
     * Converts the original list of atomic and nested permissions into one
     * list, which is structured as:
     * ```
     * [
     *     'name' => $permission_name,
     *     'roles' => $array_of_role_names
     * ]
     * ```
     * @param array $permissions
     * @return array
     */
    private function convertPermissionList(array $permissions): array
    {
        $result = [];
        foreach ($permissions as $key => $content) {
            if ($this->isNested($content)) {
                if ($this->hasPermissionAttributes($content)) {
                    $content['name'] = $key;
                    $result[] = $content;
                }
                foreach ($content as $nested_key => $nested_content) {
                    if ($this->hasPermissionAttributes($nested_content)) {
                        // The naming convention for nested permissions is set here
                        $nested_content['name'] = "$nested_key $key";
                        $result[] = $nested_content;
                    } else {
                        $result[] = [
                            // The naming convention for nested permissions is ALSO set here
                            'name' => "$nested_key $key",
                            'roles' => $nested_content
                        ];
                    }
                }
            } else {
                $result[] = [
                    'name' => $key,
                    'roles' => $content
                ];
            }
        }
        return $result;
    }

    /**
     * Checks if the given input appears to have permission attribibutes like
     * `guard_name` and `roles`.
     *
     * @param $input
     * @return bool
     */
    private function hasPermissionAttributes($input)
    {
        if (!is_array($input)) {
            return false;
        }
        // If the nested content holds the keys 'guard_name' or 'roles'
        // it is assumed to be an atomic permission with a guard_name or roles specified as attributes
        return array_key_exists('guard_name', $input) || array_key_exists('roles', $input);
    }

    /**
     * Checks if the given permission content is a nested permission.
     *
     * @param array|string $content
     * @return bool
     */
    private function isNested(array|string $content)
    {
        if (!is_array($content)) {
            return false;
        }
        // Use the `array_is_list()` function that checks if the array keys are 0, 1, ...
        // So, if the content is just an array, it assumes it is an atomic permission
        return !array_is_list($content);
    }
}
