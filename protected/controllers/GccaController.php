<?php

class GccaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';



	public function actionAssign()
	{

		$val1 = $_GET['val1'];
		$val2 = $_GET['val2'];

		$model = $this->loadModel($val1, $val2);

		if ($model->GCCA_Status == 0) {
			
			$model->GCCA_Status = 1;
			$estado = '<i class="fa fa-check"></i> Activa';
		} else if ($model->GCCA_Status == 1) {
			
			$model->GCCA_Status = 2;
			$estado = '<i class="fa fa-eye-slash"></i> Oculta';
		} else if ($model->GCCA_Status == 2) {
			
			$model->GCCA_Status = 0;
			$estado = '<i class="fa fa-times"></i> Inactiva';
			
		}
		if ($model->save()) {
			echo $estado;
		} else {
			echo "Error";
			print_r($model->getErrors());
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id, $excel = false)
	{
		$agencia = $this->loadModel($id);
		$model = new Fcco('search');
		$model->unsetAttributes();  // clear any default values
		$model->GCCA_Id = $id;
		// $model->GCCD_Id = $agencia->GCCD_Id;


		if (isset($_GET['Fcco'])) {

			$model->attributes = $_GET['Fcco'];
			$model->GCCA_Id = $id;
			// $model->GCCD_Id = $agencia->GCCD_Id;
			// $model->FCCN_Id = 1;
		}
		$model->FCCO_Enabled = 0; // historial asignado
		// $model->FCCN_Id = 1; //operacion asignado

		// $model->FCCO_Enabled = 0; //asignado actualmente


		$model->desde = date('2000-01-01');
		$model->hasta = date('2025-01-01');

		if ($excel) {
			//
			$content = $this->renderPartial("_search", array('model' => $model), true, true);

			Yii::app()->request->sendFile('Historial Agencia ' . $agencia->concatened . '.xls', $content);
		}
		$this->render('view', array(
			'model' => $agencia,
			'historial' => $model
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id = null)
	{
		$model = new Gcca;
		$model->GCCA_Status = 1;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if (isset($_POST['Gcca'])) {
			$model->attributes = $_POST['Gcca'];
			$model->GCCA_Cod = strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ", "", $model->GCCA_Cod)));
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->GCCA_Id));
		}

		$this->render('create', array(
			'model' => $model, 'id' => $id
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Gcca'])) {
			$model->attributes = $_POST['Gcca'];
			if ($model->save())
				// $this->redirect(array('view', 'id' => $model->GCCA_Id));
				$this->redirect(array('fcco/agencia', 'id' => $model->GCCA_Id, 'type' => 'completed'));
		}

		$this->render('update', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$object = $this->loadModel($id);
		if ($object->GCCA_Status == 0) {
			$object->GCCA_Status = 1;
		} else {
			$object->GCCA_Status = 0;
		}
		$object->save();
		// ->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


	public function actionAdmin()
	{
		$model = new Gcca('search');
		$model->unsetAttributes();  // clear any default values
		$model->GCCA_Status = 1;
		if (isset($_GET['Gcca']))
			$model->attributes = $_GET['Gcca'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Gcca the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Gcca::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Gcca $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'gcca-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
