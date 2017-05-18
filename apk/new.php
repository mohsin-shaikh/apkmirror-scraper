<?php  

$curl = curl_init();

//$ref="/apk/google-inc/chrome-dev/chrome-dev-60-0-3096-5-release/";
$ref="/apk/j2-interactive/mx-player-codec-armv7/mx-player-codec-armv7-1-8-20-release/";
$url="http://www.apkmirror.com$ref";
echo $url;
/*
$search = preg_replace('([/])', '\/', $ref);
$new3='<a style="color\: #(.*?) !important;" href="search(.*?)">';
$new4=preg_replace("/search/", $search, $new3);*/

curl_setopt($curl, CURLOPT_URL, $url);
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);

$app = array();
$hello=array();
$number=array();

/*preg_match_all('!<li class="active"><a(.*?)href="#file">FILE<\/a><\/li>!', $result, $matches);
print_r($matches);


	preg_match_all('!<a (.*?) href="(.*?)">(.*?)Download APK<\/a>!', $result, $matches);
	$app['down_link']=array_values($matches[2]);
	print_r($app);
*/



//print_r($result);
/*if (!empty($hello)) {

	preg_match_all('!<a (.*?) href="(.*?)">(.*?)Download APK<\/a>!', $result, $matches);
	$app['down_link']=array_values($matches[2]);
	$found=count($matches[2]);
	//save all data in a nicely formatted array
        for ($i = 0; $i < $found;$i++){
            $data[$i][$key] = $app[$key][$i];
        }
}else{
	
	$info='!<div class="table-cell rowheight addseparator expand pad dowrap">(.*?)<\/div>!';
	preg_match_all($info, $result, $matches);
	$number['tab']=array_values($matches[1]);
	
	preg_match_all($new4, $result, $matches);
	$app['down_link']=array_values($matches[2]);

	$found=count($matches[2]);

	//save all data in a nicely formatted array	
    for ($i=0,$j=0; $i < $found;$i++,$j++){
            $data[$i]['col1'] = $app['down_link'][$i];
            $data[$i]['col2'] = $number['tab'][$j];
            $j++;
            $data[$i]['col3'] = $number['tab'][$j];
            $j++;
            $data[$i]['col4'] = $number['tab'][$j];
    }
}
*///print_r($data);
curl_exec($curl);
?>