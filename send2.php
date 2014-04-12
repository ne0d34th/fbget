#!/usr/bin/php
<?php
# fbget project
# by ne0d34th
# this is another function for sending message with cURL (and without API ofc :p ) now user only provide URL to reply to the target
# usage: fbget_send2([message], [cookie file used], [reply url])
# warning: still in "debugging" stage, will cut down some unecessary output.
function fbget_send2($body, $cok, $url)
{
$aduh = array(
'charset_test'=>"%E2%82%AC%2C%C2%B4%2C%E2%82%AC%2C%C2%B4%2C%E6%B0%B4%2C%D0%94%2C%D0%84",
'body' => $body,
'wwwupp' => "V3",
'send' => "Reply");
$head[] = "Accept: */*";
$head[] = "Connection: Keep-Alive";
$c = curl_init();
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_HTTPHEADER, $head);
curl_setopt($c, CURLOPT_HEADER,  0);
curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_COOKIE, $cok);
curl_setopt($c, CURLOPT_COOKIEFILE, $cok);
curl_setopt($c, CURLOPT_COOKIEJAR, $cok); 
curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
$res = curl_exec($c);

$spl = preg_split("/".base64_decode("PGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iZmJfZHRzZyIgdmFsdWU9Ig==")."/", $res);
echo "AH AH AH YAMETE~\n\n";
echo $spl[1];
$spl = preg_split("/".base64_decode("IiBhdXRvY29tcGxldGU9Im9mZiI=")."/", $spl[1]);
echo "AH AH YAMETE\n\n";
echo $spl[0];
$aduh['fb_dtsg'] = $spl[0];

$spl = preg_split("/".base64_decode("XDxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9Imlkc1xb")."/", $res);
echo "SECOND\n\n";
echo $spl[1];
$spl = preg_split("/".base64_decode("XF0iIHZhbHVlPSI=")."/", $spl[1]);
echo "DUBUR KIRRR\n\n";
echo $spl[0];
$id = $spl[0];
eval("\$aduh['ids[".$id."]'] = \$id;");

$spl = preg_split("/".base64_decode("bmFtZT0iY3NpZCIgdmFsdWU9Ig==")."/", $res);
echo "DESHHH\n\n";
echo $spl[1];
$spl = preg_split("/".base64_decode("IiBcL1w+")."/", $spl[1]);
echo "PRANGG\n\n";
echo $spl[0];
$aduh['csid'] = $spl[0];

$ecchi = preg_split("/\?tid=/", $url);
echo "COBA COBA YUKS\n\n";
$ecchi = preg_split("/&amp;refid/", $ecchi[1]);
echo "HAYAKUUU~\n\n";
echo $ecchi[0];
$gay = $ecchi[0];
$aduh['tids'] = $gay;

$url = "https://mbasic.facebook.com/messages/send/?icm=1&amp;refid=12";
print_r($aduh);
$pf = http_build_query($aduh);
$head[] = "Accept: */*";
$head[] = "Connection: Keep-Alive";
$c = curl_init();
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_HTTPHEADER, $head);
curl_setopt($c, CURLOPT_HEADER,  0);
curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_COOKIE, $cok);
curl_setopt($c, CURLOPT_COOKIEFILE, $cok);
curl_setopt($c, CURLOPT_COOKIEJAR, $cok); 
curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
curl_setopt($c, CURLOPT_POST, 1);
curl_setopt($c, CURLOPT_POSTFIELDS, $pf);
curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
$res = curl_exec($c);
echo $res;
}
?>
