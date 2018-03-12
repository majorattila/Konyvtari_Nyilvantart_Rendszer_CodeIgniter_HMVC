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
  @media (min-width: 576px) and (max-width: 1000px) {
    .row {
      display: grid;
      width: 100% !important;
      margin-left: 0 !important;
    }
    .feed_hp.row{
      padding-top: 16px !important;
      padding-bottom: 16px !important;
      background: -webkit-gradient(linear, 0% 30%, 100% 0%, from(rgb(255, 255, 255)), color-stop(0.6, rgb(245, 245, 245)), color-stop(1, rgb(235, 235, 235)));/*#e6e6e6*/
      display: inline-block;
    }
    .cat_menu, .content{
      display: block;
      height: min-content;
      width: 100% !important;
    }
  }
</style>

<?php
$this->load->module('weboldalak');
$this->load->module("timedate");
$this->load->module('hirek');

$third_bit = $this->uri->segment(3);
$third_bit = empty($third_bit)?10:$third_bit;
$fourth_bit = $this->uri->segment(4);
$fourth_bit = empty($fourth_bit)?0:$fourth_bit;

$fifth_bit = urldecode($this->uri->segment(5));
$sixth_bit = $this->uri->segment(6);
?>

<div class="row">
  <div class="categories col-md-7 col-sm-12 content">
    
    <?php
    if(isset($category_list))
    {?>

    <div class="panel panel-default">
      <div class="panel-heading lime">Hírek</div>
        <div class="panel-body">

      <?php $this->hirek->_draw_current_news_category("%", $third_bit, $fourth_bit); ?>
    <hr/>
    <?= $pagination ?>
    <p><?= $showing_statement ?></p><br/>
    </div></div>
    <?php }
    else if(!$type)
    {?>

    <ol class="breadcrumb">
      <li><a href="<?=base_url()?>hirek/kategoriak/<?=$third_bit?>/<?=$fourth_bit?>">hirek</a></li>
      <li class="active"><?= $fifth_bit ?></li>
    </ol> 

    <div class="panel panel-default">
      <div class="panel-heading lime">Hírek</div>
        <div class="panel-body">
        
      <?php 
      $this->hirek->_draw_current_news_category($fifth_bit, $third_bit, $fourth_bit);?>
    <hr/>
    <?= $pagination ?>
    <p><?= $showing_statement ?></p><br/>
    </div>
    </div>
    <?php }
    else
    {      
      $query = $this->hirek->get_where_custom('oldal_url', urldecode($sixth_bit));
      $row = $query->row();
      $oldal_tartalom = $row->oldal_tartalom;
      $oldal_cim = $row->oldal_cim;
      $szerzo = $row->szerzo;
      $publikalas_datuma = $row->publikalas_datuma;

      ?>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>hirek/kategoriak/<?=$third_bit?>/<?=$fourth_bit?>">hirek</a></li>
        <li><a href="<?=base_url()?>hirek/kategoriak/<?=$third_bit?>/<?=$fourth_bit?>/<?=$fifth_bit?>"><?= $fifth_bit ?></a></li>
        <li class="active"><?= urldecode(urldecode($sixth_bit)) ?></li>
      </ol>      
      <?php

      echo "<h1>".$oldal_cim."</h1><br/>";
      echo "<p>".$szerzo." <i>(".$this->timedate->get_nice_date($publikalas_datuma, "datepicker_hu").")</i>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' id='print'><i class='glyphicon glyphicon-print'></i></a></p><br/>";
      echo $oldal_tartalom;
    }    
    ?>
              
    </div>
  <div class="col-md-5 hidden-xs cat_menu">
    <div class="panel panel-default">
      <div class="panel-heading pink">Hírkategóriák (<a style="color: #fff;" href="<?=base_url().'hirek/kategoriak/10'?>">összes</a>)</div>
        <div class="panel-body">
            <table class="table table-hover">
          <?php 
          $query_cat = $this->hirek->query_cat();
          foreach ($query_cat->result() as $row) {?>

            <tr class="clickable-row" data-url="<?=base_url().'hirek/kategoriak/10/0/'.$row->k_url?>"><td><?= $row->k_neve ?></td></tr>

          <?php } ?>
        </table>
        </div>
      </div>

      <div class="panel panel-danger hidden-xs hidden-sm">
      <div class="panel-heading orange">Legfrissebb</div>
        <div class="panel-body">
          <?php $this->hirek->_draw_feed_hp(); ?>
        </div>
      </div>
    </div>

    <div class="hidden-sm hidden-md hidden-lg hidden-xl">
      <div class="text-center" style="font-size: 13pt;">
        <div> <!--this is the container of the links-->
          <?php 
            $query_cat = $this->hirek->query_cat();
            foreach ($query_cat->result() as $row) {?>
              <a class="clickable-row" data-url="<?=base_url().'hirek/kategoriak/10/0/'.$row->k_url?>"><?= $row->k_neve ?></a> | 
          <?php } ?>
        </div><br/>
      </div>
    </div>
  </div>

<form id="print_data" method="post" action="<?=base_url()?>hirek/show_in_pdf" target="_blank">
  <input name="title" type="hidden" value="<?=isset($oldal_cim)?$oldal_cim:''?>">
  <input name="content" type="hidden" value="<?=isset($oldal_tartalom)?urlencode($oldal_tartalom):''?>">
</form>

<script>
  $('#print').click(function(){
    $('#print_data').submit();
  });
</script>