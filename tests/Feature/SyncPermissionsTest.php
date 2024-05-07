<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SyncPermissionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_one_role()
    {
        // Arrange some YAML: one role, no permissions
        $config = <<<'config'
        roles:
            - name: admin
              guard_name: web
        permissions: []
        config;
        // Mock the Storage facade so it returns the given YAML
        Storage::shouldReceive('get')
            ->with('config/permissions.yml')
            ->andReturn($config);

        $this->artisan('app:sync-permissions')->assertExitCode(0);

        $this->assertDatabaseCount(Role::class, 1);
        $this->assertDatabaseHas(Role::class, [
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
    }

    public function test_it_updates_one_role()
    {
        // Arrange one role in DB
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        // Arrange some YAML: updates the guard_name of existing role
        $config = <<<'config'
        roles:
            - name: admin
              guard_name: api
        permissions: []
        config;

        Storage::shouldReceive('get')
            ->with('config/permissions.yml')
            ->andReturn($config);

        $this->artisan('app:sync-permissions')->assertExitCode(0);

        // Assert there is nothing added
        $this->assertDatabaseCount(Role::class, 1);
        $this->assertDatabaseHas('roles', [
            'name' => 'admin',
            'guard_name' => 'api'
        ]);
        $this->assertDatabaseMissing('roles', [
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
    }

    public function test_it_adds_and_updates_roles()
    {
        // Arrange two roles in DB
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'user',
            'guard_name' => 'api'
        ]);
        // Arrange some YAML: admin with no changes, new editor and user that is updated
        $config = <<<'config'
        roles:
          - name: admin   # The admin role has the highest level of access.
            guard_name: web # web is considered the default guard name
          - name: editor  # The editor role has the second highest level of access.
            guard_name: web # web is considered the default guard name
          - name: user    # The user role has the lowest level of access.
            guard_name: web # web is considered the default guard name
        permissions: []
        config;
        // Mock the Storage facade so it returns the given YAML
        Storage::shouldReceive('get')
            ->with('config/permissions.yml')
            ->andReturn($config);

        $this->artisan('app:sync-permissions')->assertExitCode(0);

        $this->assertDatabaseCount(Role::class, 3);
        $this->assertDatabaseHas(Role::class, [
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        $this->assertDatabaseHas(Role::class, [
            'name' => 'editor',
            'guard_name' => 'web'
        ]);
        $this->assertDatabaseHas(Role::class, [
            'name' => 'user',
            'guard_name' => 'web'
        ]);
    }

    public function test_it_deletes_one_role()
    {
        // Arrange one role in DB
        $to_be_removed = Role::create([
            'name' => 'te_be_removed',
            'guard_name' => 'web'
        ]);
        // Arrange some YAML: no roles and permissions
        $config = <<<'config'
        roles: []
        permissions: []
        config;
        // Mock the Storage facade so it returns the given YAML
        Storage::shouldReceive('get')
            ->with('config/permissions.yml')
            ->andReturn($config);

        $this->artisan('app:sync-permissions')->assertExitCode(0);

        $this->assertDatabaseCount(Role::class, 0);
        $this->assertDatabaseMissing('roles', $to_be_removed->toArray());
    }

    public function test_it_creates_one_atomic_permission_with_one_role()
    {
        // Arrange some YAML: one role and one permission
        $config = <<<'config'
        roles:
          - name: admin   # The admin role has the highest level of access.
            guard_name: web # web is considered the default guard name
        permissions:
          format-disk: admin
        config;
        // Mock the Storage facade so it returns the given YAML
        Storage::shouldReceive('get')
            ->with('config/permissions.yml')
            ->andReturn($config);

        $this->artisan('app:sync-permissions')->assertExitCode(0);

        // Assert if the permission exists
        $permission = Permission::findByName('format-disk');
        $this->assertNotNull($permission);
        // Assert if the permission is associated with the given role
        $this->assertContains('admin', $permission->getRoleNames());
    }

    public function test_it_creates_one_atomic_permission_with_two_roles_as_an_array()
    {
        // Arrange some YAML: one role and one permission
        $config = <<<'config'
        roles:
          - name: admin   # The admin role has the highest level of access.
            guard_name: web # web is considered the default guard name
          - name: editor  # The editor role has the second highest level of access.
            guard_name: web # web is considered the default guard name
        permissions:
          format-disk: [admin, editor]
        config;
        // Mock the Storage facade so it returns the given YAML
        Storage::shouldReceive('get')
            ->with('config/permissions.yml')
            ->andReturn($config);

        $this->artisan('app:sync-permissions')->assertExitCode(0);

        // Assert if the permission exists
        $permission = Permission::findByName('format-disk');
        $this->assertNotNull($permission);
        // Assert if the permission is associated with the given role
        $this->assertContains('admin', $permission->getRoleNames());
        $this->assertContains('editor', $permission->getRoleNames());
    }

    public function test_it_creates_one_atomic_permission_with_two_roles_as_a_sequence()
    {
        // Arrange some YAML: one role and one permission
        $config = <<<'config'
        roles:
          - name: admin   # The admin role has the highest level of access.
            guard_name: web # web is considered the default guard name
          - name: editor  # The editor role has the second highest level of access.
            guard_name: web # web is considered the default guard name
        permissions:
          format-disk:
            - admin
            - editor
        config;
        // Mock the Storage facade so it returns the given YAML
        Storage::shouldReceive('get')
            ->with('config/permissions.yml')
            ->andReturn($config);

        $this->artisan('app:sync-permissions')->assertExitCode(0);

        // Assert if the permission exists
        $permission = Permission::findByName('format-disk');
        $this->assertNotNull($permission);
        // Assert if the permission is associated with the given role
        $this->assertContains('admin', $permission->getRoleNames());
        $this->assertContains('editor', $permission->getRoleNames());
    }

    public function test_it_creates_one_nested_permission_with_one_role()
    {
        // Arrange some YAML: one role and one permission
        $config = <<<'config'
        roles:
          - name: admin   # The admin role has the highest level of access.
            guard_name: web # web is considered the default guard name
        permissions:
          article:
            create: admin
        config;
        // Mock the Storage facade so it returns the given YAML
        Storage::shouldReceive('get')
            ->with('config/permissions.yml')
            ->andReturn($config);

        $this->artisan('app:sync-permissions')->assertExitCode(0);

        // Assert if the permission exists
        $permission = Permission::findByName('create-article');
        $this->assertNotNull($permission);
        // Assert if the permission is associated with the given role
        $this->assertContains('admin', $permission->getRoleNames());
    }

    public function test_it_creates_one_nested_permission_with_two_roles_as_an_array()
    {
        // Arrange some YAML: one role and one permission
        $config = <<<'config'
        roles:
          - name: admin   # The admin role has the highest level of access.
            guard_name: web # web is considered the default guard name
          - name: editor  # The editor role has the second highest level of access.
            guard_name: web # web is considered the default guard name
        permissions:
          article:
            create: [admin, editor]
        config;
        // Mock the Storage facade so it returns the given YAML
        Storage::shouldReceive('get')
            ->with('config/permissions.yml')
            ->andReturn($config);

        $this->artisan('app:sync-permissions')->assertExitCode(0);

        // Assert if the permission exists
        $permission = Permission::findByName('create-article');
        $this->assertNotNull($permission);
        // Assert if the permission is associated with the given role
        $this->assertContains('admin', $permission->getRoleNames());
        $this->assertContains('editor', $permission->getRoleNames());
    }

    public function test_it_creates_one_nested_permission_with_two_roles_as_a_sequence()
    {
        // Arrange some YAML: one role and one permission
        $config = <<<'config'
        roles:
          - name: admin   # The admin role has the highest level of access.
            guard_name: web # web is considered the default guard name
          - name: editor  # The editor role has the second highest level of access.
            guard_name: web # web is considered the default guard name
        permissions:
          article:
            create:
              - admin
              - editor
        config;
        // Mock the Storage facade so it returns the given YAML
        Storage::shouldReceive('get')
            ->with('config/permissions.yml')
            ->andReturn($config);

        $this->artisan('app:sync-permissions')->assertExitCode(0);

        // Assert if the permission exists
        $permission = Permission::findByName('create-article');
        $this->assertNotNull($permission);
        // Assert if the permission is associated with the given role
        $this->assertContains('admin', $permission->getRoleNames());
        $this->assertContains('editor', $permission->getRoleNames());
    }

    public function test_it_adds_permissions()
    {
        // Arrange some YAML with different configuration options
        $config = <<<'config'
        roles:
          - name: admin   # The admin role has the highest level of access.
            guard_name: web # web is considered the default guard name
          - name: editor  # The editor role has the second highest level of access.
            guard_name: web # web is considered the default guard name
          - name: user    # The user role has the lowest level of access.
            guard_name: web # web is considered the default guard name
        permissions:
          permission1: [admin]
          resource1:
            action1: [editor, user]
            action2: [admin, editor, user]
        config;
        // Mock the Storage facade so it returns the given YAML
        Storage::shouldReceive('get')
            ->once()
            ->with('config/permissions.yml')
            ->andReturn($config);

        $this->artisan('app:sync-permissions')->assertExitCode(0);

        $this->assertDatabaseCount(Permission::class, 3);

        $permission = Permission::findByName('permission1');
        $this->assertNotNull($permission);
        $this->assertContains('admin', $permission->getRoleNames());
        $this->assertNotContains('editor', $permission->getRoleNames());
        $this->assertNotContains('user', $permission->getRoleNames());

        $permission = Permission::findByName('action1-resource1');
        $this->assertNotNull($permission);
        $this->assertNotContains('admin', $permission->getRoleNames());
        $this->assertContains('editor', $permission->getRoleNames());
        $this->assertContains('user', $permission->getRoleNames());

        $permission = Permission::findByName('action2-resource1');
        $this->assertNotNull($permission);
        $this->assertContains('admin', $permission->getRoleNames());
        $this->assertContains('editor', $permission->getRoleNames());
        $this->assertContains('user', $permission->getRoleNames());
    }

    public function test_it_updates_permissions()
    {
        // Create some roles and permissions
        Role::findOrCreate('admin');
        Role::findOrCreate('editor');

        $permission1 = Permission::findOrCreate('permission1');
        $permission1->syncRoles(['admin', 'editor']); // one role will be removed
        $permission2 = Permission::findOrCreate('permission2');
        $permission2->syncRoles(['admin']); // one role will be added
        $permission3 = Permission::findOrCreate('permission3'); // entire permission will be removed
        $permission3->syncRoles(['admin']);

        // Arrange some YAML with different configuration options
        $config = <<<'config'
        roles:
          - name: admin   # The admin role has the highest level of access.
            guard_name: web # web is considered the default guard name
          - name: editor  # The editor role has the second highest level of access.
            guard_name: web # web is considered the default guard name
        permissions:
          permission1: [admin]
          permission2: [admin, editor]
        config;
        // Mock the Storage facade so it returns the given YAML
        Storage::shouldReceive('get')
            ->once()
            ->with('config/permissions.yml')
            ->andReturn($config);

        $this->artisan('app:sync-permissions')->assertExitCode(0);

        $this->assertDatabaseCount(Permission::class, 2);

        $permission = Permission::findByName('permission1');
        $this->assertNotNull($permission);
        $this->assertContains('admin', $permission->getRoleNames());
        $this->assertNotContains('editor', $permission->getRoleNames());

        $permission = Permission::findByName('permission2');
        $this->assertNotNull($permission);
        $this->assertContains('admin', $permission->getRoleNames());
        $this->assertContains('editor', $permission->getRoleNames());

        $this->assertDatabaseMissing(Permission::class, [
            'name' => 'permission3'
        ]);
    }

    public function test_it_notifies_the_user_when_no_roles_are_present()
    {
        $config = 'permissions: []';
        Storage::shouldReceive('get')
            ->with('config/permissions.yml')
            ->andReturn($config);

        $this->artisan('app:sync-permissions')
            ->expectsOutputToContain('Error')
            ->assertFailed();
    }

    public function test_it_notifies_the_user_when_no_permissions_are_present()
    {
        $config = 'roles: []';
        Storage::shouldReceive('get')
            ->with('config/permissions.yml')
            ->andReturn($config);

        $this->artisan('app:sync-permissions')
            ->expectsOutputToContain('Error')
            ->assertFailed();
    }
}
