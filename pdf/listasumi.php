<?php 
require('fpdf.php');
session_start();
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

class PDF extends FPDF
{
// Cabecera de página
	function Header()
	{

//------------------------------------------------      
	// Logo
		$this->Image('logo.png',12,10,100);
	// Arial bold 15
		$this->SetFont('Arial','B',12);
	// Movernos a la derecha
		$this->Cell(80);
	// Título
            
              
		$this->Cell(0,20,'Semana '.date("W"),0,0,'R');
		$this->Ln(1);
		$this->SetFont('Arial','',12);
		$this->Cell(0,30,'Fecha '.date("m - d - Y"),0,0,'R');
		
		$this->Ln(1);
			$this->Ln(10);
		$this->Ln(1);
		$this->SetFont('Arial','B',16);
		$this->Cell(0,65,'Existencia Inventario',0,0,'C');
	// Salto de línea
		$this->Ln(50);

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
		$w = array(20, 110, 60);
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
			$this->Cell($w[1],6,strtoupper(substr($row[1],0,42)),'LR',0,'L',$fill);
			$this->Cell($w[2],6,strtoupper(substr($row[2],0,20)),'LR',0,'C',$fill);
			
			$this->Ln();
			$fill = !$fill;
		}
	    // Línea de cierre
		$this->Cell(array_sum($w),0,'','T');
		$this->Ln(10);
	   


	}
}

//-------------------------------------------------------------


$mysql_host = "localhost";
$mysql_database = "excelencia_mydb";
$mysql_user = "root";
$mysql_password = "";
if($link=mysql_connect($mysql_host,$mysql_user,$mysql_password))
{
	if(mysql_select_db($mysql_database,$link))
	{
		mysql_query("SET NAMES 'iso88591'");

	}
}




$sql = 'SELECT * from suministros';
//2013-01-28 09:30:05

//echo $sql;
$datos = array(
	array('idrelacion'=>'#',
		'agencia.idagencia'=>'Modelo'),	);
$res=mysql_query($sql,$link);
$i=0;
while($reg=  mysql_fetch_array($res) ){

    $datos[$i] = $reg;
	$i++;

}

//------------------------------------------------      

// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm',array( 215.9 , 279.4));
$pdf->AliasNbPages();
$pdf->Header();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$header = array('Cod', 'Descripcion','Cantidad Disponible');

$pdf->FancyTable($header,$datos);


$pdf->Output();
?>
