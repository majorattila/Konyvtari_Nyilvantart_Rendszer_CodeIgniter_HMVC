<?php
$this->load->module('hirek');
$this->load->helper('text');
?>

<style>
  @media (max-width: 576px) {
    .feed_hp.row img{
      width: -webkit-fill-available;
    }
  }
  @media (max-width: 576px){
    .categories img {
        max-width: 100%;
    }
  }
  @media (min-width: 576px) and (max-width: 991px) {
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
    #box{
      margin-top: 0px !important;
    }
  }
  #box{
    margin-top: -127px;
  }
</style>

    <!--div class="container"-->
      <!-- Kezdőlap Tartalma -->
      <div class="row">
        <div class="col-md-7 col-xs-12">          
          <?= Modules::run('hirek/_draw_about_us') ?>
        </div>
          
          <div class="col-md-5 hidden-xs cat_menu" id="box">
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
      <!--/div-->