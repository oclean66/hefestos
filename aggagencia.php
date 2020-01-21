 <?php  
 define('INCLUDE_CHECK', true);
 include 'class/formato.php';

 include 'class/conexion.php';
 include 'class/banca.php';
 include 'class/agencia.php';
 include 'class/estado.php';

 $link = Conectar();
 $banca = new banca($link);
 $lista = $banca->listar_bancas();

 $lisstas = new estado($link);
 $estado = $lisstas->listar_estados();


 $agencia = new agencia($link);


//----------------------Inserta-agencia------------------------------------//

 if ( $_POST['agencia_codigo'] != '' and $_POST['agencia_nombre'] != '' and $_POST['grupo'] != '0' and $_POST['vendedor'] != '0' and $_POST['banca'] != '0') {

  $resul = $agencia->insertar_agencia( trim($_POST['agencia_codigo']), $_POST['agencia_nombre'],$_POST['grupo'],$_POST['vendedor'],$_POST['banca'],$_POST['responsable'],$_POST['cedula'],$_POST['telefono'],$_POST['email'],$_POST['direccion'],$_POST['ciudad']);
}
//-----------------------------------------------------------------------//




echo head();

if (isset($resul)) {
  if ($resul == 1) {

    echo '<script language="JavaScript" type="text/javascript">
    alert(\'Guardado con exito!\');
    document.location="agencia.php";
  </script>';
} else {

  echo '<script language="JavaScript" type="text/javascript">
  alert("' . mysql_errno($link) . ": " . mysql_error($link) . '");

</script>';
}
}
?>

<script type="text/javascript">
  function envia(){
    var codigo = document.getElementById('agencia_codigo');
    var nombre = document.getElementById('agencia_nombre');
    var ciudad = document.getElementById('ciudad');

    var banca = document.getElementById('banca');
    var vendedor = document.getElementById('vendedor');
    var grupo = document.getElementById('grupo');

    if (codigo!=null) 
      if (codigo.value=="") {
        alert("Tiene que escribir el codigo de la agencia")
        codigo.focus()
        return 0;
      }
      if (nombre!=null) 
        if (nombre.value.length==0) {
          alert("Tiene que el nombre de la agencia")
          nombre.focus()
          return 0;
        }
        if (ciudad!=null) 
          if (ciudad.value==0) {
            alert("Tiene que seleccionar la Ciudad")
            ciudad.focus()
            return 0;
          }
          if (banca!=null) 
            if (banca.value==0) {
              alert("Tiene que seleccionar la Banca")
              banca.focus()
              return 0;
            }
            if (vendedor!=null) 
              if (vendedor.value==0) {
                alert("Tiene que seleccionar el Receptor")
                vendedor.focus()
                return 0;
              }
              if (grupo!=null) 
                if (grupo.value==0) {
                  alert("Tiene que seleccionar el Grupo")
                  grupo.focus()
                  return 0;
                }



                document.form1.submit();
              }


            </script>

            <body><?php  echo menu(); ?>
              <script type="text/javascript" src="selectbvga.js"></script>
              <script type="text/javascript" src="selectciudesta.js"></script>
              <div id='fondo'>
                <div id='wrap'>
                  <div id="content">

                    <h1>Agregar Nuevo Agencia</h1>

                    <div class="form">

                      <form name="form1" method="post">
                        <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>


                        <div class="row">
                          <label for="agencia_codigo" class="required">Codigo <span class="required">*</span></label>		
                          <input size="45" maxlength="45" name="agencia_codigo" id="agencia_codigo" type="text">
                        </div>

                        <div class="row">
                          <label for="agencia_nombre" class="required">Nombre <span class="required">*</span></label>		
                          <input size="45" maxlength="45" name="agencia_nombre" id="agencia_nombre" type="text">
                        </div>

                        <div class="row">
                          <label for="agencia_responsable" class="required">Nombre Responsable<span class="required">*</span></label>     
                          <input size="45" maxlength="45" name="responsable" id="responsable" type="text">
                        </div>
                         <div class="row">
                          <label for="agencia_cedula" class="required">Cedula Responsable<span class="required">*</span></label>     
                          <input size="45" maxlength="45" name="cedula" id="cedula" type="text">
                        </div>

                        <div class="row">
                          <label for="agencia_telefono" class="required">Telefono <span class="required">*</span></label>     
                          <input name="telefono" id="telefono" type="text" value="" >                       
                        </div>

                        <div class="row">
                          <label for="agencia_email" class="required">E-mail <span class="required">*</span></label>     
                          <input size="45" maxlength="45" name="email" id="email" type="text">
                        </div>


                        <div class="row">
                          <label for="agencia_estado" class="required">Estado <span class="required" >*</span></label>

                          <select style=" width:150px" name="estado" id="estado" onChange='cargarCiudad(this.id)'>
                            <option name="sel" id="sel" value="0">Seleccione</option>        
                            <?php 

                            while ($fila = mysql_fetch_array($estado)) {
                             ?>
                             <option value="<?php  echo $fila[0]; ?>"><?php  echo $fila[1]; ?></option><?php  
                           }
                           ?> 
                         </select> </div>

                         <div class="row">
                          <label for="ciudad_codigo" class="required">&nbsp;&nbsp;Ciudad <span class="required">*</span></label>
                          <select disabled="disabled" style=" width:150px" name="ciudad" id="ciudad">
                            <option value="0">Elige</option>
                          </select> </div>

                          <div class="row">
                            <label for="agencia_direccion" class="required">Direccion <span class="required">*</span></label>     
                            <input size="60" maxlength="160" name="direccion" id="direccion" type="text"></div>


                            <div class="row">
                              <label for="agencia_banca" class="required">Codigo Banca <span class="required" >*</span></label>

                              <select style=" width:150px" name="banca" id="banca" onChange='cargarVendedor(this.id)'>
                                <option name="sel" id="sel" value="0">Seleccione</option>        
                                <?php 

                                while ($fila = mysql_fetch_array($lista)) {
                                 ?>
                                 <option value="<?php  echo $fila['idbanca']; ?>"><?php  echo $fila['idbanca'] . ' - ' . $fila['nombre']; ?></option><?php  
                               }
                               ?> 
                             </select> </div>

                             <div class="row">
                              <label for="agencia_vendedor" class="required">&nbsp;&nbsp;Codigo Receptor <span class="required">*</span></label>
                              <select disabled="disabled" style=" width:150px" name="vendedor" id="vendedor">
                                <option value="0">Elige</option>
                              </select> </div>

                              <div class="row">
                                <label for="agencia_grupo" class="required">&nbsp;&nbsp;Codigo Grupo <span class="required">*</span></label>
                                <select disabled="disabled" style=" width:150px" name="grupo" id="grupo">
                                  <option value="0">Elige</option>
                                </select> </div>



                                <div class="row buttons">
                                  <input type="button" value="Guardar" onclick="envia()">	</div>

                                </form>
                              </div><!-- form -->	</div>

                              <div id="sidebar">
                                <div class="portlet" id="yw2">
                                  <div class="portlet-decoration">
                                    <div class="portlet-title">Operaciones</div>
                                  </div>
                                  <div class="portlet-content">
                                    <ul class="operations" id="yw3">
                                      <li><a href="agencia.php">Listar Agencias</a></li>
                                    </ul></div>
                                  </div>	</div>



                                </div>
                              </div>


                              <?php 
                              @mysql_free_result($lista);
                              @mysql_close($agencia); 
                              @mysql_close($banca); 
                              ?>
                            </body>
                            </html>