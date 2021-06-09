<?php

class FccaController extends Controller {

    public $layout = '//layouts/column2';

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new Fcca;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Fcca'])) {
            $model->attributes = $_POST['Fcca'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->FCCA_Id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Fcca'])) {
            $model->attributes = $_POST['Fcca'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->FCCA_Id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {
        $model = new Fcca('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Fcca']))
            $model->attributes = $_GET['Fcca'];

        $this->render('admin', array(
            'model' => $model
        ));
    }

    public function loadModel($id) {
        $model = Fcca::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'fcca-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
