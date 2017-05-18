<?php  
	include 'includes/head.php';
	include 'includes/nav.php';
	include 'search.php';

	$main_url="http://www.apkmirror.com";
	$secondary_url=$_GET['url'];

	$data=searchdetail($main_url,$secondary_url);
	$count_data=count($data);
	
?>
<div class="container">
<?php
for ($i=0 ; $i < $count_data; $i++) { 
		 	$version =$data[$i]['col1']; 
            $support =$data[$i]['col2']; 
            $min_versioon =$data[$i]['col3']; 
            $screen_dpi =$data[$i]['col4']; 
            $download_link =$data[$i]['col5']; 
            
?>
<table class="table">
	<tr>
		<td></td>
		<td>App Version:</td>
		<td><?= $version;?></td>
	</tr>
	<tr>
		<td></td>
		<td>Supported Version:</td>
		<td><?= $support; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>Minimum Version:</td>
		<td><?= $min_versioon;?></td>
	</tr>
	<tr>
		<td></td>
		<td>Screen DPI:</td>
		<td><?= $screen_dpi; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>Download:</td>
		<td><a href="download.php?url=<?= $download_link; ?>">Download</a></td>
	</tr>
</table>
<?php
}
?>

</div>

<?php  
	include 'includes/foot.php';
?>