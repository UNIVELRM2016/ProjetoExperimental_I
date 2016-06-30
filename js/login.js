function login(){
  var login = $("#login").val();
  var senha = $("#senha").val();

  if(!$("#alertaLogin").hasClass("displayNone")){
    $("#alertaLogin").addClass("displayNone");
  }

  $.ajax({
    type: "post",
    url: "ajax/login/logar.php",
    data: "login="+login+"&senha="+senha,
    dataType: "json",
    success: function(data){
      if(data.sucesso == 1){
        var url = "/ajax/contexto/selecionaContexto.php";
        $.getJSON(url, function(data){
          $('form').hide(500);
          if(data.sucesso == 1 && data.selecionarContexto == 0){
            setTimeout(function(){
              location.href="/";
            }, 600);
          }else{
            if(data.deslogar == 1){
              deslogar();
            }else{
              setTimeout(function(){
                location.href="/selecionarContexto.php";
              }, 600);
            }
          }
        });
      }else{
        $("#alertaLogin p").html(data.motivo);
        if($("#alertaLogin").hasClass("displayNone")){
            $("#alertaLogin").removeClass("displayNone");
        }
      }
    }
  });
}

$("#botaoLogin").click(function(){
  login();
});

$("#login").keypress(function(e){
  if(e.which == 13){
    login();
  }
});

$("#senha").keypress(function(e){
  if(e.which == 13){
    login();
  }
});
