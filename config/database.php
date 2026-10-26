<?php
/**
 * Database Configuration - PDO Connection
 * 
 * Migração de mysqli para PDO com prepared statements
 * para maior segurança contra SQL Injection
 */

// Database configuration
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'wd43');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

/**
 * Get PDO connection instance
 * 
 * @return PDO
 * @throws PDOException
 */
function getPDOConnection(): PDO {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                DB_HOST,
                DB_NAME,
                DB_CHARSET
            );
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ];
            
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log('Database connection failed: ' . $e->getMessage());
            die('Erro de conexão com o banco de dados. Tente novamente mais tarde.');
        }
    }
    
    return $pdo;
}

/**
 * Execute a query and return all results
 * 
 * @param string $sql SQL query
 * @param array $params Parameters for prepared statement
 * @return array
 */
function fetchAll(string $sql, array $params = []): array {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/**
 * Execute a query and return single row
 * 
 * @param string $sql SQL query
 * @param array $params Parameters for prepared statement
 * @return array|false
 */
function fetchOne(string $sql, array $params = []): array|false {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch();
}

/**
 * Execute a query and return single value
 * 
 * @param string $sql SQL query
 * @param array $params Parameters for prepared statement
 * @return mixed
 */
function fetchColumn(string $sql, array $params = []): mixed {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn();
}

/**
 * Execute INSERT, UPDATE, DELETE
 * 
 * @param string $sql SQL query
 * @param array $params Parameters for prepared statement
 * @return int Number of affected rows
 */
function execute(string $sql, array $params = []): int {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->rowCount();
}

/**
 * Get last inserted ID
 * 
 * @return string
 */
function lastInsertId(): string {
    return getPDOConnection()->lastInsertId();
}

// For backward compatibility - global connection variable
$conexao = getPDOConnection();
?>
