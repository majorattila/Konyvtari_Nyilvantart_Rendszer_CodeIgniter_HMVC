<?php
$this->load->module("hirek");
?>

<div class="panel panel-default">
<div class="panel-heading sea_blue">Hírek és események</div>
  <div class="panel-body">

<?php 
$this->hirek->_draw_current_news_category("%"); ?>
<hr/>
<?= $pagination ?>
<p><?= $showing_statement ?></p><br/>
</div>
</div>

<script>
  $(document).ready(function(){
    $('.pagination a').each(function (index, value) {    
      $(this).attr("href", "hirek/kategoriak/10/"+ ($(this).attr("href")).replace("<?=base_url()?>",""));
    });
  });
</script>