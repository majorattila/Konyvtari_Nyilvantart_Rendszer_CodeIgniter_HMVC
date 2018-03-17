<?php
$this->load->helper('text');
?>

  <div id="error_msg"></div>

      <!-- Kezdőlap Tartalma -->
      <div class="row">
        <h1 class="hidden-xl hidden-lg hidden-md hidden-sm text-center">KossuthKönyvtár<hr/></h1>
        <div class="col-md-8 col-xs-12"> 
            <?= Modules::run('hirek/_draw_carousel') ?>
        <br/></div>

        <div class="col-md-4 hidden-xs hidden-sm">
          <div class="panel panel-default hidden-xs">
            <div class="panel-heading lime"># hírek</div>
            <div style="height: 389px;" id="container1"><div id="container2">
            <div class="panel-body">
            <?= Modules::run('hirek/_draw_feed_hp') ?>
            <div style="width:100%; text-align: center;">
            <a href="<?=base_url()?>hirek/kategoriak/10/">További hírek</a>
            </div>
          </div>
        </div></div></div>

        </div>
      </div>
      <div class="row">
        
        <div class="col-md-8 col-xs-12 col-sm-12">
          <?= Modules::run('hirek/_draw_news_and_events_with_pagination') ?>
        </div>        
        <div class="col-md-4 col-xs-12 col-sm-12">
          <?= Modules::run('widgets/_draw_newsletter_register_box') ?>
          
          <div class="panel panel-default hidden-xs">
            <div class="panel-heading pink">Cimkefelhő</div>
              <div class="panel-body">
                <?php 
                $query_cat2 = $this->hirek->query_cat();
                foreach ($query_cat2->result() as $row) {?>

                  <a href="<?=base_url().'hirek/kategoriak/10/0/'.$row->k_url?>"><?= $row->k_neve ?></a> | 

                <?php } ?>
              </div>
            </div>


              <div class="panel panel-default hidden-xs hidden-sm">
                <div class="panel-heading lime">Hirdess velünk</div>
                <div class="panel-body" style="background-color: #000;">
                  <?= Modules::run('widgets/_draw_advertisement') ?>
              </div>
            </div>
          <br/>

          <div id='afscontainer1'></div>
          <!--div id="sky-right">
             <iframe src="//thepiratebay.org/static/si0Eim0u/exo_na/sky2.html" width="160" height="600" frameborder="0" scrolling="no"></iframe>
          </div-->

        </div>
      </div>

<!--footer>
  <div style="border-top: 2px solid #323232;background: linear-gradient(to bottom right, #585858 0%, #b1a775 100%);">
    <div style="
    padding: 20px 15px 20px 15px;
    /* background: url('https://colorlib.com/etc/colid/images/angle-bg.png') no-repeat scroll center bottom / 100% auto; */
    z-index: -1;
    ">
        <h1 style="
    color: #fff;
    margin-bottom: 40px;
    font-weight: bold;
    font-size: 21pt;
">+ Kapcsolat</h1>
      <div class="row" style="
">
        <div class="col-md-3" style="
    color:  #fff;
    font-size: 11pt;
    text-align: right;
">
          <p>Fan? Drop a note.</p>
          <p><span class="glyphicon glyphicon-map-marker"></span> Chicago, US</p>
          <p><span class="glyphicon glyphicon-phone"></span> Phone: +00 1515151515</p>
          <p><span class="glyphicon glyphicon-envelope"></span> Email: mail@mail.com</p>
        </div>
        <div class="col-md-7">
          <div class="row">
            <div class="col-sm-6 form-group">
              <input class="form-control" id="name" name="name" placeholder="Name" type="text" required="">
            </div>
            <div class="col-sm-6 form-group">
              <input class="form-control" id="email" name="email" placeholder="Email" type="email" required="">
            </div>
          </div>
          <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5" style="margin: 0px -1.5625px 0px 0px;/* width: 1125px; */height: 112px;"></textarea>
          <br>
          <div class="row">
            <div class="col-md-12 form-group">
              <button class="btn btn-secondary pull-right" type="submit">Levél elküldése</button>
            </div>
          </div>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
  </div>
</footer-->