<style>
#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
#sortable li span { position: absolute; margin-left: -1.3em; }
</style>
<!--script src="https://code.jquery.com/jquery-1.12.4.js"></script-->
<!--script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script-->

<h1>Manage Categories</h1>

<?php
if(isset($flash))
{
  echo $flash;
}
$create_item_url = base_url()."navbar/create";
?><p style="margin-top: 30px;">
  <a href="<?php echo $create_item_url ?>"><button type="button" class="btn btn-primary">Add New Category</button></a>
  </p>

<div class="row-fluid sortable">    
        <div class="box box-warning span12" style="min-height: 400px;">
          <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Existing Categories</h2>
            <div class="box-icon">
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
          </div>
          <div class="box-content">

          <?php
          echo Modules::run('navbar/_draw_sortable_list', $szulo_kategoria_id);
          ?>
          </div>
        </div><!--/span-->
      
      </div><!--/row-->
