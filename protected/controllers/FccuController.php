<?php

class FccuController extends Controller
{

    public $layout = '//layouts/column2';

    public function actionAdd()
    {
        // $buenas = "";
        // $malas = "";

        if (isset($_POST['Fccu'])) {

            if ($_POST['Fccu']['FCUU_Id'] != 2) {

                // print_r($_POST['Fccu']);
                $fccu_serial = $_POST['Fccu']['FCCU_Serial'];
                $fcct_id = $_POST['Fccu']['FCCT_Id'];

                $correct = "<div class='label label-success'>Procesado</div>";
                $alert = "<div class='label label-danger'>NO Procesado</div>";
                $arrayNotificaciones = array();
                $total=0;
                foreach ($fccu_serial as $key => $value) {

                    $model = new Fccu;
                    
                    $model->FCCU_Serial = str_replace(" ", "", $value);
                    $model->FCCU_Facturado = 0; //false
                    $model->FCCI_Id = $_POST['Fccu']['FCCI_Id']; //almacen 2
                    // $model->FCUU_Id = $_POST['Fccu']['FCUU_Id']; //tipo equipo
                    $model->FCCU_Bussiness = Yii::app()->user->bussiness;
                    $model->FCCU_Cantidad = 1;
                    $model->FCCD_Id = 5;
                    $model->FCCU_Descripcion = "Sin Comentarios";
                    $model->FCCT_Id = $fcct_id[$key]; //modelo
                    try {
                        if ($model->save()) {
                            $total;
                            $total+=1;
                            /* $arrayNotificaciones[$model->FCCU_Serial] = array(
                                'item' => $correct,
                                'estado' => 'Serial <b style="color: green">' . $model->FCCU_Serial . '</b> Guardado correctamente',
                            ); */
                            // $buenas = $buenas . "Se guardo item " . $value . "</br>";
                        } /* else {
                            //error de model
                            // $arrayNotificaciones[]='no se guardo';
                            //print_r( $model->getErrors());
                        } */
                    } catch (Exception $exc) {
                        //repetidos
                        $arrayNotificaciones[$model->FCCU_Serial] = array(
                            'item' => $alert,
                            'estado' => '<b style="color: red">' . $model->FCCU_Serial . '</b> Repetido',
                            //'error' => $exc->getLine()
                        );
                    }
                }
                echo $correct . '&nbsp <b style="color: green">' . $total . '</b> Seriales </br>'; 
                /* echo "<div class='label label-success'>Correcto</div>";
                echo "<div class='label label-alert'>Alerta</div>"; */
                // echo $malas . $buenas;
                // print_r(json_decode("[[title:'nombre']]"));
                foreach ($arrayNotificaciones as $value){
                        echo $value['item'] . "&nbsp";
                        echo $value['estado'] . "</br>";
                        // echo 'Error' . $value['error'];
                }
                return;
            } else if ($_POST['Fccu']['FCUU_Id'] == 2) {

                //print_r($_POST['Fccu']);
                $fccu_serial = $_POST['Fccu']['FCCU_Serial'];
                $fcct_id = $_POST['Fccu']['FCCT_Id'];
                $FCCU_Numero = $_POST['Fccu']['FCCU_Numero'];
                $FCCU_MontoMin = $_POST['Fccu']['FCCU_MontoMin'];
                $FCCU_DiaCorte = $_POST['Fccu']['FCCU_DiaCorte'];

                $correct = "<div class='label label-success'>Procesado</div>";
                $alert = "<div class='label label-danger'>NO Procesado</div>";
                $arrayNotificaciones = array();
                $total=0;
                foreach ($fccu_serial as $key => $value) {
                    $model = new Fccu;
                    $model->FCCU_Bussiness = Yii::app()->user->bussiness;
                    $model->FCCU_Serial = str_replace(" ", "", $value);
                    $model->FCCU_Facturado = 0; //false
                    $model->FCCI_Id = $_POST['Fccu']['FCCI_Id']; //almacen 2
                    //  $model->FCUU_Id = $_POST['Fccu']['FCUU_Id']; //tipo equipo
                    $model->FCCU_Cantidad = 1;
                    $model->FCCD_Id = $_POST['Fccu']['FCCD_Id'];
                    
                    $model->FCCU_MontoMin = $FCCU_MontoMin[$key];
                    $model->FCCU_DiaCorte = $FCCU_DiaCorte[$key];
                    $model->FCCU_TipoServicio = $_POST['Fccu']['FCCU_TipoServicio'];
                    $model->FCCU_Numero = trim(preg_replace("/[\\x00-\\x20]+/", "", $FCCU_Numero[$key]), "\\x00-\\x20");
                    $model->FCCU_Descripcion = "Sin Comentarios";
                    $model->FCCT_Id = $fcct_id; //modelo
                    try {
                        if ($model->save()) {
                            $total;
                            $total+=1;
                            /* $arrayNotificaciones[$model->FCCU_Serial] = array(
                                'item' => $correct,
                                'estado' => 'Serial <b style="color: green">' . $model->FCCU_Serial . '</b> Guardado correctamente',
                            ); */
                    
                            //$buenas = $buenas . "Se guardo item " . $value . "</br>";
                        }
                    } catch (Exception $exc) {
                        //throw new CHttpException(500, $exc->getMessage());
                        $arrayNotificaciones[$model->FCCU_Serial] = array(
                            'item' => $alert,
                            'estado' => '<b style="color: red">' . $model->FCCU_Serial . '</b> Repetido',
                            //'error' => $exc->getMessage()
                        );
                        //$malas = $malas . "No se pudo con este " . $model->FCCU_Serial . "</br>"; //$exc->getTraceAsString();
                    }
                }

                echo $correct . '&nbsp <b style="color: green">' . $total . '</b> Seriales </br>';
                //echo $malas . $buenas;

                foreach ($arrayNotificaciones as $value){
                    echo $value['item'] . "&nbsp";
                    echo $value['estado'] . "</br>";
                    //echo 'Error' . $value['error'];
            }
                return;
            }
        } else {
            $this->render('add', array(
                'model' => new Fccu,
            ));
        }
    }

    public function actionRecibe($id)
    {
        //echo $id;

        $criteria = new CDbCriteria;
        $criteria->select = 'max(FCCO_Lote) AS FCCO_Lote';
        $row = Fcco::model()->find($criteria);
        $somevariable = $row['FCCO_Lote'] + 1;

        $inventario = Fcco::model()->find('FCCO_Enabled = 1 and FCCN_Id = 1 and FCCU_Id=' . $id . ' order by FCCO_Timestamp DESC');
        $inventario->FCCO_Enabled = 0; // deshabilito los anteriores

        $model = new Fcco;
        $model->FCCO_Timestamp = date('Y-m-d H:i:s');
        $model->FCCO_Lote = $somevariable;
        $model->FCCO_Descripcion = $inventario->FCCO_Descripcion;
        $model->FCCO_Enabled = 1;
        $model->FCCN_Id = 2;
        $model->FCCU_Id = $inventario->FCCU_Id;
        $model->GCCA_Id = $inventario->GCCA_Id;
        $model->GCCD_Id = $inventario->GCCD_Id;

        //$item = $this->loadModel($id);
        $item = Fccu::model()->find('FCCU_Id = ' . $id);
        $item->FCCI_Id = 10; //cambia de estado al seleccionado

        if ($inventario->save() && $model->save() && $item->save()) {
            // echo "ok";

            //echo $item->FCCU_Id . " actualizado en " . $model->FCCO_Id;
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else {
            return array(
                'inventario' => $inventario->getErrors(),
                'model' => $model->getErrors(),
                'item' => $item->getErrors(),
            );
        }
        //
        //
        //        
    }
    /*Funcion para agregar comunicaciones nuevas, lista los modelos*/
    public function actionRellenarmodos()
    {
      //  die(print_r($_POST));
        $id = (isset($_POST['Fccu']['FCCA'])) ? $_POST['Fccu']['FCCA']:$_POST['Fccu']['FCCA_Id'];


        $lista = Fcct::model()->findAll('FCCA_Id = ' . $id);
        $lista = CHtml::listData($lista, 'FCCT_Id', 'FCCT_Descripcion');
        echo CHtml::tag('option', array('value' => ''), 'Seleccione modelo...', true);
        foreach ($lista as $valor => $nombre) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($nombre), true);
        }
    }
    /*Funcion para agregar equipos nuevos, lista los modelos*/
    public function actionRellenar()
    {
        $id = $_POST['Fccu']['FCCA_Id_Master'];

        $lista = Fcct::model()->findAll('FCCA_Id = ' . $id);
        $lista = CHtml::listData($lista, 'FCCT_Id', 'FCCT_Descripcion');
        echo CHtml::tag('option', array('value' => ''), 'Seleccione modelo...', true);
        foreach ($lista as $valor => $nombre) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($nombre), true);
        }
    }

    public function actionView($id, $view='admin')
    { 
        ignore_user_abort(true);
        set_time_limit(0);

        $model = $this->loadModel($id);
        $modelo = new Fcco('search');
        $modelo->unsetAttributes();
        $modelo->desde = date('2000-01-01');
        $modelo->hasta = date('2025-01-01');

        $modelo->FCCU_Id = $id;    
        $resumen=$model->resumenTab();
       
        // da madre error de constraint ambiguos
        if (isset($_POST['comment']) && $_POST['comment'] != '') {
          
            $re = $model->setComment($_POST['comment']);
          
            echo "<!-- Error ";
            print_r($re);
            echo " -->";
            
        }
        
        
        if($view=='index'){
            $this->render('view', array(
                'model' => $model,
                'modelo' => $modelo,
                'resumen' => $resumen,
                'view'=>$view
            ));
        }else{
            $this->renderPartial('view', array(
                'model' => $model,
                'modelo' => $modelo,
                'resumen' => $resumen,
                'view'=>$view
            ));
        }
    }

    public function actionUpdate($id, $view = 'admin')
    {
       
        $model = $this->loadModel($id);
        if ($model->FCCI_Id == 5) {  
            $this->redirect(array('view', 'id' => $model->FCCU_Id,'view'=>$view, 'alert' => "No se puede editar, Este activo se encuentra asignado"));
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Fccu'])) {
            $model->attributes = $_POST['Fccu'];

            if ($model->FCCS_Id == '')
                $model->FCCS_Id = null;

            if ($model->save())
                $this->redirect(array($view, 'id' => $model->FCCU_Id,'Fccu[FCCU_Serial]'=>$model->FCCU_Serial));
        }
   
        if($view == 'admin'){
            $this->renderPartial('update', array(
                'model' => $model,
                'view'=>$view
            ));
        }else{
            $this->render('update', array(
                'model' => $model,
                'view'=>$view
            )); 
        }
    }

    public function actionCreate()
    {
        $model = new Fccu();
        //        $this->redirect(array('view', 'id' => $model->FCCU_Id));
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Fccu'])) {
            $model->attributes = $_POST['Fccu'];

            if ($model->FCCS_Id == '')
                $model->FCCS_Id = null;
            try {
                if ($model->save()) {
                    $this->redirect(array('view', 'id' => $model->FCCU_Id));
                }
            } catch (Exception $exc) {
                echo $exc->getMessage();
                print_r($model->getErrors());
                //$malas = $malas . "No se pudo con este " . $model->FCCU_Serial . " </br>"; //;
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id, $vista = 'admin')
    {

        $model = $this->loadModel($id);
        $model->FCCI_Id = 6;
        $model->save();
        // $this->redirect(array('view', 'id' => $model->FCCU_Id));


        //        $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])){
           // $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
           $this->redirect(array($vista, 'id' => $model->FCCU_Id,'Fccu[FCCU_Serial]'=>$model->FCCU_Serial,'alert' => "Activo dado de baja."));
        }
    }

    public function actionAdmin($id=false)
    {
       
        $model = new Fccu('search');
        ini_set('memory_limit', '-1');

       
       $model->unsetAttributes();  // clear any default values
       if($id){
            $model->FCCU_Id = $id;

        }
        if (isset($_GET['Fccu'])){
            $model->attributes = $_GET['Fccu'];
        }

        /*if ($tipo == null)
            $tipo = 1;
        $model = Fccu::model()->findAll("FCCU_Serial=:serial and FCCI_Id=:estado", array('serial' => $id, 'estado' => $tipo));*/

        /*  $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->condition = "FCCU_Serial=:serial and FCCI_Id =:estado";
        $criteria->params = array(':serial' => $id, ':estado' => $tipo); */
      //  $activos=Fccu::model()->GetActivos();
    

        $this->render('admin', array(
            'model' => $model
        ));
    }

    public function actionIndex(){
        $model = new Fccu('search');
		$model->unsetAttributes();  // clear any default values
		// $model->GCCA_Status = 1;
		if (isset($_GET['Fccu']))
			$model->attributes = $_GET['Fccu'];

        $this->render('index', array(
			'model' => $model,
		));
    }
    public function actionReport($id)
    {

        $model = $this->loadModel($id);
        $model->save();
        //$this->redirect(array('view', 'id' => $model->FCCU_Id));

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function loadModel($id)
    {
        $model = Fccu::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'fccu-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
