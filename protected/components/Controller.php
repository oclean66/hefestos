<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menuTitle = 'Operaciones';
    public $menu = array();
    public $index = array();
    public $widget = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function filters()
    {
        return array(
            array('CrugeAccessControlFilter'), // perform access control for CRUGE operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function sendNotification($id, $title, $url)
    {
        $noti = new Tccn;
        $noti->TCCN_IdUSer = $id;
        $noti->TCCN_Title = substr($title,0,160);
        $noti->TCCN_Created = date("Y-m-d H:i");
        $noti->TCCN_Read = 0;
        $noti->TCCN_Url = $url;
        // TCCN_Thread
        if (!$noti->save()) {
            print_r($noti->getErrors());
        } else {
            if (file_exists("telegram_contacts.txt")) {
                $aLineas = file("telegram_contacts.txt");
                $index = 0;
                foreach ($aLineas as $linea) {
                    $linea = substr($linea, 0, -1);
                    $contact = json_decode($linea, true);
                    if ($contact['cruge_user_id'] == $id) {
                        $this->sendTelegramMessage($contact['user_id'], $title);
                    }
                    $index++;
                }
            }
        }
    }
    public function sendTelegramMessage($chat_id, $text)
	{
		$url = "https://api.telegram.org/bot1733992246:AAHXBV-RxziT0ov71tEia4nQVuRyRnuwOyw/sendMessage";
		$options = array(
			'http' => array(
				'header' => "Content-type: application/json",
				'method' => 'POST',
				'content' => json_encode(
					array(
						"chat_id" => $chat_id,
						"text" => $text,
						"parse_mode" => "HTML"
					)
				)
			)
		);
		$context = stream_context_create($options);
		$token = file_get_contents($url, false, $context);
		return json_decode($token);
	}

    public function _sendResponse($status = 200, $body = '', $content_type = 'application/json')
    {
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        // set the status
        header($status_header);
        // set the content type
        header('Content-type: ' . $content_type);
        header('Access-Control-Allow-Methods:POST,GET');

        header('Access-Control-Allow-Origin: *');

        // pages with body are easy
        if ($body != '') {
            // send the body
            echo $body;
            exit;
        }
        // we need to create the body if none is passed
        else {
            // create some body messages
            $message = '';

            // this is purely optional, but makes the pages a little nicer to read
            // for your users.  Since you won't likely send a lot of different status codes,
            // this also shouldn't be too ponderous to maintain
            switch ($status) {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            // servers don't always have a signature turned on (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

            // this should be templatized in a real-world solution
            $body = $status . ' ' . $this->_getStatusCodeMessage($status) . ' ' . $message . ' ' . $signature;

            echo $body;
            exit;
        }
    }

    private function _getStatusCodeMessage($status)
    {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            909 => 'PMN',
        );

        return (isset($codes[$status])) ? $codes[$status] : '';
    }
}
