<?php
$this->load->module('php_strap_cv');
$first_segment = $this->uri->segment(1);

$form_location = base_url()."bibliografiak/create/".$update_id;
?>

<!--script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script-->

<style>
  textarea{
    overflow: hidden;
    resize: none;
  }
  .action_buttons{
    margin-bottom: 20px;
  }
  .input-group-addon{    
    background-color: #eceeef !important;
  }

  .pointer{
    cursor: pointer;
  }
  @media (max-width: 768px) {
    .content-wrapper{
      margin-left: -30px;
      margin-right: -31px;
    }
  }

</style>


<style class="cp-pen-styles">

.pn-ProductNav_Wrapper {
  position: relative;
  padding: 0 11px;
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
}

.pn-ProductNav {
  /* Make this scrollable when needed */
  overflow-x: auto;
  /* We don't want vertical scrolling */
  overflow-y: hidden;
  /* For WebKit implementations, provide inertia scrolling */
  -webkit-overflow-scrolling: touch;
  /* We don't want internal inline elements to wrap */
  white-space: nowrap;
  /* If JS present, let's hide the default scrollbar */
  /* positioning context for advancers */
  position: relative;
  font-size: 0;
}
.js .pn-ProductNav {
  /* Make an auto-hiding scroller for the 3 people using a IE */
  -ms-overflow-style: -ms-autohiding-scrollbar;
  /* Remove the default scrollbar for WebKit implementations */
}
.js .pn-ProductNav::-webkit-scrollbar {
  display: none;
}

.pn-ProductNav_Contents {
  float: left;
  -webkit-transition: -webkit-transform 0.2s ease-in-out;
  transition: -webkit-transform 0.2s ease-in-out;
  transition: transform 0.2s ease-in-out;
  transition: transform 0.2s ease-in-out, -webkit-transform 0.2s ease-in-out;
  position: relative;
}

.pn-ProductNav_Contents-no-transition {
  -webkit-transition: none;
  transition: none;
}

.pn-ProductNav_Link {
  text-decoration: none;
  color: #888;
  font-size: 1.2rem;
  font-family: -apple-system, sans-serif;
  display: -webkit-inline-box;
  display: -ms-inline-flexbox;
  display: inline-flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  min-height: 44px;
  border: 1px solid transparent;
  padding: 0 11px;
}
.pn-ProductNav_Link + .pn-ProductNav_Link {
  border-left-color: #eee;
}
.pn-ProductNav_Link[aria-selected="true"] {
  color: #111;
}

.pn-Advancer {
  /* Reset the button */
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  background: transparent;
  padding: 0;
  border: 0;
  /* Now style it as needed */
  position: absolute;
  top: 0;
  bottom: 0;
  /* Set the buttons invisible by default */
  opacity: 0;
  -webkit-transition: opacity 0.3s;
  transition: opacity 0.3s;
}
.pn-Advancer:focus {
  outline: 0;
}
.pn-Advancer:hover {
  cursor: pointer;
}

.pn-Advancer_Left {
  left: 0;
}
[data-overflowing="both"] ~ .pn-Advancer_Left, [data-overflowing="left"] ~ .pn-Advancer_Left {
  opacity: 1;
}

.pn-Advancer_Right {
  right: 0;
}
[data-overflowing="both"] ~ .pn-Advancer_Right, [data-overflowing="right"] ~ .pn-Advancer_Right {
  opacity: 1;
}

.pn-Advancer_Icon {
  width: 20px;
  height: 44px;
  fill: #bbb;
}

.pn-ProductNav_Indicator {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 4px;
  width: 100px;
  background-color: transparent;
  -webkit-transform-origin: 0 0;
          transform-origin: 0 0;
  -webkit-transition: background-color 0.2s ease-in-out, -webkit-transform 0.2s ease-in-out;
  transition: background-color 0.2s ease-in-out, -webkit-transform 0.2s ease-in-out;
  transition: transform 0.2s ease-in-out, background-color 0.2s ease-in-out;
  transition: transform 0.2s ease-in-out, background-color 0.2s ease-in-out, -webkit-transform 0.2s ease-in-out;
}
</style>


<form id="bibliografiak" action="<?=$form_location?>" method="POST">
<div class="col-xs-12 col-lg-10 col-xs-offset-0 col-lg-offset-1"><br/>
  <?php
    echo validation_errors("<p style='color:red;'>", "</p>");

    if(isset($flash))
    {
      echo $flash;
    }

    $honositas = base_url()."bibliografiak/honositas";
  ?>  


  <!-- Word Press Button Extension -->
  <!-- I changed the buttons at 2018.01.08 23:15:00
    btn metro-button mtr-teal mtr-round margin | btn btn-primary margin
    btn metro-button mtr-orange mtr-round margin | btn btn-secondary margin
    btn metro-button mtr-green mtr-round margin | btn btn-success margin
    btn metro-button mtr-red mtr-round margin | btn btn-danger margin
    btn metro-button mtr-indigo mtr-round margin | btn btn-secondary margin
    btn metro-button mtr-round margin | btn btn-secondary margin
    btn metro-button mtr-steel mtr-round margin | btn btn-secondary margin
  -->
  <!--div>
    <button class="btn metro-button mtr-tiny">mtr-tiny</button>
    <button class="btn metro-button mtr-small">mtr-small</button>
    <button class="btn metro-button mtr-large ">mtr-large </button>
    <button class="btn metro-button mtr-radius ">mtr-radius </button>
    <button class="btn metro-button mtr-round ">mtr-round </button>
    <button class="btn metro-button mtr-lime ">mtr-lime </button>
    <button class="btn metro-button mtr-green ">mtr-green </button>
    <button class="btn metro-button mtr-emerald ">mtr-emerald </button>
    <button class="btn metro-button mtr-teal ">mtr-teal </button>
    <button class="btn metro-button mtr-cyan ">mtr-cyan </button>
    <button class="btn metro-button mtr-cobalt ">mtr-cobalt </button>
    <button class="btn metro-button mtr-indigo ">mtr-indigo </button>
    <button class="btn metro-button mtr-violet ">mtr-violet </button>
    <button class="btn metro-button mtr-pink ">mtr-pink </button>
    <button class="btn metro-button mtr-magenta ">mtr-magenta </button>
    <button class="btn metro-button mtr-crimson ">mtr-crimson </button>
    <button class="btn metro-button mtr-red ">mtr-red </button>
    <button class="btn metro-button mtr-orange ">mtr-orange </button>
    <button class="btn metro-button mtr-amber ">mtr-amber </button>
    <button class="btn metro-button mtr-yellow ">mtr-yellow </button>
    <button class="btn metro-button mtr-brown ">mtr-brown </button>
    <button class="btn metro-button mtr-olive ">mtr-olive </button>
    <button class="btn metro-button mtr-steel ">mtr-steel </button>
    <button class="btn metro-button mtr-mauve ">mtr-mauve </button>
    <button class="btn metro-button mtr-taupe ">mtr-taupe </button>
    <button class="btn metro-button mtr-alignleft ">mtr-alignleft </button>
    <button class="btn metro-button mtr-alignright ">mtr-alignright </button>
    <button class="btn metro-button mtr-alignnone ">mtr-alignnone </button>
  </div-->





  <h1><?=$headline?> <span style="display: inline; font-size: 12pt; float: right;"> <i>gyors katalogizáló: </i>
  <select name="fast_cat">
  <?php
  $i = 0;
  $cat = $this->db->query("SELECT nev FROM z3950");
  foreach ($cat->result() as $row) { ?>
  <option <? $i==0?'selected':'' ?><?= $row->nev?></option>
  <?php $i++; } ?>
  </select>
  </span>
  </h1><br/>
  <div id="error_msg"></div>
  <?php /* ?>
  <div class="action_buttons">
    <a href="<?=base_url()?>bibliografiak/manage/20" class="btn btn-primary margin">Vissza</a>
    <button type="submit" name="submit" value="Submit" class="btn btn-primary margin">Rögzít</button>
    <button onclick="auto_lsz();" type="button" class="btn btn-primary margin">Automatikus lsz</button>
    <button onclick="resetform();" type="button" class="btn btn-primary margin">Mezők törlése</button>
    <a onClick="newwindow = window.open('<?= base_url().'katalogus_cedula/view/'.$leltari_szam ?>', '_blank', 'resizable=yes, scrollbars=yes, titlebar=yes, width=600, height=400, top=10, left=10');" href="javascript:void(0);" class="btn btn-primary margin">Kat. cédula</a>
    <!--button type="button" class="btn btn-primary margin">Többes példányok</button-->
    <div class="btn-group">
      <a onClick="newwindow = window.open('<?= $honositas ?>', '_blank', 'resizable=yes, scrollbars=yes, titlebar=yes, width=600, height=400, top=10, left=10');" href="javascript:void(0);" class="btn btn-primary margin">Honosítás</a>
      <button title="Honosítási adatok bevitele" onclick="check()" type="button" class="btn btn-primary margin">lekérés</button>
    </div>
    <?php if(!isset($update_id) && !empty($update_id)){ ?>
    <a href="<?=base_url()?>bibliografiak/borito_feltoltes/<?=$update_id?>" class="btn btn-primary margin">Borító feltöltés</a>
    <?php } ?>
    <a href="<?=base_url()?>bibliografiak/deleteconf/<?=$update_id?>" class="btn btn-primary margin">Törlés</a>    
  </div>
  <?php */ ?>









<div class="pn-ProductNav_Wrapper">
<nav id="pnProductNav" class="pn-ProductNav" data-overflowing="right" style="overflow-x: hidden">
    <div id="pnProductNavContents" class="pn-ProductNav_Contents pn-ProductNav_Contents-no-transition" style="transform: none;">
        <a href="<?=base_url()?>bibliografiak/manage/20" class="pn-ProductNav_Link" aria-selected="true">Vissza</a>
        <button type="submit" name="submit" value="Submit" class="pn-ProductNav_Link" aria-selected="false">Rögzít</button>
        <a onclick="auto_lsz();" href="javascript:void(0);" class="pn-ProductNav_Link" aria-selected="false">Automatikus lsz</a>
        <a onclick="resetform();" href="javascript:void(0);" class="pn-ProductNav_Link" aria-selected="false">Mezők törlése</a>
        <!--a <?= !empty($leltari_szam)?"onClick=\"newwindow = window.open('".base_url()."katalogus_cedula/view/".$leltari_szam."', '_blank', 'resizable=yes, scrollbars=yes, titlebar=yes, width=600, height=400, top=10, left=10');\"":""?> href="javascript:void(0);" class="pn-ProductNav_Link" aria-selected="false">Kat. cédula</a-->
        <a onClick="newwindow = window.open('<?= $honositas ?>', '_blank', 'resizable=yes, scrollbars=yes, titlebar=yes, width=829, height=553, top=10, left=10');" href="javascript:void(0);" class="pn-ProductNav_Link" aria-selected="false">Honosítás</a> <!-- 600 / 400-->
        <a href="javascript:void(0);" onclick="check()" class="pn-ProductNav_Link" aria-selected="false"><i class="glyphicon glyphicon-download-alt"></i>&nbsp;Lekérés</a>
        <?php if(!isset($update_id) && !empty($update_id)){ ?>
        <a href="<?=base_url()?>bibliografiak/borito_feltoltes/<?=$update_id?>" class="pn-ProductNav_Link" aria-selected="false">Borító feltöltése</a>
        <?php } ?>

        <?php if(!is_null($this->uri->segment(3))){ ?>
        <a <?=!empty($update_id)&&is_numeric($update_id)?"href=\"".base_url()."bibliografiak/deleteconf/".$update_id."\"":"href=\"javascript:void(0);\""?> class="pn-ProductNav_Link" aria-selected="false">Törlés</a>
        <?php } ?>

        <!--a href="<?=base_url()?>szerzok/manage/20" target="_blank" class="pn-ProductNav_Link" aria-selected="false">Szerzők</a>
        <a href="<?=base_url()?>konyvtarak/manage/20" target="_blank" class="pn-ProductNav_Link" aria-selected="false">könyvtárak</a-->
        <button type="button" name="nyelv_details" class="pn-ProductNav_Link" aria-selected="false">Nyelvek</button>
        <button type="button" name="tipus_details" class="pn-ProductNav_Link" aria-selected="false">Típusok</button>
        <button type="button" name="gyujtemeny_details" class="pn-ProductNav_Link" aria-selected="false">gyűjtemények</button>
        <button type="button" name="kiado_details" class="pn-ProductNav_Link" aria-selected="false">Kiadók</button>
<?php /* ?>
        <a href="javascript:void(0);" class="pn-ProductNav_Link" aria-selected="false">Frames &amp; Pictures</a>  
        <a href="javascript:void(0);" class="pn-ProductNav_Link" aria-selected="false">Wardrobes</a>  
        <a href="javascript:void(0);" class="pn-ProductNav_Link" aria-selected="false">Storage</a>  
        <a href="javascript:void(0);" class="pn-ProductNav_Link" aria-selected="false">Decoration</a>  
        <a href="javascript:void(0);" class="pn-ProductNav_Link" aria-selected="false">Appliances</a>
      <a href="javascript:void(0);" class="pn-ProductNav_Link" aria-selected="false">Racks</a>
        <a href="javascript:void(0);" class="pn-ProductNav_Link" aria-selected="false">Worktops</a>
<?php */ ?>
  <span id="pnIndicator" class="pn-ProductNav_Indicator" style="transform: translateX(0px) scaleX(0.794844); background-color: rgb(134, 113, 0);"></span>
    </div>
</nav>
  <button id="pnAdvancerLeft" class="pn-Advancer pn-Advancer_Left" type="button">
    <svg class="pn-Advancer_Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 551 1024"><path d="M445.44 38.183L-2.53 512l447.97 473.817 85.857-81.173-409.6-433.23v81.172l409.6-433.23L445.44 38.18z"></path></svg>
  </button>
  <button id="pnAdvancerRight" class="pn-Advancer pn-Advancer_Right" type="button">
    <svg class="pn-Advancer_Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 551 1024"><path d="M105.56 985.817L553.53 512 105.56 38.183l-85.857 81.173 409.6 433.23v-81.172l-409.6 433.23 85.856 81.174z"></path></svg>
  </button>
</div>











<div class="box box-danger">
  <div class="box-header">
    <h5><i>ADATOK A KÖNYVTÁR RÉSZÉRE</i></h5>
  </div>
  <div class="box-body">
    <div class="row">
      <?php if(!isset($leltari_szam) || isset($leltari_szam) && $leltari_szam==''){
        $leltari_szam = file_get_contents(base_url().'bibliografiak/get_inventory_number_with_ajax');
      } ?>
      <div class="form-group col-xs-12 col-sm-3">
        <label class="dotted_underline" for="leltari_szam" data-toggle="tooltip" data-placement="top" title="A leltári szám megadása kötelező. A továbbiakban a rendszer majd ennek a számnak az alapján fog hivatkozni az állományra.">Leltári szám:</label><i class="helper"></i>
        <input name="leltari_szam" value="<?=$leltari_szam?>" maxlength="11" type="text" class="form-control required_field" id="leltari_szam">
      </div>
      <div class="form-group col-xs-12 col-sm-3">
        <label class="dotted_underline" for="rszj" data-toggle="tooltip" data-placement="top" title="„Rszj”A könyvek tartalmi besorolásához használt szám, A könyvtárak által leggyakrabban használt rendszer az ETO alapján készült „Raktározási táblázatok”. A Cutter számot nem itt, hanem a „csz” mezőben kell megadni. A két mező együttesen határozza meg a szabad polcon a dokumentum helyét.">Rszj:</label>
        <input name="rszj" value="<?=$rszj?>" type="text" maxlength = "3" class="form-control" id="rszj">
      </div>
      <div class="form-group col-xs-12 col-sm-3">
        <label class="dotted_underline" for="mrj" data-toggle="tooltip" data-placement="top" title="Kevés könyvtár használja. Ezek a könyvtárak általában méret és beérkezési sorrend szerint raktárban tárolják a dokumentumokat, a jelzetet ez alapján adják ki.">Mrj:</label>
        <input name="mrj" value="<?=$mrj?>" maxlength="11" type="text" class="form-control" id="mrj">
      </div>
      <div class="form-group col-xs-12 col-sm-3">
        <label class="dotted_underline" for="vonalkod" data-toggle="tooltip" data-placement="top" title="A dokumentum vonalkódja lehet a leltári szám, de attól el is térhet. A kölcsönzők esetében az olvasójegyen lévő vonalkód kötelezően a törzsszám legyen. Így kölcsönzéskor mind az olvasó mind a dokumentum vonalkóddal azonosítható. Vonalkódos rendszer bevezetése esetén a szerzőkkel érdemes előzetesen egyeztetni. Amennyiben a könyvtár a vonalkódokat az adatok számítógépre vitele közben, vagy utána vezeti be, a dokumentumok vonalkódozása nem jelent többlet feladatot, mert a kölcsönzéskor a vonalkód azonnal hozzárendelhető a dokumentumhoz a nélkül, hogy a dokumentum módosítása menübe kellene menni!">vonalkód:</label>
        <input name="vonalkod" value="<?=$vonalkod!=0?$vonalkod:''?>" maxlength="13" type="text" class="form-control" id="vonalkod">
      </div>
    </div>

    <div class="row">
      <div class="form-group col-xs-12 col-sm-4">
        <label class="dotted_underline" for="cim" data-toggle="tooltip" data-placement="top" title="Az adatok bevitele csak ezen a beviteli mezőn keresztül törénhet. Sok más rendszer esetében megszokás adni a könyvek főcímét, alcímét és egyéb címeit, de ebben a mezőben csak a könyvv főcíme adható meg. Mivel itt csak egyetlen adatot lehetséges eltárolni, ezért formaiag nem szükséges, hogy ezt bármilyen formában jelöljük.">cím:</label>
        <input onkeyup="gyors_honosito()" name="cim" value="<?=$cim?>" list="cimek" type="text" class="form-control required_field" id="cim" autocomplete="off" />
        <datalist id="cimek">          
        </datalist>
      </div>
      <textarea type="textarea" name="json_data" style="display:none !important"></textarea>
      <div class="form-group col-xs-12 col-sm-4">
        <label class="dotted_underline" for="egyebcimek" data-toggle="tooltip" data-placement="top" title="Itt lehet megadni az összes olyan címet, ami eltér a könyv főcímétől.">egyébcímek:</label>
        <input name="egyebcimek" value="<?=$egyebcimek?>" maxlength="255" type="text" class="form-control" id="egyebcimek"/>
      </div>
      <div class="form-group col-xs-12 col-sm-4">
        <label class="dotted_underline" for="szerzo" data-toggle="tooltip" data-placement="top" title="Közvetlen adatbevitel esetén a beírt adatokat az ISBN szabványnak megfelelőn kell bevinni. (Pl.: írta Kiss Péter, Torzsa Mihály ; rajzolta Borsos Miklós ; bev. Kocsis Péter, Juhász Pál.) A cím és a szerzők között lévő / jelet nem kell megadni a címleírásban. A több szerző több művét közlő könyv esetén a szabványtól el kell térni. A címadatokban a főcímeket ; el kell elválasztani, a szerzőknél a különböző művek szerzőinek elválasztásához javasoljuk a : alkalmazását. pl.: Köszönet a kulcsokért ; Pygmalion veresége / Benkő Attila : Sebestyén András.">szerzők:</label>
        <div class="input-group col-xs-12 col-sm-12">
          <input name="szerzok" list="szerzok" id="szerzo" class="form-control required_field" autocomplete="off" value="<?=$szerzok?>">
            <!--span class="input-group-btn hidden-xs hidden-sm">
            <button onclick="_delete_szerzo()" class="btn btn-twitter btn-flat" type="button"><span class="fa fa-fw fa-times"></span></button>
            <button onclick="_insert_szerzo()" class="btn btn-dropbox btn-flat" type="button"><span class="fa fa-fw fa-check"></span></button>
          </span-->
          <datalist id="szerzok">
          </datalist>
          <div class="input-group-btn hidden-xs hidden-sm">
          <button type="button" class="btn btn-default dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown" aria-expanded="true">
                  <span id="dropdownfield" data-bind="bs-drp-sel-label" width="max-content"><i class="glyphicon glyphicon-pencil"></i></span>
                  <input type="hidden" name="selected_value" data-bind="bs-drp-sel-value" value="">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                  <li><a class="pointer" onclick="_insert_szerzo()"><i class="glyphicon glyphicon-plus"></i>Hozzáad</a></li>
                  <li><a class="pointer"  onclick="_delete_szerzo()"><i class="glyphicon glyphicon-trash"></i>Töröl</a></li>
              </ul>
              <input name="filter" type="hidden" value="cim">
            </div>
        </div>
        </div>
      </div>

    <div class="row">
      <div class="form-group col-xs-12 col-sm-4">
        <label class="dotted_underline" for="kiemelt_rendszavak" data-toggle="tooltip" data-placement="top" title="A mezőt a cím és a szerző alapjány automatikusan kiegészíti a rendszer. Mivel az automatikus rendszó kitöltés lehet hibás, ezeket kézzel kell javítani.">kiemelt rendszavak:</label>
        <input name="kiemelt_rendszavak" value="<?=$kiemelt_rendszavak?>" maxlength="500" type="text" class="form-control" id="kiemelt_rendszavak"/>
      </div>
      <div class="form-group col-xs-12 col-sm-4">
        <label class="dotted_underline" for="egyeb_rendszavak" data-toggle="tooltip" data-placement="top" title="Egyyéb rendszó megadása csak itt lehetséges. Mivel az automatikus rendszó kitöltés lehet hibás, ezeket kézzel kell javítani.">egyéb rendszavak:</label>
        <input name="egyeb_rendszavak" value="<?=$egyeb_rendszavak?>" maxlength="500" type="text" type="text" class="form-control" id="egyeb_rendszavak"/>
      </div>
      <div class="form-group col-xs-12 col-sm-4">
        <label class="dotted_underline" for="testuleti_szerzo" data-toggle="tooltip" data-placement="top" title="A testületeket a * karakter választja el egymástól. Számuk tetszőleges lehet. A rendezvények adatait a közös speciális adatoknál kell megadni. (k.spec.: mezőben!)">testületi szerző:</label>
        <input name="testuleti_szerzo" value="<?=$testuleti_szerzo?>" maxlength="500" type="text" class="form-control" id="testuleti_szerzo">
      </div>
    </div>

    <div class="row">
      <div class="form-group col-xs-12 col-sm-6">
        <label class="dotted_underline" for="kiadasjelzes" data-toggle="tooltip" data-placement="top" title="Szerkezete: kiadásjelzés / kiadásra vonatkozó szerzőségi közlés. Csak a minden kétséget kizáróan az adott kiadásra vonatkozó szerzőségi adatot szabad itt felsorolni. példa: 3. bőv. kiad. / szerk. Gallé Tibor">Kiadásjelzés:</label>
        <input name="kiadasjelzes" value="<?=$kiadasjelzes?>" maxlength="100" type="text" class="form-control" id="kiadasjelzes">
      </div>
      <div class="form-group col-xs-12 col-sm-4">
        <label class="dotted_underline" for="lelohelyek" data-toggle="tooltip" data-placement="top" title="A dokumentumok könyvtáron belüli lelőhelyét, vagy fiókkönyvtárak esetén letéti helyét lehet megadni. Amennyiben a megadott lelőhely még nem szerepel a lelőhely listában a program megkérdezi, felvegye-e?. Ld. még letétek kezelése">lelőhely:</label>
        <input name="lelohely" value="<?=$lelohely?>" maxlength="300" type="text" class="form-control" id="lelohelyek" list="lelohely" autocomplete="off">
        <datalist id="lelohely">
          <?php foreach($query->result() as $row){ ?>
          <option><?= $row->terem_neve ?></option>
          <?php } ?>
        </datalist>
      </div>
      <div class="form-group col-xs-12 col-sm-2">
        <label class="dotted_underline" for="dok_stat" data-toggle="tooltip" data-placement="top" title="Értéke „n” vagy „e” Az „n” jelentése, hogy a rekord nem végleges, valamennyi adata módosítható. Ez az alapértelmezett. Az „e” előfeldolgozott tétel átmeneti állapotnak tekintendő. Előfeldolgozott dokumentumot is meg lehet többszörözni. Az előfeldolgozott tételek megtöbbszörözésekor a saját tételekhez hasonlóan alakul ki a forráspéldány-további példányok közötti kapcsolat.">dok stat:</label>
        <input name="dok_stat" value="<?=$dok_stat!=0?$dok_stat:''?>" maxlength="100" type="text" class="form-control" id="dok_stat">
      </div>
    </div>

    <div class="row">
      <div class="form-group col-xs-12 col-sm-3">
        <label class="dotted_underline" for="megjelenes" data-toggle="tooltip" data-placement="top" title="Szerkezete: megjelenés helye : a kiadó neve, a megjelenés éve (Pl. Budapest. : Magvető, 1985 [!1965]). Az adatok ismételhetők, minden esetben ki kell tenni a központozó jeleket. (Pl. Budapest : Magvető : Szépirod. Kvk., 1980)">megjelenés:</label>
        <input name="megjelenes" value="<?=$megjelenes?>" maxlength="500" type="text" class="form-control" id="megjelenes">
      </div>
      <div class="form-group col-xs-12 col-sm-3">
        <label class="dotted_underline" for="terjedelem" data-toggle="tooltip" data-placement="top" title="Szerkezete könyveknél: oldalszám : ill. ; méret + melléklet (oldalszám : ill. ; méret) (Pl. 219 p., : ill. ; 21 cm + mell. (18 p. : ill. ; 10 cm))Többkötetes közös adatainál: a kötetek száma, utána a minden kötetre vonatkozó adatok. (Pl. 3 db. ; 20 cm) Hang-, audiovizuális dokumentum: elvileg itt is meg lehetne adni a speciális terjedelmi adatokat: (Pl. zajszűrő rendszer megnevezése: normál, dolbi stb. hangfelvétel típusa: mono, sztereo stb. felvétel rendszere: VHS, digitális stb.) Ekkor azonban ezek az adatok nem kerülnek indexelésre és a gyorskeresővel nem kereshetők vissza, hanem csak a leválogató programmal! Ezért javasoljuk a speciális adatoknál leírni, mert így a gyorskeresővel is visszakereshetők. Amennyiben olyan szempont merül fel, ami a speciális adatoknál nem választható, jelezzék, betesszük a programba!">terjedelem:</label>
        <input name="terjedelem" value="<?=$terjedelem?>" maxlength="165" type="text" class="form-control" id="terjedelem">
      </div>
      <div class="form-group col-xs-12 col-sm-3">
        <label class="dotted_underline" for="sorozat" data-toggle="tooltip" data-placement="top" title="Szerkezete: (sorozat főcíme = párhuzamos címe : alcíme / szerzőségi közlése, ISSN-je ; sorozati szám) (Pl.: (Módszertani írások, ISSN 0139-155X)) Amennyiben egy mű több sorozatban jelent meg, újabb zárójelek között adhatók meg a további sorozatok. Pl. (Borsod-Miskolci füzetek, ISSN 1524-0905 ; 13) . (Dokumentatio Borsodiensis, ISSN 0209-9446 ; 2)">sorozat:</label>
        <input name="sorozat" value="<?=$sorozat?>" maxlength="255" type="text" class="form-control" id="sorozat">
      </div>
      <div class="form-group col-xs-12 col-sm-3">
        <label class="dotted_underline" for="kozos_megj" data-toggle="tooltip" data-placement="top" title="Itt a dokumentum összes példányára érvényes megjegyzéseket adhatjuk meg. Itt közölhetjük a bibliográfiák helyét, a közös kiadások tényét stb. (Pl. Csehszlovák - magyar közös kiadás .- Bibliogr. : p. 122-128.)">közös megj:</label>
        <input name="kozos_megj" value="<?=$kozos_megj?>" type="text" class="form-control" id="kozos_megj">
      </div>
    </div>

    <div class="row">
      <div class="form-group col-xs-12 col-sm-3">
        <label class="dotted_underline" for="peldany_megj" data-toggle="tooltip" data-placement="top" title="Itt az adott példányra vonatkozó megjegyzéseket lehet megadni. (Pl. rongált .- hiányos .- törlésre javasolt stb.)">példány megj:</label>
        <input name="peldany_megj" value="<?=$peldany_megj?>" type="text" class="form-control" id="peldany_megj">
      </div>
      <div class="form-group col-xs-12 col-sm-3">
        <label class="dotted_underline" for="isbn" data-toggle="tooltip" data-placement="top" title="A dokumentumon feltüntetett ISBN számot kell megadni 10, vagy 13 hosszúságban (az ellenőrzőszámmal együtt.). A rendszer kezeli az új ISBN számokat is. Amennyiben a dokumentumon feltüntetett ISBN láthatóan hibás és tudjuk a jó ISBN-t, akkor itt a jó ISBN-t adjuk meg. Honosított tételeknél ide kerül a jó ISBN szám. ">ISBN:</label>
        <input name="isbn" value="<?=$isbn?>" maxlength="17" type="text" class="form-control" id="isbn">
      </div>
      <div class="form-group col-xs-12 col-sm-6">
        <label class="dotted_underline" for="kotes" data-toggle="tooltip" data-placement="top" title="Itt adható meg a hibás ISBN szám, vagy a 2. stb. ISBN, valamint a kötés típusa. Régi könyvek esetében a kötés leírása sok-sok szempont alapján, részletesen a speciális adatoknál adható meg. A speciális adatoknál megadott leírások a gyorskeresővel visszakereshetők.">Kötés:</label>
        <input name="kotes" value="<?=$kotes?>" type="text" class="form-control" id="kotes">
      </div>      
    </div>

    <div class="row">
      <div class="form-group col-xs-12 col-sm-5">
        <label class="dotted_underline" for="gyari_szam" data-toggle="tooltip" data-placement="top" title="Audiovizuális és hangzó dokumentum esetén a gyártási számot itt lehet megadni. Könyveknél ez a mező üres marad.">gyári szám:</label>
        <input name="gyari_szam" value="<?=$gyari_szam?>" maxlength="100" type="text" class="form-control" id="gyari_szam">
      </div>
      <div class="form-group col-xs-12 col-sm-4 col-lg-5">
        <label class="dotted_underline" for="nemzetkozi_azonosito" data-toggle="tooltip" data-placement="top" title="Minden dokumentumtípusnál a nemzetközi (vagy más) azonosító kódot lehet itt megadni.">nemzetközi azonosító:</label>
        <input name="nemzetkozi_azonosito" value="<?=$nemzetkozi_azonosito?>" maxlength="100" type="text" class="form-control" id="nemzetkozi_azonosito">
      </div>
      <div class="form-group col-xs-12 col-sm-3 col-lg-2">
        <label class="dotted_underline" for="feltuntetett_ar" data-toggle="tooltip" data-placement="top" title="A dokumentumon feltüntetett árat adjuk itt meg. Ez az ár eltérhet a tényleges beszerzési ártól, amit szintén meg lehet adni. Ez a mező szabad szöveges, beírhatjuk azt is: ár nélkül stb.">feltüntetett ár:</label>
        <input name="feltuntetett_ar" value="<?=$feltuntetett_ar!=0?$feltuntetett_ar:''?>" maxlength="11" type="text" class="form-control" id="feltuntetett_ar">
      </div>      
    </div>

    <div class="row">
      <div class="form-group col-xs-12 col-sm-3 col-md-4">
        <label class="dotted_underline" for="beszerz_jegyz" data-toggle="tooltip" data-placement="top" title="Az egyszerre vásárolt dokumentumok esetén azokat azonos jegyzékszámon lehet bevételezni. Ez alapján leltárkönyv formátumban pénzügyi kimutatás készíthető a beszerzésekről a gyorskeresőben. Ez a jegyzékszám lehet akár a vásárlási számla száma is!">beszerz. jegyz:</label>
        <input name="beszerz_jegyz" value="<?=$beszerz_jegyz?>" maxlength="150" type="text" class="form-control" id="beszerz_jegyz">
      </div>
      <div class="form-group col-xs-12 col-sm-3 col-lg-2">
        <label class="dotted_underline" for="beszerz_mod" data-toggle="tooltip" data-placement="top" title="Kötelezően a - „v” vásárolt, „c” csere, „a” ajándék, „k” köteles, „e” egyéb - karakter valamelyike.">beszerz. mód:</label>
        <input maxlength="200" name="beszerz_mod" value="<?=$beszerz_mod?>" maxlength="200" type="text" class="form-control" id="beszerz_mod">
      </div>
      <div class="form-group col-xs-12 col-sm-3 col-lg-4">
        <label class="dotted_underline" for="datum" data-toggle="tooltip" data-placement="top" title="Beszerzési dátum éééé.hh.nn. formában (Pl. 1995.02.12.) A segítő menüben található „napi dátum” az aktuális dátumot beírja a mezőbe.">dátum:</label>
        <input name="datum" value="<?=$datum?>" maxlength="15" type="text" class="form-control" id="datum">
      </div>  
      <div class="form-group col-xs-12 col-sm-3 col-lg-2">
        <label class="dotted_underline" for="beszerzesi_ar" data-toggle="tooltip" data-placement="top" title="A pénzügyi nyilvántartás adata, eltérhet a könyvön feltüntetett ártól. Az ár megadása csak a számrész feltüntetésével történik. A forint-fillér közé pontot kell tenni. (Pl. 25 vagy 100.50) Közös árral rendelkező többkötetes művek sajátosságai: Közös árral rendelkező többkötetes művek esetén mindig tudjuk a kötetek számát. Ezt a közös adatoknál a terjedelemnél kötelező megadni, mert a pénzügyi nyilvántartás csak így működik helyesen! A közös adatoknál a beszerzési ár mezőbe kötelezően a k betűt kell megadni. A valódi beszerzési árat az első kötet leírásnál kell bejegyezni. Ha a dokumentum minden kötetének külön ára van, akkor a közös adatoknál a beszerzési ár mező üresen marad, a beszerzési árat a kötetleírásoknál adjuk meg.">beszerzési ár:</label>
        <input name="beszerzesi_ar" value="<?=$beszerzesi_ar!=0?$beszerzesi_ar:''?>" maxlength="11" type="text" class="form-control" id="beszerzesi_ar">
      </div>      
    </div>

    <div class="row">
      <div class="form-group col-xs-12">
        <label class="dotted_underline" for="targyszavak" data-toggle="tooltip" data-placement="top" title="Itt adhatjuk meg a dokumentum tartalmi leírását tárgyszavakkal. Vesszővel elválasztva gyakorlatilag tetszőleges számú tárgyszót adhatunk meg. Az összetett tárgyszavakat érdemes több tárgyszóként megadni a hatékonyabb visszakereshetőség miatt. (Pl. "felvidéki magyar irodalom a 18. században" helyett "magyar irodalom,Felvidék,18. sz.")">tárgyszavak:</label>
        <textarea name="targyszavak" rows="2" class="form-control" id="targyszavak"><?=$targyszavak?></textarea>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-xs-12">
        <label class="dotted_underline" for="eto" data-toggle="tooltip" data-placement="top" title="Egymástól vesszővel elválasztva gyakorlatilag tetszőleges számú ETO jelzet adható meg. A ETO jelzet bármilyen bonyolult lehet. A megadott ETO jelzetek gyorskereső képesek.">ETO:</label>
        <input name="eto" value="<?=$eto?>" maxlength="500" type="text" class="form-control" id="eto">
      </div>
    </div>

    <div class="row">
      <div class="form-group col-xs-12 col-sm-7">
        <label class="dotted_underline" for="targyi_mt" data-toggle="tooltip" data-placement="top" title="A dokumentum tárgya adható meg. Ez nem azonos egy tárgyszóval. Pl. egy Mikszáth életrajznál tárgyi melléktételként megadhatjuk: Mikszáth Kálmán. Több tárgyi melléktétel is megadható, azokat a * karakterrel kell elválasztani egymástól.">tárgyi mt.</label>
        <input name="targyi_mt" value="<?=$targyi_mt?>" maxlength="500" type="text" class="form-control" id="targyi_mt">
      </div>
      <div class="form-group col-xs-12 col-sm-5">
        <label class="dotted_underline" for="kozos_spec_adat" data-toggle="tooltip" data-placement="top" title="A közös speciális adat mezőben azokat a speciális adatokat adjuk meg, amik minden példányra érvényesek (pl. a dokumentum nyelve), a saját speciális adat mezőben pedig az adott példányra vonatkozó speciális adatokat (pl. dedikáció).">közös spec. adat:</label>
        <input name="kozos_spec_adat" value="<?=$kozos_spec_adat?>" maxlength="10" type="text" class="form-control" id="kozos_spec_adat">
      </div>
    </div>

    <div class="row">
      <div class="form-group col-xs-12 col-sm-10 col-lg-10">
        <label class="dotted_underline" for="saj_spec_adat" data-toggle="tooltip" data-placement="top" title="A rendszer egyik erőssége, hogy a speciális adatok száma és megnevezése szabadon bővíthető!">Saj. spec. adat:</label>
        <input name="saj_spec_adat" value="<?=$saj_spec_adat?>" type="text" class="form-control" id="saj_spec_adat">
      </div>
      <div class="form-group col-xs-12 col-sm-2 col-lg-2">
        <label class="dotted_underline" for="csz" data-toggle="tooltip" data-placement="top" title="A szerzők, vagy a cím alapján automatikusan kitöltődik. Ha valamilyen oknál fogva mégis hibás, felül lehet bírálni.">Csz:</label>
        <input name="csz" value="<?=empty($csz)?$auto_cutter:$csz?>" maxlength="10" type="text" class="form-control" id="csz">
      </div>
    </div>

    <a class="pointer" data-toggle="collapse" data-target="#more_details">Részletek</a>
    <div id="more_details" class="collapse"><br/>
      
      <div class="row">
        <div class="form-group col-xs-12 col-sm-2">
          <label class="dotted_underline" for="cserear" data-toggle="tooltip" data-placement="top" title="Elveszett példányok esetében szükséges a könyv eredeti ára alapján megszabni az eredeti árnál egy alacsonyabb de mégis elfogadható díjjat kiszabni, de az is előfordulhat, hogy esetleg a kölcsönző inkább saját maga sezrzi be újra, ilyenkor persze csereár megadása nem szükséges.">Csereár:</label>
          <input name="cserear" value="<?=$cserear!=0?$cserear:''?>" type="text" class="form-control" id="cserear">
        </div>
        <div class="form-group col-xs-12 col-sm-3">
          <label class="dotted_underline" for="cserear_datuma" data-toggle="tooltip" data-placement="top" title="Új csereár megadásakor szükséges kitölteni ezt a mezőt.">Csereár dátuma:</label>
          <input name="cserear_datuma" value="<?=$cserear_datuma?>" type="date" class="form-control" id="cserear_datuma">
        </div>
        <div class="form-group col-xs-12 col-sm-3">
          <label class="dotted_underline" for="nem_kolcsonzesre" data-toggle="tooltip" data-placement="top" title="A könyv elérhetőségét lehetőségünk van korlátozni (Y - nem kölcsönözhető / N - kölcsönözhető).">Nem kölcsönzésre:</label>
          <input name="nem_kolcsonzesre" value="<?=$nem_kolcsonzesre?>" maxlength="10" type="text" class="form-control" id="nem_kolcsonzesre">
        </div>
        <div class="form-group col-xs-12 col-sm-2">
          <label class="dotted_underline" for="elveszett_elem" data-toggle="tooltip" data-placement="top" title="A könnyebb visszakereshetőségért az elveszett könyvek státuszát itt kell megadni. (Alapértelmezetten ezt a mezőt nem szükséges megadni.)">Elveszett:</label>
          <input name="elveszett_elem" value="<?=$elveszett_elem?>" maxlength="10" type="text" class="form-control" id="elveszett_elem">
        </div>
        <div class="form-group col-xs-12 col-sm-2">
          <label class="dotted_underline" for="tartalekok" data-toggle="tooltip" data-placement="top" title="A bibliográfia tartalék példányaira vonatkozó információkat csak itt lehet megadni.">Tartalékok:</label>
          <input name="tartalekok" value="<?=$tartalekok!=0?$tartalekok:''?>" maxlength="10" type="text" class="form-control" id="tartalekok">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-xs-12 col-sm-4">
          <label class="dotted_underline" for="melleklet_1" data-toggle="tooltip" data-placement="top" title="Az első melléklet leltári_számát kell itt megadni. Az adat érvényességét a rendszer nem ellenőrzi.">Melléklet 1:</label>
          <input name="melleklet_1" value="<?=$melleklet_1!=0?$melleklet_1:''?>" type="text" class="form-control" id="melleklet_1">
        </div>
        <div class="form-group col-xs-12 col-sm-4">
          <label class="dotted_underline" for="melleklet_2" data-toggle="tooltip" data-placement="top" title="A második melléklet leltári_számát kell itt megadni. Az adat érvényességét a rendszer nem ellenőrzi.">Melléklet 2:</label>
          <input name="melleklet_2" value="<?=$melleklet_2!=0?$melleklet_2:''?>" type="text" class="form-control" id="melleklet_2">
        </div>
        <div class="form-group col-xs-12 col-sm-4">
          <label class="dotted_underline" for="melleklet_3" data-toggle="tooltip" data-placement="top" title="Az harmadik melléklet leltári_számát kell itt megadni. Az adat érvényességét a rendszer nem ellenőrzi.">Melléklet 3:</label>
          <input name="melleklet_3" value="<?=$melleklet_3!=0?$melleklet_3:''?>" maxlength="10" type="text" class="form-control" id="melleklet_3">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-xs-12">
          <label class="dotted_underline" for="url" data-toggle="tooltip" data-placement="top" title="Ebook-ok esetében a weboldal címét minden esetben szükséges megadni.">URL (e-book):</label>
          <input name="url" value="<?=$url?>" type="text" class="form-control" id="url">
        </div>
      </div>
    </div>
  </div>


  </div>
  <!-- /.box-body -->

<!--div class="action_buttons">
  <button name="nyelv_details" type="button" class="btn btn-primary margin">Nyelv</button>
  <button name="tipus_details" type="button" class="btn btn-primary margin">Típus</button>
  <button name="gyujtemeny_details" type="button" class="btn btn-primary margin">Gyűjtemény</button>
  <button name="kiado_details" type="button" class="btn btn-primary margin">Kiadó</button>
</div-->

<div class="box box-danger">
  <div class="box-header">
    <h5><i>ADATOK A WEBOLDAL RÉSZÉRE - csak bevitt tulajdonságokból lehet választani</i></h5>
  </div>
  <div class="box-body">

    <div class="row">
      <div class="form-group col-xs-12 col-sm-3">
        <label class="dotted_underline" for="nyelv" data-toggle="tooltip" data-placement="top" title="A dokumentum nyelve adható meg rövídített, vagy normál forma szerint. Új nyelv hozzáadása a fenti menü segítségével adható meg.">Nyelv:</label>
        <input name="nyelvek" list="nyelvek" value="<?=$nyelv?>" maxlength="255" type="text" class="form-control required_field" id="nyelv" autocomplete="off">
        <datalist id="nyelvek">
        </datalist>
      </div>
      <div class="form-group col-xs-12 col-sm-3">
        <label class="dotted_underline" for="tipus" data-toggle="tooltip" data-placement="top" title="A dokumentum típusa adható meg. Új típus hozzáadása a fenti menü segítségével adható meg.">Típus:</label>
        <input name="tipusok" list="tipusok" value="<?=$tipus?>" maxlength="255" type="text" class="form-control required_field" id="tipus" autocomplete="off">
        <datalist id="tipusok">
        </datalist>
      </div>
      <div class="form-group col-xs-12 col-sm-3">
        <label class="dotted_underline" for="gyujtemeny" data-toggle="tooltip" data-placement="top" title="A dokumentumot csak egy gyűjteménybe van lehetőség besorolni. De egy új gyűjteményt csak akkor lehet hozzáadni a fenti menüvel, ha a fiók könyvtár már előzetesen szerepel az adatbázisban. Egy új gyűjtemény létrhezozásakor figyelni kell a fiók könyvtár szabályainak a megadására, mivel más különben nem várható sem költségtérítés az elvesztett könyvekért, sem pedig a kölcsönzési idő betartatása.">Gyűjtemény:</label>
        <input name="gyujtemenyek" list="gyujtemenyek" value="<?=$gyujtemeny?>" maxlength="255" type="text" class="form-control required_field" id="gyujtemeny" autocomplete="off">
        <datalist id="gyujtemenyek">
        </datalist>
      </div>
      <div class="form-group col-xs-12 col-sm-3">
        <label class="dotted_underline" for="kiado" data-toggle="tooltip" data-placement="top" title="A könnyebb kereshetőség érdekében érdemes a mező értékét megadni (a mező kitöltése kötelező).">Kiadó:</label>
        <input name="kiadok" list="kiadok" value="<?=$kiado?>" maxlength="255" type="text" class="form-control required_field" id="kiado" autocomplete="off">
        <datalist id="kiadok">
        </datalist>
      </div>
    </div>
  </div>
</div>


<!--div class="action_buttons"">
    <a href="<?=base_url()?>szerzok/manage/20"><button type="button" class="btn btn-primary margin">Szerzők</button></a>
    <a href="<?=base_url()?>kiadok/manage/20"><button type="button" class="btn btn-primary margin">Kiadók</button></a>
    <a href="<?=base_url()?>gyujtemenyek/manage/20"><button type="button" class="btn btn-primary margin">gyűjtemények</button></a>
    <a href="<?=base_url()?>konyvtarak/manage/20"><button type="button" class="btn btn-primary margin">könyvtárak</button></a>
    <a href="<?=base_url()?>nyelvek/manage/20"><button type="button" class="btn btn-primary margin">Nyelvek</button></a>
    <a href="<?=base_url()?>tipusok/manage/20"><button type="button" class="btn btn-primary margin">Típusok</button></a>
</div-->

<?php if(isset($borito) && !empty($borito)){?>
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Borítókép</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div style="width:fit-content;">
      <div class="thumbnail">
        <img src="<?=base_url()?>biblio_pics/<?=$borito?>" alt="Borítókép">
        <div class="caption">
          <p><?=$borito?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>

  <div style="margin-bottom: 250px;"></div>

</div>
</form>


<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>

<?php      
  //script generation
  $this->php_strap_cv->datalist('nyelv', 'nyelvek', base_url().$first_segment.'/datalist/nyelvek/nyelv');
  $this->php_strap_cv->datalist('tipus', 'tipusok', base_url().$first_segment.'/datalist/tipusok/leiras');
  $this->php_strap_cv->datalist('gyujtemeny', 'gyujtemenyek', base_url().$first_segment.'/datalist/gyujtemenyek/leiras');
  $this->php_strap_cv->datalist('kiado', 'kiadok', base_url().$first_segment.'/datalist/kiadok/kiado');
  $this->php_strap_cv->datalist('szerzo', 'szerzok', base_url().$first_segment.'/datalist/szerzok/nev');
  $this->php_strap_cv->datalist('fioktelep', 'fioktelep_list', base_url().$first_segment.'/datalist/konyvtarak/nev');
  //($modal_id, $modal_name, $form_id, $fields, $action_btn_name, $ajax_url, $message)   

  //Ez itt a könyv nyelvek ablak  
  $fields = array(
    array('label' => 'Nyelv' ,'name' => 'nyelv', 'type' => 'text'),    
    array('label' => 'Rövidítése' ,'name' => 'rovidites', 'type' => 'text')
  );
  $ajax_url = base_url().$first_segment."/insert_with_ajax/nyelv";
  $message = "Az új nyelvet sikeresen hozzáadta!";
  $this->php_strap_cv->new_modal("add_nyelv_Modal", "Részletes nyelvi adatok megadása", "insert_form_nyelv", $fields, "nyelv_details", $ajax_url, $message);

  //Ez itt a könyv típusok ablak
  $fields = array(
    array('label' => 'Leírás' ,'name' => 'leiras', 'type' => 'text')
  );
  $ajax_url = base_url().$first_segment."/insert_with_ajax/tipus";
  $message = "Az új típust sikeresen hozzáadta!";
  $this->php_strap_cv->new_modal("add_tipus_Modal", "Részletes típus adatok megadása", "insert_form_tipus", $fields, "tipus_details", $ajax_url, $message);

  //Ez itt a könyv gyűjtemények ablak
  $fields = array(
    array('label' => 'Fiók&nbsp;&nbsp;&nbsp;<button name="fioktelep_details" class="btn btn-primary btn-xs" type="button" id="new_konyvtar"><span class="fa fa-fw fa-plus"></span></button>' ,'name' => 'fioktelep', 'type' => 'datalist'),
    array('label' => 'Leírás' ,'name' => 'leiras', 'type' => 'text'),
    array('label' => 'Hátralévő napok' , 'name' => 'hatralevo_napok', 'type' => 'text'),
    array('label' => 'Késedelmi díj' , 'name' => 'kesedelmi_dij', 'type' => 'text'),          
    array('label' => 'Kölcsönzői díj' ,'name' => 'kolcsonzoi_dij', 'type' => 'text'),         
    array('label' => 'Nem másolható?' ,'name' => 'nem_masolhato', 'type' => 'text'),                 
    array('label' => 'Másolási díj' ,'name' => 'masolasi_dij', 'type' => 'text')
  );
  $ajax_url = base_url().$first_segment."/insert_with_ajax/gyujtemeny";
  $message = "Az új nyelvet sikeresen hozzáadta!";
  $custom_script = 
  "\$(\"button[name='gyujtemeny_details']\").click(function(){
    \$('#insert_form_gyujtemeny')[0].reset();
    \$(\"#add_gyujtemeny_Modal\").modal(\"show\");
  });";
  $this->php_strap_cv->new_modal("add_gyujtemeny_Modal", "Új gyűjtemény hozzadása", "insert_form_gyujtemeny", $fields, "gyujtemeny_details", $ajax_url, $message, $custom_script);

  //Ez itt a könyv kiadók ablak
  $fields = array(
    array('label' => 'kiadó' ,'name' => 'kiado', 'type' => 'text'),
    array('label' => 'hely' ,'name' => 'hely', 'type' => 'text')
  );
  $ajax_url = base_url().$first_segment."/insert_with_ajax/kiado";
  $message = "Az új kiadót sikeresen hozzáadta!";
  $this->php_strap_cv->new_modal("add_kiado_Modal", "Új Kiadó Hozzáadása", "insert_form_kiado", $fields, "kiado_details", $ajax_url, $message);

  //Ez itt a könyvtárak ablak
  $fields = array(          
    array('label' => 'Név' ,'name' => 'nev', 'type' => 'text'),
    array('label' => 'főigazgató' , 'name' => 'foigazgato', 'type' => 'text'),
    array('label' => 'irányítószám' , 'name' => 'iranyitoszam', 'type' => 'text'),          
    array('label' => 'város' ,'name' => 'varos', 'type' => 'text'),                  
    array('label' => 'kerület' ,'name' => 'kerulet', 'type' => 'text'),            
    array('label' => 'cím' ,'name' => 'cim', 'type' => 'text'),          
    array('label' => 'telefon szám' ,'name' => 'telefon_szam', 'type' => 'text'),          
    array('label' => 'fax szám' ,'name' => 'fax_szam', 'type' => 'text'),         
    array('label' => 'email' ,'name' => 'email', 'type' => 'text'),
    array('label' => 'fiók megjegyzések' ,'name' => 'fiok_megjegyzesek', 'type' => 'text'),         
    array('label' => 'url' ,'name' => 'url', 'type' => 'text')
  );
  $ajax_url = base_url().$first_segment."/insert_with_ajax/konyvtar";
  $message = "Az új létesítményt sikeresen bejegyezte!";
  $custom_script = "
  \$(\"button[name='fioktelep_details']\").click(function(){
    \$('#insert_form_konyvtar')[0].reset();
    \$(\"#add_gyujtemeny_Modal\").modal(\"hide\");
    setTimeout(function(){\$(\"#add_konyvtar_Modal\").modal(\"show\")}, 390);
  });
  \$(\"button[name='back']\").click(function(){
    \$(\"#add_konyvtar_Modal\").modal(\"hide\");
    setTimeout(function(){\$(\"#add_gyujtemeny_Modal\").modal(\"show\")}, 390);
  });";
  $this->php_strap_cv->new_modal("add_konyvtar_Modal", "Új fióktelep/telephely hozzáadása", "insert_form_konyvtar", $fields, "fioktelep_details", $ajax_url, $message, $custom_script, true);

?>

<script type="text/javascript">
  /*

PÉLDA
<input name="rszj" value="<?=$rszj?>" min="100" max="999" onkeypress="return isNumeric(event)"
    oninput="maxLengthCheck(this)"
    type = "number"
    maxlength = "3" type="number" class="form-control" id="rszj">

KÓDPROG
  function maxLengthCheck(object) {
    if (object.value.length > object.maxLength)
      object.value = object.value.slice(0, object.maxLength)
  }
    
  function isNumeric (evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode (key);
    var regex = /[0-9]|\./;
    if ( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }
  */

function resetform(){
  var x = document.getElementsByTagName("input");
  var i;
  for (i = 0; i < x.length; i++) {
      x[i].value = "";
  }
  var x = document.getElementsByTagName("textarea");
  for (i = 0; i < x.length; i++) {
      x[i].innerText = "";
  }
}

function auto_lsz()
{
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
         if (xmlhttp.status == 200) {
             document.getElementById("leltari_szam").value = xmlhttp.responseText;
         }
         else if (xmlhttp.status == 400) {
            alert('There was an error 400');
         }
         else {
             alert('something else other than 200 was returned');
         }
      }
  };

  xmlhttp.open("GET", "<?=base_url()?>bibliografiak/get_inventory_number_with_ajax", true);
  xmlhttp.send();
}

function _delete_szerzo()
{
  var szerzo = document.getElementById("szerzo").value;
  document.getElementById("szerzo").value = "";
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == XMLHttpRequest.DONE) {
         if (xmlhttp.status == 200) {
             document.getElementById("leltari_szam").value = xmlhttp.responseText;
         }
         else if (xmlhttp.status == 400) {
            alert('There was an error 400');
         }
         else {
             alert('something else other than 200 was returned');
         }
      }
  };

  xmlhttp.open("GET", "<?=base_url()?>bibliografiak/delete_szerzo/"+szerzo, true);
  xmlhttp.send();
}

function _insert_szerzo()
{
  var szerzo = document.getElementById("szerzo").value;
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == XMLHttpRequest.DONE) {
         if (xmlhttp.status == 200) {
             document.getElementById("leltari_szam").value = xmlhttp.responseText;
         }
         else if (xmlhttp.status == 400) {
            alert('There was an error 400');
         }
         else {
             alert('something else other than 200 was returned');
         }
      }
  };

  xmlhttp.open("GET", "<?=base_url()?>bibliografiak/insert_szerzo/"+szerzo, true);
  xmlhttp.send();
}

</script>

<script>

function check(){
   $.get('<?=base_url()?>bibliografiak/check_honositas', function(data) {
     if( data != "" ) {
      var arr = data.replace(/'/g,'"');
      var obj = JSON.parse(arr);
      //alert(obj);
        $.each(obj, function( key, value ) {
          $("#bibliografiak input[name='"+key+"']").val(value);
          $("#bibliografiak textarea[name='"+key+"']").text(value);
        });
        //alert(data);
     }
  });
 }


$(document).ready(function(){
  $(document).on('focusout','#cim',function(){
    //alert();
    
    var value1 = $(this).val();
    /*
    var data = $('#cimek :contains('+value+')').data('json');    
    */
    var data = $('textarea[name="json_data"').text();
    var arr = data.replace(/\'/g,'\"');
    var obj = JSON.parse(arr);
    //alert(obj);
    /*
    $.each(obj, function( key, value ) {
      $("#bibliografiak input[name='"+key+"']").val(value);
    });
    */
    $.each(obj, function( k, val ) {
      var talalat = false;
      $.each(val, function( key, value ) {
        //$("#bibliografiak input[name='"+key+"']").val(value);
        if(value == value1 || talalat){
          $("#bibliografiak input[name='"+key+"']").val(value);
          $("#bibliografiak textarea[name='"+key+"']").text(value);
          talalat = true;          
        }
      });
    });
  });
});

function gyors_honosito(){
  var cim = $('#cim').val();
  var szerver = $('select[name=fast_cat] option:selected').text();
  
   $.get('<?=base_url()?>bibliografiak/gyors_honosito?szerver='+szerver+'&cim='+cim, function(data) {
     if( data != "" ) {
      var arr = data.replace(/\'/g,'\"');
      var obj = JSON.parse(arr);
      var array = "";
      var i = 0;
      //alert(obj);
        $.each(obj, function( k, val ) {
        $.each(val, function( key, value ) {
          //$("#bibliografiak input[name='"+key+"']").val(value);
          if(key == 'cim'){
            $('textarea[name="json_data"').text(JSON.stringify(obj[i]));
            array += "<option>"+value+"</option>";
          }
        });
        i++;
        });
        $('textarea[name="json_data"').text(JSON.stringify(obj));
        $("datalist#cimek").html(array);
        //alert(data);
     }
  });
 }

//setInterval(check, 1000);

</script>





<script>var SETTINGS = {
    navBarTravelling: false,
    navBarTravelDirection: "",
   navBarTravelDistance: 150
}

var colours = {
    0: "#867100",
    1: "#7F4200",
    2: "#99813D",
    3: "#40FEFF",
    4: "#14CC99",
    5: "#00BAFF",
    6: "#0082B2",
    7: "#B25D7A",
    8: "#00FF17",
    9: "#006B49",
    10: "#00B27A",
    11: "#996B3D",
    12: "#CC7014",
    13: "#40FF8C",
    14: "#FF3400",
    15: "#ECBB5E",
    16: "#ECBB0C",
    17: "#B9D912",
    18: "#253A93",
    19: "#125FB9",
}

document.documentElement.classList.remove("no-js");
document.documentElement.classList.add("js");

// Out advancer buttons
var pnAdvancerLeft = document.getElementById("pnAdvancerLeft");
var pnAdvancerRight = document.getElementById("pnAdvancerRight");
// the indicator
var pnIndicator = document.getElementById("pnIndicator");

var pnProductNav = document.getElementById("pnProductNav");
var pnProductNavContents = document.getElementById("pnProductNavContents");

pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));

// Set the indicator
moveIndicator(pnProductNav.querySelector("[aria-selected=\"true\"]"), colours[0]);

// Handle the scroll of the horizontal container
var last_known_scroll_position = 0;
var ticking = false;

function doSomething(scroll_pos) {
    pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));
}

pnProductNav.addEventListener("scroll", function() {
    last_known_scroll_position = window.scrollY;
    if (!ticking) {
        window.requestAnimationFrame(function() {
            doSomething(last_known_scroll_position);
            ticking = false;
        });
    }
    ticking = true;
});


pnAdvancerLeft.addEventListener("click", function() {
  // If in the middle of a move return
    if (SETTINGS.navBarTravelling === true) {
        return;
    }
    // If we have content overflowing both sides or on the left
    if (determineOverflow(pnProductNavContents, pnProductNav) === "left" || determineOverflow(pnProductNavContents, pnProductNav) === "both") {
        // Find how far this panel has been scrolled
        var availableScrollLeft = pnProductNav.scrollLeft;
        // If the space available is less than two lots of our desired distance, just move the whole amount
        // otherwise, move by the amount in the settings
        if (availableScrollLeft < SETTINGS.navBarTravelDistance * 2) {
            pnProductNavContents.style.transform = "translateX(" + availableScrollLeft + "px)";
        } else {
            pnProductNavContents.style.transform = "translateX(" + SETTINGS.navBarTravelDistance + "px)";
        }
        // We do want a transition (this is set in CSS) when moving so remove the class that would prevent that
        pnProductNavContents.classList.remove("pn-ProductNav_Contents-no-transition");
        // Update our settings
        SETTINGS.navBarTravelDirection = "left";
        SETTINGS.navBarTravelling = true;
    }
    // Now update the attribute in the DOM
    pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));
});

pnAdvancerRight.addEventListener("click", function() {
    // If in the middle of a move return
    if (SETTINGS.navBarTravelling === true) {
        return;
    }
    // If we have content overflowing both sides or on the right
    if (determineOverflow(pnProductNavContents, pnProductNav) === "right" || determineOverflow(pnProductNavContents, pnProductNav) === "both") {
        // Get the right edge of the container and content
        var navBarRightEdge = pnProductNavContents.getBoundingClientRect().right;
        var navBarScrollerRightEdge = pnProductNav.getBoundingClientRect().right;
        // Now we know how much space we have available to scroll
        var availableScrollRight = Math.floor(navBarRightEdge - navBarScrollerRightEdge);
        // If the space available is less than two lots of our desired distance, just move the whole amount
        // otherwise, move by the amount in the settings
        if (availableScrollRight < SETTINGS.navBarTravelDistance * 2) {
            pnProductNavContents.style.transform = "translateX(-" + availableScrollRight + "px)";
        } else {
            pnProductNavContents.style.transform = "translateX(-" + SETTINGS.navBarTravelDistance + "px)";
        }
        // We do want a transition (this is set in CSS) when moving so remove the class that would prevent that
        pnProductNavContents.classList.remove("pn-ProductNav_Contents-no-transition");
        // Update our settings
        SETTINGS.navBarTravelDirection = "right";
        SETTINGS.navBarTravelling = true;
    }
    // Now update the attribute in the DOM
    pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));
});

pnProductNavContents.addEventListener(
    "transitionend",
    function() {
        // get the value of the transform, apply that to the current scroll position (so get the scroll pos first) and then remove the transform
        var styleOfTransform = window.getComputedStyle(pnProductNavContents, null);
        var tr = styleOfTransform.getPropertyValue("-webkit-transform") || styleOfTransform.getPropertyValue("transform");
        // If there is no transition we want to default to 0 and not null
        var amount = Math.abs(parseInt(tr.split(",")[4]) || 0);
        pnProductNavContents.style.transform = "none";
        pnProductNavContents.classList.add("pn-ProductNav_Contents-no-transition");
        // Now lets set the scroll position
        if (SETTINGS.navBarTravelDirection === "left") {
            pnProductNav.scrollLeft = pnProductNav.scrollLeft - amount;
        } else {
            pnProductNav.scrollLeft = pnProductNav.scrollLeft + amount;
        }
        SETTINGS.navBarTravelling = false;
    },
    false
);

// Handle setting the currently active link
pnProductNavContents.addEventListener("click", function(e) {
  var links = [].slice.call(document.querySelectorAll(".pn-ProductNav_Link"));
  links.forEach(function(item) {
    item.setAttribute("aria-selected", "false");
  })
  e.target.setAttribute("aria-selected", "true");
  // Pass the clicked item and it's colour to the move indicator function
  moveIndicator(e.target, colours[links.indexOf(e.target)]);
});

// var count = 0;
function moveIndicator(item, color) {
    var textPosition = item.getBoundingClientRect();
    var container = pnProductNavContents.getBoundingClientRect().left;
    var distance = textPosition.left - container;
   var scroll = pnProductNavContents.scrollLeft;
    pnIndicator.style.transform = "translateX(" + (distance + scroll) + "px) scaleX(" + textPosition.width * 0.01 + ")";
  // count = count += 100;
  // pnIndicator.style.transform = "translateX(" + count + "px)";
  
    if (color) {
        pnIndicator.style.backgroundColor = color;
    }
}

function determineOverflow(content, container) {
    var containerMetrics = container.getBoundingClientRect();
    var containerMetricsRight = Math.floor(containerMetrics.right);
    var containerMetricsLeft = Math.floor(containerMetrics.left);
    var contentMetrics = content.getBoundingClientRect();
    var contentMetricsRight = Math.floor(contentMetrics.right);
    var contentMetricsLeft = Math.floor(contentMetrics.left);
   if (containerMetricsLeft > contentMetricsLeft && containerMetricsRight < contentMetricsRight) {
        return "both";
    } else if (contentMetricsLeft < containerMetricsLeft) {
        return "left";
    } else if (contentMetricsRight > containerMetricsRight) {
        return "right";
    } else {
        return "none";
    }
}

/**
 * @fileoverview dragscroll - scroll area by dragging
 * @version 0.0.8
 * 
 * @license MIT, see https://github.com/asvd/dragscroll
 * @copyright 2015 asvd <heliosframework@gmail.com> 
 */


(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        define(['exports'], factory);
    } else if (typeof exports !== 'undefined') {
        factory(exports);
    } else {
        factory((root.dragscroll = {}));
    }
}(this, function (exports) {
    var _window = window;
    var _document = document;
    var mousemove = 'mousemove';
    var mouseup = 'mouseup';
    var mousedown = 'mousedown';
    var EventListener = 'EventListener';
    var addEventListener = 'add'+EventListener;
    var removeEventListener = 'remove'+EventListener;
    var newScrollX, newScrollY;

    var dragged = [];
    var reset = function(i, el) {
        for (i = 0; i < dragged.length;) {
            el = dragged[i++];
            el = el.container || el;
            el[removeEventListener](mousedown, el.md, 0);
            _window[removeEventListener](mouseup, el.mu, 0);
            _window[removeEventListener](mousemove, el.mm, 0);
        }

        // cloning into array since HTMLCollection is updated dynamically
        dragged = [].slice.call(_document.getElementsByClassName('dragscroll'));
        for (i = 0; i < dragged.length;) {
            (function(el, lastClientX, lastClientY, pushed, scroller, cont){
                (cont = el.container || el)[addEventListener](
                    mousedown,
                    cont.md = function(e) {
                        if (!el.hasAttribute('nochilddrag') ||
                            _document.elementFromPoint(
                                e.pageX, e.pageY
                            ) == cont
                        ) {
                            pushed = 1;
                            lastClientX = e.clientX;
                            lastClientY = e.clientY;

                            e.preventDefault();
                        }
                    }, 0
                );

                _window[addEventListener](
                    mouseup, cont.mu = function() {pushed = 0;}, 0
                );

                _window[addEventListener](
                    mousemove,
                    cont.mm = function(e) {
                        if (pushed) {
                            (scroller = el.scroller||el).scrollLeft -=
                                newScrollX = (- lastClientX + (lastClientX=e.clientX));
                            scroller.scrollTop -=
                                newScrollY = (- lastClientY + (lastClientY=e.clientY));
                            if (el == _document.body) {
                                (scroller = _document.documentElement).scrollLeft -= newScrollX;
                                scroller.scrollTop -= newScrollY;
                            }
                        }
                    }, 0
                );
             })(dragged[i++]);
        }
    }

      
    if (_document.readyState == 'complete') {
        reset();
    } else {
        _window[addEventListener]('load', reset, 0);
    }

    exports.reset = reset;
}));

//# sourceURL=pen.js
</script>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>