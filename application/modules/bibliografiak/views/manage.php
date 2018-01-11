<?php

  if(isset($flash))
  {
    echo $flash;
  }
  ?>

<h1>Bibliográfiák Kezelése</h1><br/>

<a href="<?=base_url()?>bibliografiak/create" class="btn metro-button mtr-teal mtr-round margin">Új Bibliográfia</a>

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
                <th class="col-xs-2 col-md-2 col-lg-2">Leltári Szám</th>
                <th class="col-xs-4 col-md-4 col-lg-4">Cím</th>
                <th class="col-xs-3 col-md-3 col-lg-4">Szerző</th>
                <th class="col-xs-3 col-md-3 col-lg-4">Dátum</th>
                <th class="col-xs-3 col-md-3 col-lg-2">Műveletek</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($query->result() as $row) {?>
            <tr>
                <td class="col-xs-2 col-md-2 col-lg-2"><?=$row->leltari_szam?></td>
                <td class="col-xs-4 col-md-4 col-lg-4"><?=$row->cim?></td>
                <td class="col-xs-3 col-md-3 col-lg-4"><?=$row->nev?></td>
                <td class="col-xs-3 col-md-3 col-lg-4"><?=$row->datum?></td>
                <td class="col-xs-3 col-md-3 col-lg-2">
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