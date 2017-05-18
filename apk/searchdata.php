<?php  
	include 'includes/head.php';
	include 'includes/nav.php';
	include 'search.php';

	$demo=$_GET['search'];
	$search = preg_replace('!\s+!', '+', $demo);

	$type="apk";
	$data = searchdata($type,$search);
	$count_data=count($data);

?>
<style type="text/css">
	table {
		margin-top: 5px;
	}
</style> 
<div class="container">

<?php 
	if ($count_data === 0)  {
?>
	<h1 style="text-align: center;">Sorry!!!</h1>
	<h3 style="text-align: center;">No Data Found</h3>
<?php 
	}else{
		for ($i=0 ; $i < $count_data; $i++) { 
		 	
		 	$download_link =$data[$i]['download_link']; 
            $app_name =$data[$i]['name']; 
            $dev_by =$data[$i]['dev_by']; 
            $image_url =$data[$i]['image_url']; 
            $version =$data[$i]['version']; 
            $uploaded =$data[$i]['uploaded']; 
            $file_size =$data[$i]['file_size']; 
			$app_hit =$data[$i]['app_hit']; 
			$variants =$data[$i]['variants_link'];

            //[variants_by] => j2-interactive
			$variants_by=$data[$i]['variants_by'];
            //[variants_name] => mx-player
			$variants_name=$data[$i]['variants_name'];
            //[variants_release] => mx-player-1-8-20-release
			$variants_release=$data[$i]['variants_release'];
		if (!empty($variants)) {
			$download_link =$data[$i]['download_link']; 
		}else{
			$second_half = preg_replace('[-release]', '-android-apk-download/', $variants_release);
			$download_link="$download_link$second_half";
		}
?>
<div class="d-inline-block ">
  <img style="width:32px; height:32px;" src="http://www.apkmirror.com/<?= $image_url;?>">
</div>
<div class="d-inline-block ">
  <h3><a href="details.php?url=<?= $download_link; ?>"><?= $app_name; ?></a></h3>
</div>
<div class="d-inline-block ">
  <h3><?=$dev_by ;?></h3>
</div>
<table class="table">
	<tr>
		<td></td>
		<td>Version:</td>
		<td><?= $version;?></td>
	</tr>
	<tr>
		<td></td>
		<td>Uploaded:</td>
		<td><?= $uploaded; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>File Size:</td>
		<td><?= $file_size;?></td>
	</tr>
	<tr>
		<td></td>
		<td>Download:</td>
		<td><?= $app_hit; ?></td>
	</tr>
</table>
<?php
	}
}
?>
</div>

<?php
	include 'includes/foot.php';
?>