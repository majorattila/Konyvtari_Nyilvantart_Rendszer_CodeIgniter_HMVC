<style>
	.kat-box{
		padding-top: 25px;
		padding-left:200px;
		padding-right:200px;
	}
	.pull-right{
		float: right;
	}
</style>

<div class="kat-box">

<?php 
foreach ($query->result() as $row) {
$targyi_mt_tomb = explode(";", $row->targyi_mt);
$egyebcimek_tomb = explode(";", $row->egyebcimek);
$kiemelt_rendszavak_tomb = explode(";", $row->kiemelt_rendszavak);
$egyeb_rendszavak_tomb = explode(";", $row->egyeb_rendszavak);
?>

<p><?= $row->eto.' '.$row->csz ?></p>
<p class="pull-right"><?= $row->rszj.' '.$row->mrj ?></p>

<!--p><?= $row->leltari_szam ?></p-->

<p><?= $row->nev ?></p>

<p><?= $row->cim ?></p>

<p><?= $row->hely.' - '.$row->datum.' - '.$row->terjedelem.(!empty($egyebcimek_tomb[0]))?' - ':''?>

<?php
foreach ($egyebcimek_tomb as $egyebcimek) {
	if(!empty($egyebcimek)){
		echo $egyebcimek.',';
	}
}
if(!empty($egyebcimek_tomb[0])){
	echo ' - ';
}
?>

<?php
foreach ($kiemelt_rendszavak_tomb as $kiemelt_rendszavak) {
	if(!empty($kiemelt_rendszavak)){
		echo $kiemelt_rendszavak.',';
	}
}
if(!empty($kiemelt_rendszavak_tomb[0])){
	echo ' - ';
}
?>

<?php
foreach ($egyeb_rendszavak_tomb as $egyeb_rendszavak) {
	if(!empty($egyeb_rendszavak)){
		echo $egyeb_rendszavak.',';
	}
}
if(!empty($egyeb_rendszavak_tomb[0])){
	echo ' - ';
}

?>

<!--p><?= $row->vonalkod ?></p-->
<?= !empty($row->kiadasjelzes)?$row->kiadasjelzes.' - ':'' ?>
<?= !empty($row->megjelenes)?$row->megjelenes.' - ':'' ?>
<?= !empty($row->sorozat)?$row->sorozat.' - ':'' ?>
<?= !empty($row->gyari_szam)?$row->gyari_szam.' - ':'' ?>
<?= !empty($row->nemzetkozi_azonosito)?$row->nemzetkozi_azonosito.' - ':'' ?>
<?= !empty($row->dok_stat)?$row->dok_stat.' - ':'' ?>
<?= !empty($row->kotes)?$row->kotes.' - ':'' ?>
<?= !empty($row->kozos_megjegyzesek)?$row->kozos_megjegyzesek.' - ':'' ?>
<?= !empty($row->peldany_megjegyzesek)?$row->peldany_megjegyzesek.' - ':'' ?>
<?= !empty($row->lelohely)?$row->lelohely.' - ':'' ?>
<?= !empty($row->beszerz_jegyz)?$row->beszerz_jegyz.' - ':'' ?>
<?= !empty($row->kozos_spec_adat)?$row->kozos_spec_adat.' - ':'' ?>
<?= !empty($row->saj_spec_adat)?$row->saj_spec_adat.' - ':'' ?>
<?= !empty($row->leiras_tipusok)?$row->leiras_tipusok.' - ':'' ?>
<?= !empty($row->kiado)?$row->kiado.' - ':'' ?>
<?= !empty($row->nyelv)?$row->nyelv.' - ':'' ?>
<?= !empty($row->leiras)?$row->leiras.' - ':'' ?></p>

<p>ISBN.: <?= (($row->isbn!=0)?$row->isbn:' - ').(!empty($row->kotes)?', ':'').$row->kotes.(!empty($row->beszerzesi_ar)?', ':'').($row->beszerzesi_ar!=0?$row->beszerzesi_ar:'').(!empty($row->beszerzesi_ar)?' - Ft':'') ?></p>

<p><?= trim(str_replace(';', ', ', $row->targyszavak),', ') ?></p>

<?php foreach ($targyi_mt_tomb as $targyi_mt) {
if(!empty($targyi_mt)){?>
<p>Mt.: <?= $targyi_mt ?></p>
<?php }} ?>



<?php } ?>
</div>