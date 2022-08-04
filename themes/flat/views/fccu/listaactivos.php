
<br>
<ul class="list-group" style="margin:0 !important;" >
    <?php foreach($movimientos as $m){ ?>
        <li class="list-group-item list-group-item-action  ">
            <b>Serial:</b> 
            <a class=" not-link " href="<?= Yii::app()->createUrl('fccu/'.$m['FCCU_Id'],array('view'=>'index')) ?>" target="_blank" ><?= $m['FCCU_Serial'] ?> </a>
            /<b>Fecha asignacion: </b><?= $m['FCCO_Timestamp'] ?>
            /
            <?php 
                if(!empty($m['GCCA_Nombre'])){
                    ?>
                    <a class=" not-link " href="<?= Yii::app()->createUrl('fcco/agencia/'.$m['GCCA_Id']) ?>?type=<?= $m['GCCA_Id'] ?>" target="_blank" > <?= $m['GCCA_Nombre'] ?> </a>
                    <?php
                }else{
                    ?>
                    <a class=" not-link " href="<?= Yii::app()->createUrl('gccd/'.$m['GCCD_Id']) ?>" target="_blank" > <?= $m['GCCD_Nombre'] ?> </a>
                    <?php
                }
            ?>
        </li>
    <?php } ?>
</ul>