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

<body onload="w3_show_nav('menuProduto')">
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
				$id_produto = $_GET['id'];

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
				$sql = "SELECT ID_Produto, Nome, Descricao, Preco, Estoque, Codigo_Barras, ID_Categoria FROM Produto WHERE ID_Produto = $id_produto";

				//Inicio DIV form
				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = mysqli_query($conn, $sql)) {
					if (mysqli_num_rows($result) == 1) {
						$row = mysqli_fetch_assoc($result);

						$nome = $row['Nome'];
						$descricao = $row['Descricao'];
						$preco = $row['Preco'];
						$estoque = $row['Estoque'];
						$codigo_barras = $row['Codigo_Barras'];
						$id_categoria = $row['ID_Categoria'];
						$nome_categoria = "";
				?>
						<div class="w3-container w3-theme">
							<h2>Altere os dados do Produto Cód. = [<?php echo $id_produto; ?>]</h2>
						</div>
						<form class="w3-container" action="productAtualizar_exe.php" method="post" enctype="multipart/form-data">
							<table class='w3-table-all'>
								<tr>
									<td style="width:50%;">
										<p>
											<input type="hidden" id="ID_Produto" name="ID_Produto" value="<?php echo $id_produto; ?>">
										<p>
											<label class="w3-text-IE"><b>Nome</b></label>
											<input class="w3-input w3-border w3-light-grey" name="Nome" type="text" value="<?php echo $nome; ?>">
										</p>
										<p>
											<label class="w3-text-IE"><b>Descrição</b></label>
											<input class="w3-input w3-border w3-light-grey" name="Descricao" type="text" value="<?php echo $descricao; ?>">
										</p>
										<p>
											<label class="w3-text-IE"><b>Preço</b></label>
											<input class="w3-input w3-border w3-light-grey" name="Preco" type="text" value="<?php echo $preco; ?>">
										</p>
										<p>
											<label class="w3-text-IE"><b>Estoque</b></label>
											<input class="w3-input w3-border w3-light-grey" name="Estoque" type="text" value="<?php echo $estoque; ?>">
										</p>
										<p>
											<label class="w3-text-IE"><b>Código de Barras</b></label>
											<input class="w3-input w3-border w3-light-grey" name="Codigo_Barras" type="text" value="<?php echo $codigo_barras; ?>">
										</p>
										<p>
											<label class="w3-text-IE"><b>Categoria</b>*</label>
											<select class="w3-input w3-border w3-light-grey" name="Id_Categoria" required>
												<!-- Exibe a categoria atual como a opção selecionada -->
												<option value="<?php echo $id_categoria; ?>" selected><?php echo $nome_categoria; ?></option>

												<?php
												// Faz Select para obter todas as categorias
												$sql = "SELECT ID_Categoria, Nome FROM Categoria";
												$result = mysqli_query($conn, $sql);

												if ($result && mysqli_num_rows($result) > 0) {
													while ($row = mysqli_fetch_assoc($result)) {
														$id_cat = $row["ID_Categoria"];
														$nome_cat = $row["Nome_categoria"];

														// Evita que a categoria atual seja duplicada na lista
														if ($id_cat != $id_categoria) {
															echo "<option value='$id_cat'>$nome_cat</option>";
														}
													}
												}
												?>
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