#!/usr/bin/php
<?php
# fbget project
# by ne0d34th
# this is a function to check if anyone "call" the account for communication (server side function)
# usage: fbget_check([cookie file])
# warning: still in "debugging" stage, will cut down some unecessary output.
function fbget_check($cok)
{
$url = "https://mbasic.facebook.com/messages/";
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
$chan = preg_split("/threadlist_row_/", $res);
foreach ($chan as $suki)
{
if (preg_match("/\[!\] PANGGIL \[!\]/", $suki))
{
$ai = preg_split("/".base64_decode("PGgzIGNsYXNzPSJfNTJqZSBfNTJqZyBfM3oxMiBfNXRnXyI+PGEgaHJlZj0i")."/", $suki);
$ai = preg_split("/".base64_decode("Ij4=")."/", $ai[1]);
$sup = $ai[0];
echo $sup;
}
}
}
?>
