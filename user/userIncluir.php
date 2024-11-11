<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Agosto/2022
---------------------------------------------------------------------------------->
<!-- medIncluir.php -->

<html>

<head>

	<title>Clínica Médica ABC</title>
	  <link rel="icon" type="image/png" href="../images/favicon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" href="../css/customize.css">

</head>

<body onload="w3_show_nav('menuUsuario')">

	<!-- Inclui MENU.PHP  -->
	<?php require '../geral/menu.php'; ?>
	<?php require '../bd/conectaBD.php'; ?>

	<!-- Conteúdo Principal: deslocado paa direita em 270 pixels quando a sidebar é visível -->
	<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

		<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
			<!-- h1 class="w3-xxlarge">Contratação de Médico</h1 -->
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

				?>

				<div class="w3-responsive w3-card-4">
					<div class="w3-container w3-theme">
						<h2>Informe os dados do novo do Usuário</h2>
					</div>
					<form class="w3-container" action="userIncluir_exe.php" method="post" enctype="multipart/form-data">
						<table class='w3-table-all'>
							<tr>
								<td style="width:50%;">
									<p>
										<label class="w3-text-IE"><b>Nome</b>*</label>
										<input class="w3-input w3-border w3-light-grey" type="text" name="Nome" required>
									</p>
									<p>
										<label class="w3-text-IE"><b>Email</b>*</label>
										<input class="w3-input w3-border w3-light-grey" type="email" name="Email" required>
									</p>
									<p>
										<label class="w3-text-IE"><b>Senha</b>*</label>
										<input class="w3-input w3-border w3-light-grey" type="password" name="Senha" required>
									</p>
									<p>
										<label class="w3-text-IE"><b>Endereço</b>*</label>
										<input class="w3-input w3-border w3-light-grey" type="text" name="Endereco" required>
									</p>
									<p>
										<label class="w3-text-IE"><b>Celular</b>*</label>
										<input class="w3-input w3-border w3-light-grey" type="text" name="Celular" required>
									</p>
									<p>
										<label class="w3-text-IE"><b>Tipo</b>*</label>
										<select class="w3-select w3-border w3-light-grey" name="Tipo" required>
											<option value="1">Administrador</option>
											<option value="2">Usuário</option>
										</select>
									</p>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="text-align:center">
									<p>
										<input type="submit" value="Salvar" class="w3-btn w3-theme">
										<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='userListar.php'">
									</p>
								</td>
							</tr>
						</table>
					</form>
					<br>
				</div>
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