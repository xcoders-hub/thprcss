<?php
function curl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    $proxy= 'base/data/proxies/proxy.txt';
    $head[] = "Connection: keep-alive";
    $head[] = "Keep-Alive: 300";
    $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $head[] = "Accept-Language: en-us,en;q=0.5";
    //$proxyauth = 'user:password';
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    // curl_setopt($ch, CURLOPT_PROXY, '151.106.18.123:1080');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
    curl_setopt($ch, CURLOPT_POSTREDIR, 3);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    $page = curl_exec($ch);
    curl_close($ch);
    return $page;
}
function mirrorTg($url, $filename,$peerid){
include '/www/wwwroot/host.driveup.in/tgprcss2/madeline.php';   
$MadelineProto = new \danog\MadelineProto\API('/www/wwwroot/host.driveup.in/tgprcss2/session.madeline');
$MadelineProto->start();
$me = $MadelineProto->getSelf();
$MadelineProto->logger($me);

$MessageMedia = $MadelineProto->messages->uploadMedia([
    'media' => [
        '_' => 'inputMediaUploadedDocument',
        'file' => $url,
        'attributes' => [
                ['_' => 'documentAttributeFilename', 'file_name' => $filename]
            ],
          
    ],
]);
$sentMessage = $MadelineProto->messages->sendMedia([
    'peer' => $peerid,
    'media' => $MessageMedia,
    'message' => $filename .' Host:- driveup.in',
    'parse_mode' => 'Markdown',
]);

$res = json_encode($sentMessage,true);
$tes = json_decode($res , true);
$rc = $tes['updates'][0]['id'];
$channelid= abs(1001792933722*$rc);
$li= 'get-'.$channelid;
return $li;

}
$downloadurl = base64_decode($_GET['url']);
$orgid = $_GET['orgid'];
$filename = basename($downloadurl);
$peerid = '@uieyiuwchiuc';
if (!empty($downloadurl))
    {
        $cloudtelgm = mirrorTg($downloadurl, $filename, $peerid);
        $tgid = $cloudtelgm;
        curl('https://driveup.in/mrockapi/tgapi.php?orgid='.$orgid.'&tgid='.$tgid);
        echo 'done';
        
    }
?>