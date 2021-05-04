<?php $modell = isset($modelo[0]) ? $modelo[0] : (isset($d->data[0]) ? $d->data[0] : null); ?>

<img class="imprimir" class='brand' width="100px" src="/hefestos/themes/flat/img/brand.png" alt="">
<div id="summary">
  <h4>
    <?php echo isset($tipo) ? ($tipo == 1 ? "Reporte de Salida" : "Reporte de Entrada") : "Inventario de equipos en Prestamo" ?>
    <br />
    <?php echo isset($fecha) ? $fecha . "<br/>" : ""; ?>

    Fecha de Impresion: <?php echo date("d M, Y"); ?>
    <br />
    
    <?php echo $model->concatened; ?>
  </h4>

  <table width='100%' class="table paleBlueRows" style="border: 0;text-align: left;">
    <tr style="border:0">
      <td style="border:0">
        <strong>Comercializadora La Excelencia</strong>
        <address>
          Rif: J-29401587-5 <br>
          Departamento Tecnico
          <br>Calle 15, Barrio Obrero - San Cristobal
          <br>
          Telefono: (0276) 355-6947
          <br>
          Telefono Principal: (0276) 356-7958
          <br />
          Realizado por: <b><?php echo isset($modell) ? $modell->username : "";?></b>
        </address>
      </td>
      <td style="border:0"> <b><?php echo count($d->data) . " activos"; ?></b></td>
    </tr>
  </table>
  <br />
  <table width="100%" class="table paleBlueRows">
    <tr>
      <th>Id</th>
      <th>Fecha</th>
      <th>Serial</th>
      <!-- <th>Numero</th> -->
      <th>Descripcion</th>

    </tr>
    <?php
    $id = 1;
    //  print_r($d);
    foreach ($d->data as $item) {


    ?>
      <tr>

        <td> <?php echo $id; ?></td>
        <td> <?php echo $item->FCCO_Enabled == 0 ? '<strike>' : ""; ?> <?php echo date("d M Y", strtotime($item->FCCO_Timestamp)); ?> <?php echo $item->FCCO_Enabled == 0 ? '</strike>' : ""; ?> </td>
        <td> <?php echo $item->FCCO_Enabled == 0 ? '<strike>' : ""; ?> <?php echo $item->fCCU->FCCU_Serial; ?></td> <?php echo $item->FCCO_Enabled == 0 ? '</strike>' : ""; ?>
        <!-- <td> <?php echo $item->FCCO_Enabled == 0 ? '<strike>' : ""; ?> <?php echo !isset($item->fCCU->FCCU_Numero) ? "" : $item->fCCU->FCCU_Numero; ?> <?php echo $item->FCCO_Enabled == 0 ? '</strike>' : ""; ?> </td> -->
        <td> <?php echo $item->FCCO_Enabled == 0 ? '<strike>' : ""; ?> <?php echo $item->fCCU->fCCT->fCCA->fCUU->FCUU_Descripcion . " - " . $item->fCCU->fCCT->fCCA->FCCA_Descripcion . " - " . $item->fCCU->fCCT->FCCT_Descripcion; ?> <?php echo $item->FCCO_Enabled == 0 ? '</strike>' : ""; ?> </td>
      </tr>
    <?php
      $id += 1;
    }
    ?>
  </table>
</div>
<style>
  body {
    font: 12px 'andele mono', monospace;
    margin: 10px 0 10px 0px;
  }

  .brand {
    visibility: hidden;
    position: fixed;
    height: 0px;
  }

  table.paleBlueRows {
    font: 12px 'andele mono', monospace;
    border: 1px solid #FFFFFF;
    width: 100%;
    /* height: 200px; */
    text-align: center;
    border-collapse: collapse;
  }

  table.paleBlueRows td,
  table.paleBlueRows th {
    border: 1px solid #000000;
    padding: 3px 2px;
  }

  table.paleBlueRows tbody td {
    font: 12px 'andele mono', monospace;
  }

  table.paleBlueRows thead {
    background: #0B6FA4;
  }

  table.paleBlueRows thead th {
    font: 12px 'andele mono', monospace;
    font-weight: normal;
    color: #FFFFFF;
    text-align: center;
    border-left: 0px solid #000000;
  }

  table.paleBlueRows thead th:first-child {
    border-left: none;
  }

  table.paleBlueRows tfoot {
    font: 12px 'andele mono', monospace;
    font-weight: bold;
    color: #333333;
    background: #D0E4F5;
    border-top: 3px solid #444444;
  }

  table.paleBlueRows tfoot td {
    font: 12px 'andele mono', monospace;
  }

  .invoice-info .invoice-name {
    font-size: 24px;
    margin-bottom: 40px;
  }

  .invoice-info .invoice-from,
  .invoice-info .invoice-to {
    float: left;
    margin-bottom: 30px;
    font: 12px 'andele mono', monospace;
  }

  .invoice-info .invoice-from span,
  .invoice-info .invoice-to span {
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