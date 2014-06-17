<?php
function http_head_curl($url,$timeout=30)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); // in seconds
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_NOBODY, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$res = curl_exec($ch);
	if ($res === false) {
		throw new RuntimeException("cURL exception: ".curl_errno($ch).": ".curl_error($ch));
	}
	
	$res = trim($res);
	$res = explode("\n",$res);
	unset($res[0]);
	foreach($res as $k => $header)
	{
		$header = explode(':', $header);
		$key = trim($header[0]);
		$val = trim($header[1]);
		$res[$key] = $val;
		unset($res[$k]);
	}
	
	return $res;
}

$url = 'http://docs.google.com/spreadsheet/pub?key=0An2BgPnSFrG6dFE2XzF0bVl0cmZfbVYtcThGRFo4anc&single=true&gid=1&output=csv';

$headers = http_head_curl($url);

header('Content-Description: File Transfer');
header('Content-Type: '.$headers['Content-Type']);
header('Content-Disposition: '.$headers['Content-Disposition']);
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . $size);
ob_clean();
flush();

readfile($url);
exit;
?>