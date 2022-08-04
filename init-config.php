<?php
$master = array(
    'database'=> array(
        'connectionString' => 'mysql:host=localhost;dbname=hefestos',
        'emulatePrepare' => true,
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ), 
    'crugemailer'=> array(
        'class' => 'application.modules.crugemailer.CrugeSwiftMailer',
        'mailfrom' => 'soporte@kingdeportes.com',
        'subjectprefix' => 'Notificacion - ',
        'transport' => 'gmail', //imap, pop3
        'gmailAcount' => "soporte@kingdeportes.com",
        'gmailPassword' => "Angel1509!",       
        // 'debug' => true,
    ),
    'domain' => (isset($_SERVER['HTTPS'])) ? "https://":"http://".$_SERVER ['SERVER_NAME'],
    'folder' => "hefestos"
);