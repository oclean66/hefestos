<img class="imprimir" width="150px" src="/hefestos/themes/flat/img/brand.png" alt="">
<div id="summary">
<h4>Inventario de Activos<br/> 
        <?php echo isset($fecha) ? $fecha . "<br/>" : ""; ?>
        Fecha de Impresion: <?php echo date("d M, Y");?>
        <br/>
      <?php echo Yii::app()->session['desc'];?>
      </h4>    

<div class="invoice-info">
    <div class="invoice-to">

        <strong>Comercializadora La Excelencia</strong>
        <address>
            Rif: J-29401587-5 <br> 
            Departamento Tecnico
            <br>Calle 15, Barrio Obrero - San Cristobal
            <br>
            Telefono: (0276) 355-6947
            <br>
            Telefono Principal:  (0276) 356-7958
        </address>
    </div>
    <div class="invoice-from">
         
    </div>
</div>
<br/>



<table width="100%" class="table paleBlueRows">
    <tr>
        <th>Fecha de Ingreso</th>
        <th>Serial</th>
        <th>Tipo</th>
        <th>Modelo</th>
        <th>Agencia</th>
       
    </tr>  
    <?php   
  //  print_r($d);
    foreach($d->data as $item)
    {

       
    ?>
    <tr>
        
        <td> <?php echo date("d M Y" , strtotime($item->FCCU_Timestamp)); ?></td>
        <td> <?php echo $item->FCCU_Serial; ?></td>
        <td> <?php echo $item->fCCT->fCCA->FCCA_Descripcion; ?></td>
        <td> <?php echo $item->fCCT->FCCT_Descripcion; ?></td>
        <td> <?php echo $item->fccos->gCCA->GCCA_Nombre; ?></td>
    </tr>
    <?php 
       
    }
    ?>
</table>
</div>
<style>
table.paleBlueRows {
  font-family: "Times New Roman", Times, serif;
  border: 1px solid #FFFFFF;
  width: 100%;
  /* height: 200px; */
  text-align: center;
  border-collapse: collapse;
}
table.paleBlueRows td, table.paleBlueRows th {
  border: 1px solid #000000;
  padding: 3px 2px;
}
table.paleBlueRows tbody td {
  font-size: 13px;
}
table.paleBlueRows thead {
  background: #0B6FA4;
}
table.paleBlueRows thead th {
  font-size: 17px;
  font-weight: normal;
  color: #FFFFFF;
  text-align: center;
  border-left: 0px solid #000000;
}
table.paleBlueRows thead th:first-child {
  border-left: none;
}

table.paleBlueRows tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #333333;
  background: #D0E4F5;
  border-top: 3px solid #444444;
}
table.paleBlueRows tfoot td {
  font-size: 14px;
}

.invoice-info .invoice-name {
  font-size: 24px;
  margin-bottom: 40px;
}
.invoice-info .invoice-from, .invoice-info .invoice-to {
  float: left;
  margin-bottom: 30px;
}
.invoice-info .invoice-from span, .invoice-info .invoice-to span {
  color: #888;
  display: block;
}
.invoice-info .invoice-from {
  margin-left: 50px;
}
.invoice-info .invoice-infos {
  float: right;
  margin-right: 20px;
}

</style>

<script>
window.print();
setTimeout(window.close, 500);
</script>