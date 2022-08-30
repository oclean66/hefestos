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


<div id="modal-activos" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <!-- /.modal-header -->
            <div class="modal-body modal-activos">
                    
            </div>
            <!-- /.modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
            </div>
            <!-- /.modal-footer -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


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
					<table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable dataTable-es responsive nowrap dataTable-scroll-x">
						<thead>
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
							<tr class='thefilter'>
								<th>Tipo de activo </th>
								<th>Total </th>
								<th>Deposio tecnico</th>

								<th>Por revisar</th>

								<th>Alamacen 1</th>
								<th>Alamacen 2</th>
								
								<th>Deposito central</th>
								
								<th>Garantia</th>
								<th>Prestado</th>
								<th>De baja</th>
								<th>En reparacion</th>
								<th>Falta parte</th>
								<th>Para repuesto</th>
							</tr>
							
						</thead>
						<tbody>
						<?php  
						$total=0;
						$talmacen1=0;
						$talmacen2=0;
						$tdepotecnico=0;
						$tdepocentral=0;
						$tporrevisar=0;
						$tgarantia=0;
						$tprestado=0;
						$tdebaja=0;
						$treparacion=0;
						$tfaltaparte=0;
						$tpararepuesto=0;
 

						foreach($resumen as $k => $r){ ?>
							<tr>
								<td><?= $r['FCCA_Descripcion'] ?></td>
								<td>
									<?= $r['total'] ?>
								</td>
								<td>
									<?php if($r['depotecnico'] > 0){ ?>
									<a href="#c-<?= $r['FCCI_Id'] ?>" class="not-link " ondblclick="listaactivos('Deposito tecnico - <?= $r['FCCA_Descripcion'] ?>','<?= Yii::app()->createUrl('fccu/listaactivos/',array('view'=>'index','FCCA_Id'=>$r['FCCA_Id'],'FCCI_Id'=>10)) ?>')">
										<?= $r['depotecnico'] ?>
									</a>
									<?php }else{
										echo $r['depotecnico'] ;
									} ?>
								</td>
								<td>
									<?php if($r['porrevisar'] > 0){ ?>
									<a href="#c-<?= $r['FCCI_Id'] ?>" class="not-link " ondblclick="listaactivos('Por revisar - <?= $r['FCCA_Descripcion'] ?>','<?= Yii::app()->createUrl('fccu/listaactivos/',array('view'=>'index','FCCA_Id'=>$r['FCCA_Id'],'FCCI_Id'=>3)) ?>')">
										<?= $r['porrevisar'] ?>
									</a>
									<?php }else{
										echo $r['porrevisar'] ;
									} ?>	
								</td>
								<td>
									<?php if($r['almacen1'] > 0){ ?>
									<a href="#c-<?= $r['FCCI_Id'] ?>" class="not-link " ondblclick="listaactivos('Almacen 1 - <?= $r['FCCA_Descripcion'] ?>','<?= Yii::app()->createUrl('fccu/listaactivos/',array('view'=>'index','FCCA_Id'=>$r['FCCA_Id'],'FCCI_Id'=>1)) ?>')">
										<?= $r['almacen1'] ?></td>
									</a>
									<?php }else{
										echo $r['almacen1'] ;
									} ?>
								<td>
									<?php if($r['almacen2'] > 0){ ?>
									<a href="#c-<?= $r['FCCI_Id'] ?>" class="not-link " ondblclick="listaactivos('Almacen 2 - <?= $r['FCCA_Descripcion'] ?>','<?= Yii::app()->createUrl('fccu/listaactivos/',array('view'=>'index','FCCA_Id'=>$r['FCCA_Id'],'FCCI_Id'=>2)) ?>')">
										<?= $r['almacen2'] ?></td>
									</a>
									<?php }else{
										echo $r['almacen2'] ;
									} ?>
								
								<td>
									<?php if($r['depocentral'] > 0){ ?>
									<a href="#c-<?= $r['FCCI_Id'] ?>" class="not-link " ondblclick="listaactivos('Deposito central - <?= $r['FCCA_Descripcion'] ?>','<?= Yii::app()->createUrl('fccu/listaactivos/',array('view'=>'index','FCCA_Id'=>$r['FCCA_Id'],'FCCI_Id'=>11)) ?>')">
										<?= $r['depocentral'] ?></td>
									</a>
									<?php }else{
										echo $r['depocentral'] ;
									} ?>
								
								<td>
									<?php if($r['garantia'] > 0){ ?>
									<a href="#c-<?= $r['FCCI_Id'] ?>" class="not-link " ondblclick="listaactivos('Garantia - <?= $r['FCCA_Descripcion'] ?>','<?= Yii::app()->createUrl('fccu/listaactivos/',array('view'=>'index','FCCA_Id'=>$r['FCCA_Id'],'FCCI_Id'=>4)) ?>')">
										<?= $r['garantia'] ?></td>
									</a>
									<?php }else{
										echo $r['garantia'] ;
									} ?>
								<td>
									<?php if($r['prestado'] > 0){ ?>
									<a href="#c-<?= $r['FCCI_Id'] ?>" class="not-link " ondblclick="listaactivos('Prestado - <?= $r['FCCA_Descripcion'] ?>','<?= Yii::app()->createUrl('fccu/listaactivos/',array('view'=>'index','FCCA_Id'=>$r['FCCA_Id'],'FCCI_Id'=>5)) ?>')">
										<?= $r['prestado'] ?>
									</a> 
									<?php }else{
										echo $r['prestado'] ;
									} ?>
								</td>
								<td>
									<?php if($r['debaja'] > 0){ ?>
									<a href="#c-<?= $r['FCCI_Id'] ?>" class="not-link " ondblclick="listaactivos('De baja - <?= $r['FCCA_Descripcion'] ?>','<?= Yii::app()->createUrl('fccu/listaactivos/',array('view'=>'index','FCCA_Id'=>$r['FCCA_Id'],'FCCI_Id'=>6)) ?>')">
										<?= $r['debaja'] ?>
									</a>
									<?php }else{
										echo $r['debaja'] ;
									} ?>
								</td>
								<td>
									<?php if($r['reparacion'] > 0){ ?>
									<a href="#c-<?= $r['FCCI_Id'] ?>" class="not-link " ondblclick="listaactivos('En Reparacion - <?= $r['FCCA_Descripcion'] ?>','<?= Yii::app()->createUrl('fccu/listaactivos/',array('view'=>'index','FCCA_Id'=>$r['FCCA_Id'],'FCCI_Id'=>7)) ?>')">
										<?= $r['reparacion'] ?>
									</a>
									<?php }else{
										echo $r['reparacion'] ;
									} ?>
								</td>
								<td>
									<?php if($r['faltaparte'] > 0){ ?>
									<a href="#c-<?= $r['FCCI_Id'] ?>" class="not-link " ondblclick="listaactivos('Falta parte - <?= $r['FCCA_Descripcion'] ?>','<?= Yii::app()->createUrl('fccu/listaactivos/',array('view'=>'index','FCCA_Id'=>$r['FCCA_Id'],'FCCI_Id'=>8)) ?>')">
										<?= $r['faltaparte'] ?>
									</a>
									<?php }else{
										echo $r['faltaparte'] ;
									} ?>
								</td>
								<td>
									<?php if($r['pararepuesto'] > 0){ ?>
									<a href="#c-<?= $r['FCCI_Id'] ?>" class="not-link " ondblclick="listaactivos('Para repuesto - <?= $r['FCCA_Descripcion'] ?>','<?= Yii::app()->createUrl('fccu/listaactivos/',array('view'=>'index','FCCA_Id'=>$r['FCCA_Id'],'FCCI_Id'=>9)) ?>')">
										<?= $r['pararepuesto'] ?>
									</a>
									<?php }else{
										echo $r['pararepuesto'] ;
									} ?>
								</td>
							</tr>
						<?php 
						$total+=$r['total'];
						$talmacen1+=$r['almacen1'];
						$talmacen2+=$r['almacen2'];
						$tdepotecnico+=$r['depotecnico'];
						$tdepocentral+=$r['depocentral'];
						$tporrevisar+=$r['porrevisar'];
						$tgarantia+=$r['garantia'];
						$tprestado+=$r['prestado'];
						$tdebaja+=$r['debaja'];
						$treparacion+=$r['reparacion'];
						$tfaltaparte+=$r['faltaparte'];
						$tpararepuesto+=$r['pararepuesto'];
					} ?>
						</tbody>
						<tfoot>
							<tr>
								<td>Totales</td>
								<td><?= $total ?></td>
								<td><?= $tdepotecnico; ?></td>
								<td><?= $tporrevisar; ?></td>
								<td><?= $talmacen1; ?></td>
								<td><?= $talmacen2; ?></td>
								
								<td><?= $tdepocentral; ?></td>
								
								<td><?= $tgarantia; ?></td>
								<td><?= $tprestado; ?></td>
								<td><?= $tdebaja; ?></td>
								<td><?= $treparacion; ?></td>
								<td><?= $tfaltaparte; ?></td>
								<td><?= $tpararepuesto; ?></td>
									
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function listaactivos(nombre,url){
	$('#myModalLabel').html(nombre);
	$('#modal-activos').modal('show');
  	$('.modal-activos').load(url);
}
</script>