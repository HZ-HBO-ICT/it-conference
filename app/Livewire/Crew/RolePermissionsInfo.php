<?php

namespace App\Livewire\Crew;

use App\Actions\Permissions\ReadPermissionConfig;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class RolePermissionsInfo extends ModalComponent
{
    public $role;
    protected ReadPermissionConfig $readPermissionConfig;
    public $permissionsForRole = [];

    /**
     * Initializes the component
     * @param $role
     * @return void
     */
    public function mount($role)
    {
        $this->role = Role::find($role);
        $this->readPermissionConfig = new ReadPermissionConfig();
        $permissionsData = $this->readPermissionConfig->execute();

        foreach ($permissionsData['permissions'] as $entity => $actions) {
            foreach ($actions as $action => $rolesWithPermission) {
                if (!is_array($rolesWithPermission)) {
                    $rolesWithPermission = [$rolesWithPermission];
                }

                if (in_array($this->role->name, $rolesWithPermission)) {
                    // Group permissions by entity
                    $this->permissionsForRole[$entity][] = $action;
                }
            }
        }
    }

    /**
     * Renders the component
     * @return View
     */
    public function render(): View
    {
        return view('livewire.crew.role-permissions-info');
    }
}
