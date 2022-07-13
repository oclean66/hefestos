<style>
    #main {
        margin-left: 0px;
        height: 100%;
    }

    #left {
        display: none;
    }
</style>

<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;
?>

<!--Logo de dashbord-->



<div class="wide form">






<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-table"></i>
									Resumen de activos
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable dataTable-es">
									<thead>
										<tr class='thefilter'>
											<th>Tipo de activo </th>
											<th>Total </th>
											<th >Alamacen 1</th>
											<th >Alamacen 2</th>
											<th>Deposio tecnico</th>
											<th >Deposito central</th>
											<th >Por revisar</th>
											<th>Garantia</th>
											<th >Prestado</th>
											<th >De baja</th>
											<th>En reparacion</th>
											<th>Falta parte</th>
											<th>Para repuesto</th>
 
 
 
										</tr>
                                        <tr class=''>
											<th>Tipo de activo </th>
											<th>Total </th>
											<th >Alamacen 1</th>
											<th >Alamacen 2</th>
											<th>Deposio tecnico</th>
											<th >Deposito central</th>
											<th >Por revisar</th>
											<th>Garantia</th>
											<th >Prestado</th>
											<th >De baja</th>
											<th>En reparacion</th>
											<th>Falta parte</th>
											<th>Para repuesto</th>
 
 
 
										</tr>
									</thead>
									<tbody>
									<?php foreach($resumen as $r){ ?>
                                        <tr>
                                            <td><?= $r['FCCA_Descripcion'] ?></td>
                                            <td><?= $r['total'] ?></td>
                                            <td><?= $r['almacen1'] ?></td>
                                            <td><?= $r['almacen2'] ?></td>
                                            <td><?= $r['depotecnico'] ?></td>
                                            <td><?= $r['depocentral'] ?></td>
                                            <td><?= $r['porrevisar'] ?></td>
                                            <td><?= $r['garantia'] ?></td>
                                            <td><?= $r['prestado'] ?></td>
                                            <td><?= $r['debaja'] ?></td>
                                            <td><?= $r['reparacion'] ?></td>
                                            <td><?= $r['faltaparte'] ?></td>
                                            <td><?= $r['pararepuesto'] ?></td>
                                            
                                        </tr>
                                    <?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
 <script>

    </script>