<?php

class TccaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{

		if(isset($_POST['name']) && $_POST['name']=='TCCA_New'){
			// print_r($_POST);
				$model=new Tcca;
				$model->TCCA_Name = $_POST['value'];
				$model->TCCA_BoardId=$id;
				$model->TCCA_Type=1;			

				if($model->save()){
					echo $model->TCCA_Name;
					return $model;

			 }else{
				throw new CHttpException(404,'The requested page does not exist.');
			 }
		}
		$board=array();
		$listas = Tcca::model()->findAll('TCCA_Type=1 and TCCA_BoardId =:id and TCCA_Archived is null',array('id'=>$id));
		foreach ($listas as  $value) {
			$board[]=array(
				'id'=>$value->TCCA_Id,
				'name'=>$value->TCCA_Name,
				'order'=>1,
				'task'=>Tccd::model()->findAll('TCCA_Id =:id order by TCCD_Order',array('id'=>$value->TCCA_Id))
			);
		}


		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'lists'=>$board
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Tcca;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tcca']))
		{
			$model->attributes=$_POST['Tcca'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->TCCA_Id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tcca']))
		{
			$model->attributes=$_POST['Tcca'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->TCCA_Id));
		}

		if(isset($_POST['name']) && $_POST['name']=='TCCA_Name'){
			// print_r($_POST);
			 $model->TCCA_Name = $_POST['value'];
			 if($model->save()){
				 echo $model->TCCA_Name;
				 return $model;

			 }else{
				throw new CHttpException(404,'The requested page does not exist.');
			 }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$model->TCCA_Archived = date('Y-m-d H:i');
		$model->save();
		echo "Archived";
		
	}
	public function actionDeleteAll($id)
	{
		// Tcca::model()->update
		Tccd::model()->updateAll(array('TCCD_Archived'=>date("Y-m-d")),'TCCA_Id="'.$id.'"');


		// $model = $this->loadModel($id);
		// $model->TCCA_Archived = date('Y-m-d H:i');
		// $model->save();
		echo "All Archived";
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Tcca;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tcca']))
		{
			$model->attributes=$_POST['Tcca'];
			$model->TCCA_BoardId=null;
			$model->TCCA_Type=0;
			if($model->save())
				$this->redirect(array('view','id'=>$model->TCCA_Id));
		}

		$dataProvider=Tcca::model()->findAll('TCCA_Type=0');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tcca('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tcca']))
			$model->attributes=$_GET['Tcca'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tcca the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Tcca::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Tcca $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tcca-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
