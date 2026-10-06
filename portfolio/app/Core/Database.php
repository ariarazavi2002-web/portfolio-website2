<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use RuntimeException;

final class Database
{
    private static ?PDO $connection = null;

    public static function connect(?array $config = null): PDO
    {
        if (self::$connection !== null) {
            return self::$connection;
        }

        if ($config === null) {
            $configFile = BASE_PATH . '/config/database.php';
            if (!is_file($configFile)) {
                throw new RuntimeException("Database config file not found: [{$configFile}]");
            }
            $config = require $configFile;
        }

        $driver = $config['driver'] ?? 'mysql';
        $host = $config['host'] ?? '127.0.0.1';
        $port = $config['port'] ?? 3306;
        $database = $config['database'] ?? '';
        $charset = $config['charset'] ?? 'utf8mb4';
        $username = $config['username'] ?? 'root';
        $password = $config['password'] ?? '';
        $options = $config['options'] ?? [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $dsn = "{$driver}:host={$host};port={$port};dbname={$database};charset={$charset}";

        self::$connection = new PDO($dsn, $username, $password, $options);

        return self::$connection;
    }

    public static function disconnect(): void
    {
        self::$connection = null;
    }
}
