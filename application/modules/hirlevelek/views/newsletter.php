<?php

$form_location = base_url()."hirlevelek/hibernate";

if(isset($flash))
{
  echo $flash;
}

?>

<h2>Hírlevél Beállítások</h2><br/>

<div id="error_msg"></div>


      <div class="row">
        <div class="col-md-7 col-xs-12">   
<div class="panel panel-primary">
<div class="panel-heading">Információk</div>
<div class="panel-body">
<p>Itt csak a hírlevélre feliratkozott felhasználók tudják módosítani a feliratkozásukat.
(Ezek a beállítások nincsenek kihatással a felhasználói profilra).</p>
</div>
</div>

<div class="panel panel-default">
<div class="panel-heading lime">Beállítások</div>
<div class="panel-body">

<p style="color: #808080;">*Beállítást csak azután végezhet, miután kitöltötte az Email mezőt!</p>

<form id="user_data" action="<?=$form_location?>" style="display: inline;">

<div class="input-group">
   <input id="email" type="text" class="form-control" name="email" placeholder="Email">
</div>

<h4><a href="javascript:void(0);"" id="unsuscribe">Leiratkozás</a></h4>
<h4>Felhasználói státusz: 
<select id="submit234" name="stat">
  <option value="Y">aktiv</option>
  <option value="N">inaktiv</option>
</select>
</h4>
</form>

</div>
</div>

</div>
<div class="col-md-5 hidden-xs hidden-sm">
<div class="panel panel-danger hidden-xs hidden-sm">
<div class="panel-heading orange">Legfrissebb</div>
  <div class="panel-body">
    <?php $this->hirek->_draw_feed_hp(); ?>
  </div>
</div>
</div>
</div>

<script>
  $("#submit234").change(function(){
  event.preventDefault();
    $.ajax({  
         url:'<?=$form_location?>',  
         method:'POST',  
         data:$('#user_data').serialize(),
         complete:function(data){
              $('#error_msg').html("<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Sikeresen módosította az állapotát!!</div>");
        }  
    });
  });

  $("#unsuscribe").click(function(){
  event.preventDefault();
    $.ajax({  
         url:'<?=base_url()?>hirlevelek/unsuscribe_from_newsletter',  
         method:'POST',  
         data:$('#user_data').serialize(),
         complete:function(data){
              $('#error_msg').html("<div class='alert alert-warning alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Erősítse meg leiratkozási szándékát!!!</div>");
        }  
    });
  });  
</script>