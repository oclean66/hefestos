<?php 
require('fpdf.php');
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

class PDF extends FPDF
{
// Cabecera de página
	function Header()
	{

//-------------------------------------------------------------
if(isset($_GET['id'])){
  $transaccion = $_GET['id'];
$mysql_host = "localhost";
   $mysql_database = "excelencia_mydb";
   $mysql_user = "root";
   $mysql_password = "jay310887";
   if($link=mysql_connect($mysql_host,$mysql_user,$mysql_password))
   {
   	if(mysql_select_db($mysql_database,$link))
   	{
   		mysql_query("SET NAMES 'iso88591'");
   		
   	}
   }
   
  
$sql = "(Select @rnum:=@rnum + 1 as num, iditem, tipo,nombremodel,agencia.nombre as agenombre,
agencia.idagencia as idage, grupo.nombre as grnombre, grupo.idgrupo as idgr, fechaprestamo
 from 
computador,item,tipoitem,modelo, (Select @rnum:=0) n, agencia, grupo,vendedor,banca 
where idtransaccion = '".$transaccion."'
and iditem = serialitem
and computador.idagencia = agencia.idagencia
and computador.idgrupo = grupo.idgrupo
and computador.idvendedor = vendedor.idvendedor
and computador.idbanca = banca.idbanca
and agencia.idgrupo = grupo.idgrupo
and agencia.idvendedor = vendedor.idvendedor
and agencia.idbanca = banca.idbanca
and grupo.idvendedor = vendedor.idvendedor
and grupo.idbanca = banca.idbanca
and vendedor.idbanca = banca.idbanca
and item.idtipoitem = tipoitem.idtipoitem
and modelo_idmodelo = modelo.idmodelo)
union 
(Select @rnum:=@rnum + 1 as num, conexion.IMEI, conexionnombre,modelo,agencia.nombre as agenombre,
agencia.idagencia as idage, grupo.nombre as grnombre, grupo.idgrupo as idgr, fechaprestamo
 from 
computador,conexion,tipoconexion,modeloconexion, (Select @rnum:=0) n, agencia, grupo ,vendedor,banca 
where idtransaccion = '".$transaccion."'
and computador.idconexion = conexion.idconexion
and computador.idagencia = agencia.idagencia
and computador.idgrupo = grupo.idgrupo
and computador.idvendedor = vendedor.idvendedor
and computador.idbanca = banca.idbanca
and agencia.idgrupo = grupo.idgrupo
and agencia.idvendedor = vendedor.idvendedor
and agencia.idbanca = banca.idbanca
and grupo.idvendedor = vendedor.idvendedor
and grupo.idbanca = banca.idbanca
and vendedor.idbanca = banca.idbanca
and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
and conexion.idmodeloconexion = modeloconexion.idmodeloconexion)";

 
    $res=mysql_query($sql,$link);
    $i=0;
     $reg=  mysql_fetch_array($res);
        $agencia = $reg['idage'].' - '.$reg['agenombre'];
        $grupo = $reg['idgr'].' - '.$reg['grnombre'];
        
}
//------------------------------------------------      
	// Logo
		$this->Image('logo.png',12,10,100);
	// Arial bold 15
		$this->SetFont('Arial','B',12);
	// Movernos a la derecha
		$this->Cell(80);
	// Título
		
		$this->Cell(0,20,'Ticket Nº '.$_GET['id'],0,0,'R');
		$this->Ln(1);
		$this->Cell(0,30,strftime("%d %B %Y",strtotime ($reg['fechaprestamo'])),0,0,'R');
		$this->SetFont('Arial','',12);
		$this->Ln(1);
		$this->Cell(0,40,'Agencia: '.$agencia,0,0,'R');
		$this->Ln(10);
		$this->Cell(0,30,'Grupo: '.$grupo,0,0,'R');
		$this->Ln(1);
		$this->SetFont('Arial','B',16);
		$this->Cell(0,65,'Salida de equipos',0,0,'C');
	// Salto de línea
		$this->Ln(50);

	}

// Pie de página
	function Footer()
	{
	// Posición: a 1,5 cm del final
		$this->SetY(-30);
		$this->Cell(0,0,'',1,0,'C');
	// Arial italic 8
		$this->SetFont('Arial','I',8);
	// Número de página

		$this->Ln(1);
		$this->Cell(0,-5,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
		$this->Ln(1);
		$this->Cell(0,5,'Barrio Obrero, Calle 15 entre Carrera 20 y 21, Nº 20-61 -San Cristobal - Edo. Táchira',0,0,'C');
		$this->Ln(1);
		$this->Cell(0,10,'Recibimos listas y Legalizamos tu jugada',0,0,'C');
		$this->Ln(1);
		$this->Cell(0,15,'Telefonos: 0414-738 3581 / 0416-676 6881',0,0,'C');
	}

	// Tabla coloreada
	function FancyTable($header, $data)
	{
	    // Colores, ancho de línea y fuente en negrita
	    $this->SetFillColor(109, 132, 180);
	    $this->SetTextColor(255);
	    $this->SetDrawColor(128,0,0);
	    $this->SetLineWidth(.3);
	    $this->SetFont('','B');
	    // Cabecera
	    $w = array(10, 60, 60, 60);
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	    $this->Ln();
	    // Restauración de colores y fuentes
	    $this->SetFillColor(224,235,255);
	    $this->SetTextColor(0);
	    $this->SetFont('');
	    // Datos
	    $fill = false;
	    foreach($data as $row)
	    {
	        $this->Cell($w[0],6,$row[0],'LR',0,'C',$fill);
	        $this->Cell($w[1],6,$row[1],'LR',0,'C',$fill);
	        $this->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
	        $this->Cell($w[3],6,$row[3],'LR',0,'C',$fill);
	        $this->Ln();
	        $fill = !$fill;
	    }
	    // Línea de cierre
	    $this->Cell(array_sum($w),0,'','T');
	    $this->Ln(10);
	    // Linea
		$this->Image('firmas.png',null,null,190);
	    

	}
}

//-------------------------------------------------------------
if(isset($_GET['id'])){
  $transaccion = $_GET['id'];
  
$mysql_host = "localhost";
   $mysql_database = "excelencia_mydb";
   $mysql_user = "root";
   $mysql_password = "jay310887";
   if($link=mysql_connect($mysql_host,$mysql_user,$mysql_password))
   {
   	if(mysql_select_db($mysql_database,$link))
   	{
   		mysql_query("SET NAMES 'iso88591'");
   		
   	}
   }
   
  


 
$sql = "(Select @rnum:=@rnum + 1 as num, iditem, tipo,nombremodel,agencia.nombre as agenombre,
agencia.idagencia as idage, grupo.nombre as grnombre, grupo.idgrupo as idgr
 from 
computador,item,tipoitem,modelo, (Select @rnum:=0) n, agencia, grupo,vendedor,banca 
where idtransaccion = '".$transaccion."'
and iditem = serialitem
and computador.idagencia = agencia.idagencia
and computador.idgrupo = grupo.idgrupo
and computador.idvendedor = vendedor.idvendedor
and computador.idbanca = banca.idbanca
and agencia.idgrupo = grupo.idgrupo
and agencia.idvendedor = vendedor.idvendedor
and agencia.idbanca = banca.idbanca
and grupo.idvendedor = vendedor.idvendedor
and grupo.idbanca = banca.idbanca
and vendedor.idbanca = banca.idbanca
and item.idtipoitem = tipoitem.idtipoitem
and modelo_idmodelo = modelo.idmodelo)
union 
(Select @rnum:=@rnum + 1 as num, conexion.IMEI, conexionnombre,modelo,agencia.nombre as agenombre,
agencia.idagencia as idage, grupo.nombre as grnombre, grupo.idgrupo as idgr
 from 
computador,conexion,tipoconexion,modeloconexion, (Select @rnum:=0) n, agencia, grupo ,vendedor,banca 
where idtransaccion = '".$transaccion."'
and computador.idconexion = conexion.idconexion
and computador.idagencia = agencia.idagencia
and computador.idgrupo = grupo.idgrupo
and computador.idvendedor = vendedor.idvendedor
and computador.idbanca = banca.idbanca
and agencia.idgrupo = grupo.idgrupo
and agencia.idvendedor = vendedor.idvendedor
and agencia.idbanca = banca.idbanca
and grupo.idvendedor = vendedor.idvendedor
and grupo.idbanca = banca.idbanca
and vendedor.idbanca = banca.idbanca
and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
and conexion.idmodeloconexion = modeloconexion.idmodeloconexion)";

 $datos = array(
array('num'=>'#','iditem'=>'Serial', 'tipo'=>'Tipo', 'nombremodel'=>'Modelo'),
);
    $res=mysql_query($sql,$link);
    $i=0;
      while($reg=  mysql_fetch_array($res) ){
        $agencia = $reg['idage'].'  '.$reg['agenombre'];
        $grupo = $reg['idgr'].'  '.$reg['grnombre'];
         $datos[$i] = $reg;
         $i++;
       
      }
}
//------------------------------------------------      

// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm',array( 215.9 , 279.4));
$pdf->AliasNbPages();
$pdf->Header();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$header = array('#', 'Item', 'Tipo', 'Modelo');

$pdf->FancyTable($header,$datos);


$pdf->Output();
?>
