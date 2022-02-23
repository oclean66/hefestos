<?php

class GccdController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    public function actionAssign()
    {

        $id = $_GET['val1'];
        //   echo $id;
        $model = $this->loadModel($id);

        if ($model->GCCD_Estado == 0) {
            $model->GCCD_Estado = 1;
            $estado = '<i class="fa fa-check"></i> Activos';
        } else if ($model->GCCD_Estado == 1) {
            $model->GCCD_Estado = 2;
            $estado = '<i class="fa fa-eye-slash"></i> Oculta';
        } else if ($model->GCCD_Estado == 2) {
            $model->GCCD_Estado = 0;
            $estado = '<i class="fa fa-times"></i> Inactivo';
        } 
        if ($model->save()) {
            echo $estado;
            // echo $model->GCCD_Estado;
            // echo  $model->getErrors();
        }
    }

    public function actionRellenarmodos() {
        //print_r($_POST);
        $id = $_POST['Fcco']['GCCD_Id'];
//
        $lista = Gcca::model()->findAll('GCCD_Id = :id and GCCA_Status=1',array(':id'=>$id));
        $lista = CHtml::listData($lista, 'GCCA_Id', 'concatened');
        echo CHtml::tag('option', array('value' => ''), 'Seleccione agencia...', true);
        foreach ($lista as $valor => $nombre) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($nombre), true);
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
    public function actionCreate($id = null) {
        $model = new Gccd;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Gccd'])) {
            $model->attributes = $_POST['Gccd'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->GCCD_Id));
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
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Gccd'])) {
            // print_r($_POST);
            $model->attributes = $_POST['Gccd'];
            if(isset($_POST['Public'])){
                $url = 'http://91.121.116.131/gecko/api/list/model/gccd';


                $options = array(
                    'http' => array(
                        'header' => "Content-type: application/json",
                        'method' => 'GET',

                    ),
                );
                $context = stream_context_create($options);
                $ajax_list = json_decode(file_get_contents($url, false, $context), true);

                GccaPublic::model()->deleteAll('GCCD_Id =:id', array(':id' => $model->GCCD_Id));
                foreach ($_POST['Public'] as $key => $value) {
                    $p = new GccaPublic;
                    $p->PUBLIC_GCCD_Id =  $value;
                    $p->PUBLIC = $ajax_list[$value];
                    $p->GCCD_Id = $id;
                    $p->save();
                }
                // print_r($_POST['Public']);
            }
            // if ($model->save()){
                // $this->redirect(array('admin'));

            // }
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
       $model = $this->loadModel($id);
       
       if($model->GCCD_Estado==0){
            $model->GCCD_Estado = 1;
        }else{
            $model->GCCD_Estado=0;
        }
       $model->save();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    
    public function actionAdmin() {

       
     
        $model = new Gccd('search');
        $model->unsetAttributes();  // clear any default values
        // $model->GCCD_Estado=1;
        $data['model']= $model;
        if (isset($_GET['Gccd']))
            $model->attributes = $_GET['Gccd'];

        $this->render('admin', array(
            'model' => $model ));
      
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Gccd the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Gccd::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Gccd $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'gccd-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
