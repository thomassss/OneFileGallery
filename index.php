<?php
/*
 * Welcome to OneFileGallery
 *
 * Simply place your Pictures in Subfolders of the ./fotos folder like ./fotos/GalleryName/img.jpg
 * OneFileGallery will render all your gallerys
 * The name of the gallerys is the name of the folder
 * "_" will be rendered to whitespaces
 *
 * Have fun!
 *
 */



function showGallery(){
	if(isset($_GET['gal'])){
		showDetailPage($_GET['gal']);
	} else {
		createGallery();
	}
}

function showDetailPage($gal){
	$files = scandir('./fotos/'.$gal.'/');

	foreach($files as $file){
		if($file == '.') continue;
		if($file == '..') continue;
		echo <<<END
					<div class="col-xs-6 col-md-4">
					<a href="fotos/$gal/$file" class="group1">
					<div class="thumbnail">
					<img src="fotos/$gal/$file" alt="..." class="img-rounded">
					</div>
					</a>
					</div>
					   
END;
	}
}

function createGallery(){
	$out = "";
	$dir = new DirectoryIterator('./fotos');
	foreach ($dir as $fileinfo) {
		if ($fileinfo->isDir() && !$fileinfo->isDot()) {
			//echo $fileinfo->getFilename().'<br>';
			$gal_print_name = str_replace('_', ' ', $fileinfo->getFilename());
			$link_name = $fileinfo->getFilename();
			$thumbnail = getThumb($link_name);
			echo <<<END
					<div class="col-xs-6 col-md-4">
					<a href="index.php?gal=$link_name">
					<div class="thumbnail">
					<img src="$thumbnail" alt="..." class="img-rounded">
					<div class="caption">
					<h3 class="text-center">$gal_print_name</h3>
					</div>
					</div>
					</a>
					</div>
END;
		}
	}
}

function getThumb($gal){
	$files = scandir('./fotos/'.$gal);
	return('fotos/'.$gal.'/'.$files[2]);
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Fotos</title>

<script src="https://code.jquery.com/jquery.js"></script>
<link rel="stylesheet"
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet"
	href="//cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.3/example1/colorbox.min.css">

<!-- Optional theme -->
<link rel="stylesheet"
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
<script
	src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

<script type="text/javascript"
	src="//cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.3/jquery.colorbox-min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	 $(".group1").colorbox({rel:'group1', height: "96%"});
});
</script>

<style type="text/css">

</style>


</head>
<body>
	<a href="index.php">
		<div class="page-header">
			<h1>
				Photography. <small>enjoy.</small>
			</h1>
		</div> </a>
		<?php 
			if(isset($_GET['gal'])) {
				echo '<h4><a href="index.php">... back</a></h4>';
			}
			?>
	<div class="container">
	<?php
	echo showGallery();
	?>

	</div>

	<div id="footer">
		<div class="container">
			<p class="text-muted">&copy; Thomas Sauer</p>
			<p></p>
		</div>
	</div>

	<script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-10872675-3']);
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>

</body>

</html>
