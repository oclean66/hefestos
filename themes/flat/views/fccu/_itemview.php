<?php
$estado="";
switch ($data->FCCI_Id) {
    case 7:{
        $estado = "purple";
        break;
    }case 6:{
        $estado="danger";
        break;
    }case 5:{
        $estado="warning";
        break;
    }case 4:{
        $estado="info";
        break;
    }case 3:{
        $estado="alert";
        break;
    }case 2:{
        $estado="warning";
        break;
    }case 10:{
        $estado="default";
        break;
    }case 1:{
        $estado="success";
        break;
    }
}
?>
<a href="javascript:loadpage('<?= Yii::app()->createUrl('fccu/view/',array('id'=>$data->FCCU_Id)) ?>','<?= $data->FCCU_Id ?>');" class="item-<?= $data->FCCU_Id ?> list-group-item row panel-default list-group-item-<?= $estado ?> " style="margin: 0 !important;color:darkslategray" 
 >
<b><?= $data->FCCU_Bussiness ?></b><br/>
<?= $data->FCCU_Serial ?><br/>
<?= $data->fCCT->fCCA->FCCA_Descripcion ?> <?= $data->fCCT->FCCT_Descripcion ?>
<span class="badge badge-<?= $estado ?>"><?= $data->fCCI->FCCI_Descripcion ?></span>
</a>