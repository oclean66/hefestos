<?php  
$mysql_host = "localhost";
$mysql_database = "excelencia_mydb";
$mysql_user = "root";
$mysql_password = "jay310887";


 if($link=mysql_connect($mysql_host,$mysql_user,$mysql_password))
 {
     if(mysql_select_db($mysql_database,$link))
	 {
		 mysql_query("SET NAMES 'iso-8859-1'");
	    
	}
}
$sql = "Select * from suministros where cantidad>0";

		$res=mysql_query($sql,$link);
		


		echo '<script type="text/javascript" language="JavaScript">
		collection =[';
		  while($reg=  mysql_fetch_array($res) ){

		  	echo '\''.$reg[0].' | '.$reg[1].'\',
		  	';
		  }
		  echo '];</script>';

		
?>