<br>

<div class="box-content">
    <div class="panel-group" id="ac4">
        <?php
        foreach($movimientos as $m){
        ?>
        <div class="panel panel-default ">
            <div class="panel-heading">
                <h6 class="panel-title" style="font-size: 11px;">
                    <a href="#c-<?= $m['GCCD_Id'] ?>" data-toggle="collapse" class="not-link " onclick="listaactivos('<?= $m['GCCD_Id'] ?>','<?= Yii::app()->createUrl('fccu/DetalleMovimientos/',array('view'=>'index','id'=>$id,'tipo'=>$tipo,'desde'=>$desde,'hasta'=>$hasta,'agencia'=>$m['GCCD_Id'])) ?>')">
                    <?= $m['GCCD_Nombre'] ?>  
                    </a> 
                    <span class="badge" ><?= $m['total'] ?></span>
                </h6>
            </div>
            <div id="c-<?= $m['GCCD_Id'] ?>" class="panel-collapse collapse ">
                <div class="panel-body panel-body-<?= $m['GCCD_Id'] ?>"  style="padding:0 10px;" >
                  
                </div>
            </div>
        </div>
    <?php
        }
    ?>
    </div>
</div>
<script>
function listaactivos(id,url){
   $('.panel-body-'+id).load(url);
}
</script>