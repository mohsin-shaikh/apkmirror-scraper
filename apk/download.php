<?php  
	include 'includes/head.php';
	include 'includes/nav.php';
	include 'search.php';

	$download=$_GET['url'];
	$main_url="http://www.apkmirror.com";
	$url="$main_url$download";

	$data=download($url);

	$real_download_link=$data[0]['down_link'];
	$download_url="$main_url$real_download_link";

?>
<style type="text/css">
	.btno {
		margin-top: 50px;
		margin-left: 500px;
		width: 200px;
		height: 50px;
	}
</style>

<a class="btn btn-success btno" role="button" href="<?= $download_url; ?>" download>Download</a>