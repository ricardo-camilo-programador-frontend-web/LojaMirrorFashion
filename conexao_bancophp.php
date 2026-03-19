<?php
/**
 * Database Connection - PDO Migration
 * 
 * Este arquivo foi migrado de mysqli para PDO
 * para maior segurança com prepared statements
 */

require_once __DIR__ . '/config/database.php';

// Get PDO connection
$conexao = getPDOConnection();

// Fetch all products (for backward compatibility)
$produtos = fetchAll("SELECT * FROM produtos");

// NEW PRODUCTS - Latest 4
$new_products = fetchAll("SELECT * FROM produtos ORDER BY data LIMIT 4");

// TOP SELLERS - Best selling 4
$top_sellers = fetchAll("SELECT * FROM produtos ORDER BY vendas DESC LIMIT 4");
?>
