<?php
$this->load->helper('text');
/*
echo anchor('fiok/start','Create Account');
echo nbs(7);
echo anchor('fiok/login','Login');
echo Modules::run('homepage_blocks/_draw_blocks');
*/
?>
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-8 col-xs-12 hidden-xs">          
          <?= Modules::run('hirek/_draw_carousel')/*_draw_feed_hp*/ ?>
        </div>
        <div class="col-md-4 hidden-xs hidden-sm">
          <?= Modules::run('hirek/_draw_feed_hp')/*_draw_feed_hp*/ ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-xs-12 col-sm-12">
          <h1>Hírek és rendezvények</h1><br/>
          <?= Modules::run('hirek/_draw_news_and_events')/*_draw_feed_hp*/ ?>
        </div>        
        <div class="col-md-4"></div>
      </div>
    </div>
          <script>
          /*
          <h2>Heading</h2>
          <a href="http://localhost/cishop/musical/instrument/BC-Rich-Warlock-Neck-Through-with-Floyd-Rose-and-Dimarzios-Electric-Guitar5">CLICK HERE</a>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
      </div>
    </div>
  */
  </script>