<?php
$estado="";
$theme = Yii::app()->user->um->getFieldValue(Yii::app()->user->id, 'theme');
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
<li class="list-group-item row panel-default item-<?= $data->FCCU_Id ?> item-<?= $theme ?>"style="margin: 0 !important; ">
    <div class="col-md-11 nopadding "  >
     <button class=" btn " onclick="copyserial(this)"><i class="fa fa-copy"> </i></button>&nbsp;<span class="id_fccu_serial"><?= $data->FCCU_Serial ?></span><br/>
        <?= $data->fCCT->fCCA->FCCA_Descripcion ?> <?= $data->fCCT->FCCT_Descripcion ?><br>
        <span class="badge badge-info">F. Ingreso: <?= $data->FCCU_Timestamp ?></span>
        <span class="badge badge-<?= $estado ?>"><?= $data->fCCI->FCCI_Descripcion ?>
        <?=  $data->FCCI_Id==5 ? ': '.Fcco::model()->find("FCCU_Id=".$data->FCCU_Id. " order by FCCO_Id desc")->cod:'' ?>
    </span>

       
    </div>
    
    <a href="javascript:loadpage('<?= Yii::app()->createUrl('fccu/view/',array('id'=>$data->FCCU_Id)) ?>','<?= $data->FCCU_Id ?>');" class="col-md-1 nopadding btn-list-right " >
        <i class="fa fa-angle-right" ></i>
    </a>
</li>