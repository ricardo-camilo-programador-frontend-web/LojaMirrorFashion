<div class="container p-1"><!--TUDO-->
<?php
$cabecalho_title='Login/Cadastro';
include("cabecalho_bootstrap.php");
require_once 'config/database.php';
//Sessão
session_start();

//Botão enviar
if (isset($_POST['btn_login'])):
	$errors=array();
	$login = trim($_POST['user_mail'] ?? '');
	$senha = $_POST['user_password'] ?? '';

	if(empty($login) or empty($senha)):
		$errors[]="
				<div class='text-center mt-2'>
					<p class='border border-danger p-2 text-danger  rounded'>
						O campo login/senha precisa ser preenchido.
					</p>
				</div>";
	else:
		// Check if user exists using PDO with prepared statement
		$sql = "SELECT user_mail FROM users WHERE user_mail = ?";
		$resultado = fetchOne($sql, [$login]);
		
		if($resultado):
			// Verify password (still using md5 for backward compatibility)
			$senhaHash = md5($senha);
			$sql = "SELECT * FROM users WHERE user_mail = ? AND user_password = ?";
			$dados = fetchOne($sql, [$login, $senhaHash]);

			if ($dados):
				$_SESSION['logado'] = true;
				$_SESSION['user_code']=$dados['user_code'];
				$_SESSION['user_name'] = $dados['user_name'];
				$_SESSION['user_mail'] = $dados['user_mail'];
				header('Location: user_connected.php');
				exit;
			else:
				$errors[]="
				<div class='text-center mt-2'>
					<p class='border border-danger p-2 text-danger  rounded'>
						Usuario e senha não conferem.
					</p>
				</div>";
			endif;
		else:
			$errors[] ="
					<div class='text-center mt-2'>
						<p class='border border-danger p-2 text-danger  rounded'>
							Usuário inexistente
						</p>
					</div>";
		endif;

endif;
endif;
?>
<head>
	<link rel="stylesheet" href="css/keyframes.css">
</head>

<div class="container mt-5 mb-5 pb-5"><!--janela principal inicio-->

	<div class="container text-center col-md-4 col-md-offset-3 mb-5 div_form_loggin_register" ><!--2-->

		<div  id="mirror_form_login"><!--formulario para login-->
			<!--imagem clikavel do espelho inicio-->

			<div id="panda-login" class=" d-flex align-items-center justify-content-center">
				<a href="index.php">
					<img class="w-50" src="img/round_mirror.png" alt="">
				</a>	
			</div><!--imagem clikavel do espelho fim-->
			<form method="POST" action="login.php">
				<?php
					if(!empty($errors)):
						foreach($errors as $error):
							echo $error;
						endforeach;
					endif;
				?>
				<div class="p-2">
					<label  for="user_mail"><i class="fas fa-envelope"> Email</i></label>
					<input class="mb-1 form-control" id="user_mail" name="user_mail" type="text" placeholder="TrueImmortalEmail@NovesReinos.cultivo">
				</div>
				
				<div class="p-2">
					<label  for="panssword"><i class="fas fa-key"> Senha</i></label>
					<input class="form-control" id="user_password" name="user_password" type="password" placeholder="Texto Misterioso">
				</div>				


				<div class=" d-flex align-items-center justify-content-center">
					<button class="btn btn-primary btn-lg" name="btn_login">LOGAR</button>		
				</div>						
			</form><!--/formulario para login-->
		</div>
		


	</div><!--janela principal inicio-->

	<div class="p-5 mb-5"><!--para contornar a sobreposição do footer-->
	</div>

</div>


	<?php
	include("rodape_bootstrap.php")
	?>