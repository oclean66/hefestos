<?php

class ApiController extends Controller
{
	public function filters()
	{
		return array();
	}

	public function actionTelegram()
	{
		$data = array(
			'Vacio'
		);
		$entityBody = file_get_contents('php://input');
		$method = json_decode($entityBody, true);
		// $method = json_decode($entityBody);
		Yii::app()->crugemailer->sendEmail(
			"<pre>" . json_encode(
				$method,
				JSON_PRETTY_PRINT
			) . "</pre>",
			array('oclean66@gmail.com'),
			null,
			"Bot Telegram"
		);
		if (isset($method['message'])) {

			$chat_id = $method['message']['chat']['id'];
			$user_id = $method['message']['from']['id'];
			$username = isset($method['message']['from']['username']) ? $method['message']['from']['username'] : $method['message']['from']['first_name'];
			$incomingText = isset($method['message']['text']) ? $method['message']['text'] : false;

			$type = isset($method['message']['entities']) ? $method['message']['entities'][0]['type'] : 'not';

			if ($type == 'bot_command') {
				switch ($incomingText) {
					case '/start':
						$text =  "Hola, " . $username . ". Bienvenido al Asistente de <b>Hefestos para Telegram</b>.\n\nPuedes controlarme enviando estos comandos:\n\n/login - Iniciar Sesion en Hefestos";
						$data = $this->sendTelegramMessage($chat_id, $text);

						break;
					case '/login':

						$find = false;
						$listen = false;

						if (file_exists("telegram_contacts.txt")) {
							//metodo 1
							$text = "Hola, {$username}. Bienvenido al Asistente de Hefestos para Telegram, envia /command para ver los comandos disponibles";

							$aLineas = file("telegram_contacts.txt");
							foreach ($aLineas as $linea) {
								$linea = substr($linea, 0, -1);
								$contact = json_decode($linea, true);
								if ($contact['user_id'] == $user_id) {
									$find = true;
									if ($contact['listen'] == 'username') {
										$text = "Por favor indicame tu usuario de Hefestos, y te enviare por correo con un codigo para verificar tu identidad";
									} else if ($contact['listen'] == 'completed') {
										$text = "Hola, {$username}. Ya has iniciado sesion exitosamente en el asistente de hefestos para telegram. Envia / para ver la lista completa de comandos";
									}
									break;
								}
							}
						}

						if (!$find) {
							$file = fopen("telegram_contacts.txt", "a");
							fwrite($file, '{"user_id" : "' . $user_id . '","chat_id" : "' . $chat_id . '","username" : "' . $username . '", "listen": "username", "find":"' . intval($find) . '"}' . PHP_EOL);
							fclose($file);
						}

						$data = $this->sendTelegramMessage($chat_id, $text);

						break;

					case '/command':
						$text = "Por favor indicame tu usuario de Hefestos, y te enviare por correo con un codigo para verificar tu identidad";
						$data = $this->sendTelegramMessage($chat_id, $text);
						break;
					default:
						$text = "Mmm, no lo se, ese comando no lo es reconocido, intenta de nuevo, envia / para ver la lista completa de comandos";
						$data = $this->sendTelegramMessage($chat_id, $text);
						break;
				}
			} else {
				$find = false;
				$listen = false;

				if (file_exists("telegram_contacts.txt")) {
					$aLineas = file("telegram_contacts.txt");
					$index = 0;
					foreach ($aLineas as $linea) {
						$linea = substr($linea, 0, -1);
						$contact = json_decode($linea, true);
						if ($contact['user_id'] == $user_id) {
							$find = true;
							switch ($contact['listen']) {
								case 'username':
									$user = Yii::app()->user->um->loadUserByUsername($incomingText);

									if (isset($user)) {

										Yii::app()->crugemailer->sendEmail(
											"Utilice el siguiente PIN  para continuar con el Asistente de Hefestos para telegram <br/><h2>" . Yii::app()->user->um->getFieldValue($user, 'teletoken') . "</h2>",
											array($user->email),
											null,
											"Iniciar Sesion Hefestos / Telegram"
										);

										array_splice($aLineas, $index, 1, array('{"user_id" : "' . $user_id . '","chat_id" : "' . $chat_id . '","username" : "' . $username . '", "listen": "token", "find":"' . intval($find) . '"}'));
										$archivo = fopen("telegram_contacts.txt", "w+");
										foreach ($aLineas as $linea)
											fwrite($archivo, $linea . PHP_EOL);
										fclose($archivo);

										$text = "Muy bien, revisa tu bandeja de entrada de correo y enviame el PIN que te he llegado, Tambien puedes iniciar sesion en Hefestos y copiarlo desde tu perfil";
									} else {
										$text = "Lo siento, no he encontrado un usuario " . $incomingText;
									}
									$data = $this->sendTelegramMessage($chat_id, $text);
									break;

								case 'token':
									$text = "Lo siento, creo que el token es incorrecto";
									foreach (Yii::app()->user->um->listUsers() as $user) {

										$token = Yii::app()->user->um->getFieldValue($user, 'teletoken');
										if ($token == $incomingText) {

											array_splice($aLineas, $index, 1, array('{"user_id" : "' . $user_id . '","chat_id" : "' . $chat_id . '","username" : "' . $username . '", "listen": "completed", "cruge_user_id":"' . $user->iduser . '"}'));
											$archivo = fopen("telegram_contacts.txt", "w+");
											foreach ($aLineas as $linea)
												fwrite($archivo, $linea . PHP_EOL);
											fclose($archivo);

											$text = "Genial, Has iniciado sesion correctamente ✨✨🎉🎉";
											break;
										}
									}
									$data = $this->sendTelegramMessage($chat_id, $text);
									break;
								case 'completed':
									$text = "Hola, {$username}. Bienvenido al Asistente de Hefestos para Telegram, envia /command para ver los comandos disponibles";
									$data = $this->sendTelegramMessage($chat_id, $text);
									break;
								default:
									$text = "Lo siento me perdi, code: " . $contact['listen'];
									$data = $this->sendTelegramMessage($chat_id, $text);
									break;
							}
						}
						$index++;
					}
				} else {
					$text = "Hola, {$username}. Bienvenido al Asistente de Hefestos para Telegram, envia /login para iniciar sesion en Hefestos";
					$data = $this->sendTelegramMessage($chat_id, $text);
				}
			}
		} else if (isset($method['inline_query'])) {
			$data = array(
				"inline_query_id" => $method['inline_query']['query'],
				"method" => "answerInlineQuery",
				"results" => array(
					array(
						"type" => "photo",
						"id" => 1,
						"photo_url" => Yii::app()->theme->baseUrl."/img/logo-bigger.png",
						"thumb_url" => Yii::app()->theme->baseUrl."/img/logo-bigger.png",
					)
				)
			);
		}

		$this->_sendResponse(200, CJSON::encode($data));
	}
	public function actionList()
	{
		$data = array();

		switch ($_GET['model']) {
			case 'fcco':
				$model = GccaPublic::model()->findAll('PUBLIC_GCCD_Id=:cod', array(':cod'=>$_GET['gccd']));
				$data = array(
					'resultados' => 0,
					'items' => array()
				);
				
				foreach ($model as $key => $value) {
					$final=array();
					$historial = Fcco::model()->findAll('FCCO_Enabled = 1 and FCCN_Id = 1 and GCCD_Id = :id order by GCCA_Id, FCCO_Lote desc', array(':id'=>$value->GCCD_Id));
					foreach ($historial as $hvalue) {
						$final[]=array(
							"FCCO_Id" =>  $hvalue->FCCO_Id,
							"FCCO_Timestamp" =>  $hvalue->FCCO_Timestamp,
							"FCCO_Lote" =>  $hvalue->FCCO_Lote,
							"GCCA_Id" =>  $hvalue->GCCA_Id,							
							"GCCA_Cod" =>  $hvalue->gCCA->GCCA_Cod,							
							"GCCA_Nombre" =>  $hvalue->gCCA->concatened,							
							"FCCO_Descripcion" =>  $hvalue->FCCO_Descripcion,
							"FCCU_Serial" =>  $hvalue->fCCU->FCCU_Serial,
							"FCCT_Modelo" =>  $hvalue->fCCU->fCCT->FCCT_Descripcion,
							"FCCA_Tipo" =>  $hvalue->fCCU->fCCT->fCCA->FCCA_Descripcion,
						);
					}
					$data['resultados']+=count($historial);
					$data['items'][]=array(
						"GCCD_Nombre"=>$value->gCCD->concatened,
						"Historial"=>$final,
					);
				}
				// $data = $model;
				break;
			default:
				$this->_sendResponse(501, sprintf('Error: Mode <b>list</b> is not implemented for model <b>%s</b>', $_GET['model']));
				exit;
		}

		$this->_sendResponse(200, CJSON::encode($data));
	}
	/**Publicaciones del API */
	public function actionPublic(){
		
		// $this->render('public', array(
		// 	'data'=> GccaPublic::model()->findAll()
		// ));

		$model = new GccaPublic('search');
		$model->unsetAttributes();  // clear any default values
		// $model->GCCA_Status = 1;
		if (isset($_GET['GccaPublic']))
			$model->attributes = $_GET['GccaPublic'];

		$this->render('public', array(
			'model' => $model,
		));

	}
}
