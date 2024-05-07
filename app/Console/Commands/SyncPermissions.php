<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
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
    protected $signature = 'app:sync-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronizes the permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $config = $this->readPermissionConfig('config/permissions.yml');
        if(!$config) {
            $this->error("Aborting...");
            return 1;
        }

        $this->syncRoles($config['roles']);
        $this->syncPermissions($config['permissions']);
    }

    /**
     * Reads the config file and parses it into an associative array
     *
     * @param string $path
     * @return array|null
     */
    private function readPermissionConfig(string $path): array|null
    {
        $content = Storage::get($path);
        if (!$content) {
            $this->error("Error: file storage/app/$path is not found!");
            return null;
        }

        $config = Yaml::parse($content);
        // Validate if roles and permissions sections are present
        if (!isset($config['roles'])) {
            $this->error('Error: there are no roles specified!');
            return null;
        }
        if (!isset($config['permissions'])) {
            $this->error('Error: there are no permissions specified!');
            return null;
        }
        return $config;
    }

    /**
     * Synchronizes all the role data
     *
     * @param array $roles
     * @return void
     */
    private function syncRoles(array $roles)
    {
        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
        // Delete the roles that are not in the config
        $names_array = array_map(fn($item) => $item['name'], $roles);
        Role::whereNotIn('name', $names_array)->delete();
    }

    /**
     * @param array $permissions
     * @return void
     */
    private function syncPermissions(array $permissions)
    {
        $permissions = $this->convertPermissionList($permissions);
        foreach ($permissions as $item) {
            $permission = Permission::findOrCreate($item['name']);
            $permission->syncRoles($item['roles']);
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
                foreach ($content as $nested_key => $nested_content) {
                    $result[] = [
                        // The naming convention for nested permissions is set here
                        'name' => "$nested_key-$key",
                        'roles' => $nested_content
                    ];
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
