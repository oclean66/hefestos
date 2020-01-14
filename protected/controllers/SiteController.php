<?php

class SiteController extends Controller {

    public function actionLog() {
        $model = Pcue::model()->findAll(array("condition" => "PCUE_Date between DATE_SUB(now(), INTERVAL 5 SECOND) and now()"));
        $data = array();
        foreach ($model as $item) {
            $data[] = array(
                'id' => $item->PCUE_UserId,
                'value' => date("d/m/Y h:i:s A", strtotime($item->PCUE_Date)) . " -  " . $item->PCUE_Descripcion,
            );
        }

        echo json_encode($data);
    }

    public function actionMigrate() {
        //print_r($_POST);
        $notas = "Inicio: ";
        $dato = "";
        $aux = '';
        $agencia = array(
            'idagencia' => '',
            'idgrupo' => '', 'codgrupo' => '', 'idbanca' => 1,
            'nombre' => '',
            'cedula' => '',
            'direccion' => '',
            'responsable' => '',
            'telefono' => '',
            'email' => '',
        );
        $inventario = array();
        if (isset($_POST['cod'])) {
            $sql = "Select * from agencia where idagencia ='" . $_POST['cod'] . "' and idgrupo ='" . $_POST['gr'] . "' and idbanca = '" . $_POST['banca'] . "'";
            $agencia = Yii::app()->excelencia->createCommand($sql)->queryRow();

            if (empty($agencia)) {
                $dato = "No encontrada";
                $agencia = array(
                    'idagencia' => '',
                    'codgrupo' => '',
                    'idgrupo' => '',
                    'idbanca' => 1,
                    'nombre' => '',
                    'cedula' => '',
                    'direccion' => '',
                    'responsable' => '',
                    'telefono' => '',
                    'email' => '',
                );
            } else {
                $dato = $agencia['idagencia'] . " encontrada en grupo " . $agencia['idgrupo'];
                $agencia['codgrupo'] = $agencia['idgrupo'];
                $grupo = Gccd::model()->find('gccd_cod like "' . $agencia['idgrupo'] . '%"');

                $sql = "Select * from computador left join item on computador.iditem = item.serialitem where  idagencia ='" . $_POST['cod'] . "'  and idgrupo ='" . $agencia['idgrupo'] . "'  and idbanca = '" . $_POST['banca'] . "' order by iditem";
                if (!isset($grupo)) {
                    $agencia['idgrupo'] = "No encontrado";
                } else {
                    $agencia['idgrupo'] = $grupo->GCCD_Id;
                }

                $inventario = Yii::app()->excelencia->createCommand($sql)->query();
            }



            //print_r($reader);
        }
        if (isset($_POST['checkbox'])) {

// print_r($_POST);
            $model = new Gcca;
            $model->GCCA_Cod = $_POST['cod'];
            $model->GCCA_Nombre = $_POST['nombre'];
            $model->GCCD_Id = $_POST['GCCD_Id'];
            $model->GCCA_Rif = $_POST['rif'] . "-";
            $model->GCCA_Direccion = $_POST['direccion'] . "-";
            $model->GCCA_Responsable = $_POST['responsable'] . "-";
            $model->GCCA_Telefono = $_POST['telefono'] . "-";
            $model->GCCA_Email = $_POST['email'] . "-";
            $model->GCCA_Status = 1;
            $aux = $_POST['gr'];

            try {
                if ($model->save()) {
                    $notas = $notas . "Agencia Guardada  </br>";

                    $notas = $notas . " Actualizado en 2.0: " . Yii::app()->excelencia->createCommand()
                                    ->update('agencia', array('Estado' => '0'), 'idagencia=:ida and idgrupo=:idg and idbanca=:idb', array(':ida' => $_POST['cod'], ':idg' => $aux, ':idb' => $_POST['banca'])) . "</br>";
                } else {
                    $notas = $notas . "Agencia No Guardada  </br>";
                    echo "</br>";
                    print_r($model->getErrors());
                    $model = Gcca::model()->find('GCCA_Cod like "' . $model->GCCA_Cod . '%"');
                }
            } catch (Exception $e) {
                $notas = $notas . "intentando con " . $_POST['cod'] . " - " . $aux . " - " . $_POST['banca'] . "</br>";
                $notas = $notas . " Agencia no migrada, " . $e->errorInfo[2] . "</br>";
                $model = Gcca::model()->find('GCCA_Cod like "' . $model->GCCA_Cod . '%"');

                if (isset($model)) {
                    $notas = $notas . " Actualizado en 2.0-" . Yii::app()->excelencia->createCommand()
                                    ->update('agencia', array('Estado' => '0'), 'idagencia=:ida  and idgrupo=:idg and idbanca=:idb', 
                                            array(':ida' => $_POST['cod'], ':idg' => $aux, ':idb' => $_POST['banca'])) . "</br>";
                }
            }

            $criteria = new CDbCriteria;
            $criteria->select = 'max(FCCO_Lote) AS FCCO_Lote';
            $row = Fcco::model()->find($criteria);


           foreach ($_POST['checkbox'] as $value => $key) {
                //echo $value." - ";
                $sql = "Select * from computador where idcomputador ='" . $value . "' order by iditem";
                $computad = Yii::app()->excelencia->createCommand($sql)->queryRow();


                $sql = "Select * from item where serialitem ='" . $computad['iditem'] . "' order by serialitem";
                $item = Yii::app()->excelencia->createCommand($sql)->queryRow();
                if (!empty($item)) {
                    $activo = new Fccu;
                    $activo->FCCU_Serial = $item['serialitem'];
                    $activo->FCCI_Id = 5;
                    $activo->FCCT_Id = $_POST['FCCT_Id'][$value];
                    $activo->FCCU_Timestamp = $item['fechagregado'];
                    $activo->FCCU_Facturado = 0;
                    $activo->FCCD_Id = 5;
                    $activo->FCCU_Descripcion = "Migrado de 2.0";

                    try {
                        if ($activo->save()) {
                            $notas = $notas . " activo " . $item['serialitem'] . " migrado con exito ";
                            $new = new Fcco;
                            $new->FCCO_Enabled = 1;
                            $new->FCCN_Id = 1;
                            $new->FCCU_Id = $activo->FCCU_Id;
                            $new->GCCA_Id = $model->GCCA_Id;
                            $new->GCCD_Id = $model->GCCD_Id;
                            $new->FCCO_Lote = $row['FCCO_Lote'] + 1;
                            
                            if ($new->save()) {
                                $notas = $notas . " - asignacion en fcco " . $new->FCCO_Id . "</br>";
                            }
                            $notas = $notas . " Migrado en 2.0: " . Yii::app()->excelencia->createCommand()
                                            ->update('item', array('idestado' => '9'), 'serialitem=:serial', array(':serial' => $item['serialitem'])) . "</br>";
                        } else {
                            echo "</br>";
                            print_r($activo->getErrors());
                            $notas = $notas . " Activo " . $activo->FCCU_Serial . " no migrado :(</br>";
                        }
                    } catch (Exception $e) {
                        $notas = $notas . " Activo " . $activo->FCCU_Serial . " no migrado, " . $e->errorInfo[2] . "</br>";


                        $look = Fccu::model()->find('FCCU_Serial="' . $item['serialitem'] . '"');
                        if (isset($look)) {
                            $prev = Fcco::model()->find('FCCO_Enabled =1 and FCCU_Id=:serial and GCCA_Id =:agencia', 
                                    array(':serial' => $look->FCCU_Id,
                                ':agencia' => $model->GCCA_Id));
                            if (!isset($prev)) {
                                $new = new Fcco;
                                $new->FCCO_Enabled = 1;
                                $new->FCCN_Id = 1;
                                $new->FCCU_Id = $look->FCCU_Id;
                                $new->GCCA_Id = $model->GCCA_Id;
                                $new->GCCD_Id = $model->GCCD_Id;

                                $new->FCCO_Lote = $row['FCCO_Lote'] + 1;
                                if ($new->save()) {
                                    $notas = $notas . " -catch- asignacion en fcco " . $new->FCCO_Id . "</br>";
                                }
                            } else {
                                $notas = $notas . " - ya con asignacion en fcco " . $prev->FCCO_Id . "</br>";
                            }
                        }
                    }
                }


                $sql = "Select * from conexion where idconexion ='" . $computad['idconexion'] . "' order by idconexion";
                $conexion = Yii::app()->excelencia->createCommand($sql)->queryRow();
                //echo "vacio-" . empty($conexion);
                if (!empty($conexion)) {
                    $activo = new Fccu;
                    $activo->FCCU_Serial = $conexion['IMEI'];
                    $activo->FCCI_Id = 5;
                    $activo->FCCT_Id = $_POST['FCCT_Id'][$value];
                    $activo->FCCU_Timestamp = $conexion['fechagregado'];
                    $activo->FCCU_Numero = $conexion['numero'];
                    $activo->FCCD_Id = $conexion['idoperador'];
                    $activo->FCCU_ClaveDatos = $conexion['clavedatos'];
                    $activo->FCCU_DiaCorte = $conexion['diacorte'];
                    $activo->FCCU_MontoMin = $conexion['monto'];
                    $activo->FCCU_TipoServicio = $conexion['servicio'];
                    $activo->FCCU_Facturado = 0;
                    $activo->FCCU_Descripcion = "Migrado de 2.0";
                    try {
                        if ($activo->save()) {
                            $notas = $notas . " conexion " . $conexion['IMEI'] . " migrado con exito ";
                            $new = new Fcco;
                            $new->FCCO_Enabled = 1;
                            $new->FCCN_Id = 1;
                            $new->FCCU_Id = $activo->FCCU_Id;
                            $new->GCCA_Id = $model->GCCA_Id;
                            $new->GCCD_Id = $model->GCCD_Id;


                            $new->FCCO_Lote = $row['FCCO_Lote'] + 1;
                            if ($new->save()) {
                                $notas = $notas . " - asignacion en fcco " . $new->FCCO_Id . "</br>";
                            }
                            $notas = $notas . " Migrado en 2.0: " . Yii::app()->excelencia->createCommand()
                                            ->update('conexion', array('idestado' => '9'), 'IMEI=:serial', array(':serial' => $conexion['IMEI'])) . "</br>";
                        } else {
                            echo "</br>";
                            print_r($activo->getErrors());
                            $notas = $notas . " conexion " . $conexion['IMEI'] . " no migrado :(</br>";
                        }
                    } catch (Exception $e) {
                        $notas = $notas . " conexion " . $conexion['IMEI'] . " no migrado, " . $e->errorInfo[2] . "</br>";
                        $look = Fccu::model()->find('FCCU_Serial="' . $conexion['IMEI'] . '"');

                        if (isset($look)) {

                            $prev = Fcco::model()->find('FCCU_Id=:serial and GCCA_Id =:agencia', array(':serial' => $look->FCCU_Id,
                                ':agencia' => $model->GCCA_Id));
                            if (!isset($prev)) {
                                $new = new Fcco;
                                $new->FCCO_Enabled = 1;
                                $new->FCCN_Id = 1;
                                $new->FCCU_Id = $look->FCCU_Id;
                                $new->GCCA_Id = $model->GCCA_Id;
                                $new->GCCD_Id = $model->GCCD_Id;


                                $new->FCCO_Lote = $row['FCCO_Lote'] + 1;
                                if ($new->save()) {
                                    $notas = $notas . " -catch- asignacion en fcco " . $new->FCCO_Id . "</br>";
                                }
                            } else {
                                $notas = $notas . " - ya con asignacion en fcco " . $prev->FCCO_Id . "</br>";
                            }
                        }
                    }
                }
            }

            $log = new Pcue;
            $log->PCUE_Descripcion = 'Usuario ' . Yii::app()->user->Name
                    . ' ejecuto una migracion 2.0';
            $log->PCUE_Action = 'MIGRACION';
            $log->PCUE_Model = "Agencia";           
            $log->PCUE_IdModel = $model->GCCA_Id;
            $log->PCUE_Field = "Migracion 2.0";
            $log->PCUE_Date = new CDbExpression('NOW()');
            $log->PCUE_UserId = Yii::app()->user->id . " - " . Yii::app()->user->Name;
            $log->PCUE_Detalles = $notas;
            $log->save();

            $this->redirect(array('fcco/agencia', 'id' => $model->GCCA_Id, 'type' => $notas));/*1 */
        }
        $this->render('migrate', array('agencia' => $agencia, 'inventario' => $inventario, 'notas' => $notas, 'dato' => $dato
        ));
    }

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'

        $model = Pcue::model()->findAll('1 order by PCUE_Date desc limit 10');
        $this->render('index', array('model' => $model));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $this->layout = '//layouts/error';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
            //print_r($error);
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}
