<?php 
require('fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
	function Header()
	{
//-------------------------------------------------------------
if(isset($_GET['id'])){
   $transaccion= $_GET['id'];

   
   	$mysql_host = "mysql4.000webhost.com";
   	$mysql_database = "a3219922_excelen";
   	$mysql_user = "a3219922_root";
   	$mysql_password = "jay310887";
   	$link=mysql_connect($mysql_host,$mysql_user,$mysql_password);
  	


 mysql_select_db($mysql_database,$link);
$sql = "select * from factura 
where idfactura='".$transaccion."' limit 1";


    $res=mysql_query($sql,$link);
    $i=0;
     $reg=  mysql_fetch_array($res);
        $fecha = new DateTime($reg['fecha']);
        $proveedor = $reg['proveedor'];
     
}

      
	// Logo
		$this->Image('logo.png',12,10,100);
	// Arial bold 15
		$this->SetFont('Arial','B',12);
	// Movernos a la derecha
		$this->Cell(80);
	// Título
		$this->Cell(0,30,'Factura de compra Nº '.$_GET['id'],0,0,'R');
		$this->SetFont('Arial','B',12);
		$this->Ln(1);
		$this->Cell(0,40,'Fecha: '.$fecha->format('d-M-Y'),0,0,'R');
		$this->Ln(10);
		$this->Cell(0,30,'Proveedor: '.$proveedor,0,0,'R');
		$this->Ln(1);
		
		$this->SetFont('Arial','B',16);
		$this->Cell(0,65,'Detalle de equipos',0,0,'C');
	// Salto de línea
		$this->Ln(40);

	}

// Pie de página
	function Footer()
	{
	// Posición: a 1,5 cm del final
		$this->SetY(-15);
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
	    $w = array(60, 60, 60);
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
	       
	        $this->Ln();
	        $fill = !$fill;
	    }
	    // Línea de cierre
	    $this->Cell(array_sum($w),2,'','T');
	}
}

//-------------------------------------------------------------
if(isset($_GET['id'])){
   $transaccion= $_GET['id'];


   	$mysql_host = "mysql4.000webhost.com";
   	$mysql_database = "a3219922_excelen";
   	$mysql_user = "a3219922_root";
   	$mysql_password = "jay310887";
   	$link=mysql_connect($mysql_host,$mysql_user,$mysql_password);
 
 mysql_select_db($mysql_database,$link);

 
$sql = "select serialitem,  tipo,nombremodel,proveedor, fecha 
from item, modelo, tipoitem, factura 
where item.idfactura='".$transaccion."'
and modelo_idmodelo = idmodelo
and item.idtipoitem = tipoitem.idtipoitem
and factura.idfactura = item.idfactura";

 $datos = array(
array('num'=>'Serial', 'tipo'=>'Tipo', 'nombremodel'=>'Modelo'),
);
    $res=mysql_query($sql,$link);
    $i=0;
      while($reg=  mysql_fetch_array($res) ){
       	 $fecha = $reg['fecha'];
       	 $proveedor = $reg['proveedor'];
         $datos[$i] = $reg;
         $i++;
       
      }
}
//------------------------------------------------      

// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm',array( 215.9 , 279.4));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$header = array('Serial', 'Tipo', 'Modelo');

$pdf->FancyTable($header,$datos);

$pdf->Output();
?>
