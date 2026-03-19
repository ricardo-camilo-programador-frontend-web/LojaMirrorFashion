<?php

require_once 'config/database.php';

// Get product by ID using PDO with prepared statement (prevents SQL injection)
$produto_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$produtos = fetchOne("SELECT * FROM produtos WHERE id = ?", [$produto_id]);

if (!$produtos) {
    header('Location: index.php');
    exit;
}

$cabecalho_title='Mirror Fashion';
$cabecalho_css='<link rel="stylesheet" type="text/css" href="css/produto.css">';
include("cabecalho.php");
?>



<script type="text/javascript" src="js/produto.js"></script>
<div class="produto-back">
	<div class="container">
		<div class="produto">
			<h1><?= $produtos['nome']?></h1>
			<p><?= $produtos['preco']?></p>

			<form action="checkout.php" method="POST">
				<fieldset class="cores">
					<legend>Escolha a cor</legend>

					<input	type="radio" name="cor" id="verde" checked value="verde">
					<label for="verde" >
						<img src="img/produtos/foto<?= $produtos['id']?>-verde.png" alt="Produto na cor verde">
					</label>

					<input	type="radio" name="cor" id="rosa" value="rosa">
					<label for="rosa">
						<img src="img/produtos/foto<?= $produtos['id']?>-rosa.png" alt="Produto na cor rosa">
					</label>

					<input	type="radio" name="cor" id="azul" value="azul">
					<label for="azul">
						<img src="img/produtos/foto<?= $produtos['id']?>-azul.png" alt="Produto na cor azul">
					</label>

				</fieldset>

				<fieldset class="tamanhos">
					<legend>Escolha o Tamanho:</legend>
					<input type="range" min="36" max="46" step="2" name="tamanho" id="tamanho">
					<output	for="tamanho" name="valortamanho" id="valortamanho">42 </output>
				</fieldset>

				<!--valores ocultos dos detalhes da compra para serem enviados a pagina checkout -->
				<input type="hidden" name="clothing_name" value="<?= $produtos['nome']?>">	
				<input type="hidden" name="clothing_id" value="<?= $produtos['id']?>">
				<input type="hidden" name="clothing_price" value="<?= $produtos['preco']?>">
				<!--/valores ocultos dos detalhes da compra para serem enviados a pagina checkout -->

				<input type="submit" class="comprar" value="Comprar">
			</form>	

			<table>
				<caption>Quantidade e preço de camisetas.</caption>
				<colgroup>
					<col width="10%">
					<col width="40%">
					<col width="30%">
					<col width="20%">
				</colgroup>

				<thead>
					<tr>
						<th rowpan="2"></th>
						<th colspan="2">Quantidade de Camisetas</th>
						<th rowspan="2">Preço</th>
					</tr>
					<tr>
						<th>Amarela</th>
						<th>Vermelha</th>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<td>
							<td>Total de camisetas amarelas:35</td>
							<td>Total de camisetas amarelas:34</td>
							<td>Valor Total:R$45,00</td>
						</tr>
					</tfoot>

					<tbody>
						<tr>
							<td>Polo</td>
							<td>12</td>
							<td>5</td>
							<td>R$30,00</td>
						</tr>
						<tr>
							<td>Regata</td>
							<td>23</td>
							<td>29</td>
							<td>R$15,00</td>
						</tr>
					</tbody>
				</table>	
			</div>

			<div class="detalhes">
				<h2>Detalhes	do	produto</h2>

				<p><!--descricao do produto-->
					<?= $produtos['descricao']?>
				</p><!--/descricao do produto-->

				<table>
					<thead>
						<tr>
							<th>Característica</th>
							<th>Detalhe</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Modelo</td>
							<td>Cardigã 7845</td>
						</tr>
						<tr>
							<td>Cores</td>
							<td>Azul, Rosa e Verde</td>
						</tr>
						<tr>
							<td>Lavagem</td>
							<td>Lavar a mão</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
	</div>



	<?php
	include("rodape.php")
	?>

</body>

</html>