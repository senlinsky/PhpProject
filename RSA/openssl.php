<?php
class Rsa
{
private static $PRIVATE_KEY = '-----BEGIN RSA PRIVATE KEY-----
MIICWwIBAAKBgQDtpoZSFconKFLsx2aFhh6XGr4/P1HzjKlNqidNsZhoxEdw1GEN
ywr4aU0f5a2Mz6iJGczY5tmU2ZMYzSRHRAls5ll2BCpAR/GpeLu7H1sL4+agce10
rBQiXcxb8u5h0Ns39eiFuVgX3zAJSh5bCSBhMw2zbKG9MBkIYuI6IwPynwIDAQAB
AoGASYDN3qmaos3YCCAMV5QJ9hZxbUJ6aGfDHaBZE7CwQQckSYOGmSuJsxduoUT6
jqjTqcPvFc8g0OcSlgMtC1XBy/I8w7WrhCC2ELAPyjUazETq5UU4Lp3ZdxtqF3Zd
TYR4wcHsElKFbAI0ABZF1Sn+UkpJLjAGEAWobqP9YRFOYBECQQD8W9MOruN/adLZ
djDdehrKVJJWqtXFGDMXQqUeeqYlXLPjZ7Rf3qvka3gcAVvh7w9mpNkiNZXEMwg+
QAlozKuNAkEA8RRezfyQli/ebPMd1Zsbyouv/W+vUfrv/zd1tNfparOOkkpoI2Xj
0CFqYPxk+W4J4OBFcw+hMtudhtCnT0012wJAYj24/0lUJSDkRWX+henoDgY4Zebh
i3XtRcvbDe9/SKI7IXcYwA2mayjvPC/HPkBbhYD9SpUDtbqMJfe18gdjbQJAMnc4
LVicj8PvhNETwr5Yf/rj2WLCyZ+FE+DxM+0qwJpb0wXebOKMYOpN0YWkQY6mZLut
7hssfG/6ttkA3RnllwJAa/H6apZ7cPqCm2pf2CZPHPxzp057hCivsunWm7dt1RjP
g1kOOyG7QwB1X7/FcvZioRnNFMhgm+asgySbl+W//Q==
-----END RSA PRIVATE KEY-----';
private static $PUBLIC_KEY = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDtpoZSFconKFLsx2aFhh6XGr4/
P1HzjKlNqidNsZhoxEdw1GENywr4aU0f5a2Mz6iJGczY5tmU2ZMYzSRHRAls5ll2
BCpAR/GpeLu7H1sL4+agce10rBQiXcxb8u5h0Ns39eiFuVgX3zAJSh5bCSBhMw2z
bKG9MBkIYuI6IwPynwIDAQAB
-----END PUBLIC KEY-----';
/**
 * 16进制
 * 公匙: D42E861C04CFB9EBB1368A682EC22BDCA364A35E1C5DF1D43FC4F24197D4B798BCB7FD0192774749C4DED8B659002B4ABEA2F11F7896BCEE5CD615D31EF8936823ED6760CA01D91F677F1459019383679D78BE72FE67E7C1C3FDA1A514B5FE35879A9A9DC90EAE059948CD222F4C69F37F23F0864112CD4A8AE2B4FD9EC36297
 * 密匙: 85035557233D059457579594921B6F5BB5A255379E18D68CF41D06B14FF92DCF361F3120572D27277B9F27C3C82F6EF44065ED3A896215B667C45D92280C347B235AB10164B15A3799D5CFFE7B4FDA5A823116F4DA48A08E6CFED11F274BEE1CE74AD161045992EEDE859A8B048CA9FECE7DFD5E1DA25E71FD2624380FBB8DA1
 */
    /**
    *返回对应的私钥
    */
    private static function getPrivateKey(){
    
        $privKey = self::$PRIVATE_KEY;
         
        return openssl_pkey_get_private($privKey);      
    }
    /**
    *返回对应的公钥
    */
    private static function getPublicKey(){
    
        $pubkey = self::$PUBLIC_KEY;
         
        return openssl_pkey_get_public($pubkey);      
    }
    /**
     * 私钥加密
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function privEncrypt($data)
    {
        if(!is_string($data)){
                return null;
        }           
        return openssl_private_encrypt($data,$encrypted,self::getPrivateKey())? base64_encode($encrypted) : null;
    }
    
    
    /**
     * 私钥解密
     * @param  [type]  $encrypted 密文（二进制格式且base64编码）
     * @param  boolean $fromjs    密文是否来源于JS的RSA加密
     * @return [type]             [description]
     */
    public static function privDecrypt($encrypted, $fromjs = FALSE)
    {
        if(!is_string($encrypted)){
                return null;
        }
        $padding = $fromjs ? OPENSSL_NO_PADDING : OPENSSL_PKCS1_PADDING;  
        if (openssl_private_decrypt(base64_decode($encrypted), $decrypted, self::getPrivateKey(), $padding))  
        {  
            return $fromjs ? trim(strrev($decrypted)) : $decrypted;  
        }  
        return null; 
    }
    /**
     * 私匙加密
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function encrypt($data) {
        if (openssl_public_encrypt($data, $encrypted, self::getPublicKey()))  
            $data = base64_encode($encrypted);  
        else  
            throw new Exception('Unable to encrypt data. Perhaps it is bigger than the key size?');  
  
        return $data;  
    }
}
 

//JS->PHP传输RSA加密解密测试
$password = $_POST['password'];
echo "Password Source String:<br/>".$password;
echo "<br/>";
$key = base64_encode(pack("H*", $password));
echo "Password Decrypt String:".Rsa::privDecrypt($key,true);
echo "<br/>";

$username=$_POST['username'];
echo 'Username Source String:<br/>'.$username.'<br/>';
$key=base64_encode(pack("H*",$username));

echo "Username DecryptString:".Rsa::privDecrypt($key,true);


//echo '<br>';
//PHP->PHP RSA加密解密测试
//$key = Rsa::encrypt('测试中文rsa加密');
//echo $key;
//echo '<br/>';
//echo Rsa::privDecrypt($key);
