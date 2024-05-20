<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    protected $crewPermissions = [
        'view company list',
        'create company',
        'view company details',
        'edit company details',
        'view company approval status',
        'edit company approval status',
        'view company sponsorship status',
        'edit company sponsorship status',
        'view company members',
        'delete company',
        'view presentation list',
        'create presentation',
        'view presentation',
        'edit presentation',
        'view presentation approval status',
        'edit presentation approval status',
        'view presentation participants',
        'delete presentation',
        'view booth list',
        'create booth',
        'view booth',
        'edit booth',
        'delete booth',
        'view booth approval status',
        'edit booth approval status',
        'view sponsorship list',
        'create sponsorship',
        'view sponsorship',
        'view sponsorship approval status',
        'edit sponsorship approval status',
        'delete sponsorship',
        'create crew invitation',
        'edit crew',
        'view room list',
        'create room',
        'edit room',
        'view room',
        'delete room',
        'edit schedule',
        'view schedule'
    ];

    protected $companyRepPermissions = [
        'view company index',
        'view company details',
        'edit company details',
        'view company members',
        'edit company members',
        'view member invitations',
        'create member invitation',
        'delete member invitation',
        'delete company members',
        'create booth request',
        'create sponsorship request',
        'create presentation request',
        'request company delete'
    ];

    protected $companyMemPermissions =
        ['view company index', 'view company details', 'view company members'];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyRepPermissions = array_diff($this->companyRepPermissions, $this->companyMemPermissions);

        $speaker = Role::findByName('speaker');
        $booth_owner = Role::findByName('booth owner');
        $representative = Role::findByName('company representative');

        foreach ($this->companyMemPermissions as $permissionName) {
            $permission = Permission::create(['name' => $permissionName]);
            $representative->givePermissionTo($permission);
            $speaker->givePermissionTo($permission);
            $booth_owner->givePermissionTo($permission);
        }
        foreach ($companyRepPermissions as $permission) {
            $representative->givePermissionTo(Permission::create(['name' => $permission]));
        }

        $role = Role::firstOrCreate(['name' => 'event organizer']);
        foreach ($this->crewPermissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $role->givePermissionTo($permission);
        }
    }
}
