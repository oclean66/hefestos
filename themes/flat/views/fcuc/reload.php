<style>
    @media (min-width:972px){
        .add {
            width: 25.3%;
            display: inline;
            margin-right: 9px;
        }
        .add-hall {
            width: 20%;
            display: inline;
            margin-right: 9px;
        }
        .add-group{
            width: 10%;
            display: inline-table;
            top:10px;
            margin-right: 9px;
        }.add-label {
            margin-right: 4px;
        }
    } 

</style>
<style>
    #main{
        margin-left: 0px;
    }   
    .sidebar-fixed{
        display: none;
    }
</style>
<div class="box box-bordered box-color">
    <div class="box-title">
        <h3 id="serialC"><i class="fa fa-th-list"></i>Recargar Saldo</h3>
    </div>
    <div class="box-content nopadding">
        <form onsubmit="return false;" class="form-horizontal form-bordered" id="fccu-form" action="/hefestos/fccu/add.html" method="post">            <!--row1-->
            <div class="row" id="row1">
                <!--categoria-->
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Categoria</label>
                        <div class="col-sm-10">
                            <?php
                            echo CHtml::textField('Categoria', '', array('placeholder' => 'Categoria',
                                'class' => 'form-control ', 'disabled' => 'disabled', 'id' => 'categoria', 'size' => 45, 'maxlength' => 45));
                            ?>   
                        </div>
                    </div>


                </div>
                <!--lugar-->
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Estado</label>
                        <div class="col-sm-10">
                            <?php
                            echo CHtml::textField('Lugar', '', array('placeholder' => 'Estado',
                                'class' => 'form-control', 'disabled' => 'disabled', 'id' => 'lugar', 'size' => 45, 'maxlength' => 45));
                            ?>     
                        </div>
                    </div>


                </div>
            </div>
            <!--row2-->
            <div class="row " id='row2'>
                <!--operador-->
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Operador</label>
                        <div class="col-sm-10">
                            <?php
                            echo CHtml::textField('Operador', '', array('placeholder' => 'Operador',
                                'class' => 'form-control ', 'disabled' => 'disabled', 'id' => 'operador', 'size' => 45, 'maxlength' => 45));
                            ?>  
                        </div>
                    </div>


                </div>
                <!--servicio-->
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Servicio</label>
                        <div class="col-sm-10">
                            <?php
                            echo CHtml::textField('Servicio', '', array('placeholder' => 'Servicio',
                                'class' => 'form-control ', 'disabled' => 'disabled', 'id' => 'servicio', 'size' => 45, 'maxlength' => 45));
                            ?>  
                        </div>
                    </div>


                </div>
            </div>
            <!--row3-->
            <div class="row " id='row3' >
                <!--Tipo-->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Tipo</label>
                        <div class="col-sm-10">
                            <?php
                            echo CHtml::textField('Tipo', '', array('placeholder' => 'Tipo',
                                'class' => 'form-control ', 'disabled' => 'disabled', 'id' => 'tipo', 'size' => 45, 'maxlength' => 45));
                            ?>  


                        </div>
                    </div>


                </div>
                <!--Modelo-->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Modelo</label>
                        <div class="col-sm-10">
                            <?php
                            echo CHtml::textField('Modelo', '', array('placeholder' => 'Modelo',
                                'class' => 'form-control ', 'disabled' => 'disabled', 'id' => 'modelo', 'size' => 45, 'maxlength' => 45));
                            ?> 

                        </div>
                    </div>


                </div>
            </div>

            <!--lote    2 (hall)  -->
            <div id="hall" class=''>
                <div class="col-sm-12" style="margin-top:10px; margin-bottom: 10px;">
                    <?php echo CHtml::label('Serial', 'Serial', array('class' => 'control-label add-label ')); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                        'name' => 'lineas',
                        // additional javascript options for the autocomplete plugin
                        'options' => array(
                            'minLength' => '1',
                            'autoFocus' => true,
                            'select' => "js:function(event, ui) { 
                                    $('#id').val(ui.item.id);                                    
                                    $('#categoria').val(ui.item.categoria); 
                                      $('#lugar').val(ui.item.lugar);
                                        $('#operador').val(ui.item.operador);
                                          $('#servicio').val(ui.item.servicio); 
                                            $('#tipo').val(ui.item.tipo);
                                              $('#modelo').val(ui.item.modelo); 
                                               $('#numero').val(ui.item.numero); 
                                                $('#renta').val(ui.item.renta); 
                                                 $('#vence').val(ui.item.vence); 

                            }"
                        ),
                        'source' => $this->createUrl("lineas"),
                        'htmlOptions' => array(
                            'class' => 'form-control add',
                        ),
                    ));
                    ?>

                    <?php echo CHtml::label('Numero', 'Numero', array('class' => 'control-label add-label ')); ?>
                    <?php
                    echo CHtml::textField('Numero', '', array('placeholder' => 'Numero de telefono',
                        'class' => 'form-control add-hall', 'id' => 'numero', 'size' => 45, 'maxlength' => 45));
                    ?>


                    <?php echo CHtml::label('Monto', 'Monto', array('class' => 'control-label add-label')); ?>

                    <div class="input-group add-group">
                        <?php
                        echo CHtml::textField('monto', '', array('placeholder' => '0', 'id' => 'renta',
                            'class' => 'form-control ', 'size' => 45, 'maxlength' => 45));
                        ?>
                        <span class="input-group-addon">Bs</span>
                    </div>




                    <?php echo CHtml::label('Vence', 'Vence', array('class' => 'control-label add-label')); ?>

                    <div class="input-group add-group">
                        <?php echo CHtml::textField('vence', '', array('placeholder' => '0', 'id' => 'vence', 'class' => 'form-control add', 'size' => 45, 'maxlength' => 45)); ?>
                        <span class="input-group-addon">c/mes</span>
                    </div>


                    <button class="btn btn-success"  type="button">
                        <i class="fa fa-plus"></i> Recargar
                    </button>


                </div>
            </div>


            <!--Table-->
            <table class="table table-hover table-nomargin" style="padding-top: 5px" id="myTable">
                <thead>
                    <tr>



                        <th>#Serial</th><th>Tipo</th><th>Modelo</th><th>Acciones</th></tr>
                </thead>
                <tbody id="padre">
                </tbody>
            </table>
            <!--Botones-->
            <div class="form-actions">
                <button type="button" id="btn" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn" onclick="cleaner()">Limpiar</button>
            </div>



        </form>        </div>
</div>