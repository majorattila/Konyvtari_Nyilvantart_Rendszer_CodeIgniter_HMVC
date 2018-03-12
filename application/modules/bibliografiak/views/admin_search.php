
<h1 style="margin-bottom: 30px;">Online Katalógus</h1>

<?php
$this->load->module("bibliografiak");
echo $this->bibliografiak->_draw_search_toolkit();
?><br/>

<div class="row-fluid sortable">
<?php if(isset($query)){ ?>
<table id="talalatok" class="table table-hover table-bordered">
  <thead>
    <tr>
      <th class="col-xs-1">#</th>
      <th>Leírás</th>
      <th class="col-xs-1"></th>
    </tr>
  </thead>   
  <tbody>
  <?php }
  $id = 1;
  if(isset($query) and !empty($query)){
  foreach($query->result() as $row){
    $more_detais = base_url()."bibliografiak/details/".$row->id;
  ?>
  <tr>
    <td data-title="#"><?= $id ?>.</td> 
    <td data-title="Leírás"><?= $row->cim ?></td>         
    <td data-title="Részletek" class="tools">
      <a onClick="newwindow = window.open('<?= $more_detais ?>', '_blank', 'resizable=yes, scrollbars=yes, titlebar=yes, width=600, height=600, top=10, left=10');" href="javascript:void(0);">Részletek</a>
    </td>
  </tr>
  <?php 
  $id++;
  } if(isset($query)){ ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="4">
        <?= $pagination ?>
      </td>
    </tr>  
    <tr>
      <td colspan="4">
        <p><?= $showing_statement ?></p>
      </td>
    </tr>          
  </tfoot>  
  <?php } }
  if(isset($query) and $query->num_rows() == 0){?>
    <tbody class="text-center">
      <tr>
        <td colspan="4"><b>Sajnos nincs ilyen találat... - Próbálkozzon újból</b></td>
      </tr>
    </tbody>
  <?php } if(isset($query)){ ?>
</table>
<?php } ?>
</div><!--/row-->