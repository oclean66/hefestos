<?php

class ReportesController extends Controller
{

    public function actionResumen(){ 
  
        $resumen = Yii::app()->db->createCommand()
        ->select('fccu.FCCM_Id,
        fccu.FCCT_Id AS modelos,
        fccu.FCCI_Id AS estatus,
        fccu.FCCS_Id,
        fcct.FCCT_Descripcion,
        fcca.FCCA_Descripcion,
        fcci.FCCI_Descripcion,
        count(fcct.FCCA_Id) as total,
        sum(IF(fccu.FCCI_Id=1,1,0)) as almacen1,
        sum(IF(fccu.FCCI_Id=2,1,0)) as almacen2,
        sum(IF(fccu.FCCI_Id=3,1,0)) as porrevisar,
        sum(IF(fccu.FCCI_Id=4,1,0)) as garantia,
        sum(IF(fccu.FCCI_Id=5,1,0)) as prestado,
        sum(IF(fccu.FCCI_Id=6,1,0)) as debaja,
        sum(IF(fccu.FCCI_Id=7,1,0)) as reparacion,
        sum(IF(fccu.FCCI_Id=8,1,0)) as faltaparte,
        sum(IF(fccu.FCCI_Id=9,1,0)) as pararepuesto,
        sum(IF(fccu.FCCI_Id=10,1,0)) as depotecnico,
        sum(IF(fccu.FCCI_Id=11,1,0)) as depocentral')
        ->from('fccu')
        ->join('fcct', 'fccu.FCCT_Id = fcct.FCCT_Id')
        ->join('fcca', 'fcct.FCCA_Id = fcca.FCCA_Id')
        ->join('fcci', 'fccu.FCCI_Id = fcci.FCCI_Id')
        ->group('fcct.FCCA_Id')
        ->query();
   
        return $this->render('resumen', array('resumen' => $resumen));
    }
    
}
