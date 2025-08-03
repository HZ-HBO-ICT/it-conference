<?php

namespace App\Actions\Permissions;

use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Symfony\Component\Yaml\Yaml;

class ReadPermissionConfig
{
    /**
     * Reads the roles and permissions from the yml file
     * Originally in the SyncPermissions command but moved to be reused
     * @return array|null
     */
    public function execute(): array|null
    {
        $configFilePath = config_path('permissions/permissions.yml');
        $config = Yaml::parseFile($configFilePath);
        // Validate if roles and permissions sections are present
        if (!isset($config['roles'])) {
            throw new Exception('Error: there are no roles specified!');
        }
        if (!isset($config['permissions'])) {
            throw new Exception('Error: there are no permissions specified!');
        }
        return $config;
    }
}
