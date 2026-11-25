<?php
// Database connection helper
// Uses PDO with prepared statements only (never raw SQL)

function loadEnv(string $path): array {
    if (!file_exists($path)) return [];
    $env = [];
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === "" || str_starts_with($line, "#")) continue;
        if (!str_contains($line, "=")) continue;
        [$k, $v] = explode("=", $line, 2);
        $env[trim($k)] = trim($v);
    }
    return $env;
}

function getDb(): PDO {
    static $pdo = null;
    if ($pdo !== null) return $pdo;

    $env = loadEnv(__DIR__ . "/../.env");
    if (empty($env)) $env = loadEnv(__DIR__ . "/../.env.example");

    $host = $env["DB_HOST"] ?? "localhost";
    $port = $env["DB_PORT"] ?? "3306";
    $name = $env["DB_NAME"] ?? "turkmen_ai";
    $user = $env["DB_USER"] ?? "root";
    $pass = $env["DB_PASS"] ?? "";

    $dsn = "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
    return $pdo;
}