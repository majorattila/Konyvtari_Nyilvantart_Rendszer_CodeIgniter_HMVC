<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>
	<?php 
	if(isset($title)){
		echo $title;
	}else{
		//we can set anything
	}
	?>
	</title>

	<style>
    	*{font-family: DejaVu Sans !important;word-wrap:break-word;}
	</style>
</head>
<body>
	<?php echo $html_content; ?>
</body>
</html>