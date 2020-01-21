<?php  session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body {
	
}
-->
</style></head>

<body>
  <form name="form1" action="../html/index.php" method="get">
  <a href="../html/"></a>
</form>
  <?php  
  

  

if(isset($_SESSION["usr"]))
   {
   	session_destroy();
   unset($_SESSION["usr"]);

   }


	
	
?>
  <script language="JavaScript" type="text/javascript">
         document.location.href='../login.php';
      </script>
</p>
</body>
</html>
