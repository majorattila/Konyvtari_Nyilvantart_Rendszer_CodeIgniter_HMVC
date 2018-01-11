<style>
  @media (max-width: 576px) {
    .categories img{
      width: -webkit-fill-available;
    }
  }
  @media (max-width: 576px){
    .categories img {
        max-width: 100%;
    }
  }
  @media (min-width: 576px) and (max-width: 1200px) {
    .row {
      display: inline-grid;
    }
    .cat_menu, .content{
      display: block;
      height: min-content;
    }
  }
</style>

<?php
$this->load->module('weboldalak');
$this->load->module('hirek');

$third_bit = $this->uri->segment(3);
$fourth_bit = $this->uri->segment(4);
?>

<div class="row">
  <div class="categories col-md-7 col-sm-12 content">
    <?php
    if(isset($category_list))
    {
      $this->hirek->_draw_current_news_category("%");
    }
    else if(!$type)
    {
      $this->hirek->_draw_current_news_category($third_bit);
    }
    else
    {      
      $query = $this->hirek->get_where_custom('oldal_url', urldecode($fourth_bit));
      $row = $query->row();
      $oldal_tartalom = $row->oldal_tartalom;
      echo $oldal_tartalom;
    }    
    ?>
  </div>
  <div class="col-md-5 hidden-xs cat_menu">
    <div class="panel panel-default">
      <div class="panel-heading pink">Hírkategóriák</div>
        <div class="panel-body">
            <table class="table table-hover">
          <?php 
          $query_cat = $this->hirek->query_cat();
          foreach ($query_cat->result() as $row) {?>

            <tr class="clickable-row" data-url="<?=base_url().'hirek/kategoriak/'.$row->k_url?>"><td><?= $row->k_neve ?></td></tr>

          <?php } ?>
        </table>
        </div>
      </div>
    </div>

    <div class="hidden-sm hidden-md hidden-lg hidden-xl">
      <div class="text-center" style="font-size: 13pt;">
        <div> <!--this is the container of the links-->
          <?php 
            $query_cat = $this->hirek->query_cat();
            foreach ($query_cat->result() as $row) {?>
              <a class="clickable-row" data-url="<?=base_url().'hirek/kategoriak/'.$row->k_url?>"><?= $row->k_neve ?></a> | 
          <?php } ?>
        </div><br/>
      </div>
    </div>
  </div>
</div>