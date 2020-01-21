
$(document).ready(function(){
  verlistado()
  //CARGAMOS EL ARCHIVO QUE NOS LISTA LOS REGISTROS, CUANDO EL DOCUMENTO ESTA LISTO


})
function verlistado(){ //FUNCION PARA MOSTRAR EL LISTADO EN EL INDEX POR JQUERY

  var randomnumber=Math.random()*11;

  
  if (document.getElementById('bancas')) {
    $.post("libs/bancas.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#bancas").html(data);
    });
  }if (document.getElementById('usuarios')) {
    $.post("libs/usuarios.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#usuarios").html(data);
    });
  }

  if (document.getElementById('agencias')) {
    $.post("libs/agencias.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#agencias").html(data);
    });
  }

  if (document.getElementById('grupos')) {
    $.post("libs/grupos.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#grupos").html(data);
    });
  }

  if (document.getElementById('vendedores')) {
    $.post("libs/vendedores.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#vendedores").html(data);
    });
  }

  if (document.getElementById('items')) {

    $.post("libs/items.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#items").html(data);
    });
  }

  if (document.getElementById('bitacora')) {
    $.post("libs/bitacora.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#bitacora").html(data);
    });
  }

  if (document.getElementById('computador')) {
    $.post("libs/computador.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#computador").html(data);
    });
  }

  if (document.getElementById('modelos')) {
    $.post("libs/modelos.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#modelos").html(data);
    });
  }

  if (document.getElementById('tipoitems')) {
    $.post("libs/tipoitem.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#tipoitems").html(data);
    });
  }

  if (document.getElementById('entrada')) {
    $.post("libs/entradas.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#entrada").html(data);
    });
  }

  if (document.getElementById('compras')) {
    $.post("libs/compras.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#compras").html(data);
    });
  }

  if (document.getElementById('conexiones')) {
    $.post("libs/conexiones.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#conexiones").html(data);
    });
  }

  if (document.getElementById('asignacion')) {
    $.post("libs/asignacion.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#asignacion").html(data);
    });
  }

  if (document.getElementById('computadorConexion')) {
    $.post("libs/computadorConexion.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#computadorConexion").html(data);
    });
  }

  if (document.getElementById('modeloconexion')) {
    $.post("libs/modelosconexion.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#modeloconexion").html(data);
    });
  }

  if (document.getElementById('tipoconexion')) {
    $.post("libs/tipoconexion.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#tipoconexion").html(data);
    });
  }

  if (document.getElementById('suministros')) {
    $.post("libs/suministros.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#suministros").html(data);
    });
  }
  
  if (document.getElementById('relacion')) {
    $.post("libs/relacion.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#relacion").html(data);
    });
  }

    if (document.getElementById('pendientes')) {
    $.post("libs/pendientes.php", {
      randomnumber:randomnumber
    }, function(data){
      $("#pendientes").html(data);
    });
  }

}