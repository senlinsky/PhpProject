<?php
require 'autoload.php';
use Mailgun\Mailgun;
$mg=new Mailgun("key-e09f485a75d7eca754aee6f57c14e15d");
$domain="support.tboopkjj88.com";
$result=$mg->sendMessage($domain,array('from'=>'senlinsky@support.tboopkjj88.com','to'=>'senlinsky@gmail.com','subject'=>'The Mailgun PHP SDK is awesome!',
'text'=>'This..It is so simple to send a message'));
print_r($result);




?>

