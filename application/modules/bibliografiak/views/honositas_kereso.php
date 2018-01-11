<!DOCTYPE html>
<html lang="hun">
<head>
	<meta charset="UTF-8">
	<title>Honosítás</title>
    <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?=base_url()?>bower_components/bootstrap/dist/js/popper.js"></script>
    <script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

	<style>
		tbody { border-top: 2px solid black; }

		table.scroll tbody,
		table.scroll thead { display: block; }

		table.scroll tbody {
		    /*width: 700px;*/
		    height: 500px;
		    overflow-y: auto;
		    overflow-x: hidden;
		}
		thead tr th { 
		    height: 30px;
		    line-height: 60px;
		    /* text-align: left; */
		}

		pre{
			border: 1px solid #878787;
			overflow-y: hidden;
		    overflow-x: hidden;
		}
	</style>
</head>
<body>
<br/>
<div class="col-xs-6"><br/><br/>
 <table class="scroll table table-striped">
 <thead>
 	<tr>
 		<th class="col-xs-1"><h5>nyelv</h5></th>
 		<th class="col-xs-5"><h5>szerző</h5></th>
 		<th class="col-xs-5"><h5>cím</h5></th>
 		<th class="col-xs-1"><h5>dátum</h5></th>
 	</tr>
 </thead>
 <tbody>
 <?php if(isset($parsedResult)){ foreach($parsedResult as $row){?>
 <?php 	
 	if(!empty($row) && !empty($row['titel'])){ 
	 	//language,isbn,issn,author,titel,edition,pub_date,extent,series,editor
	 	$arr = array("cim" => (isset($row['titel'])?iconv(mb_detect_encoding($row['titel'], mb_detect_order(), true), "UTF-8", $row['titel']):''), "szerzok" => (isset($row['author'])?iconv(mb_detect_encoding($row['author'], mb_detect_order(), true), "UTF-8", $row['author']):''), "datum" => (isset($row['pub_date'])?iconv(mb_detect_encoding($row['pub_date'], mb_detect_order(), true), "UTF-8", $row['pub_date']):''), "isbn" => (isset($row['isbn'])?iconv(mb_detect_encoding($row['isbn'], mb_detect_order(), true), "UTF-8", $row['isbn']):''), "nyelvek" => (isset($row['language'])?iconv(mb_detect_encoding($row['language'], mb_detect_order(), true), "UTF-8", $row['language']):''), "nemzetkozi_azonosito" => (isset($row['national_no'])?iconv(mb_detect_encoding($row['national_no'], mb_detect_order(), true), "UTF-8", $row['national_no']):''), "tipusok" => (isset($row['genre'])?iconv(mb_detect_encoding($row['genre'], mb_detect_order(), true), "UTF-8", $row['genre']):''), "eto" => (isset($row['eto'])?iconv(mb_detect_encoding($row['eto'], mb_detect_order(), true), "UTF-8", $row['eto']):''), "kiadok" => (isset($row['publisher'])?iconv(mb_detect_encoding($row['publisher'], mb_detect_order(), true), "UTF-8", $row['publisher']):'')); 
	 	$data = str_replace('"','\'',json_encode($arr));
 ?>
<tr class="clickable-row" data-source="<?=$row['data']?>" data-array="<?=$data?>">
<td class="col-xs-1"><?=(isset($row['language'])) ? iconv(mb_detect_encoding(substr($row['language'],0, 50), mb_detect_order(), true), "UTF-8", substr($row['language'],0, 50)) : " - "?></td>
<td class="col-xs-5"><?=(isset($row['author'])) ? iconv(mb_detect_encoding(substr($row['author'],0,50), mb_detect_order(), true), "UTF-8", substr($row['author'],0, 50)) : " - "?></td>
<td class="col-xs-4"><?=(isset($row['titel'])) ? iconv(mb_detect_encoding(substr($row['titel'],0,50), mb_detect_order(), true), "UTF-8", substr($row['titel'],0, 50)) : " - "?></td>
<td class="col-xs-2"><?=(isset($row['pub_date'])) ? iconv(mb_detect_encoding(substr($row['pub_date'],0,50), mb_detect_order(), true), "UTF-8", substr($row['pub_date'],0, 50)) : " - "?></td>
</tr>
<?php } ?>
<?php } }else{?>
<tr><td colspan="4">Nincs találat...</td></tr>
<?php } ?>
</tbody>
</table>
</div>
<div class="col-xs-6">
	<a id="export" class="btn btn-lg btn-primary" href="javascript:void(0);" disabled="disabled">Tétel export</a>
	<button type="button" onclick="self.close()" class="btn btn-lg">Mégse</button><br/><br/>
	<pre class="content" style="height: 500px;">
		
	</pre>
</div>

<input name="selected_record" type="hidden">

<script>
	/*$.session.set('some key', 'a value');*/

	$('.clickable-row').click(function(){
		$('.clickable-row').css({'background-color':'', 'color':'#000'});
		$(this).css({'background-color':'#3C8DBC', 'color':'#fff'});
		var data = $(this).data('array');
		$('input[name="selected_record"]').val(data);
		var data = $(this).data('source');
		$('pre').text(data);
		$('#export').removeAttr('disabled');
	});

	$('#export').click(function() {
		var array_string = $('input[name="selected_record"]').val();
		$.cookie("honositas_check", array_string);
		/*JSON.parse()*/
	});
</script>
</body>
</html>