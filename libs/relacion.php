<?php  require_once('conexion.php');

session_start();
$cn=  conectar();

       $sql = 'SELECT idrelacion, fecha, suministros.nombre,relacion.cantidad, banca.idbanca,
        vendedor.idvendedor, grupo.idgrupo,agencia.idagencia,agencia.nombre as nombreag, grupo.nombre as nombregr, 
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
       '.$_SESSION['sql'].'
       order by idrelacion desc';
  

$listado=  mysql_query($sql,$cn);

?>

 <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>



            <table cellpadding="0" cellspacing="0" border="0" class="display" 
            id="tabla_lista_computador" 
            style="border-top: 1px solid;
                  border-bottom: 1px solid;
                  font-size: 12px;">
                <thead>
                    <tr>
                        
                        <th>#</th>
                        
                         <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>Suministro</th>
                        
                        <th>Agencia</th>
                        <th>Grupo</th> 
                        <!-- <th>Vendedor</th>                          
                        <th>Banca</th> -->
                        
                    </tr>
                </thead>
                
                  <tbody>
                    <?php 
                    $j=1;     
                   while($reg=  mysql_fetch_array($listado))
                   {
                             
                              echo '<tr>';
                              echo '<td >'.$j.'</a></td>';
                              $fecha = new DateTime(mb_convert_encoding($reg['fecha'], "iso-8859-1"));
 
                              echo '<td >'.$fecha->format('d-m-Y').'</td>';    
                              echo '<td >'.mb_convert_encoding($reg['cantidad'], "iso-8859-1").'</td>';   
                              echo '<td >'.mb_convert_encoding($reg['nombre'], "iso-8859-1").'</td>';
                              
                             
                              echo '<td ><a href="relacion.php?age='.$reg['idagencia'].'&gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].'">'.mb_convert_encoding($reg['idagencia'].' '.$reg['nombreag'], "iso-8859-1").'</a></td>';
                              echo '<td >'.mb_convert_encoding($reg['idgrupo'].' '.$reg['nombregr'], "iso-8859-1").'</a></td>';
                              // echo '<td >'.mb_convert_encoding($reg['nombreven'], "iso-8859-1").'</td>';
                              // echo '<td >'.mb_convert_encoding($reg['nombreban'], "iso-8859-1").'</td>';
                              

                              echo '</tr>'; 
                              $j++;
                     
                        }
                   $cn=  desconectar();
 ?>
                <tbody>
            </table>
            