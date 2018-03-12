<?php
$this->load->module('php_strap_cv');

  if(isset($flash))
  {
    echo $flash;
  }
  ?>

<h1>Bibliográfiák Kezelése</h1><br/>

<a href="<?=base_url()?>bibliografiak/create" class="btn btn-primary margin">Új Bibliográfia</a>
<!--a href="<?=base_url()?>bibliografiak/truncate" class="btn btn-warning margin">Kiürítés</a-->
<button name="truncate" class="btn btn-warning margin">Kiürítés</button>

<?php
$form_location = base_url().'bibliografiak/manage/20';
?>
<form action="<?=$form_location?>" method="get">
<div class="row-fluid sortable">
  <div class="box box-default">
    <div class="box-header with-border" data-original-title>
    <h3 class="box-title"><i class="fa fa-fw fa-search"></i> Keresés</h3> <a href="<?=base_url()?>bibliografiak/manage/20"><i class="fa fa-fw fa-close"></i></a>
      <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
    </div>
    <div class="box-body">      
      <div class="col-xs-12 col-sm-6">
        <div class="input-group">         
          <span class="input-group-addon hidden-xs">Keresés</span>
                  <input name="keres" type="text" value="<?=$keres?>" class="form-control" autocomplete="off">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Keresés!</button>
                    </span>
                </div>
      </div><br class="visible-xs"/><br class="visible-xs"/>
      <div class="col-xs-12 col-sm-6">
        <div class="input-group">
          <span class="input-group-addon hidden-xs">Rendezés</span>
          <select id="rendez" name="rendez" class="selectpicker form-control" data-live-search="true" title="leltrái szám">
                    <option value="leltari_szam" <?=($rendez=="leltari_szam")?'selected':''?>>leltári szám</option>
                    <option value="cim" <?=($rendez=="cim")?'selected':''?>>cím</option>
                    <option value="nev" <?=($rendez=="nev")?'selected':''?>>szerző</option>
                    <option value="megjelenes" <?=($rendez=="megjelenes")?'selected':''?>>megjelenés</option>
                </select>
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat btn_rendez">Rendez!</button>
                    </span>
            </div>
      </div>
    </div>
  </div>
</div>
</form>

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Bibliográfiák</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-12">
        
        <table id="myTable" class="table table-striped table-bordered">          
          <thead>
            <tr>
                <th class="col-xs-12 col-sm-2 col-md-2 col-lg-2">Leltári Szám</th>
                <th class="col-xs-12 col-sm-4 col-md-4 col-lg-5">Cím</th>
                <th class="col-xs-12 col-sm-3 col-md-3 col-lg-3">Szerző</th>
                <th class="col-xs-12 col-sm-3 col-md-3 col-lg-4">Megjelenés</th>
                <th class="col-xs-12 col-sm-3 col-md-3 col-lg-2">Műveletek</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($query->result() as $row) {?>
            <tr>
                <td data-title="Leltári Szám" class="col-xs-12 col-sm-2 col-md-2 col-lg-2"><?=$row->leltari_szam?></td>
                <td data-title="Cím" class="col-xs-12 col-sm-4 col-md-4 col-lg-5"><?=$row->cim?></td>
                <td data-title="Szerző" class="col-xs-12 col-sm-3 col-md-3 col-lg-3"><?=$row->nev?></td>
                <td data-title="Megjelenés" class="col-xs-12 col-sm-3 col-md-3 col-lg-4"><?=$row->megjelenes?></td>
                <td data-title="Műveletek" class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                  <div class="btn-group" style="width: max-content;">
                    <a href="<?=base_url()?>bibliografiak/create/<?=$row->id?>" class="btn btn-primary"><span class="fa fa-fw fa-edit"></span></a>   
                    <a onClick="newwindow = window.open('<?=base_url()?>bibliografiak/details/<?=$row->id?>', '_blank', 'resizable=yes, scrollbars=yes, titlebar=yes, width=600, height=600, top=10, left=10');" href="javascript:void(0);" class="btn btn-primary"><span class="fa fa-fw fa-eye"></span></a>
                  </div>
                </td>
            </tr>
            <?php
            }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="5">
                <?= $pagination ?>
              </td>
            </tr>  
            <tr>
              <td colspan="5">
                <p><?= $showing_statement ?></p>
              </td>
            </tr>          
          </tfoot>
        </table>

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.box-body -->
</div>


<?php
$fields = array();
$ajax_url = base_url()."bibliografiak/truncate";
$message = "Az elemet sikeresen eltávolította!";
$modal_message = "<h5 style='color: red; display: inline;'>&nbsp;&nbsp;&nbsp;Biztos, hogy szeretné törölni az adatokat?</h5>&nbsp;&nbsp;&nbsp;<img id='loader3' src='".base_url()."dist/img/loader.gif' alt='loader' style='height: 20px; display: none;'><br/>";
$custom_script = 
  "\$(\"button[name='truncate']\").click(function(){
    \$('#loader3').hide();
    \$(\"#truncate_Modal\").modal(\"show\");
  });
  \$('#truncate_form').on(\"submit\", function(event){
    \$('#loader3').show();
    \$('tbody').empty();
  });";
  $this->php_strap_cv->new_modal("truncate_Modal", "Adatok törlése", "truncate_form", $fields, "truncate", $ajax_url, $message, $custom_script, "", $modal_message, "Törlés", "glyphicon glyphicon-trash");
?>