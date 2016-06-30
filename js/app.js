$(document).foundation();
function deslogar(){
  $.getJSON("/ajax/login/logout.php", function(data){
    if(data.sucesso == 1){
      location.reload();
    }
  });
}
$("#sair").click(function(){
  deslogar();
});
