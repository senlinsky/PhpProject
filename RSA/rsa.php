<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>RSA加解实现</title>
	<script type="text/javascript" src="RSA.js"></script>
	<script type="text/javascript" src="BigInt.js"></script>
	<script type="text/javascript" src="Barrett.js"></script>
</head>
<body>
    <font style="color:red; font-size: 20px; font-weight:bold;"> 建立安全的信息传输系统,防止数据被截取及过滤!</font><br/>
<form action="RsaResult.php" method="post" name="rsa_form" id="rsa_form">
用户名:<input type="text" name="username" id="username"/><br/><br/>
密&nbsp;码:<input type="password" name="password" id="password"/>
<input type="button" value="提交" onclick="rsa()" />
</form>
    <?php
    include 'RsaPublicKey.php';
    ?>
    
<script type="text/javascript">
var rsa =function(){
	//十六进制公钥  
	var rsa_n="<?php  print_r(GetPublicKey());?>";
	var pw = document.getElementById("password");
        var un = document.getElementById("username");
	setMaxDigits(131); //131 => n的十六进制位数/2+3
	var key  = new RSAKeyPair("10001", '', rsa_n); //10001 => e的十六进制
	pw.value = encryptedString(key, pw.value); //不支持汉字
        un.value=encryptedString(key,un.value);//+'\x01'	
	document.rsa_form.submit();
}
</script>
</body>
</html>
