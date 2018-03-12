<style>
@media (max-width: 1200px) and (min-width: 576px){
.cat_menu {
    display: grid;
}
</style>


<?php
$this->load->module('weboldalak');
$this->load->module('hirek');

$third_bit = $this->uri->segment(3);
?>

<div class="row">
  <div class="categories col-md-7 col-sm-12 content">
    <?php
      if(empty($third_bit)){?>
      <!--h1>Könyvtáraink</h1><br/-->
      <div class="table100 ver4">
        <table data-vertable="ver4" style="border: 1px solid #d6c1c1; width:100%;">
          <thead>
            <tr class="row100 head">
              <th class="column100 column2" data-column="column2">Név</th>
              <th class="column100 column3" data-column="column3">Cím</th>
              <th class="column100 column4" data-column="column4">Telefon</th>
              <!--th class="column100">Email</th-->
            </tr>
          </thead>
          <tbody>
        <?php foreach ($query_cat->result() as $row) { ?>
            <tr class="row100">
              <td class="column100 column2" data-column="column2" data-title="Név"><?=$row->nev?></td>
              <td class="column100 column3" data-column="column3" data-title="Cím"><?=$row->iranyitoszam?> <?=$row->varos?> <?=$row->cim?></td>
              <td class="column100 column4" data-column="column4" data-title="Telefon"><?=$row->telefon_szam?></td>
              <!--td class="column100"><?=$row->email?></td-->
            </tr>
        <?php } ?>
        </tbody>
        </table>
        </div><br/><br/>
        
      <div class="panel panel-danger">
      <div class="panel-heading sea_blue">Hírek és események</div>
        <div class="panel-body">
          <?php $this->hirek->_draw_news_and_events(); ?>
        </div>
      </div>

        <br/><br/>
      <?php }
      if(!empty($third_bit)){
        foreach ($query->result() as $row) { ?>
      <div class="panel panel-danger">
      <div class="panel-heading sea_blue">Könyvtár Adatai</div>
        <div class="panel-body">
          <h1><?=$row->nev?></h1><br/>
          <p><?=$row->iranyitoszam?> <?=$row->varos?> <?=$row->cim?></p>
          <?php if(!empty($row->telefon_szam)){ ?><p>Tel.: <a href="<?=$row->telefon_szam?>"><?=$row->telefon_szam?></a></p><?php } ?>
          <?php if(!empty($row->fax_szam)){ ?><p>Fax.: <?=$row->fax_szam?></p><?php } ?>
          <?php if(!empty($row->email)){ ?><p>Email: <a href="<?=$row->email?>"><?=$row->email?></a></p><?php } ?>
          <?php if(!empty($row->fiok_megjegyzesek)){ ?><p><?=$row->fiok_megjegyzesek ?></p><?php } ?>
        </div>
      </div>

      <?php if($this->hirek->get_join_with_condition_and_limit("nev",urldecode($third_bit),5,0)->num_rows()>0){ ?>
      <div class="panel panel-danger">
      <div class="panel-heading sea_blue">Információk és Események</div>
        <div class="panel-body">
          <?php $this->hirek->_draw_lib_news_and_events(); ?>
        </div>
      </div>
      <?php } ?>
        <?php } }    
    ?>
  </div>
  <div class="col-md-5 cat_menu">
    <div class="panel panel-default hidden-xs">
      <div class="panel-heading lime">Könyvtáraink (<a style="color: #cffda6;" href="<?=base_url().'konyvtarak/kirendeltseg'?>">Táblázat</a>)</div>
        <div class="panel-body">
            <table class="table table-hover">
          <?php
          foreach ($query_cat->result() as $row) {?>

            <tr class="clickable-row" data-url="<?=base_url().'konyvtarak/kirendeltseg/'.urldecode($row->nev)?>"><td><?= $row->nev ?></td></tr>

          <?php } ?>
        </table>
        </div>
      </div>

      <div class="panel panel-primary hidden-xs">
      <div class="panel-heading">Cimkefelhő</div>
        <div class="panel-body">
          <?php 
          $query_cat2 = $this->hirek->query_cat();
          foreach ($query_cat2->result() as $row) {?>

            <a href="<?=base_url().'hirek/kategoriak/10/0/'.$row->k_url?>"><?= $row->k_neve ?></a> | 

          <?php } ?>
        </div>
      </div>

      <div class="panel panel-danger hidden-xs hidden-sm">
      <div class="panel-heading orange">Legfrissebb</div>
        <div class="panel-body">
          <?php $this->hirek->_draw_feed_hp(); ?>
        </div>
      </div>

    <div class="hidden-sm hidden-md hidden-lg hidden-xl">
      <div class="text-center" style="font-size: 13pt;">
        <div> <!--this is the container of the links-->
          <?php
            foreach ($query_cat->result() as $row) {?>
              <a class="clickable-row" data-url="<?=base_url().'konyvtarak/kirendeltseg/'.urldecode($row->nev)?>"><?= $row->nev ?></a> | 
          <?php } ?>
        </div><br/>
      </div>
    </div>
  </div>
</div>