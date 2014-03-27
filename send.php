#!/usr/bin/php
<?php
# fbget project
# by ne0d34th
# this is a function for sending message with cURL (and without API ofc :p )
# usage: fbget_send([message], [recipient's user id], [recipient's user name], [cookie file used])
# next: automating recipient's user id and user name input by user can just input account url
# warning: still in "debugging" stage, will cut down some unecessary output.
function fbget_send($body, $id, $name, $cok)
{
$sid = $id;
$url = "https://mbasic.facebook.com/messages/compose/?folder=inbox&ids[".$sid."]=".$sid;
$nama = $name;
$aduh = array(
'charset_test'=>"%E2%82%AC%2C%C2%B4%2C%E2%82%AC%2C%C2%B4%2C%E6%B0%B4%2C%D0%94%2C%D0%84",
'body' => $body,
'Send' => "Send");
eval("\$aduh['ids[".$id."]'] = \$sid;");
eval("\$aduh['text_ids[".$id."]'] = \$nama;");
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
echo "test~\n\n";
echo $spl[1];
$spl = preg_split("/".base64_decode("IiBhdXRvY29tcGxldGU9Im9mZiI=")."/", $spl[1]);
echo "test\n\n";
echo $spl[0];
$aduh['fb_dtsg'] = $spl[0];
$url = "https://mbasic.facebook.com/messages/send/index.php?icm=1";
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
