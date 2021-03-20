<?php

class TccmController extends Controller
{
	public function actionToggle()
	{
		// $_GET['']
		$board = Tcca::model()->find('TCCA_Id=:id',array(':id'=>$_GET['idmodel']));

		$access = Tccm::model()->find('TCCM_IdUser=:TCCM_IdUser and TCCM_IdModel=:TCCM_IdModel and TCCM_Model="TCCA"',
				array(
					"TCCM_IdUser"=>$_GET['iduser'],
					"TCCM_IdModel"=>$_GET['idmodel']
		));
		if(isset($access)){
			// $access->TCCM_Status="";
			if($access->delete())
			echo "Agregar";
			
		}else{
			$access = new Tccm;
			
			$access->TCCM_IdUser=$_GET['iduser'];
			$access->TCCM_IdModel=$_GET['idmodel'];
			$access->TCCM_Model="TCCA";
			$access->TCCM_Status="Invitado";
			if($access->save()){
				echo "Eliminar";
				if( Yii::app()->user->id != $_GET['iduser'])
				$this-> sendNotification(
					$id=$_GET['iduser'], 
					$title = "<b>".Yii::app()->user->name."</b> te agrego al tablero <b>".$board->TCCA_Name."</b>",
					$url = Yii::app()->createUrl('tcca/view',array('id'=>$_GET['idmodel']))
					
					
				);
			
			}

		}
		
		
	}

	
}