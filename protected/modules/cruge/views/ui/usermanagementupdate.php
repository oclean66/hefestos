<?php
/*
  $model:
  es una instancia que implementa a ICrugeStoredUser, y debe traer ya los campos extra 	accesibles desde $model->getFields()

  $boolIsUserManagement:
  true o false.  si es true indica que esta operandose bajo el action de adminstracion de usuarios, si es false indica que se esta operando bajo 'editar tu perfil'
 */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3>
                    <i class="fa fa-copy"></i><?php
                                                echo ucwords(CrugeTranslator::t(
                                                    $boolIsUserManagement ? "editando usuario" : "editando tu perfil"
                                                ));
                                                ?>
                </h3>
            </div>
            <div class="box-content nopadding">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'crugestoreduser-form',
                    'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => false,
                ));
                ?>
                <div class="col-sm-2">
                    <?php
                    @$actualizar = $_REQUEST['actualizar'];
                    @$error = false;
                    //Array de archivos permitidos
                    @$archivos_disp_ar = array('jpeg', 'jpg', 'png');
                    //Carpeta en donde se guardan las imagenes
                    @$carpeta = '/hefestos/themes/flat/avatars/';
                    //Recibo el campo de la imagen
                    @$imagen = $_FILES['imagen']['tmp_name'];
                    //Se guarda el nombre real de la imagen en una variable
                    @$nombre_orig = $_FILES['imagen']['name'];
                    //Verificamos el tipo de archivo
                    @$array_nombre = explode('.', $nombre_orig);
                    @$cuenta_arr_nombre = count($array_nombre);
                    @$extension = strtolower($array_nombre[--$cuenta_arr_nombre]);
                    //Le asignamos un nombre unico a la imagen
                    @$nombre_nuevo = time() . ' - ' . rand(0, 100) . ' . ' . $extension;
                    //Nuevo nombre junto con la carpeta
                    @$nombre_nuevo_con_carpeta = $carpeta . $nombre_nuevo;

                    if (isset($actualizar)) {
                        if (!in_array($extension, $archivos_disp_ar)) { {
                                @$errores['imagen'] = "Esto no es una imagen";
                                $error = true;
                            }
                            if (trim($imagen) == '') {
                                @$errores['imagen'] = "Ingresa una imagen";
                                $error = true;
                            }
                        } else
                            @$errores['imagen'] = '';
                    }
                    if (isset($actualizar) && $error == false) {
                        $id = $_SESSION['iduser'];
                        $actualiza = "Update cruge_session Set picture='$nombre_nuevo' Where iduser='$id'";
                        $resultado = $link->query($actualiza);
                        $mover_archivos = move_uploaded_file($imagen, $nombre_nuevo_con_carpeta);

                        $select_foto = "SELECT picture FROM cruge_session WHERE iduser='$id'" or die("Error en la consulta" . mysqli_error($link));
                        $res_foto = $link->query($select_foto);
                        $ses = $res_foto->fetch_assoc();
                        $_SESSION['iduser'] = $ses['picture'];

                        echo "Se le asigno nuevo nombre de imagen: " . $nombre_nuevo . "</br>";
                        // echo '<img style="width:40%; margin-top:10px" src="user/' . $_SESSION['iduser'] . '" alt="'. $_SESSION['username'] .'"/>';
                        echo "<img style='width:40%; margin-top:10px' src='user/{$_SESSION['iduser']}' alt='{$_SESSION['username']}'/>";
                    } else { ?>
                        <div class="demo-wrap upload-dedmo" style="padding:30px 22px 0px 22px">
                            <div class="thumbnail" id="imagen" style="width: 125px; height:125px; padding:4px; border: 1px solid #ddd; border-radius: 6px">
                                <img id="imgperfil" src="<?php echo Yii::app()->theme->baseUrl . "/img/avatars/" . (isset($_SESSION['picture']) ? $_SESSION['picture'] : 'user.png'); ?>" alt="Imagen de Perfil">
                            </div>
                            <div id="upload-demo" class="croppie-container">
                                <div class="cr-boundary" aria-dropeffect="none"><canvas class="cr-image" alt="preview" aria-grabbed="false"></canvas>
                                    <div class="cr-viewport cr-vp-circle" tabindex="0" style="width: 100px; height: 100px;"></div>
                                    <div class="cr-overlay"></div>
                                </div>
                                <div class="cr-slider-wrap"><input class="cr-slider" type="range" step="0.0001" aria-label="zoom"></div>
                            </div>

                        </div>
                            <input type="file" id="upload" value="Choose a file" accept="image/*">
                        <div class="btn btn-orange btn-block" style="overflow: hidden; width:160px">

                            <input id="subir" name="subir" type="file" style="opacity: 0; position: absolute" />
                            <i class="fa fa-camera"></i> Subir Imagen
                            <?php
                            if (isset($actulizar))
                                //nombre de la imagen
                                print("VALUE='$imagen'/>\n");
                            else
                                print("/>\n");
                            if (@$errores['imagen'] != "")
                                //Mostrar errores
                                print("<BR><SPAN CLASS='error'>" . @$errores['imagen'] . "</SPAN>");
                            ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-sm-10 ">
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'username', array('class' => 'control-label col-sm-2')); ?>
                        <div class="col-sm-10">
                            <?php echo $form->textField($model, 'username', array('class' => 'form-control')); ?>
                            <?php echo $form->error($model, 'username'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'email', array('class' => 'control-label col-sm-2')); ?>
                        <div class="col-sm-10">
                            <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                            <?php echo $form->error($model, 'email'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'newPassword', array('class' => 'control-label col-sm-2')); ?>
                        <div class="col-sm-10">
                            <?php echo $form->textField($model, 'newPassword', array('class' => 'form-control')); ?>
                            <?php echo $form->error($model, 'newPassword'); ?>
                            <script>
                                function fnSuccess(data) {
                                    $('#CrugeStoredUser_newPassword').val(data);
                                }

                                function fnError(e) {
                                    alert("error: " + e.responseText);
                                }
                            </script>
                            <?php
                            echo CHtml::ajaxbutton(
                                CrugeTranslator::t("Generar una nueva clave"),
                                Yii::app()->user->ui->ajaxGenerateNewPasswordUrl,
                                array(
                                    'success' => new CJavaScriptExpression('fnSuccess'),
                                    'error' => new CJavaScriptExpression('fnError'),

                                ),
                                array('class' => 'btn btn-small')
                            );
                            ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'regdate', array('class' => 'control-label col-sm-2')); ?>
                        <div class="col-sm-10">
                            <?php
                            echo $form->textField($model, 'regdate', array(
                                'class' => 'form-control', 'readonly' => 'readonly',
                                'value' => Yii::app()->user->ui->formatDate($model->regdate),
                            ));
                            ?>
                            <?php echo $form->error($model, 'regdate'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'actdate', array('class' => 'control-label col-sm-2')); ?>
                        <div class="col-sm-10">
                            <?php
                            echo $form->textField($model, 'actdate', array(
                                'class' => 'form-control', 'readonly' => 'readonly',
                                'value' => Yii::app()->user->ui->formatDate($model->actdate),
                            ));
                            ?>
                            <?php echo $form->error($model, 'actdate'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'logondate', array('class' => 'control-label col-sm-2')); ?>
                        <div class="col-sm-10">
                            <?php echo $form->textField($model, 'logondate', array(
                                'class' => 'form-control', 'readonly' => 'readonly',
                                'value' => Yii::app()->user->ui->formatDate($model->logondate),
                            )); ?>
                            <?php echo $form->error($model, 'logondate'); ?>
                        </div>
                    </div>
                    <?php
                    if (count($model->getFields()) > 0) {


                        foreach ($model->getFields() as $f) {
                            echo "<div class='form-group'>";
                            // aqui $f es una instancia que implementa a: ICrugeField
                            echo Yii::app()->user->um->getLabelField($f);
                            echo "<div class='col-sm-10'>";
                            echo Yii::app()->user->um->getInputField($model, $f);
                            echo $form->error($model, $f->fieldname);
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                    ?>


                    <div class="form-actions col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
if ($boolIsUserManagement)
    if (Yii::app()->user->checkAccess(
        'edit-advanced-profile-features',
        __FILE__ . " linea " . __LINE__
    ))
        $this->renderPartial(
            '_edit-advanced-profile-features',
            array('model' => $model, 'form' => $form),
            false
        );
?>






<?php echo $form->errorSummary($model); ?>
<?php $this->endWidget(); ?>
</div>
<script>

    $(function(){

    
        var $uploadCrop;
        
        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.upload-demo').addClass('ready');
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function() {
                        console.log('jQuery bind complete');
                    });

                }

                reader.readAsDataURL(input.files[0]);
            } else {
                swal("Sorry - you're browser doesn't support the FileReader API");
            }
        }
        console.log("cargando");

        // $uploadCrop = $('#upload-demo').croppie({
        //     viewport: {
        //         width: 100,
        //         height: 100,
        //         type: 'circle'
        //     },
        //     enableExif: true
        // });

        $('#upload').on('change', function() {
            console.log("cambio");
            readFile(this);
        });
        $('.upload-result').on('click', function(ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {
                popupResult({
                    src: resp
                });
            });
        });
    })

    // function showMyImage(fileInput) {
    //     var files = fileInput.files;
    //     for (var i = 0; i < files.length; i++) {
    //         var file = files[i];
    //         var imageType = /image.*/;
    //         if (!file.type.match(imageType)) {
    //             continue;
    //         }
    //         var img = document.getByElementById("imgperfil");
    //         img.file = file;
    //         var reader = new FileReader();
    //         reader.onload = (function(aImg) {
    //             return function(e) {
    //                 aImg.src = e.target.result;
    //             };
    //         })(img);
    //         reader.readAsDataURL(file);
    //     }
    // }
</script>