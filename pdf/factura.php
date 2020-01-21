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

   	$mysql_host = "localhost";
   $mysql_database = "excelencia_mydb";
   $mysql_user = "root";
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
		$this->SetFont('Arial','B',10);
	// Movernos a la derecha
		$this->Cell(80);
	// Título
		$this->Cell(0,30,'Factura de compra Nº '.$_GET['id'],0,0,'R');
		$this->SetFont('Arial','B',10);
		$this->Ln(1);
		$this->Cell(0,40,'Fecha: '.$fecha->format('d-M-Y'),0,0,'R');
		$this->Ln(10);
		$this->Cell(0,30,'Proveedor: '.$proveedor,0,0,'R');
		$this->Ln(1);
		
		$this->SetFont('Arial','B',14);
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
	    $w = array(55, 65, 60);
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
	        $this->Cell($w[0],6,$row[5],'LR',0,'C',$fill);
	        $this->Cell($w[1],6,substr($row[9].' '.$row[10],0,22),'LR',0,'C',$fill);
	        $this->Cell($w[2],6,substr($row[6].' - '.$row[16],0,24),'LR',0,'L',$fill);
	       
	        $this->Ln();
	        $fill = !$fill;
	    }
	    // Línea de cierre
	    $this->Cell(array_sum($w),0,'','T');
	}
}

//-------------------------------------------------------------
if(isset($_GET['id'])){
   $transaccion= $_GET['id'];
 
   	$mysql_host = "localhost";
   $mysql_database = "excelencia_mydb";
   $mysql_user = "root";
   $mysql_password = "jay310887";
   	$link=mysql_connect($mysql_host,$mysql_user,$mysql_password);
  	

 mysql_select_db($mysql_database,$link);


$sql = 'select * from (SELECT var.idbanca, var.idgrupo, var.idvendedor, fechagregado, 
  idcomputador, var.serialitem, var.idagencia,status,
  var.idestado,tipo, nombremodel, tipoitem.idtipoitem
  from (SELECT idcomputador, item.serialitem,
    fechagregado,idestado,
    item.modelo_idmodelo, computador.idagencia, computador.idvendedor, 
    computador.idgrupo, computador.idbanca, idfactura
    from item
    left join computador on item.serialitem=computador.iditem) as var,  
modelo, tipoitem, estado
where  var.idestado = estado.idestado
and var.modelo_idmodelo = modelo.idmodelo
and idfactura="'.$transaccion.'"
and modelo.idtipoitem = tipoitem.idtipoitem 
order by tipo desc) as compra
left join agencia on compra.idagencia = agencia.idagencia
and agencia.idgrupo = compra.idgrupo
and agencia.idvendedor = compra.idvendedor
and agencia.idbanca = compra.idbanca order by tipo, serialitem';

 $datos = array(
array(),);
    $res=mysql_query($sql,$link);
    $i=0;
      while($reg=  mysql_fetch_array($res) ){
       	 // $fecha = $reg['fecha'];
       	 // $proveedor = $reg['proveedor'];
         $datos[$i] = $reg;
         $i++;
       
      }
}
//------------------------------------------------      

// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm',array( 215.9 , 279.4));
$pdf->AliasNbPages();

$pdf->AddPage();
$pdf->SetFont('Times','',10);
$header = array('Serial', 'Equipo', 'Agencia');

$pdf->FancyTable($header,$datos);

$pdf->Output();
?>
