#!/usr/bin/php
<?php
# fbget project
# by ne0d34th
# this is a function for logging in and store the session in cookie file
# usage: fbget_login([email], [password], [cookie file])
# next: see those "random" hidden form i should POST with cURL below? i think i should investigate it whether it affect the login process or something like what happened in send message form
# but somehow, this code works :D
# warning: still in "debugging" stage, will cut down some unecessary outputs
function fbget_login($email, $pass, $cok)
{
echo "Tes tes\n";
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
curl_setopt($c, CURLOPT_COOKIEFILE, $cok);
curl_setopt($c, CURLOPT_COOKIEJAR, $cok); 
curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
$res = curl_exec($c);
echo $res;
$url = "https://mbasic.facebook.com/login.php?refsrc=https%3A%2F%2Fmbasic.facebook.com%2F&amp;refid=8";
$fff = array(
'email'=>$email,
'pass'=>$pass,
'login'=>"Log In",
'lsd'=>"AVoCf66t",
'charset_test'=>"",
'version'=>'1',
'ajax'=>'0',
'width'=>'0',
'pxr'=>'0',
'gps'=>'0',
'm_ts'=>'1385037769',
'li'=>'yf-NUs6LpSuE1hmq9gYxSa7v',
'signup_layout'=>'layout|bottom_clean||wider_form||prmnt_btn|special||st|create||header_crt_acct_button||hdbtn_color|green||signupinstr||launched_Mar3',
'_fb_noscript'=>'true');
$pf = http_build_query($fff);
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_POST, 1);
curl_setopt($c, CURLOPT_POSTFIELDS, $pf);
$res = curl_exec($c);
echo "\n\n";
echo $res;
curl_close($c);
}
?>
