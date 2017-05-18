<?php  
/*$mohsin=searchdata('apk','vlc');
print_r($mohsin);
*/

function searchdata($type,$keyword){

$curl = curl_init();
$all_data = array();

$url="http://www.apkmirror.com/?post_type=app_release&searchtype=$type&s=$keyword";

curl_setopt($curl, CURLOPT_URL, $url);
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);

$app = array();
$new = array();

preg_match_all('!<a class="fontBlack" href="(.*?)">(.*?)<\/a>!', $result, $matches);
$app['download_link']=array_values(array_unique($matches[1]));
$app['name']=array_values(array_unique($matches[2]));

preg_match_all('!<a href="\/apk\/.*?\/" class="byDeveloper block-on-mobile wrapText">(.*?)<\/a>!', $result, $matches);
$app['dev_by']=array_values($matches[1]);

preg_match_all('!wp-content\/[^\s]*?.png(.*?)32(.*?)32(.*?)100!', $result, $matches);
$app['image_url']=array_values(array_unique($matches[0]));

preg_match_all('!<span class="infoslide-name">Uploaded:<\/span><span class="infoslide-value"><span style="" class="(.*?)" data-utcdate="(.*?)">(.*?)<\/span><\/span>!', $result, $matches);
$app['uploaded']=array_values($matches[3]);

preg_match_all('!<span class="infoslide-name">File size:<\/span><span class="infoslide-value">(.*?)<\/span>!', $result, $matches);
$app['file_size']=array_values($matches[1]);

preg_match_all('!<span class="infoslide-name">Downloads:<\/span><span class="infoslide-value">(.*?)<\/span>!', $result, $matches);
$app['app_hit']=array_values($matches[1]);

preg_match_all('!<span class="infoslide-name">Version:<\/span><span class="infoslide-value">(.*?)<\/span>!', $result, $matches);
$app['version']=array_values($matches[1]);

$variants='!<a href="(.*?)" class="byDeveloper block-on-mobile wrapText">(.*?)<\/a> <div class="appRowVariantTag"><a style="color: #(.*?);" href="(\/(.*?)\/(.*?)\/(.*?)\/(.*?)\/)"><svg class="icon tag-icon"><use xlink:href="#apkm-icon-tag"><\/use><\/svg>(.*?) variants<\/a><\/div> <\/div>!';
preg_match_all($variants, $result, $matches);
$new['4'] =array_values($matches[4]);
$new['6'] =array_values($matches[6]);
$new['7'] =array_values($matches[7]);
$new['8'] =array_values($matches[8]);

$count=count($matches[4]);

preg_match_all('!<div style="display: none;" class="infoSlide">!', $result, $matches);
$found=count($matches[0]);

for ($i=0; $i < $found; $i++) { 
	$str1=$app['download_link'][$i];
		for ($j=0; $j < $count; $j++) { 
			$str2=$new['4'][$j];
			$str3=$new['6'][$j];
			$str4=$new['7'][$j];
			$str5=$new['8'][$j];
			
			if ($str1===$str2) {
				$app['variants_link'][$i]=$str2;
				$app['variants_by'][$i]=$str3;
				$app['variants_name'][$i]=$str4;
				$app['variants_release'][$i]=$str5;
				break;
			}else{
				$app['variants_link'][$i]='';
				$app['variants_by'][$i]=$str3;
				$app['variants_name'][$i]=$str4;
				$app['variants_release'][$i]=$str5;
		}
	}
}
if ($found === 0) {

	$all_data = null;
	
	return $all_data;
	
}else{
//save all data in a nicely formatted array
    foreach($app as $key => $value) {
        for ($i = 0; $i < $found;$i++){
            $data[$i][$key] = $app[$key][$i];
        }
    }
    $all_data = array_merge($data,$all_data);
    return $all_data;
}
curl_exec($curl);
}

/*$mohsin=searchdetail('http://www.apkmirror.com','/apk/j2-interactive/mx-player-codec-armv7/mx-player-codec-armv7-1-8-20-release/');
print_r($mohsin);
*/

function searchdetail($main_url,$secondary_url){

$curl = curl_init();
$url="$main_url$secondary_url";

curl_setopt($curl, CURLOPT_URL, $url);
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);
	
$all_data = array();
$app = array();
$hello=array();
$number=array();

	preg_match_all('!aria-controls="(file)"!', $result, $matches);
	$hello['find']=array_values($matches[0]);

if (!empty($hello['find'])) {

	preg_match_all('!<a (.*?) href="(.*?)">(.*?)Download APK<\/a>!', $result, $matches);
	$app['down_link']=array_values($matches[2]);

	preg_match_all('!<div class="appspec-value">Version:(.*?)<br>(.*?)<br>!', $result, $matches);
	$app['architecture']=array_values($matches[2]);
	$app['version']=array_values($matches[1]);
	
	preg_match_all('!Min:(.*?)<\/div>!', $result, $matches);
	$app['minimum_version']=array_values($matches[1]);

	//save all data in a nicely formatted array
        	$data[0]['col1'] = $app['version'][0];
        	$data[0]['col2'] = $app['architecture'][0];
        	$data[0]['col3'] = $app['minimum_version'][0];
        	$data[0]['col4'] = "nodpi";
        	$data[0]['col5'] = $app['down_link'][0];
        $all_data = array_merge($data,$all_data);
    return $all_data;
}else{
	
	$info='!<div class="table-cell rowheight addseparator expand pad dowrap">(.*?)<\/div>!';
	preg_match_all($info, $result, $matches);
	$number['tab']=array_values($matches[1]);
	
	$modifed_secondary_url = preg_replace('([/])', '\/', $secondary_url);
	$modifed_tag='<a style="color\: #(.*?) !important;" href="search(.*?)">';
	$down_link=preg_replace("/search/", $modifed_secondary_url, $modifed_tag);
	preg_match_all($down_link, $result, $matches);
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
    		$da=$data[$i]['col1'];
    $curl = curl_init();
    $changed_url="$main_url$secondary_url$da";
    curl_setopt($curl, CURLOPT_URL, $changed_url);
	//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($curl);	
	$link_var=array();
	preg_match_all('!<a (.*?) href="(.*?)">(.*?)Download APK<\/a>!', $result, $matches);
	$link_var['down_link']=array_values($matches[2]);
			$data[$i]['col5']=$link_var['down_link'][0];
	}
	$all_data = array_merge($data,$all_data);
    return $all_data;
}
curl_exec($curl);
}

function download($url){

	$curl = curl_init();
	
	$url="$url";

	curl_setopt($curl, CURLOPT_URL, $url);
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($curl);

	$all_data = array();
	$app = array();

preg_match_all('!<a rel="nofollow" data-google-vignette="false" href="(\/wp-content\/themes\/APKMirror\/download\.php\?id=(.*?))">here<\/a>!', $result, $matches);
	$app['down_link']=array_values($matches[1]);

	$data[0]['down_link'] = $app['down_link'][0];

	$all_data = array_merge($data,$all_data);
    return $all_data;
}
?>