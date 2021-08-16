<?php

class FccoController extends Controller
{

    public $layout = '//layouts/column2';

    public function actionReport($FCCN_Id = null)
    {
        $model = new Fcco('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['desde']) && isset($_POST['hasta'])) {
            $model->desde = strftime("%Y-%m-%d", strtotime($_POST['desde']));
            $model->hasta = strftime("%Y-%m-%d", strtotime($_POST['hasta']));

            if ($model->desde == $model->hasta) {
                $model->hasta = date('Y-m-d', strtotime($model->desde . ' +1 day'));
            }

            // $model->FCCO_Timestamp = strftime("%Y-%m-%d", strtotime($_POST['datepicker']));
        } else {
            $model->FCCO_Timestamp = date('Y-m-d');
            $model->desde = date('Y-m-d');
            $model->hasta = date('Y-m-d', strtotime($model->desde . ' +1 day'));
        }

        $model->FCCN_Id = $FCCN_Id;
        if (isset($_GET['Fcco']))
            $model->attributes = $_GET['Fcco'];

        // $array = array();
        $query = new CDbCriteria;
        $query->with = 'gCCA';
        $query->select = "count(*) as FCCO_Id, GCCA_Id, FCCO_Timestamp";

        $query->condition = $model->GCCA_Id != '' ? "FCCO_Timestamp BETWEEN '" . $model->desde . "' and '" . $model->hasta . "' and FCCN_Id = " . $FCCN_Id . " and t.GCCA_Id = " . $model->GCCA_Id : "FCCO_Timestamp BETWEEN '" . $model->desde . "' and '" . $model->hasta . "' and FCCN_Id = " . $FCCN_Id;
        $query->group = "t.GCCA_Id, DATE_FORMAT(FCCO_Timestamp,'%Y-%m-%d')";
        $query->order = "FCCO_Timestamp desc";
        $agencias = Fcco::model()->findAll($query);

        $this->render('report', array(
            'model' => $model,
            'agencias' => $agencias,
            'FCCN_Id' => $FCCN_Id,
            'desde' => $model->desde,
            'hasta' => $model->hasta
        ));
    }
    public function actionDetalleReporte($FCCN_Id = 1, $gcca_id)
    {
        if (isset($_POST['desde']) && isset($_POST['hasta'])) {
            $desde = strftime("%Y-%m-%d", strtotime($_POST['desde']));
            $hasta = strftime("%Y-%m-%d", strtotime($_POST['hasta']));

            if ($desde == $hasta) {
                $hasta = date('Y-m-d', strtotime($model->desde . ' +1 day'));
            }

            // $model->FCCO_Timestamp = strftime("%Y-%m-%d", strtotime($_POST['datepicker']));
        } else {
            $desde = date('Y-m-d');
            $hasta = date('Y-m-d', strtotime($desde . ' +1 day'));
        }

        $agencia = Fcco::model()->findAll("
        FCCO_Timestamp BETWEEN '" . $desde . "' and '" . $hasta . "' 
        and FCCN_Id = " . $FCCN_Id . "
        and GCCA_Id = " . $gcca_id . " order by FCCO_Timestamp desc");


        echo "
            <table class='table table-hover table-condensed'>
                <thead>
                <tr>
                    <th>#Serial</th>
                    <th>Descripcion</th>
                    
                </tr>
                </thead>
                <tbody>";
        foreach ($agencia as $value) {
            echo "<tr>
                    <td>
                    {$value->fCCU->FCCU_Serial}
                    </td>
                    <td>
                    {$value->fCCU->fCCT->fCCA->FCCA_Descripcion}
                    </td>
                    </tr>";
        }
        echo "
                </tbody>
            </table>
            ";
    }

    public function actionLess()
    {

        if (isset($_POST['Fcco'])) {
            // print_r($_POST['Fcco']);
            // $salida = array();
            $array = $_POST['Fcco']['FCCU_Id'];
            $criteria = new CDbCriteria;
            $criteria->select = 'max(FCCO_Lote) AS FCCO_Lote';
            $row = Fcco::model()->find($criteria);
            $somevariable = $row['FCCO_Lote'] + 1;
            foreach ($array as $key => $value) {

                $inventario = Fcco::model()->find('FCCO_Enabled = 1 and FCCN_Id = 1 and FCCU_Id=' . $value . ' order by FCCO_Timestamp DESC');
                if (isset($inventario)) {

                    $inventario->FCCO_Enabled = 0; // deshabilito los anteriores


                    $model = new Fcco;
                    $model->FCCO_Timestamp = date('Y-m-d H:i:s');
                    $model->FCCO_Lote = $somevariable;
                    $model->FCCO_Descripcion = isset($inventario) ? $inventario->FCCO_Descripcion : "";
                    $model->FCCO_Enabled = 1;
                    $model->FCCN_Id = 2;
                    $model->FCCU_Id = $value;
                    $model->GCCA_Id = $inventario->GCCA_Id;
                    $model->GCCD_Id = $inventario->GCCD_Id;

                    $item = Fccu::model()->find('FCCU_Id = ' . $value);
                    $item->FCCI_Id = $_POST['Fcco']['FCCI_Id'][$key]; //cambia de estado al seleccionado

                    if ($inventario->save() && $model->save() && $item->save()) {
                        //$salida[]=array('serial'=>$inventario->FCCU_Id, 'descripcion'=> $item->fCCU->fCCT->fCCA->FCCA_Descripcion . " " . $item->fCCU->fCCT->FCCT_Descripcion . " | " . $item->fCCU->FCCU_Numero, 'lugar'=>$item->lugar);
                        $log = new Pcue;
                        $log->PCUE_Descripcion = 'Usuario inserto en Fcco';
                        $log->PCUE_Action = 'INSERTAR';
                        $log->PCUE_Model = 'Fcco';
                        $log->PCUE_IdModel = $model->FCCO_Id;
                        $log->PCUE_Field = 'TODOS';
                        $log->PCUE_Date = date("Y-m-d H:i");
                        $log->PCUE_UserId = Yii::app()->user->id . " - " . Yii::app()->user->name;
                        $log->PCUE_Detalles = 'Uso el metodo de asignar en lote';
                        $log->save();

                        echo $item->FCCU_Id . " actualizado en " . $model->FCCO_Id;
                    }
                }
            }
            $this->redirect(array('enter', 'id' => $somevariable, 'tipo' => 2));
        } else {
            $this->render('less', array(
                'model' => new Fccu,
            ));
        }
    }

    public function actionView($id, $tipo = null, $view = null, $agencia = null)
    {


        if ($tipo == null)
            $tipo = 1;

        $modell = Fcco::model()->findAll("FCCO_Lote=:lote and FCCN_Id =:tipo", array(':lote' => $id, ':tipo' => $tipo));
        if (isset($agencia))
            $model = Gcca::model()->find('GCCA_Id=:id', array(':id' => $agencia));
        else
            $model = $modell->gCCA;


        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->condition = "FCCO_Lote=:lote and FCCN_Id =:tipo";
        $criteria->params = array(':lote' => $id, ':tipo' => $tipo);


        if ($view === null)
            $this->render('view', array(
                'modelo' => $modell, 'tipo' => $tipo, 'model' => $model, 'lote' => $id
            ));
        else
            $this->renderPartial('view', array(
                'modelo' => $modell, 'tipo' => $tipo, 'model' => $model, 'lote' => $id
            ));
    }

    public function actionViewSalidaDia($tipo = null, $view = null, $agencia, $print = false)
    {

        $model = Gcca::model()->find('GCCA_Id=:id', array(':id' => $agencia));

        if (isset($_POST['desde']) && isset($_POST['hasta'])) {
            $desde = strftime("%Y-%m-%d", strtotime($_POST['desde']));
            $hasta = strftime("%Y-%m-%d", strtotime($_POST['hasta']));

            if ($desde == $hasta) {
                $hasta = date('Y-m-d', strtotime($model->desde . ' +1 day'));
            }
        } else if (isset($_GET['desde']) && isset($_GET['hasta'])) {
            $desde = strftime("%Y-%m-%d", strtotime($_GET['desde']));
            $hasta = strftime("%Y-%m-%d", strtotime($_GET['hasta']));

            if ($desde == $hasta) {
                $hasta = date('Y-m-d', strtotime($model->desde . ' +1 day'));
            }
        } else {
            $desde = date('Y-m-d');
            $hasta = date('Y-m-d', strtotime($desde . ' +1 day'));
        }

        if ($tipo == null)
            $tipo = 1;

        $modelo = Fcco::model()->findAll(
            "GCCA_Id = :id 
            and FCCN_Id =:tipo
            and FCCO_Timestamp BETWEEN 
            :ini and :fin  
            order by FCCO_Timestamp desc",
            array(
                ':id' => $agencia,
                ':tipo' => $tipo,
                ':ini' => $desde,
                ':fin' => $hasta,
            )
        );

        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->condition = "GCCA_Id = :id 
                and FCCN_Id =:tipo
                and FCCO_Timestamp BETWEEN 
                :ini and :fin";

        $criteria->with = array('fCCU' => array('with' => 'fCCT', 'fCCT' => array('with' => 'fCCA')));

        $criteria->params = array(
            ':id' => $agencia,
            ':tipo' => $tipo,
            ':ini' => $desde,
            ':fin' => $hasta,
        );
        $data = new CActiveDataProvider('Fcco', array(
            'criteria' => $criteria,
            'pagination' => false,
            'sort' => array(
                'defaultOrder' => 'FCCA_Id desc',
                'attributes' => array(
                    'GCCA_search' => array(
                        'asc' => 'gCCA.GCCA_Nombre',
                        'desc' => 'gCCA.GCCA_Nombre  DESC',
                    ),
                    'FCCA_search' => array(
                        'asc' => 'fCCU.fCCT.fCCA.FCCA_Descripcion',
                        'desc' => 'fCCU.fCCT.fCCA.FCCA_Descripcion  DESC',
                    ),
                    //'GCCD_Nombre' => array(
                    //'asc' => 'gCCD.GCCD_Nombre',
                    //'desc' => 'gCCD.GCCD_Nombre  DESC',
                    //),
                    'GCCA_Id', 'FCCN_Id',
                    'FCCU_Numero' => array(
                        'asc' => 'fCCU.FCCU_Numero',
                        'desc' => 'fCCU.FCCU_Numero  DESC',
                    ),
                    'FCCU_Serial' => array(
                        'asc' => 'fCCU.FCCU_Serial',
                        'desc' => 'fCCU.FCCU_Serial  DESC',
                    ),
                    'FCCT_Descripcion' => array(
                        'asc' => 'fCCT.FCCT_Descripcion',
                        'desc' => 'fCCT.FCCT_Descripcion  DESC',
                    ),
                    //Agregar todos los filtro o quedaran deshabilitados
                    'FCCO_Lote' => array(
                        'asc' => 'FCCO_Lote',
                        'desc' => 'FCCO_Lote  DESC',
                    ),
                    'FCCO_Timestamp' => array(
                        'asc' => 'FCCO_Timestamp',
                        'desc' => 'FCCO_Timestamp  DESC',
                    ),

                ),
            ),
        ));

        if ($print) {

            // Yii::app()->session['all'] = $data;
            // Yii::app()->session['desc'] = $model->concatened;
            // Yii::app()->session['all'] = array();
            $this->renderPartial('print', array('d' => $data, 'model' => $model,  'tipo' => $tipo, 'fecha' => "Resumen " . $desde . " al " . $hasta), false, true);
        } else   if ($view === null)
            $this->render('view', array(
                'modelo' => $modelo, 'tipo' => $tipo, 'model' => $model,  'desde' => $desde, 'hasta' => $hasta, 'fecha' => "Resumen " . $desde . " al " . $hasta
            ));
        else
            $this->renderPartial('view', array(
                'modelo' => $modelo, 'tipo' => $tipo, 'model' => $model, 'desde' => $desde, 'hasta' => $hasta, 'fecha' => "Resumen " . $desde . " al " . $hasta, 'resumen' => true
            ));
    }

    public function actionRecibe($id)
    {
        // echo $id;

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
        //
        //        $item = $this->loadModel($id);
        $item = Fccu::model()->find('FCCU_Id = ' . $id);
        $item->FCCI_Id = 10; //cambia de estado al seleccionado

        if ($inventario->save() && $model->save() && $item->save()) {

            //            echo $item->FCCU_Id . " actualizado en " . $model->FCCO_Id;
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('fcco/agencia/' . $inventario->GCCA_Id . "?type=1"));
        } else {
            echo "error";
        }
    }

    public function actionEnter($id, $tipo = null, $view = null)
    {
        if ($tipo == null)
            $tipo = 1;
        $model = Fcco::model()->findAll("FCCO_Lote=:lote and FCCN_Id =:tipo", array('lote' => $id, 'tipo' => $tipo));


        $this->render('enter', array(
            'modelo' => $model, 'tipo' => $tipo, 'lote' => $id
        ));
    }

    public function actionActivos()
    {
        $request = trim($_GET['term']);
        if ($request != '') {
            $model = Fccu::model()->findAll(array("condition" => "(FCCI_Id =2 or FCCI_Id =10 or FCCI_Id =11) and (FCCU_Serial like '$request%' or FCCU_Numero like '$request%')"));
            $data = array();
            foreach ($model as $item) {
                $data[$item->FCCU_Id] = array(
                    'id' => $item->FCCU_Id,
                    'value' => $item->FCCU_Serial,
                    'label' => $item->FCCU_Serial . " | " . $item->fCCT->fCCA->FCCA_Descripcion . " " . $item->fCCT->FCCT_Descripcion . " | " . $item->FCCU_Numero,
                    'descrip' => $item->fCCT->fCCA->FCCA_Descripcion . " " . $item->fCCT->FCCT_Descripcion . " | " . $item->FCCU_Numero,
                    'numero' => $item->FCCU_Numero,
                );

                // $data[] = $get->FCCU_Serial;
            }
            $this->layout = 'empty';
            echo json_encode($data);
        }
    }

    public function actionAsignados()
    {
        $request = trim($_GET['term']);
        if ($request != '') {
            $model = Fccu::model()->findAll(array("condition" => "FCCI_Id =5 and (FCCU_Serial like '$request%' or FCCU_Numero like '$request%')"));
            $data = array();
            foreach ($model as $item) {
                $data[] = array(
                    'id' => $item->FCCU_Id,
                    'value' => $item->FCCU_Serial,
                    'label' => $item->FCCU_Serial . " | " . $item->fCCT->fCCA->FCCA_Descripcion . " " . $item->fCCT->FCCT_Descripcion . " | " . $item->FCCU_Numero,
                    'descrip' => $item->fCCT->fCCA->FCCA_Descripcion . " " . $item->fCCT->FCCT_Descripcion . " | " . $item->FCCU_Numero,
                    'numero' => $item->FCCU_Numero,
                    'lugar' => Fcco::model()->find(array("condition" => "FCCU_Id = '$item->FCCU_Id' and FCCO_Enabled = 1"))->getLugar()
                );

                // $data[] = $get->FCCU_Serial;
            }
            $this->layout = 'empty';
            echo json_encode($data);
        }
    }

    public function actionGrupo($id, $type = null)
    {
        $grupo = Gccd::model()->find('GCCD_Id=:id', array(':id' => $id));
        $model = new Fcco('search');
        $model->unsetAttributes();  // clear any default values
        $model->GCCD_Id = $id; //array de gccd hijos, actualmente solo veo inventario propio del grupo
        $model->FCCN_Id = "=1"; //operacion: asignados
        $model->FCCO_Enabled = "=1"; //asignado actualmente
        $count = array();
        $count = $grupo->estadisticas;

        //--Estadisticas rapidas



        if (isset($_GET['Fcco'])) {

            $model->attributes = $_GET['Fcco'];
            $model->GCCD_Id = $id; //array de gccd hijos, actualmente solo veo inventario propio del grupo
            $model->FCCN_Id = "=1"; //operacion: asignados
            $model->FCCO_Enabled = "=1"; //asignado actualmente
        }
        $model->desde = date('2000-01-01');
        $model->hasta = date('2025-01-01');

        if ($type == null) {
            $this->renderPartial('grupo', array(
                'model' => $model, 'count' => $count, 'type' => $type, 'grupo' => $grupo
            ));
        } else {
            $this->render('grupo', array(
                'model' => $model, 'count' => $count, 'type' => $type, 'grupo' => $grupo
            ));
        }

        //        $this->render('grupo', array(
        //            'model' => $model, 'count' => $count
        //        ));
    }

    public function actionAgencia($id, $type = null, $print = false, $excel = false)
    {
        $agencia = Gcca::model()->find('GCCA_Id=:id', array(':id' => $id));


        // print_r($_POST);
        //Si envian un comentario
        if (isset($_POST['comment']) && $_POST['comment'] != '') {

            $re = $agencia->setComment($_POST['comment']);
            echo "<!-- Error ";
            print_r($re);
            echo " -->";
            
        }

        $model = new Fcco('search');
        $model->unsetAttributes();  // clear any default values
        $model->GCCA_Id = $id;

        $model->FCCO_Enabled = 1; //asignado actualmente
        $model->FCCN_Id = 1; //operacion asignado

        //--Estadisticas rapidas     
        $count = array();
        $count = $agencia->estadisticas;


        //Historial de Asignaciones Previas
        $modelos = new Fcco('search');
        $modelos->unsetAttributes();
        $modelos->GCCA_Id = $id;

        if (isset($_GET['Fcco'])) {

            $modelos->attributes = $_GET['Fcco'];
            $modelos->GCCA_Id = $id;
        }
        $modelos->FCCO_Enabled = 0; //historial asignado

        $modelos->desde = date('2000-01-01');
        $modelos->hasta = date('2025-01-01');

        /************************* */

        if (isset($_GET['Fcco'])) {

            $model->attributes = $_GET['Fcco'];
            $model->GCCA_Id = $id;
            $model->FCCO_Enabled = 1; //asignado actualmente
            $model->FCCN_Id = 1;
        }

        /************************* */

        $model->desde = date('2000-01-01');
        $model->hasta = date('2025-01-01');

        if ($excel) {
            //
            $content = $this->renderPartial("excel", array('model' => $model, 'modelos' => $modelos), true, true);

            Yii::app()->request->sendFile('Historial Agencia ' . $agencia->concatened . '.xls', $content);
        }

        /************************* */

        if ($print) {
            $criteria = new CDbCriteria;
            $criteria->select = '*';
            $criteria->condition = "GCCA_Id = :id 
                    and FCCN_Id =:tipo
                    and FCCO_Enabled = 1
                    and FCCO_Timestamp BETWEEN 
                    :ini and :fin";

            $criteria->with = array('fCCU' => array('with' => 'fCCT', 'fCCT' => array('with' => 'fCCA')));

            $criteria->params = array(
                ':id' => $id,
                ':tipo' => 1,
                ':ini' =>  $model->desde,
                ':fin' =>  $model->hasta,
            );

            $data = new CActiveDataProvider('Fcco', array(
                'criteria' => $criteria,
                'pagination' => false,
                'sort' => array(
                    'defaultOrder' => 'FCCA_Id',
                    'attributes' => array(
                        'GCCA_search' => array(
                            'asc' => 'gCCA.GCCA_Nombre',
                            'desc' => 'gCCA.GCCA_Nombre  DESC',
                        ),
                        'FCCA_search' => array(
                            'asc' => 'fCCU.fCCT.fCCA.FCCA_Descripcion',
                            'desc' => 'fCCU.fCCT.fCCA.FCCA_Descripcion  DESC',
                        ),
                        //'GCCD_Nombre' => array(
                        //'asc' => 'gCCD.GCCD_Nombre',
                        //'desc' => 'gCCD.GCCD_Nombre  DESC',
                        //),
                        'GCCA_Id', 'FCCN_Id',
                        'FCCU_Numero' => array(
                            'asc' => 'fCCU.FCCU_Numero',
                            'desc' => 'fCCU.FCCU_Numero  DESC',
                        ),
                        'FCCU_Serial' => array(
                            'asc' => 'fCCU.FCCU_Serial',
                            'desc' => 'fCCU.FCCU_Serial  DESC',
                        ),
                        'FCCT_Descripcion' => array(
                            'asc' => 'fCCT.FCCT_Descripcion',
                            'desc' => 'fCCT.FCCT_Descripcion  DESC',
                        ),
                        //Agregar todos los filtro o quedaran deshabilitados
                        'FCCO_Lote' => array(
                            'asc' => 'FCCO_Lote',
                            'desc' => 'FCCO_Lote  DESC',
                        ),
                        'FCCO_Timestamp' => array(
                            'asc' => 'FCCO_Timestamp',
                            'desc' => 'FCCO_Timestamp  DESC',
                        ),

                    ),
                ),
            ));


            // Yii::app()->session['all'] = $data;
            // Yii::app()->session['desc'] = $agencia->concatened;
            // Yii::app()->session['all'] = array();
            $this->renderPartial('print', array('d' => $data, 'model' => $agencia), false, true);
        } else if ($type == null) {
            $this->renderPartial('agencia', array(
                'model' => $model, 'type' => $type, 'agencia' => $agencia, 'count' => $count, 'modelos' => $modelos
            ));
        } else {
            $this->render('agencia', array(
                'model' => $model, 'type' => $type, 'agencia' => $agencia, 'count' => $count, 'modelos' => $modelos
            ));
        }
    }

    public function actionPrint($id, $tipo = null, $view = null, $agencia)
    {
        $model = Gcca::model()->find('GCCA_Id=:id', array(':id' => $agencia));
        if ($tipo == null)
            $tipo = 1;

        $modell = Fcco::model()->findAll("FCCO_Lote=:lote and FCCN_Id =:tipo", array(':lote' => $id, ':tipo' => $tipo));

        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->condition = "FCCO_Lote=:lote and FCCN_Id =:tipo";
        $criteria->params = array(':lote' => $id, ':tipo' => $tipo);
        $data = new CActiveDataProvider('Fcco', array(
            'criteria' => $criteria,
            'pagination' => false,
            'sort' => array(
                'defaultOrder' => 'FCCO_Timestamp desc',
                'attributes' => array(
                    'GCCA_search' => array(
                        'asc' => 'gCCA.GCCA_Nombre',
                        'desc' => 'gCCA.GCCA_Nombre  DESC',
                    ),
                    //'GCCD_Nombre' => array(
                    //'asc' => 'gCCD.GCCD_Nombre',
                    //'desc' => 'gCCD.GCCD_Nombre  DESC',
                    //),
                    'GCCA_Id', 'FCCN_Id',
                    'FCCU_Numero' => array(
                        'asc' => 'fCCU.FCCU_Numero',
                        'desc' => 'fCCU.FCCU_Numero  DESC',
                    ),
                    'FCCU_Serial' => array(
                        'asc' => 'fCCU.FCCU_Serial',
                        'desc' => 'fCCU.FCCU_Serial  DESC',
                    ),
                    'FCCT_Descripcion' => array(
                        'asc' => 'fCCT.FCCT_Descripcion',
                        'desc' => 'fCCT.FCCT_Descripcion  DESC',
                    ),
                    'FCCA_Descripcion' => array(
                        'asc' => 'fCCA.FCCA_Descripcion',
                        'desc' => 'fCCA.FCCA_Descripcion  DESC',
                    ),
                    'FCUU_Descripcion' => array(
                        'asc' => 'fCUU.FCUU_Descripcion',
                        'desc' => 'fCUU.FCUU_Descripcion  DESC',
                    ),
                    //Agregar todos los filtro o quedaran deshabilitados
                    'FCCO_Lote' => array(
                        'asc' => 'FCCO_Lote',
                        'desc' => 'FCCO_Lote  DESC',
                    ),
                    'FCCO_Timestamp' => array(
                        'asc' => 'FCCO_Timestamp',
                        'desc' => 'FCCO_Timestamp  DESC',
                    ),

                ),
            ),
        ));

        // Yii::app()->session['all'] = $data;
        // Yii::app()->session['desc'] = $model->concatened;


        // $d = $_SESSION['all'];
        $this->renderPartial('print', array('d' => $data, "model" => $model, "tipo" => $tipo, "modelo" => $modell), false, true);
    }

    public function actionCreate($id = null)
    {

        $model = new Fcco;
        $criteria = new CDbCriteria;
        $criteria->select = 'max(FCCO_Lote) AS FCCO_Lote';
        $row = Fcco::model()->find($criteria);
        $somevariable = $row['FCCO_Lote'] + 1;

        if (isset($_POST['Fcco'])) {
            $x = array();
            $y = array();

            $id = $_POST['Fcco']['FCCU_Id'];
            $id = array_unique($id);

            foreach ($id as $value) {
                $modelo = new Fcco;
                $modelo->attributes = $_POST['Fcco'];
                $modelo->FCCO_Lote = $somevariable;
                $modelo->FCCN_Id = 1;
                $modelo->FCCO_Enabled = 1;
                $modelo->FCCU_Id = $value;

                $item = Fccu::model()->findByPk($value);
                $item->FCCI_Id = 5;

                $inventario = Fcco::model()->findAll('FCCO_Enabled = 1 and FCCU_Id=' . $item->FCCU_Id);

                foreach ($inventario as $inv) {
                    $inv->FCCO_Enabled = 0;
                    $inv->save();
                }

                if ($item->save()) {
                    if ($modelo->save()) {
                        //creo la bitacora
                        $log = new Pcue;
                        $log->PCUE_Descripcion = 'Usuario inserto en Fcco';
                        $log->PCUE_Action = 'INSERTAR';
                        $log->PCUE_Model = 'Fcco';
                        $log->PCUE_IdModel = $modelo->FCCO_Id;
                        $log->PCUE_Field = 'TODOS';
                        $log->PCUE_Date = date("Y-m-d H:i");
                        $log->PCUE_UserId = Yii::app()->user->id . " - " . Yii::app()->user->name;
                        $log->PCUE_Detalles = 'Uso el metodo de asignar en lote';
                        $log->save();
                    }
                    $x[] = $value;
                } else {
                    $y[] = $value;
                }
            }

            $this->redirect(array('view', 'id' => $modelo->FCCO_Lote, 'tipo' => 1, 'agencia' => $modelo->GCCA_Id));
            // print_r($_POST);
        } else {
            $this->render('create', array(
                'model' => $model, 'lote' => $somevariable
            ));
        }
    }

    public function actionAdmin()
    {
        $model = new Fcco('search');

        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Fcco']))
            $model->attributes = $_GET['Fcco'];

        $this->render('admin', array(
            'model' => $model, 'arbol' => Gccd::model()->arbol()
        ));
    }

    public function loadModel($id)
    {
        $model = Fcco::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'fcco-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
