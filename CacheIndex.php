<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'Cache.php';
$cache=new Cache();
$cache=new Cache(60,'cache/');
$value=$cache->get('lianglisen');
if($value==false)
{
    $cache->put('lianglisen',"this is my test data at:".  time());
    print_r("insert data to Cache.");
}
else
{
    print_r("Read Cache:".$value);
}
    


?>

<table>
    <tr>
        <td>
            亲爱的TBsky12345:
        </td>
    </tr>
    <tr>
        <td>
            欢迎加入通宝在线娱乐城！您已经成功地创造了一个真实帐户，现在登陆就可开始游戏。
        </td>
    </tr>
    <tr>
        <td>
            以下是您在通宝娱乐城真实游戏信息，请您妥善保管！
        </td>
    </tr>
    <tr>
        <td>
            用户名:TBsky12345
        </td>
    </tr>
    <tr>
        <td>
            注册姓名:莫问天
        </td>
    </tr>
    <tr>
        <td>
            注册电话:13922042350
        </td>
    </tr>
    <tr>
        <td>
            电子邮件:senlinsky@gmail.com
        </td>
    </tr>
    <tr>
        <td>
            如有任何问题，欢迎您随时联系我们的7X24小时在线客服！
        </td>
    </tr>
    <tr>
        <td>
            客服邮箱地址：cs@tbluckclub.com  QQ客服：800077629
        </td>
    </tr>
    <tr>
        <td>
            www.tongbao918.com 通宝客服部
        </td>
    </tr>
</table>