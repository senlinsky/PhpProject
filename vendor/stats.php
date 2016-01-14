<?php
require 'autoload.php';
use Mailgun\Mailgun;
$mgClient= new Mailgun('key-8bb667ef4a8fc33ed0b3ff93f666ba28');
$domain='service.tboopkjj88.com';
$result=$mgClient->get("$domain/stats/total",array(
	'event'=>array('accepted','delivered','failed'),
        'duration'=>'1m'
	));
//print_r($result);
print_r("------------><br/>");
$statu=500;
$tempArr;
foreach($result as $key=>$value){
	if($key=="http_response_body"){
		$tempArr=$value;
	}
        else{
          if($value==200){
		$statu=200;
		print_r("<br/>Get data success!<br/>");
	  }

	}
      //  print_r("<br/>---------><br/>");
      //  print_r($value);
      //  print_r("<br>----------><br/>");
}
if($statu==200){
	foreach($tempArr as $key=>$value){
		if($key=="stats"){
			print_r($value[0]);
		}
	}

}else{
	print_r("<br/>Get data error<br/>");
}


?>
