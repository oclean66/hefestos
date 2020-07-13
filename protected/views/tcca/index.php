<?php
/* @var $this TccaController */
/* @var $dataProvider CActiveDataProvider */



// $this->menu=array(
// 	array('label'=>'Nuevo Tablero', 'url'=>array('create')),
// 	// array('label'=>'Manage Tcca', 'url'=>array('admin')),
// );
?>

<h1>Mis Tableros</h1>



<div class="col-sm-12">
    <ul class="tiles">

        <?php 

        foreach ($dataProvider as $value) {
            // print_r($value);
            ?>
            <li class='<?php echo $value['TCCA_Archived'] ? "pink long":"blue long"; ?>'>
                <a href="<?php echo Yii::app()->createUrl('tcca/view',array('id'=>$value['TCCA_Id']));?>">
                    <span class="nopadding">
                        <h5><?php echo $value['TCCA_Name'];?>
                        <br/>
                            <small style="color:white;"><?php echo $value['TCCA_Archived']?"Archivado":"";?></small>                   
                        </h5>     
                    </span>
                    
                </a>
            </li>
            <?php
            }
        ?>        

        <li class="lime">
            <a href="#modal-1" data-toggle="modal" target="_blank" >
                <span class="">
                    <i class="fa fa-plus-square"></i> </span>
                <span class="name">Agregar Tablero</span>
            </a>
        </li>

    </ul>
</div>

<!-- <div class="col-sm-12" style="margin-top:40px;">
    <div class="panel-group panel-widget" id="ac3">

        <div class="panel panel-default blue">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a href="#c1" data-toggle="collapse" data-parent="#ac3" class="collapsed">
                        Tableros Archivados
                    </a>
                </h4>
                
            </div>
           
            <div id="c1" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate eaque saepe doloribus excepturi! Aut minus ullam quaerat tempore fugiat ex.
                </div>
               
            </div>
          
        </div>       

    </div>
</div> -->

<div id="modal-1" class="modal fade" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content ">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'tcca-form',
                'enableAjaxValidation'=>false,                
                'htmlOptions' => array('class' => 'form-bordered'),
                )); ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel" >
                            <a href="#" class="listTitle" data-placement="right">Crear Tablero</a>
                        </h4>
                    </div>
                    
                    <div class="modal-body">
                    

                        <?php echo $form->errorSummary($model); ?>

                        <div class="form-group">
                            
                            <div class="col-sm-12">
                                <?php echo $form->textField($model,'TCCA_Name',array('placeholder'=>'Nombre del Tablero','size'=>60,'maxlength'=>80)); ?>
                                <?php echo $form->error($model,'TCCA_Name'); ?>
                            </div>
                        </div>                        
                    </div>

                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Tablero</button>
                        
            
                        <!-- <button type="submit" class="btn btn-default">Sign in</button> -->
                    </div>
                <?php $this->endWidget(); ?>
            <!-- /.modal-footer -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>