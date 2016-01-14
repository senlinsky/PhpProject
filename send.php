<?php
require 'vendor/autoload.php';
use Mailgun\Mailgun;
include 'MailAccount.php';
function hashCode($str)
{
    if(empty($str)){return 0;}
    $mdv = md5($str);
    $mdv1 = substr($mdv,0,16);
    $crc1 = abs(crc32($mdv1));
    return $crc1;
}
function GetGuidString() {
    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
    $hyphen = chr(45);// "-"
    $uuid = chr(123)// "{"
    .substr($charid, 0, 8).$hyphen
    .substr($charid, 8, 4).$hyphen
    .substr($charid,12, 4).$hyphen
    .substr($charid,16, 4).$hyphen
    .substr($charid,20,12)
    .chr(125);// "}"
    return $uuid;
}
try{
    $apiDomain=GetDomainAccount();
    $apiKey=GetDomainApiKey();  
    $content=$_POST['content']; 
    $subject=$_POST['subject']; 
    $toEmail=$_POST['toEmail'];
    $content=$content."<br/><br/>TickId:".GetGuidString();
    $mailArr=explode("@",$toEmail);
    $mailIndex=abs(hashCode($mailArr[0])%count($apiDomain));
    //$mailIndex=3;
    $domain=$apiDomain[$mailIndex];
    $domailKey=$apiKey[$mailIndex];
    $sendByEmail="TBcustomerService<support"."@".$domain.">";
    $mg=new Mailgun($domailKey);
    $result=$mg->sendMessage($domain,array('from'=>$sendByEmail,
        'to'=>$toEmail,
        'subject'=>$subject,
    'html'=>$content));
    $jsonData=json_encode($result);
    $jsonString=json_decode($jsonData,true);
    $httpCode=$jsonString['http_response_code'];
    $returnMsg=$jsonString['http_response_body']['message'];    
    print_r($httpCode.":".$returnMsg);
    
}
catch (Exception $e)
{
    print("Failed:");
    print_r($e->getMessage());
}
?>
