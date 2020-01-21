<?php 
require('fpdf.php');
session_start();
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

class PDF extends FPDF
{
	var $link;
	
	function conectar(){

		$mysql_host = "localhost";
		$mysql_database = "excelencia_mydb";
		$mysql_user = "root";
		$mysql_password = "";
		if($this->link=mysql_connect($mysql_host,$mysql_user,$mysql_password))
		{
			if(mysql_select_db($mysql_database,$this->link))
			{
				mysql_query("SET NAMES 'iso88591'");

			}
		}


	}
	function getlink(){

		return 	$this->link;
	}
// Cabecera de página
	function Header()
	{

//------------------------------------------------      
	// Logo
		//$this->Image('logo.png',12,10,100);
	// Arial bold 15
		//$this->SetFont('Arial','B',10);
	// Movernos a la derecha
		//$this->Cell(80);
	// Título


		//$this->Cell(0,20,'Semana '.date("W").' - Del lunes '.date("d",strtotime ('last Monday')).' de '. strftime("%B",strtotime ('last Monday')).' al Sabado '.date("d",strtotime ('next Saturday')).' de '.strftime("%B",strtotime ('next Saturday')).' '.date("Y",strtotime ('last Monday')),0,0,'R');
		//$this->Ln(13);
		
	}



	// Tabla coloreada
	function FancyTable($header, $data)
	{
	    // Colores, ancho de línea y fuente en negrita
		$this->SetFillColor(255, 255, 255);
		$this->SetTextColor(0);
		$this->SetDrawColor(128,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
	    // Cabecera
		$w = array(80);
		for($i=0;$i<count($header);$i++)
			//$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		//$this->Ln();

	    // Restauración de colores y fuentes
		//$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
	    // Datos
		$fill = true;
		foreach($data as $row)
		{
			$this->SetFillColor(255, 255, 255);
			$this->SetTextColor(0);
			$this->Cell(80,6,strtoupper(substr($row[8],0,20)),'LRT',0,'C',true); //agencia
			


			$sqls = 'SELECT idrelacion, fecha, suministros.nombre,relacion.cantidad, banca.idbanca,
			vendedor.idvendedor, grupo.idgrupo,agencia.idagencia,agencia.nombre as nombreag, 
			grupo.nombre as nombregr, 
			vendedor.nombre as nombreven, banca.nombre as nombreban
			from agencia,grupo,vendedor,banca, relacion, suministros
			where relacion.idsuministros = suministros.idsuministros
			and relacion.idagencia = agencia.idagencia
			and relacion.idgrupo = grupo.idgrupo
			and relacion.idvendedor = vendedor.idvendedor
			and relacion.idbanca = banca.idbanca
			and agencia.idgrupo = grupo.idgrupo
			and agencia.idvendedor = vendedor.idvendedor
			and agencia.idbanca = banca.idbanca
			and grupo.idvendedor = vendedor.idvendedor
			and grupo.idbanca = banca.idbanca
			and vendedor.idbanca = banca.idbanca 
			and agencia.idagencia = "'.$row[7].'"
			and fecha <= "'.date("Y",strtotime ('last Monday')).'-'.date("m",strtotime ('last Monday')).'-'.date("d",strtotime ('last Monday')).' 00:00:00" order by agencia.idagencia desc ';

//echo $sqls;
			$datas = array(
				array('idrelacion'=>'#',
					'agencia.idagencia'=>'Modelo'),	);
			$res=mysql_query($sqls,$this->getlink());
			$i=0;
			while($reg=  mysql_fetch_array($res) ){

				$datas[$i] = $reg;
				$i++;

			}
			$this->Ln();
			$this->FancyTableData($header,$datas,$fill);
			
			//$fill = !$fill;

			if($fill)$this->Cell(70);
			$fill = !$fill;
		}
	    // Línea de cierre
		//$this->Cell(array_sum($w),0,'','T');
		
		//$this->Cell(80);



	}

	// Tabla coloreada
	function FancyTableData($header, $data,$fill)
	{
	    /*// Colores, ancho de línea y fuente en negrita
		$this->SetFillColor(255, 255, 255);
		$this->SetTextColor(0);
		$this->SetDrawColor(128,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');*/
$w = array(20, 60);
	   /* // Cabecera
		
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		$this->Ln();
	    // Restauración de colores y fuentes
		$this->SetFillColor(255, 255, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
	    // Datos*/
		//$fill = false;
		//$this->Ln();
		foreach($data as $row)
		{
			if(!$fill)$this->Cell(70);
			//$this->Ln();
			$this->Cell($w[0],6,$row[3],'LRTB',0,'C',false);
			$this->Cell($w[1],6,strtoupper(substr($row[2],0,22)),'LRTB',0,'L',false);
			//$this->Cell($w[2],6,strtoupper(substr($row[8],0,20)),'LR',0,'C',$fill);
			
			//
			//$fill = !$fill;
			$this->Ln();
		}
	    // Línea de cierre
		//$this->Cell(array_sum($w),0,'','T');
		//$this->Ln(5);



	}

}

//-------------------------------------------------------------
$pdf = new PDF('P','mm',array( 215.9 , 279.4));
$pdf->conectar();

$sql = 'SELECT idrelacion, fecha, suministros.nombre,relacion.cantidad, banca.idbanca,
vendedor.idvendedor, grupo.idgrupo,agencia.idagencia,agencia.nombre as nombreag, 
grupo.nombre as nombregr, 
vendedor.nombre as nombreven, banca.nombre as nombreban
from agencia,grupo,vendedor,banca, relacion, suministros
where relacion.idsuministros = suministros.idsuministros
and relacion.idagencia = agencia.idagencia
and relacion.idgrupo = grupo.idgrupo
and relacion.idvendedor = vendedor.idvendedor
and relacion.idbanca = banca.idbanca
and agencia.idgrupo = grupo.idgrupo
and agencia.idvendedor = vendedor.idvendedor
and agencia.idbanca = banca.idbanca
and grupo.idvendedor = vendedor.idvendedor
and grupo.idbanca = banca.idbanca
and vendedor.idbanca = banca.idbanca 
and fecha <= "'.date("Y",strtotime ('last Monday')).'-'.date("m",strtotime ('last Monday')).'-'.date("d",strtotime ('last Monday')).' 00:00:00" group by agencia.idagencia desc ';

//echo $sql;
$datos = array(
	array('idrelacion'=>'#',
		'agencia.idagencia'=>'Modelo'),	);
$res=mysql_query($sql,$pdf->getlink());
$i=0;
while($reg=  mysql_fetch_array($res) ){

	$datos[$i] = $reg;
	$i++;

}

//------------------------------------------------      

// Creación del objeto de la clase heredada

$pdf->AliasNbPages();
$pdf->Header();
$pdf->AddPage();
$pdf->SetFont('Times','',10);
$header = array('Cant', 'Descripcion');

$pdf->FancyTable($header,$datos);


$pdf->Output();
?>
