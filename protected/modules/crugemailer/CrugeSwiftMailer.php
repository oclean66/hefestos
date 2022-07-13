<?php 

/**
*
* class SwiftMailerContainer container for the lib swiftmailer
* @author Carlos Belisario <carlos.belisario.gonzalez@gmail.com>
* @version 1.0
*/

class CrugeSwiftMailer extends CrugeMailerBase implements ICrugeMailer 
{
	/**
	 * 
	 * @var SwiftMailerContainer $container
	 */
	private $container;

	/**
	 * 
	 * @var string
	 */
	public $transport;	

	/**
	 * 
	 * @var email
	 */
	public $gmailAcount;

	/**
	 * 
	 * @var string
	 */
	public $gmailPassword;

	/**
	 * 
	 * @override
	 */
	public function init(){		
		parent::init();		
		/*		  
		 * create the Object SwiftMailerContainer
		 */
		$this->container = new SwiftMailerContainer($this->getConfig());								 				
	}

	/**
	 * getConfig 
	 * @return Array
	 */
	public function getConfig() {
		if(isset($this->gmailAcount)) {
			if(!filter_var($this->gmailAcount, FILTER_VALIDATE_EMAIL)) {
	            throw new CrugeMailerException('Error: mail format wrong');
	        } else {
	            $this->gmailAcount = filter_var($this->gmailAcount, FILTER_VALIDATE_EMAIL);            
	        }
	    }
	    if(!isset($this->transport)) {
	    	$config = null;
	    } else {
			$config = array(
				'transport' => $this->transport, 
				'mail' =>  isset($this->gmailAcount) ? $this->gmailAcount : null,				
				'password' => isset($this->gmailPassword) ? $this->gmailPassword : null,
			);
		}
		return $config;
	}

	/**
     * @method sendMail send the mail 
     * @param  string $body 
     * @param  array  $to 
     * @param  mixed $from  
     * @param  string $subject
     * @param string $contentType
     * @param string $attachment
     * @return boolean
     * 
     */
	public function sendEmail($body, array $to, array $from = null, $subject = '', $contentType = 'text/html', $attachment = null) {
        return parent::sendEmail($body,$to,$from, $subject, $contentType, $attachment);
	}
	
	// public function sendEmail($body, array $to, array $from = null, $subject = '', $contentType = 'text/html', $attachment = null)
	// {		
	// 	if(empty($from)) {
	// 		$from = array($this->mailfrom);		
	// 	}		
	// 	if(is_null($attachment)) {
	// 		$message = $this->container->getMessenger($subject)			
	// 		->setFrom($from)
	// 		->setTo($to)
	// 		->setBody($body, $contentType);			
	// 	} else {
	// 		$attachmentFile = $this->container->getAttachmenter($attachment);
	// 		$message = $this->container->getMessenger($subject)			
	// 		->setFrom($from)
	// 		->setTo($to)
	// 		->setBody($body, $contentType)
	// 		->attach($attachmentFile);		
	// 	}
		
	// 	$result = $this->container->getMailer()->send($message);
	// 	// spl_autoload_register(array('YiiBase', 'autoload')); // register Yii autoload
	// 	if($result) {
	// 		return $result;
	// 	} else {
	// 		throw new CrugeMailerException('Error: Revisar Configuración del Mail');
	// 	}
	// }

	public function t($text){
		return $text;
	}

	//--------------
	public function sendPasswordTo(ICrugeStoredUser $userInst, $notEncryptedPassword) {
        $this->sendEmail(				
				$this->render(
                        'sendpasswordto',
						array(
							'model' => $userInst, 
							'password' => $notEncryptedPassword
						)),
				[$userInst->email], 
				null,
				self::t("La informacion de su cuenta ha cambiado")			
        		);
    }
	

}
