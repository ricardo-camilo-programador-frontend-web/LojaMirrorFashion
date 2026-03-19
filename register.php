<div class="container p-1"><!--TUDO-->
	<?php
	$cabecalho_title='Login/Cadastro';
	include("cabecalho_bootstrap.php");
	require_once 'config/database.php';
	?>
	<head>
		<link rel="stylesheet" href="css/keyframes.css">
	</head>

	<div class="container mt-2 col-md-7""><!--janela principal inicio">


		<div class=" text-center " ><!--2-->	
			<div class="container text-cente" >
				<?php

				$user_register_name = trim($_POST['mirror_name_register'] ?? '');
				$user_register_mail = trim($_POST['mirror_email_register'] ?? '');
				$user_register_password = $_POST['mirror_password_register'] ?? '';
				$user_register_phone = trim($_POST['mirror_register_phone'] ?? '');

				if(isset($_POST['btn_register'])):
					if(empty($user_register_name)||empty($user_register_mail)||empty($user_register_password)){
						echo'
						<div class="text-center">
						<p class="border border-warning p-2 text-dark  rounded">
						Por favor preencha todos os campos com * !
						</p>
						</div>
						';
					}else{
						// Check if email already exists
						$existingUser = fetchOne("SELECT user_mail FROM users WHERE user_mail = ?", [$user_register_mail]);
						
						if ($existingUser) {
							echo'
							<div class="text-center">
							<p class="border border-danger p-2 text-danger  rounded">
							Este email já está cadastrado!
							</p>
							</div>
							';
						} else {
							// Insert new user using PDO prepared statement
							$sql_register = "INSERT INTO users(user_name, user_mail, mirror_user_phone, user_password) VALUES (?, ?, ?, md5(?))";
							$result = execute($sql_register, [$user_register_name, $user_register_mail, $user_register_phone, $user_register_password]);

							if ($result > 0) {
								echo'
								<div class="text-center">
								<p class="border border-success p-2 text-success  rounded">
								Cadastro efetuado com sucesso !!
								</p>
								</div>
								';
							} else {
								echo'
								<div class="text-center">
								<p class="border border-danger p-2 text-danger  rounded">
								Erro ao cadastrar. Tente novamente.
								</p>
								</div>
								';
							}
						}
						unset($_POST); 
						exit;
					};
				endif;


				?>	
			</div>
						';
					}else{

						$sql_register="INSERT INTO users(user_name,user_mail,mirror_user_phone,user_password) VALUES ('$user_register_name','$user_register_mail','$user_register_phone',md5($user_register_password))";
						$rs = mysqli_query($conexao, $sql_register);
						mysqli_close($conexao);

						echo'
						<div class="text-center">
						<p class="border border-success p-2 text-success  rounded">
						Cadastro efetuado com sucesso !!
						</p>
						</div>
						';
						unset($_POST); 

						exit;
					};
				endif;


				?>	
			</div>

			<div id="mirror_form_register" class="text-left card p-3" >



				<form  method="POST" action="register.php"><!--formulario para cadastro-->
					<div class="p-2 form-group">
						<label class="card-title"  for="mirror_name_register"><i class="fas fa-file-signature"> Nome *</i></label>
						<input class="mb-1 form-control" id="mirror_name_register" name="mirror_name_register" type="text" placeholder="Meng Hao">
					</div>
					<div class="p-2 form-group">
						<label class="card-title"  for="mirror_email_register"><i class="fas fa-envelope"> Email *</i> </label>
						<input class="mb-1 form-control" id="mirror_email_register" name="mirror_email_register" type="text" placeholder="TrueImmortalEmail@NoveReinos.cultivo">
					</div>
					<div class="p-2 form-group">
						<label class="card-title"  for="mirror_register_phone"><i class="fas fa-phone"> Telefone</i> </label>
						<input class="form-control" id="mirror_register_phone" name="mirror_register_phone" type="text" placeholder="14998478537">
					</div>
					<div class="p-2 form-group">
						<label class="card-title"  for="mirror_password_register"><i class="fas fa-key"> Senha *</i></label>
						<input class="form-control" id="mirror_password_register" name="mirror_password_register" type="password" placeholder="123456">
					</div>
					<div class=" d-flex align-items-center justify-content-center p-2">
						<button class="btn btn-primary btn-lg" name="btn_register">CADASTRAR <i class="fas fa-hand-pointer"></i></button>		
					</div>
				</form><!--/formulario para cadastro-->
			</div>
		</div><!--/janela principal inicio-->



		<div class="p-5 mb-5"><!--para contornar a sobreposição do footer-->
		</div>
	</div>

	<?php
	include("rodape_bootstrap.php")
	?>