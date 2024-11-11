<!-- Top -->
<div class="w3-top">
	<div class="w3-row w3-white w3-padding">
		<div class="w3-half" style="margin:0 0 0 0">
			<a href="."><img style='width: 200px' src='../images/logoFarmacia.png' alt='PUC Farma'></a>
		</div>
		<div class="w3-half w3-margin-top w3-wide w3-hide-medium w3-hide-small">
			<div class="w3-right"></div>
		</div>
	</div>
	<div class="w3-bar w3-theme w3-large">
		<a class="w3-bar-item w3-button w3-left w3-hide-large w3-hover-light-gray w3-large w3-theme w3-padding-16" href="javascript:void(0)" onclick="w3_open()">☰</a>
		<!-- Redireciona diretamente para as páginas de lista -->
		<a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-light-gray w3-padding-16" href="../user/userListar.php">Usuários</a>
		<a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-light-gray w3-padding-16" href="../product/productListar.php">Produtos</a>
	</div>
</div>

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-collapse w3-animate-left" style="z-index:3;width:270px; display:none;" id="mySidebar">
	<a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-right w3-xlarge w3-hide-large" title="Close Menu">x</a>

	<!-- Menu de Usuários -->
	<div id="menuUsuario" class="myMenu" style="display:none;">
		<div class="w3-container">
			<h3>Menu de Usuários</h3>
		</div>
		<a class="w3-bar-item w3-button" href="../user/userListar.php">Relação de Usuários</a>
		<a class="w3-bar-item w3-button" href="../user/userIncluir.php">Cadastro de Usuários</a>
	</div>

	<!-- Menu de Produtos -->
	<div id="menuProduto" class="myMenu" style="display:none;">
		<div class="w3-container">
			<h3>Menu de Produtos</h3>
		</div>
		<a class="w3-bar-item w3-button" href="../product/productListar.php">Relação de Produtos</a>
		<a class="w3-bar-item w3-button" href="../product/productIncluir.php">Cadastro de Produtos</a>
	</div>
</div>

<script src="../js/myScriptFarma.js"></script>