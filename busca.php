<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Todos os Produtos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 	<!-- Bootstrap 4 online -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

 	<!-- Icone no topo da aba da pagina -->
	<link rel="icon" href="img/nastari-editores-logo-rodape.png">

 	<!-- Css Pessoal -->
	<link rel="stylesheet" type="text/css" href="css/orni.css">

	  <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
	
	<?php
		require_once 'config/database.php';
	?>

<header class="container">
	<div class="row">

		<div class="col-md-4">
			<a href="index.php">
				<img class='navbar-brand img-fluid' src="img/logo.png" alt="Mirror	Fashion">
			</a> 

		</div>

		<div class='col-md-8'>
			<div class='d-flex justify-content-end'>
				<a class="bandeira" href="index.php">
					<img class='img-thumbnail' src="img/BR.png">
				</a>
				<a class="bandeira" href="english/index.php">
					<img class='img-thumbnail' src="img/GB.png">
				</a>

			</div>
			<div class='d-flex justify-content-end mt-1'>
				<p	class="mr-1">Nenhum	item	na	sacola	de	compras</p>
				<img class='img-fluid' src="img/sacola.png">
			</div>
			<nav class="navbar border d-flex justify-content-center border-primary">
				<ul class='nav nav-pills navbar-right'>
					<li class='nav-item'>
						<a class='nav-link' href="#">Sua Conta</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href="#">Lista de Desejos</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href="#">Cartão Fidelidade</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href="sobre.php">Sobre</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href="#">Ajuda</a>
					</li>
				</ul>
			</nav>
		</div>	
	</div>
</header>


<div class='d-flex justify-content-center'>
	<div class='container  row mt-2'>
	<?php
		$arr = array( "a"=>"azul", "b"=>"verde", "c"=>"rosa");
		$pesquisa = trim($_GET['txtbusca'] ?? '');
		
		// Use PDO with prepared statement to prevent SQL injection
		$buscaD = fetchAll("SELECT * FROM produtos WHERE nome LIKE ?", ['%' . $pesquisa . '%']);

		foreach($buscaD as $p):

	?>
	
		<div class=" col-md-4 ">
			<div>
				
				<a class="nav-link text-dark" href="produto.php?id=<?= $p['id'] ?>">
					
					<img class='img-fluid' src='img/produtos/foto<?= $p['id'] ?>-<?= $arr[array_rand($arr)] ?>.png'>
					<div class="border">
						<p class="card-header mb-1"><?= $p['nome'] ?></p>
						<div class="d-flex justify-content-center">
						<p ><?= $p['preco'] ?></p>
						</div>
					</div>
					
				</a>
			</div>

		</div>


	
	<?php
		endforeach;
	?>



</div>

</div>

</body>
</html>