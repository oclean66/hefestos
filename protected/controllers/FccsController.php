<?php

class FccsController extends Controller
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Fccs;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Fccs']))
		{
			$model->attributes=$_POST['Fccs'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->FCCS_Id));
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

		if(isset($_POST['Fccs']))
		{
			$model->attributes=$_POST['Fccs'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->FCCS_Id));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	
	public function actionAdmin()
	{
		$model=new Fccs('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Fccs']))
			$model->attributes=$_GET['Fccs'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	public function actionNumbfac()
	{
		$factura=$_GET['FCCS_Numfac'];
		$model = Fccu::model()->find(array('condition'=>'FCCU_Serial=:serial','params'=>array(':serial'=>$serial)));
		$r=1;
		if ($model === null){
			$r=0;
		}
		echo $r;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Fccs the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Fccs::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Fccs $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='fccs-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
