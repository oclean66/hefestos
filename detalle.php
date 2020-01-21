<?php  

define('INCLUDE_CHECK',true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/banca.php';

$link=Conectar();
$banca=new banca($link);
echo head();

?>

<link rel="stylesheet" href="css/jquery.treeview.css" />

<script type="text/javascript" 
src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script src="js/jquery.cookie.js" type="text/javascript"></script>
<script src="js/jquery.treeview.js" type="text/javascript"></script>

<script type="text/javascript">


function printer(){
	w=window.open();

	total = document.getElementById("total").innerHTML;

	xx = document.getElementById("cabeceras");
	xx.removeChild(document.getElementById("cticket"));
	xx.removeChild(document.getElementById("cusuario"));
	xx.removeChild(document.getElementById("caccion"));

	for (var i = 1; i <= total; i++) {

		xy = document.getElementById("lresul"+i);
		xy.removeChild(document.getElementById("lticket"+i));
		xy.removeChild(document.getElementById("lusuario"+i));
		xy.removeChild(document.getElementById("laccion"+i));	

	};

	xz = document.getElementById("fowrm");
	xz.removeChild(document.getElementById("Guardar"));
	xz.removeChild(document.getElementById("total"));
	xz.removeChild(document.getElementById("totalr"));

	tabla = document.getElementById("car");

	w.document.write(tabla.innerHTML);
	w.print();
	w.close();
	
}

function Carga(url,id)
{
//Creamos un objeto dependiendo del navegador
var objeto;
if (window.XMLHttpRequest)
{
//Mozilla, Safari, etc
objeto = new XMLHttpRequest();
}
else if (window.ActiveXObject)
{
//Nuestro querido IE
try {
	objeto = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
try { //Version mas antigua
	objeto = new ActiveXObject("Microsoft.XMLHTTP");
} catch (e) {}
}
}
if (!objeto)
{
	alert("No ha sido posible crear un objeto de XMLHttpRequest");
}
//Cuando XMLHttpRequest cambie de estado, ejecutamos esta funcion
objeto.onreadystatechange=function()
{
	cargarobjeto(objeto,id)
}
objeto.open('GET', url, true) // indicamos con el método open la url a cargar de manera asíncrona
objeto.send(null) // Enviamos los datos con el metodo send
}
function cargarobjeto(objeto, id)
{
if (objeto.readyState == 4) //si se ha cargado completamente
	document.getElementById(id).innerHTML=objeto.responseText
else //en caso contrario, mostramos un gif simulando una precarga
	document.getElementById(id).innerHTML='<img src="images/loading3.gif" alt="cargando" />'
}




$(function() {
	$("#browser").treeview({
		
		persist: "location",
		collapsed: true,
		unique: true
	});
})


</script>
<style type="text/css">

tr {
	font: bold 12px Arial;
}
td{
	font: bold 10px Arial;
}td a {
	font: bold 10px Arial;
}
​
</style>
<body><?php  echo menu();?>
	<div id="fondo">


		<?php  $banca->todo();?>
		
		<div id="car" 
		style="text-align: center;    
		padding: 13px;
		margin-left: 13px;
		margin-top: 20px;    
		height: 85%;
		overflow-y: auto;
		position: absolute;
		top: 52px;
		font-size: 75%;
		left: 300px;
		right: 10px;">
		

	</div>
</div>



</body></html>