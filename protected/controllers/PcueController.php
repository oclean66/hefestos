<?php

class PcueController extends Controller {

   
    public $layout = '//layouts/column2';

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionIndex() {
       
        $model = new Pcue('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Pcue']))
            $model->attributes = $_GET['Pcue'];

        if (!Yii::app()->user->checkAccess('controller_pcue'))
            $model->PCUE_UserId = Yii::app()->user->id;
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = Pcue::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pcue-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
