<?php
include 'RsaDecryption.php';
$username=$_POST['username'];
echo '需要解密字符串(username):<br/>'.$username.'<br/>';
echo "解密后原用户名:".DecryptString($username);
echo "<br/>";
$password = $_POST['password'];
echo "需要解密字符串(password):<br/>".$password;
echo "<br/>";
echo "解密后原密码:".DecryptString($password);
echo "<br/>";



?>