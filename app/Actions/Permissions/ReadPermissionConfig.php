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
     * @param string $path
     * @return array|null
     */
    public function execute(string $path): array|null
    {
        $config = Yaml::parseFile($path);
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
