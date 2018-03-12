<?php
$create_account_url = base_url()."Tipusok/create";
$uri1 = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);
?> 

		<form action="<?=base_url()?><?=$uri1?>/<?=$uri2?>/osszetett_kereses" method="GET"><br/>

			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" style="min-height:70px;">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div>Dokumentumtípus</div>
							<div class="input-group-btn radiusless-dropdown">
        		<button type="button" class="btn btn-default dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown" style="width: 100%;
    text-align: left;">
            <span id="dropdownfield_tipus" data-bind="bs-drp-sel-label"><?=isset($tipus)&&!empty($tipus)?$tipus:'bármi'?></span>
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul id="tipus_menu" class="dropdown-menu" role="menu" style="
    width: 100%;
    max-height: 350px;
    overflow-y: scroll;
    overflow-x: hidden;">

            <li><a data-value="">bármi</a></li>
<?php foreach ($tipus_query->result() as $row) { ?>
	<li><a data-value="<?=$row->leiras?>"><?=$row->leiras?></a></li>
<?php } ?>

        </ul>
    </div>
    <input name="tipus" type="hidden" value="<?=isset($tipus)&&!empty($tipus)?$tipus:''?>"/>
</div>
					</div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" style="min-height:70px;">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div>
						Nyelv</div>
						<div class="input-group-btn radiusless-dropdown">
        <button type="button" class="btn btn-default dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown" style="width: 100%;
    text-align: left;">
            <span id="dropdownfield_nyelv" data-bind="bs-drp-sel-label"><?=isset($nyelv)&&!empty($nyelv)?$nyelv:'bármi'?></span>
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul id="nyelv_menu" class="dropdown-menu" role="menu" style="
    width: 100%;
    max-height: 350px;
    overflow-y: scroll;
    overflow-x: hidden;">

            <li><a data-value="">bármi</a></li>
<?php foreach ($nyelv_query->result() as $row) { ?>
	<li><a data-value="<?=$row->nyelv?>"><?=$row->nyelv?></a></li>
<?php } ?>

        </ul>
    </div>
    <input name="nyelv" type="hidden" value="<?=isset($nyelv)&&!empty($nyelv)?$nyelv:''?>"/>
</div>
					</div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" style="min-height:70px;">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div>
						Gyűjtemény</div>
						<div class="input-group-btn radiusless-dropdown">
        <button type="button" class="btn btn-default dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown" style="width: 100%;
    text-align: left;">
            <span id="dropdownfield_gyujtemeny" data-bind="bs-drp-sel-label"><?=isset($gyujtemeny)&&!empty($gyujtemeny)?$gyujtemeny:'bármi'?></span>
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul id="gyujtemeny_menu" class="dropdown-menu" role="menu" style="
    width: 100%;
    max-height: 350px;
    overflow-y: scroll;
    overflow-x: hidden;">
		
            <li><a data-value="">bármi</a></li>
<?php foreach ($gyujtemeny_query->result() as $row) { ?>
	<li><a data-value="<?=$row->leiras?>"><?=$row->leiras?></a></li>
<?php } ?>

        </ul>
    </div>
    <input name="gyujtemeny" type="hidden" value="<?=isset($gyujtemeny)&&!empty($gyujtemeny)?$gyujtemeny:''?>"/>
</div>


</div>
	

	<script type="text/javascript">

      $( document ).ready(function() {
      manipulateLangSelect();
      });
    </script>
    <div class="col-xs-12 col-sm-12  col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2" style="margin-top:30px;">
    <div class="input-group" style="width: 100%;">
    <div class="input-group-btn radiusless-dropdown">
        <button type="button" class="btn btn-default dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown">
            <span id="dropdownfield_keresokifejezes1" data-bind="bs-drp-sel-label"><?=isset($kk1_lbl)&&!empty($kk1_lbl)?$kk1_lbl:'Kiadó'?></span>
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul id="keresokifejezes1_menu" class="dropdown-menu" role="menu">
            <li><a data-value="nev">Szerző, közreműködő</a></li>
            <li><a data-value="cim">Cím, cím szavai</a></li>
            <li><a data-value="targyszavak">Tárgyszó</a></li>
            <li><a data-value="kiado">Kiadó</a></li>
            <li><a data-value="rszj">Raktári jelzet</a></li>
            <li><a data-value="url">Internet cím</a></li>
            <li><a data-value="isbn">ISBN</a></li>
            <li><a data-value="gyari_szam">Gyáriszám (av)</a></li>
            <li><a data-value="temacsoport">Témacsoport</a></li>
            <li><a data-value="megjelenes">Forrásdokumentum</a></li>
            <li><a data-value="eto">Osztályozás (ETO)</a></li>
        </ul>
    </div>
    <input name="keresokifejezes1" type="hidden" value="kiado"/>
    <input class="form-control ac_input" type="text" name="keresokifejezes1_input" id="keresokifejezes1_input" value="<?=isset($keresokifejezes1)&&!empty($keresokifejezes1_input)?$keresokifejezes1_input:''?>" placeholder="keresőkifejezés" autocomplete="off" minlength="3">    
    <input type="hidden" name="kk1_lbl" value="">
</div>
    <br/>


<div class="or-and-butnot input-group col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
	<span class="input-group-addon beautiful">
	<input type="radio" value="and" name="textlogic0" id="textlogic0_and" <?=isset($textlogic0)&&$textlogic0=="and"?'checked':'checked'?>>
</span>
<label for="textlogic0_and" class="form-control">
&nbsp;és&nbsp;</label>
<span class="input-group-addon beautiful">
	<input type="radio" value="or" name="textlogic0" id="textlogic0_or" <?=isset($textlogic0)&&$textlogic0=="or"?'checked':''?>>
</span>
<label for="textlogic0_or" class="form-control">
&nbsp;vagy&nbsp;</label>
<span class="input-group-addon beautiful">
	<input value="and not" type="radio" name="textlogic0" id="textlogic0_not" <?=isset($textlogic0)&&$textlogic0=="and not"?'checked':''?>>
</span>
<label for="textlogic0_not" class="form-control">
&nbsp;de&nbsp;nem&nbsp;</label>
</div><br/>


    <div class="input-group" style="width: 100%;">
    <div class="input-group-btn radiusless-dropdown">
        <button type="button" class="btn btn-default dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown">
            <span id="dropdownfield_keresokifejezes2" data-bind="bs-drp-sel-label"><?=isset($kk2_lbl)&&!empty($kk2_lbl)?$kk2_lbl:'Szerző, közreműködő'?></span>
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul id="keresokifejezes2_menu" class="dropdown-menu" role="menu">
            <li><a data-value="nev">Szerző, közreműködő</a></li>
            <li><a data-value="cim">Cím, cím szavai</a></li>
            <li><a data-value="targyszavak">Tárgyszó</a></li>
            <li><a data-value="kiado">Kiadó</a></li>
            <li><a data-value="rszj">Raktári jelzet</a></li>
            <li><a data-value="url">Internet cím</a></li>
            <li><a data-value="isbn">ISBN</a></li>
            <li><a data-value="gyari_szam">Gyáriszám (av)</a></li>
            <li><a data-value="temacsoport">Témacsoport</a></li>
            <li><a data-value="megjelenes">Forrásdokumentum</a></li>
            <li><a data-value="eto">Osztályozás (ETO)</a></li>
        </ul>
    </div>
    <input name="keresokifejezes2" type="hidden" value="szerzo"/>
    <input class="form-control ac_input" type="text" name="keresokifejezes2_input" id="keresokifejezes2_input" value="<?=isset($keresokifejezes2)&&!empty($keresokifejezes2_input)?$keresokifejezes2_input:''?>" placeholder="keresőkifejezés" autocomplete="off" minlength="3">
    <input type="hidden" name="kk2_lbl">
</div>
    <br>
    <div class="or-and-butnot input-group col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
    	<span class="input-group-addon beautiful">
    	<input type="radio" value="and" name="textlogic1" id="textlogic1_and" <?=isset($textlogic1)&&$textlogic1=="and"?'checked':'checked'?>>
</span>
    <label for="textlogic1_and" class="form-control">
    &nbsp;és&nbsp;</label>
    <span class="input-group-addon beautiful">
    	<input type="radio" value="or" name="textlogic1" id="textlogic1_or" <?=isset($textlogic1)&&$textlogic1=="or"?'checked':''?>>
</span>
    <label for="textlogic1_or" class="form-control">
    &nbsp;vagy&nbsp;</label>
    <span class="input-group-addon beautiful">
    	<input value="and not" type="radio" name="textlogic1" id="textlogic1_not" <?=isset($textlogic1)&&$textlogic1=="and not"?'checked':''?>>
</span>
    <label for="textlogic1_not" class="form-control">
    &nbsp;de&nbsp;nem&nbsp;</label>
</div>
    <br>
    <div class="input-group" style="width: 100%;">
    <div class="input-group-btn radiusless-dropdown">
        <button type="button" class="btn btn-default dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown">
            <span id="dropdownfield_keresokifejezes3" data-bind="bs-drp-sel-label"><?=isset($kk3_lbl)&&!empty($kk3_lbl)?$kk3_lbl:'Cím, cím szavai'?></span>
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul id="keresokifejezes3_menu" class="dropdown-menu" role="menu">
            <li><a data-value="nev">Szerző, közreműködő</a></li>
            <li><a data-value="cim">Cím, cím szavai</a></li>
            <li><a data-value="targyszavak">Tárgyszó</a></li>
            <li><a data-value="kiado">Kiadó</a></li>
            <li><a data-value="rszj">Raktári jelzet</a></li>
            <li><a data-value="url">Internet cím</a></li>
            <li><a data-value="isbn">ISBN</a></li>
            <li><a data-value="gyari_szam">Gyáriszám (av)</a></li>
            <li><a data-value="temacsoport">Témacsoport</a></li>
            <li><a data-value="megjelenes">Forrásdokumentum</a></li>
            <li><a data-value="eto">Osztályozás (ETO)</a></li>
        </ul>
    </div>
    <input name="keresokifejezes3" type="hidden" value="cim"/>
    <input class="form-control ac_input" type="text" name="keresokifejezes3_input" id="keresokifejezes3_input" value="<?=isset($keresokifejezes3)&&!empty($keresokifejezes3_input)?$keresokifejezes3_input:''?>" placeholder="keresőkifejezés" autocomplete="off" minlength="3">
    <input type="hidden" name="kk3_lbl">
</div>
    <br>
    <div class="or-and-butnot input-group col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
    </div>
    <br>
</div>
    <div class="col-xs-12  col-sm-12  col-md-12  col-lg-12">
    	<br>
    <span class="pull-left">
    	<button type="reset" style="float: left;" class="btn btn-primary" onclick="
          event.preventDefault();
			
		  $('input[type=hidden]').each(function () {
          $(this).val('');
          });
          $('input[type=text]').each(function () {
          $(this).val('');
          }); //radiobutton, checkbox is lehet itt
          $('input[type=radio]').each(function () {
          if (this.id.indexOf('_and') > -1){
          document.getElementById(this.id).checked = true;
          }
          });
          
          $('input[type=checkbox]').prop('checked', false);

          $('#dropdownfield_oldal').text('10');
          $('#dropdownfield_tipus').text('bármi');
          $('#dropdownfield_nyelv').text('bármi');
          $('#dropdownfield_gyujtemeny').text('bármi');
          $('#dropdownfield_lelohely').text('bármi');
          $('#dropdownfield_terem').text('bármi');
          $('#dropdownfield_keresokifejezes1').text('Kulcsszó');
          $('#dropdownfield_keresokifejezes2').text('Szerző, közreműködő');
          $('#dropdownfield_keresokifejezes3').text('Cím, cím szavai');

          $('input[name=oldal]').val('10');
          $('input[name=tipus]').val('bármi');
          $('input[name=nyelv]').val('bármi');
          $('input[name=gyujtemeny]').val('bármi');
          $('input[name=lelohely]').val('bármi');
          $('input[name=terem]').val('bármi');
          $('input[name=keresokifejezes1]').val('kulcsszo');
          $('input[name=keresokifejezes2]').val('szerzo');
          $('input[name=keresokifejezes3]').val('cim');
        ">Keresési feltétel(ek) törlése</button>
    </span>
    <span class="pull-right"><input type="submit" name="button" class="btn btn-primary" value="Keres" disabled></span>
</div>
</div> <!-- onclick="setLoadingGif();" -->

</form>





<script>  

    $(document).ready(function(){
		if( $("input[name=keresokifejezes1_input]").val().length < 3 &&
			$("input[name=keresokifejezes2_input]").val().length < 3 &&
			$("input[name=keresokifejezes3_input]").val().length < 3) {
			$("input[name=button]").prop("disabled", true);
		}else{
			$("input[name=button]").prop("disabled", false);
		}
	});

	$("input[name=keresokifejezes1_input]").on("keyup", function() {
	  $("input[name=button]").prop("disabled", false);
	  if( $("input[name=keresokifejezes1_input]").val().length < 3) {
	    $("input[name=button]").prop("disabled", true);
	 }
	});

	$("input[name=keresokifejezes2_input]").on("keyup", function() {
	  $("input[name=button]").prop("disabled", false);
	  if( $("input[name=keresokifejezes2_input]").val().length < 3) {
	    $("input[name=button]").prop("disabled", true);
	 }
	});

	$("input[name=keresokifejezes3_input]").on("keyup", function() {
	  $("input[name=button]").prop("disabled", false);
	  if( $("input[name=keresokifejezes3_input]").val().length < 3) {
	    $("input[name=button]").prop("disabled", true);
	 }
	});

	$(document).on('click', '#keresokifejezes1_menu.dropdown-menu li a', function() {
	    text = $(this).text();
	    data = $(this).data("value");
	    $('#dropdownfield_keresokifejezes1').text(text);
	    $('#dropdownfield_keresokifejezes1').attr('width', 'max-content');
	    $("input[name='keresokifejezes1']").val(data);
        $('input[name=kk1_lbl]').val($(this).text());
	});

	$(document).on('click', '#keresokifejezes2_menu.dropdown-menu li a', function() {
	    text = $(this).text();
	    data = $(this).data("value");
	    $('#dropdownfield_keresokifejezes2').text(text);
	    $('#dropdownfield_keresokifejezes2').attr('width', 'max-content');
	    $("input[name='keresokifejezes2']").val(data);
        $('input[name=kk2_lbl]').val($(this).text());
	});

	$(document).on('click', '#keresokifejezes3_menu.dropdown-menu li a', function() {
	    text = $(this).text();
	    data = $(this).data("value");
	    $('#dropdownfield_keresokifejezes3').text(text);
	    $('#dropdownfield_keresokifejezes3').attr('width', 'max-content');
	    $("input[name='keresokifejezes3']").val(data);
        $('input[name=kk3_lbl]').val($(this).text());
	});

	$(document).on('click', '#oldal_menu.dropdown-menu li a', function() {
	    text = $(this).text();
	    data = $(this).data("value");
	    $('#dropdownfield_oldal').text(text);
	    $('#dropdownfield_oldal').attr('width', 'max-content');
	    $("input[name='oldal']").val(data);
	});

	$(document).on('click', '#szakbibliografia_menu.dropdown-menu li a', function() {
	    text = $(this).text();
	    data = $(this).data("value");
	    $('#dropdownfield_szakbibliografia').text(text);
	    $('#dropdownfield_szakbibliografia').attr('width', 'max-content');
	    $("input[name='filter']").val(data);
	});

	$(document).on('click', '#nyelv_menu.dropdown-menu li a', function() {
	    text = $(this).text();
	    data = $(this).data("value");
	    $('#dropdownfield_nyelv').text(text);
	    $('#dropdownfield_nyelv').attr('width', 'max-content');
	    $("input[name='nyelv']").val(data);
	});

	$(document).on('click', '#gyujtemeny_menu.dropdown-menu li a', function() {
	    text = $(this).text();
	    data = $(this).data("value");
	    $('#dropdownfield_gyujtemeny').text(text);
	    $('#dropdownfield_gyujtemeny').attr('width', 'max-content');
	    $("input[name='gyujtemeny']").val(data);
	});

	$(document).on('click', '#tipus_menu.dropdown-menu li a', function() {
	    text = $(this).text();
	    data = $(this).data("value");
	    $('#dropdownfield_tipus').text(text);
	    $('#dropdownfield_tipus').attr('width', 'max-content');
	    $("input[name='tipus']").val(data);
	});
</script>