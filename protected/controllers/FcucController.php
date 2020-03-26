<?php

class FcucController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    public function actionReload() {
        $this->render('reload');
    }
     public function actionLineas() {
        $request = trim($_GET['term']);
        if ($request != '') {
            $model = Fccu::model()->findAll(array("condition" => "FCCU_Numero is not NULL and (FCCU_Serial like '$request%' or FCCU_Numero like '$request%')"));
            $data = array();
            foreach ($model as $item) {
                $data[] = array(
                    'id' => $item->FCCU_Id,
                    'value' => $item->FCCU_Serial,
                    'numero' => $item->FCCU_Numero,
                    'categoria'=> $item->fCCT->fCCA->fCUU->FCUU_Descripcion,
                    'lugar'=> $item->fCCI->FCCI_Descripcion,
                    'operador'=> $item->fCCD->FCCD_Descripcion,
                    'servicio'=> $item->FCCU_TipoServicio,
                    'tipo'=> $item->fCCT->fCCA->FCCA_Descripcion,
                    'modelo'=> $item->fCCT->FCCT_Descripcion,
                    'renta'=> $item->FCCU_MontoMin,
                    'vence'=> $item->FCCU_DiaCorte,
                    
                    'label' => $item->FCCU_Serial . " | " . $item->fCCT->fCCA->FCCA_Descripcion . " " . $item->fCCT->FCCT_Descripcion . " | " . $item->FCCU_Numero,
                    'descrip' => $item->fCCT->fCCA->FCCA_Descripcion . " " . $item->fCCT->FCCT_Descripcion . " | " . $item->FCCU_Numero,
                   
                );

                // $data[] = $get->FCCU_Serial;
            }
            $this->layout = 'empty';
            echo json_encode($data);
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Fcuc;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Fcuc'])) {
            $model->attributes = $_POST['Fcuc'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->FCUC_Id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Fcuc'])) {
            $model->attributes = $_POST['Fcuc'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->FCUC_Id));
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
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {
        $model = new Fcuc('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Fcuc']))
            $model->attributes = $_GET['Fcuc'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Fcuc the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Fcuc::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Fcuc $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'fcuc-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
