<?php 
/**	CrugeMailerBase

	centraliza la emision de correos electronicos ademas de darle formato utilizando patrones
	y vistas.

   asume que el layout sera: 
	application/protected/modules/cruge/views/layout/mailer.php
	
   y que las vistas estan alojadas en:	
	application/protected/modules/cruge/views/mailer/

	uso:
	
	1. configuracion:
		debe ser inicializado en config/main de esta manera:
			'crugemailer'=>array(
				'class' => 'application.modules.cruge.components.CrugeMailer',
				'mailfrom' => 'christiansalazarh@gmail.com',
				'subjectprefix' => 'CrugeMailer - ',
			),
			
	
	@author: Christian Salazar H. <christiansalazarh@gmail.com> @bluyell
	http://www.yiiframeworkenespanol.org/licencia
*/
abstract class CrugeMailerBase extends CApplicationComponent {

	public $layout=null; 		// por defecto hacia //protected/modules/cruge/views/mailer
	public $mailfrom;			// configurado en mail config
	public $subjectprefix="Hefestos Notifica - ";	// prefijo para los asuntos del correo
	public $controllerId="mailer";
	private $container;
	
	private $_controller = null;
	private $_module = null;

	public function init()
	{
		parent::init();
		$this->container = new SwiftMailerContainer($this->getConfig());								 				

		$this->_module = Yii::app();			// si no se quiere usar como modulo, apuntar a app()
	}
	
	public function setModule(CModule $module){
		$this->_module = $module;
	}
	
	/* Contruye un controller para renderizar el contenido de los correos en base
	   a vistas.
	   
	   asume que el layout sera: 
		application/protected/modules/cruge/views/layout/mailer.php
		
	   y que las vistas estan alojadas en:	
	    application/protected/modules/cruge/views/mailer/
	*/
	protected function getController(){
		if($this->_controller == null){
			$this->_controller = new CController($this->controllerId,$this->_module);
			$this->_controller->layout = $this->controllerId;
		}
		return $this->_controller;
	}

	protected function render($viewname,$data=array()){
		return $this->getController()->render($viewname,$data,true);
	}

	public function sendEmail($body, array $to, array $from = null, $subject = '', $contentType = 'text/html', $attachment = null)
	{
		// $from = $this->mailfrom;
		// $headers="From: {$from}\r\nReply-To: {$from}";
		// $ret = @mail($to,$this->subjectprefix.$email->getSubject(),$email->getBody(),$headers);
		// $tmp = "to:".$to."\nsubject:".$email->getSubject()."\nbody:".$email->getBody()."\n";
		// Yii::log("email:\n".$tmp."\n","info");
		// return $ret;
		if(empty($from)) {
				$from = array($this->mailfrom=>"Soporte Tecnico Hefestos");		
			}		
			if(is_null($attachment)) {
				$message = $this->container->getMessenger( $this->subjectprefix.$subject)			
				->setFrom($from)
				->setTo($to)
				->setBody($body, $contentType);			
			} else {
				$attachmentFile = $this->container->getAttachmenter($attachment);
				$message = $this->container->getMessenger( $this->subjectprefix.$subject)			
				->setFrom($from)
				->setTo($to)
				->setBody($body, $contentType)
				->attach($attachmentFile);		
			}
			
			$result = $this->container->getMailer()->send($message);
			// spl_autoload_register(array('YiiBase', 'autoload')); // register Yii autoload
			if($result) {
				return $result;
			} else {
				throw new CrugeMailerException('Error: Revisar Configuración del Mail');
			}
	}
	
}
