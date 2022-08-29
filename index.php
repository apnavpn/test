<?php
$url = "https://jazztv.pk/jazzlive/index.php/services/webservices/singleChannel";
$id = $_GET['c'];


$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$first="------WebKitFormBoundaryUYIuSm57u6qJfG4R\r\nContent-Disposition: form-data; name=\"slug\"\r\n\r\n";

$slug='madani-channel-live';

$part="\r\n------WebKitFormBoundaryUYIuSm57u6qJfG4R\r\nContent-Disposition: form-data; name=\"ip\"\r\n\r\n";

$iip= $_SERVER['REMOTE_ADDR'];

$last ="\r\n------WebKitFormBoundaryUYIuSm57u6qJfG4R\r\nContent-Disposition: form-data; name=\"user_id\"\r\n\r\n9999999999\r\n------WebKitFormBoundaryUYIuSm57u6qJfG4R\r\nContent-Disposition: form-data; name=\"mobile\"\r\n\r\n9999999999\r\n------WebKitFormBoundaryUYIuSm57u6qJfG4R\r\nContent-Disposition: form-data; name=\"package_id\"\r\n\r\n9999999999\r\n------WebKitFormBoundaryUYIuSm57u6qJfG4R--\r\n";
$all = $first.$slug.$part.$iip.$last;
curl_setopt($curl, CURLOPT_POSTFIELDS, $all);
$headers = array();
$headers[] = 'Host: jazztv.pk';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Content-Length: 570';
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'Token: 774a719yycaa6xc44bg12e5hf5buj69dmkcdt46dl';
$headers[] = 'Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryUYIuSm57u6qJfG4R';
$headers[] = 'Origin: http://tamashaweb.com';
$headers[] = 'Referer: http://tamashaweb.com/';

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$risp = curl_exec($curl);
curl_close($curl);
$json = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $risp), true );

$fnl = $json['eData']; 


$dataToDecrypt = hex2bin($fnl);
    $aesKey ="0k3fe880499l4k31e8999b14d9c5lkmn";
    $iv = "spfjtrbhgijlenpy";
    $result = openssl_decrypt($dataToDecrypt, 'AES-256-CBC', $aesKey, OPENSSL_RAW_DATA, $iv);
    
$df = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $result), true );

$redi = $df['data']['ChannelStreamingUrl'];
$token = str_replace("https://cdn2.jazztv.pk:8087/webauth/Madni-121/playlist.m3u8", "", $redi);
header("Location:$id$token");
?>
	<video controls src="$redi"></video>