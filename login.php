#!/usr/bin/php
<?php
# fbget project
# by ne0d34th
# this is a function for logging in and store the session in cookie file (can be server / client side function)
# usage: fbget_login([email], [password], [cookie file])
# next: see those "random" hidden form i should POST with cURL below? i think i should investigate it whether it affect the login process or something like what happened in send message form
# but somehow, this code works :D
# warning: still in "debugging" stage, will cut down some unecessary outputs
function fbget_login($email, $pass, $cok)
{
echo "Tes tes\n";
if(file_exists($cok))
{
unlink($cok);
}
$url = "https://mbasic.facebook.com/";
$head[] = "Accept: */*";
$head[] = "Connection: Keep-Alive";
$c = curl_init();
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_HTTPHEADER, $head);
curl_setopt($c, CURLOPT_HEADER,  0);
curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
$res = curl_exec($c);
echo $res;
$url = "https://mbasic.facebook.com/login.php?refsrc=https%3A%2F%2Fmbasic.facebook.com%2F&amp;refid=8";
$fff = array(
'email'=>$email,
'pass'=>$pass,
'login'=>"Log In",
'charset_test'=>"%E2%82%AC%2C%C2%B4%2C%E2%82%AC%2C%C2%B4%2C%E6%B0%B4%2C%D0%94%2C%D0%84",
'version'=>'1',
'ajax'=>'0',
'width'=>'0',
'pxr'=>'0',
'gps'=>'0');

echo "\n\nCAPEK GA SIH?\n\n";
$susah = preg_split("/".base64_decode("PGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0ibHNkIiB2YWx1ZT0i")."/", $res);
$susah = preg_split("/".base64_decode("XCIgYXV0b2NvbXBsZXRlPVwib2ZmXCI=")."/", $susah[1]);
echo $susah[0];
$fff['lsd'] = $susah[0];

echo "\n\nCAPEK GA SIH?\n\n";
$susah = preg_split("/".base64_decode("PGlucHV0IHR5cGU9ImhpZGRlbiIgYXV0b2NvbXBsZXRlPSJvZmYiIG5hbWU9Im1fdHMiIHZhbHVlPSI=")."/", $res);
$susah = preg_split("/".base64_decode("XCIgXC8+")."/", $susah[1]);
echo $susah[0];
$fff['m_ts'] = $susah[0];

echo "\n\nCAPEK GA SIH?\n\n";
$susah = preg_split("/".base64_decode("PGlucHV0IHR5cGU9ImhpZGRlbiIgYXV0b2NvbXBsZXRlPSJvZmYiIG5hbWU9ImxpIiB2YWx1ZT0i")."/", $res);
$susah = preg_split("/".base64_decode("XCIgXC8+")."/", $susah[1]);
echo $susah[0];
$fff['li'] = $susah[0];

$pf = http_build_query($fff);
curl_setopt($c, CURLOPT_COOKIEFILE, $cok);
curl_setopt($c, CURLOPT_COOKIEJAR, $cok); 
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_POST, 1);
curl_setopt($c, CURLOPT_POSTFIELDS, $pf);
$res = curl_exec($c);
echo "\n\n";
echo $res;
curl_close($c);
}
?>
