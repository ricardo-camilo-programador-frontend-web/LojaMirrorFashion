<?php
require_once 'config/database.php';

$client_name = $_POST['client_name'] ?? '';
$client_email = $_POST['client_email'] ?? '';
$client_cpf = $_POST['client_cpf'] ?? '';
$client_card = $_POST['client_card'] ?? '';
$client_flag = $_POST['client_flag'] ?? '';
$client_card_expiring_date = $_POST['client_card_expiring_date'] ?? '';
$sale_date = date("d,m,Y, H:i");
$client_newsletter = $_POST['client_newsletter'] ?? '';
$clothing_id = (int)($_POST['clothing_id2'] ?? 0);
$clothing_name = $_POST['clothing_name2'] ?? '';
$clothing_color = $_POST['clothing_color2'] ?? '';
$clothing_size = $_POST['clothing_size2'] ?? '';
$clothing_quantity = (int)($_POST['clothing_quantity'] ?? 1);
$clothing_total_price = $_POST['clothing_total_price'] ?? '';

$sql = "
INSERT INTO sales_details(
    clothing_sale_code,
    client_name,
    client_email,
    client_cpf,
    client_card,
    client_flag,
    client_card_expiring_date,
    sale_date,
    client_newsletter,
    clothing_id,
    clothing_name,
    clothing_color,
    clothing_size,
    clothing_quantity,
    clothing_total_price)
VALUES (
    clothing_sale_code,
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

try {
    $result = execute($sql, [
        $client_name,
        $client_email,
        $client_cpf,
        $client_card,
        $client_flag,
        $client_card_expiring_date,
        $sale_date,
        $client_newsletter,
        $clothing_id,
        $clothing_name,
        $clothing_color,
        $clothing_size,
        $clothing_quantity,
        $clothing_quantity
    ]);
    
    if ($result > 0) {
        echo "
        <h1>Compra Confirmada!</h1>
        <p>Obrigado por comprar na Mirror Fashion!</p>
        <p><strong>Cliente:</strong> $client_name</p>
        <p><strong>Email:</strong> $client_email</p>
        <p><strong>Produto:</strong> $clothing_name</p>
        <p><strong>Quantidade:</strong> $clothing_quantity</p>
        <p><strong>Total:</strong> $clothing_total_price</p>
        ";
    } else {
        echo "<p class='text-danger'>Erro ao processar compra. Tente novamente.</p>";
    }
} catch (Exception $e) {
    error_log('Checkout error: ' . $e->getMessage());
    echo "<p class='text-danger'>Erro ao processar compra. Tente novamente mais tarde.</p>";
}
?>