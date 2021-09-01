<?php

$url = "http://glauniversity.in:80/result.asmx/searchemployeewithcode";
$data = 'name=subhash+chand+agrawal&depart=&desg=&stafftype=&mob=&servicekey=thisismycommunicationapp&servicetype=SOFT';
$headers = array('Host: glauniversity.in',
'Connection: keep-alive',

'Cache-Control: max-age=0',
'Upgrade-Insecure-Requests: 1',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36',
'Origin: http://glauniversity.in',
'Content-Type: application/x-www-form-urlencoded',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'Referer: http://glauniversity.in/result.asmx?op=searchemployeewithcode',

'Accept-Language: en-US,en;q=0.9',
'Cookie: _ga=GA1.1.672023977.1626337671; __utma=101992023.672023977.1626337671.1629950153.1629950153.1; __utmz=101992023.1629950153.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); _ga_C1BE720JQ4=GS1.1.1630039046.40.1.1630039150.0'
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$output = curl_exec($ch);
print_r($output);
