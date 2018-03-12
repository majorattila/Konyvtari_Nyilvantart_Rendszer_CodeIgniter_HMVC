<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Honosítás</title>
    <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?=base_url()?>bower_components/bootstrap/dist/js/popper.js"></script>
    <script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
    $form_location = base_url()."bibliografiak/honositas_kereso";
    ?>
    <form target="print_popup" action="<?=$form_location?>" method="post" onsubmit="window.open('about:blank','print_popup','width=1000,height=450');">
        <section class="container">
        
            <h4>Honosítás</h4><hr/>

            <div class="row">

                <div class="form-actions" style="margin-left: 15px;">
                  <button type="submit" class="btn btn-lg btn-success" name="submit" value="Submit" disabled="disabled">Keresés</button>
                  <button type="button" onclick="self.close()" class="btn btn-lg">Mégse</button>
                </div><hr/>

                <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label for="szempont1">Szempont:</label>
                      <select name = "szempont1" class="form-control" id="szempont1">
                        <option value="nev" value="nev">Szerző, közreműködő</option>
                        <option value="cim" value="cim">Cím, cím szavai</option>
                        <option value="targyszavak" value="targyszavak">Tárgyszó</option>
                        <option value="datum" value="datum">Dátum</option>
                        <option value="kiado">Kiadó</option>
                        <option value="leiras">Adathordozó</option>
                        <option selected value="isbn">ISBN</option>
                        <option value="eto">Osztályozás (ETO)</option>
                      </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="kriterium1">Kritérium:</label>
                    <input name="kriterium1" class="form-control" id="kriterium1" type="text">
                </div>                
                <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label for="kapcsolat1">Kapcsolat:</label>
                      <select name = "kapcsolat1" class="form-control" id="kapcsolat1">
                        <option selected value="es">ÉS</option>
                        <option value="vagy">VAGY</option>
                        <option value="esnem">ÉSNEM</option>
                      </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label for="formatum">Formátum:</label>
                      <select name = "formatum" class="form-control" id="formatum">
                        <option value="usmarc" selected>USMARC</option>
                        <option value="mab">MAB</option>
                      </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label for="szempont2">Szempont:</label>
                      <select name = "szempont2" class="form-control" id="szempont2">
                        <option value="nev">Szerző, közreműködő</option>
                        <option selected value="cim">Cím, cím szavai</option>
                        <option value="targyszavak">Tárgyszó</option>
                        <option value="datum">Dátum</option>
                        <option value="kiado">Kiadó</option>
                        <option value="leiras">Adathordozó</option>
                        <option value="isbn">ISBN</option>
                        <option value="eto">Osztályozás (ETO)</option>
                      </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="kriterium2">Kritérium:</label>
                    <input name="kriterium2" class="form-control" id="kriterium2" type="text">
                </div>                
                <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label for="kapcsolat2">Kapcsolat:</label>
                      <select name = "kapcsolat2" class="form-control" id="kapcsolat2">
                        <option selected value="es">ÉS</option>
                        <option value="vagy">VAGY</option>
                        <option value="esnem">ÉSNEM</option>
                      </select>
                    </div>
                </div>                
                <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label for="szerver">Szerver:</label>
                      <select name = "szerver" class="form-control" id="szerver">
                        <?php $id = 0; foreach ($query_z3950->result() as $row): $id++;?>                          
                            <option <?php if($id == 1){ echo "selected"; } ?> ><?=$row->nev?></option>                        
                        <?php endforeach ?>
                      </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label for="szempont3">Szempont:</label>
                      <select name = "szempont3" class="form-control" id="szempont3">
                        <option value="nev">Szerző, közreműködő</option>
                        <option value="cim">Cím, cím szavai</option>
                        <option value="targyszavak">Tárgyszó</option>
                        <option selected value="datum">Dátum</option>
                        <option value="kiado">Kiadó</option>
                        <option value="leiras">Adathordozó</option>
                        <option value="isbn">ISBN</option>
                        <option value="eto">Osztályozás (ETO)</option>
                      </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="kriterium3">Kritérium:</label>
                    <input name="kriterium3" class="form-control" id="kriterium3" type="text">
                </div>                
                <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label for="kapcsolat3">Kapcsolat:</label>
                      <select name = "kapcsolat3" class="form-control" id="kapcsolat3">
                        <option selected value="es">ÉS</option>
                        <option value="vagy">VAGY</option>
                        <option value="esnem">ÉSNEM</option>
                      </select>
                    </div>
                </div>
                <div class="hidden-xs col-sm-3">
                    <a class="btn btn-primary" onClick="self.close(); newwindow = window.open('<?=base_url()?>bibliografiak/manage_z3950', '', '');" href="javascript:void(0);">z39.50 szerverek</a>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label for="szempont4">Szempont:</label>
                      <select name = "szempont4" class="form-control" id="szempont4">
                        <option selected value="nev">Szerző, közreműködő</option>
                        <option value="cim">Cím, cím szavai</option>
                        <option value="targyszavak">Tárgyszó</option>
                        <option value="datum">Dátum</option>
                        <option value="kiado">Kiadó</option>
                        <option value="leiras">Adathordozó</option>
                        <option value="isbn">ISBN</option>
                        <option value="eto">Osztályozás (ETO)</option>
                      </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="kriterium4">Kritérium:</label>
                    <input name="kriterium4" class="form-control" id="kriterium4" type="text">
                </div>                
                <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label for="kapcsolat4">Kapcsolat:</label>
                      <select name = "kapcsolat4" class="form-control" id="kapcsolat4">
                        <option selected value="es">ÉS</option>
                        <option value="vagy">VAGY</option>
                        <option value="esnem">ÉSNEM</option>
                      </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3"></div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label for="szempont5">Szempont:</label>
                      <select name = "szempont5" class="form-control" id="szempont5">
                        <option value="nev">Szerző, közreműködő</option>
                        <option value="cim">Cím, cím szavai</option>
                        <option value="targyszavak">Tárgyszó</option>
                        <option value="datum">Dátum</option>
                        <option selected value="kiado">Kiadó</option>
                        <option value="leiras">Adathordozó</option>
                        <option value="isbn">ISBN</option>
                        <option value="eto">Osztályozás (ETO)</option>
                      </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="kriterium5">Kritérium:</label>
                    <input name="kriterium5" class="form-control" id="kriterium5" type="text">
                </div>                
                <div class="col-xs-12 col-sm-3"><br/>
                </div>
            </div>            
        </form>
    </section>

    <script>
        $(document).ready(function() {
            $('input').keyup(function() {

                var empty = false;
                if ($(this).val().length == 0) {
                    empty = true;
                }

                if (empty) {
                    $('button[type="submit"]').attr('disabled', 'disabled');
                } else {
                    $('button[type="submit"]').removeAttr('disabled');
                }
            });
        });
    </script>

</body>
</html>