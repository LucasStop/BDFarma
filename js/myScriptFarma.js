// Função para abrir a barra lateral
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}

// Função para fechar a barra lateral
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}

// Mostra um menu específico e esconde o outro
function w3_show_nav(name) {
  // Oculta ambos os menus
  document.getElementById("menuUsuario").style.display = "none";
  document.getElementById("menuProduto").style.display = "none";
  
  // Exibe apenas o menu especificado
  document.getElementById(name).style.display = "block";
  
  // Garante que a barra lateral esteja visível
  document.getElementById("mySidebar").style.display = "block";
}
