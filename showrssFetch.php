<?php

$destDir = "../personal/torrents/";
//$destDir = "./torrents/";

//	set to your showrss feed URL, or leave it as is and watch the shows I like
$rssUrl = "http://showrss.karmorra.info/rss.php?user_id=6191&hd=0&proper=1";

ini_set( 'date.timezone', 'Europe/London' );

// get last date from cache
$cache_file = './lastAccess.txt';
if(file_exists($cache_file))
	$lastAccess = file_get_contents($cache_file);
$rssData = $xml = new SimpleXMLElement(getData($rssUrl));

foreach($rssData->channel->item as $item)
{
	// skip if we've already seen it
	$date = strtotime($item->pubDate);
	if($date <= $lastAccess)
		continue;

	// update the latest timestamp
	if($date > $latestAccess)
		$latestAccess = $date;
	saveTorrent($item->link);
}

// write cache if updated
if($latestAccess > $lastAccess)
	writeBack($cache_file, $latestAccess);

exit(0);

function saveTorrent($url)
{
	global $destDir;

	// get filename from http://showrss.karmorra.info/r/67849b94daf750c142adf43266525b3a.torrent
	$matches = split("/", $url);
	$filename = $matches[count($matches)-1];

	$torData = getData($url);

	// write to disk
	writeBack($destDir.$filename, $torData);
}

function writeBack($filename, $data)
{
	$handle = fopen($filename, "wb");
	fwrite($handle, $data);
	fclose($handle);
}

function getData($url)
{
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
} 

