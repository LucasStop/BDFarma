<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Agosto/2022
---------------------------------------------------------------------------------->
<!-- userAtualizar.php -->

<html>

<head>
	<title>PUC Farma</title>
	<link rel="icon" type="image/png" href="../images/favicon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="../css/customize.css">
</head>

<body onload="w3_show_nav('menuUsuario')">
	<!-- Inclui MENU.PHP  -->
	<?php require '../geral/menu.php'; ?>
	<?php require '../bd/conectaBD.php'; ?>

	<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
	<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">
		<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
			<p class="w3-large">
			<div class="w3-code cssHigh notranslate">
				<!-- Acesso em:-->
				<?php

				date_default_timezone_set("America/Sao_Paulo");
				$data = date("d/m/Y H:i:s", time());
				echo "<p class='w3-small' > ";
				echo "Acesso em: ";
				echo $data;
				echo "</p> "
				?>

				<!-- Acesso ao BD-->
				<?php
				$id_usuario = $_GET['id'];

				// Cria conexão
				$conn = mysqli_connect($servername, $username, $password, $database);

				// Verifica conexão
				if (!$conn) {
					die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
				}
				// Configura para trabalhar com caracteres acentuados do português	 
				mysqli_query($conn, "SET NAMES 'utf8'");
				mysqli_query($conn, 'SET character_set_connection=utf8');
				mysqli_query($conn, 'SET character_set_client=utf8');
				mysqli_query($conn, 'SET character_set_results=utf8');

				// Faz Select na Base de Dados
				$sql = "SELECT ID_Usuario, Nome, Email, Senha, Endereco, Celular, Tipo FROM Usuario WHERE ID_Usuario = $id_usuario";

				//Inicio DIV form
				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = mysqli_query($conn, $sql)) {
					if (mysqli_num_rows($result) == 1) {
						$row = mysqli_fetch_assoc($result);

						$nome = $row['Nome'];
						$email = $row['Email'];
						$senha = $row['Senha'];
						$endereco = $row['Endereco'];
						$celular = $row['Celular'];
						$tipo = $row['Tipo'];

				?>
						<div class="w3-container w3-theme">
							<h2>Altere os dados do Usuário Cód. = [<?php echo $id_usuario; ?>]</h2>
						</div>
						<form class="w3-container" action="userAtualizar_exe.php" method="post" enctype="multipart/form-data">
							<table class='w3-table-all'>
								<tr>
									<td style="width:50%;">
										<p>
											<input type="hidden" id="ID_Usuario" name="ID_Usuario" value="<?php echo $id_usuario; ?>">
										<p>
											<label class="w3-text-IE"><b>Nome</b></label>
											<input class="w3-input w3-border w3-light-grey" name="Nome" type="text" value="<?php echo $nome; ?>">
										</p>
										<p>
											<label class="w3-text-IE"><b>Email</b></label>
											<input class="w3-input w3-border w3-light-grey" name="Email" type="text" value="<?php echo $email; ?>">
										</p>
										<p>
											<label class="w3-text-IE"><b>Senha</b></label>
											<input class="w3-input w3-border w3-light-grey" name="Senha" type="password" value="<?php echo $senha; ?>">
										</p>
										<p>
											<label class="w3-text-IE"><b>Endereço</b></label>
											<input class="w3-input w3-border w3-light-grey" name="Endereco" type="text" value="<?php echo $endereco; ?>">
										</p>
										<p>
											<label class="w3-text-IE"><b>Celular</b></label>
											<input class="w3-input w3-border w3-light-grey" name="Celular" type="text" value="<?php echo $celular; ?>">
										</p>
										<p>
											<label class="w3-text-IE"><b>Tipo</b>*</label>
											<select class="w3-input w3-border w3-light-grey" name="Tipo">
												<!-- Exibe o tipo atual do usuário como opção selecionada -->
												<option value="<?php echo $tipo; ?>" selected><?php echo $tipo; ?></option>

												<!-- Opções adicionais, evitando duplicar o valor atual -->
												<?php if ($tipo != 'Administrador'): ?>
													<option value="Administrador">Administrador</option>
												<?php endif; ?>
												<?php if ($tipo != 'Cliente'): ?>
													<option value="Cliente">Cliente</option>
												<?php endif; ?>
											</select>
										</p>

									</td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center">
										<p>
											<input type="submit" value="Alterar" class="w3-btn w3-red">
											<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='userListar.php'">
										</p>
								</tr>
							</table>
							<br>
						</form>
					<?php
					} else { ?>
						<div class="w3-container w3-theme">
							<h2>Usuário inexistente</h2>
						</div>
						<br>
				<?php
					}
				} else {
					echo "<p style='text-align:center'>Erro executando UPDATE: " . mysqli_error($conn) . "</p>";
				}
				echo "</div>"; //Fim form
				mysqli_close($conn);  //Encerra conexao com o BD
				?>
			</div>
			</p>
		</div>

		<?php require '../geral/sobre.php'; ?>
		<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require '../geral/rodape.php'; ?>

</body>

</html>