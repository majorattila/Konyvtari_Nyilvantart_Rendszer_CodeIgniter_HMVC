<?php
$third_segment = $this->uri->segment(3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
	<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?=base_url()?>bower_components/bootstrap/dist/js/popper.js"></script>
	<script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body><br/>   

    <section class="container">

    <span><b>Nyomtatás: </b></span><a href='<?= base_url()?>bibliografiak/download_pdf/<?= $third_segment ?>'><i class='glyphicon glyphicon-print'></i></a>
    <br/><br/>

	<table class="table table-striped table-bordered">
	<?php if(!empty($leltari_szam)){ ?><tr><td>Leltári szám</td><td><?=$leltari_szam?></td></tr><?php } ?>
    <?php if(!empty($rszj)){ ?><tr><td>Rszj</td><td><?=$rszj?></td></tr><?php } ?>
    <?php if(!empty($mrj)){ ?><tr><td>Mrj</td><td><?=$mrj?></td></tr><?php } ?>
    <?php if(!empty($vonalkod)){ ?><tr><td>Vonalkód</td><td><?=$vonalkod?></td></tr><?php } ?>
    <?php if(!empty($cim)){ ?><tr><td>cím</td><td><?=$cim?></td></tr><?php } ?>
    <?php if(!empty($egyebcimek)){ ?><tr><td>Egyebcímek</td><td><?=$egyebcimek?></td></tr><?php } ?>
    <?php if(!empty($szerzok)){ ?><tr><td>Szerzők</td><td><?=$szerzok?></td></tr><?php } ?>
    <?php if(!empty($kiemelt_rendszavak)){ ?><tr><td>Kiemelt rendszavak</td><td><?=$kiemelt_rendszavak?></td></tr><?php } ?>
    <?php if(!empty($egyeb_rendszavak)){ ?><tr><td>Egyéb rendszavak</td><td><?=$egyeb_rendszavak?></td></tr><?php } ?>
    <?php if(!empty($testuleti_szerzo)){ ?><tr><td>Testületi szerző</td><td><?=$testuleti_szerzo?></td></tr><?php } ?>
    <?php if(!empty($kiadasjelzes)){ ?><tr><td>Kiadasjelzés</td><td><?=$kiadasjelzes?></td></tr><?php } ?>
    <?php if(!empty($lelohely)){ ?><tr><td>Lelőhely</td><td><?=$lelohely?></td></tr><?php } ?>
    <?php if(!empty($dok_stat)){ ?><tr><td>Dok stat</td><td><?=$dok_stat?></td></tr><?php } ?>
    <?php if(!empty($megjelenes)){ ?><tr><td>Megjelenés</td><td><?=$megjelenes?></td></tr><?php } ?>
    <?php if(!empty($terjedelem)){ ?><tr><td>Terjedelem</td><td><?=$terjedelem?></td></tr><?php } ?>
    <?php if(!empty($sorozat)){ ?><tr><td>Sorozat</td><td><?=$sorozat?></td></tr><?php } ?>
    <?php if(!empty($kozos_megj)){ ?><tr><td>Közös megj</td><td><?=$kozos_megj?></td></tr><?php } ?>
    <?php if(!empty($peldany_megj)){ ?><tr><td>Példány megj</td><td><?=$peldany_megj?></td></tr><?php } ?>
    <?php if(!empty($isbn)){ ?><tr><td>ISBN</td><td><?=$isbn?></td></tr><?php } ?>
    <?php if(!empty($kotes)){ ?><tr><td>Kötéss</td><td><?=$kotes?></td></tr><?php } ?>
    <?php if(!empty($gyari_szam)){ ?><tr><td>Gyáriszám</td><td><?=$gyari_szam?></td></tr><?php } ?>
    <?php if(!empty($nemzetkozi_azonosito)){ ?><tr><td>Nemzetközi azonositó</td><td><?=$nemzetkozi_azonosito?></td></tr><?php } ?>
    <?php if(!empty($feltuntetett_ar)){ ?><tr><td>Feltüntetett ár</td><td><?=$feltuntetett_ar?></td></tr><?php } ?>
    <?php if(!empty($beszerz_jegyz)){ ?><tr><td>Beszerz jegyz</td><td><?=$beszerz_jegyz?></td></tr><?php } ?>
    <?php if(!empty($beszerz_mod)){ ?><tr><td>Beszerz mód</td><td><?=$beszerz_mod?></td></tr><?php } ?>
    <?php if(!empty($datum)){ ?><tr><td>Dátum</td><td><?=$datum?></td></tr><?php } ?>
    <?php if(!empty($beszerzesi_ar)){ ?><tr><td>Beszerzési ár</td><td><?=$beszerzesi_ar?></td></tr><?php } ?>
    <?php if(!empty($targyszavak)){ ?><tr><td>Targyszavak</td><td><?=$targyszavak?></td></tr><?php } ?>
    <?php if(!empty($eto)){ ?><tr><td>ETO</td><td><?=$eto?></td></tr><?php } ?>
    <?php if(!empty($targyi_mt)){ ?><tr><td>Tárgyi mt</td><td><?=$targyi_mt?></td></tr><?php } ?>
    <?php if(!empty($kozos_spec_adat)){ ?><tr><td>Közös spec adat</td><td><?=$kozos_spec_adat?></td></tr><?php } ?>
    <?php if(!empty($saj_spec_adat)){ ?><tr><td>Saj spec adat</td><td><?=$saj_spec_adat?></td></tr><?php } ?>
    <?php if(!empty($csz)){ ?><tr><td>Csz</td><td><?=$csz?></td></tr><?php } ?>
    <?php if(!empty($nyelv)){ ?><tr><td>Nyelv</td><td><?=$nyelv?></td></tr><?php } ?>
    <?php if(!empty($tipus)){ ?><tr><td>Típus</td><td><?=$tipus?></td></tr><?php } ?>
    <?php if(!empty($gyujtemeny)){ ?><tr><td>Gyűjtemény</td><td><?=$gyujtemeny?></td></tr><?php } ?>
    <?php if(!empty($kiado)){ ?><tr><td>Kiadó</td><td><?=$kiado?></td></tr><?php } ?>
    <?php if(!empty($cserear)){ ?><tr><td>Csereár</td><td><?=$cserear?></td></tr><?php } ?>
    <?php if(!empty($cserear_datuma) && $cserear_datuma != "0000-00-00"){ ?><tr><td>Csereár dátuma</td><td><?=$cserear_datuma?></td></tr><?php } ?>
    <?php /* ?>
    <?php if(!empty($nem_kolcsonzesre)){ ?><tr><td>Nem kölcsönzésre</td><td><?=$nem_kolcsonzesre?></td></tr><?php } ?>
    <?php if(!empty($elveszett_elem)){ ?><tr><td>Eelveszett elem</td><td><?=$elveszett_elem?></td></tr><?php } ?>
    <?php */ ?>
    <?php if(!empty($tartalekok)){ ?><tr><td>Tartalékok</td><td><?=$tartalekok?></td></tr><?php } ?>
    <?php if(!empty($melleklet_1)){ ?><tr><td>Melleklét 1</td><td><?=$melleklet_1?></td></tr><?php } ?>
    <?php if(!empty($melleklet_2)){ ?><tr><td>Melleklét 2</td><td><?=$melleklet_2?></td></tr><?php } ?>
    <?php if(!empty($melleklet_3)){ ?><tr><td>Melleklét 3</td><td><?=$melleklet_3?></td></tr><?php } ?>
    <?php if(!empty($url)){ ?><tr><td>URL</td><td><?=$url?></td></tr><?php } ?>
	</table>

    <?php /*foreach ($query->result() as $row) { die($row->datum); }*/?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Lelőhely</th>
                <!--th>Jelzet</th-->
                <th>Státusz</th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 1; foreach ($query->result() as $row) { ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= empty($row->terem_neve)?"nincs":$row->nev." / ".$row->terem_neve ?></td>
                <!--td><?= empty($row->csz)?"nincs":$row->csz ?></td-->
                <td>
                <?php 
                if(empty($row->datum) || !empty($row->visszahozta)){
                    if($row->nem_kolcsonzesre == "Y"){
                        echo "Helyben olvasható";
                    }else{
                        echo "Kölcsönözhető";
                    }
                }else{
                    echo "Nem kölcsönözhető";                    
                } ?></td>
            </tr>
        <?php $i++; } ?>

        <?php if($query->num_rows() == 0){
        ?>
        <tr>
            <td colspan="3">Nem áll rendelkezésre</td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</section>

</body>
</html>