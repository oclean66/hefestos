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
        'mailfrom' => 'soporte.kingdeportes@gmail.com',
        'subjectprefix' => 'Notificacion - ',
        'transport' => 'gmail', //imap, pop3
        'gmailAcount' => "company@gmail.com",
        'gmailPassword' => "password",       
        // 'debug' => true,
    )
);