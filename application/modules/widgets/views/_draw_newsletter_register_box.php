<div class="panel panel-danger hidden-xs hidden-sm">
<div class="panel-heading orange"><a href="<?=base_url()?>hirlevelek/settings" style="color: #7d2900; font-size: 14pt;"><i class="glyphicon glyphicon-cog"></i></a> <span>Feliratkozás Hírlevélre</span></div>
<div class="panel-body">
<?php
$form_location = base_url()."hirlevelek/subscribe_to_newsletter";
?>
<form id="reg_data" method="post" actionn="<?=$form_location?>">
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
    <input id="email" type="text" class="form-control" name="email" placeholder="Email">
    <span class="input-group-btn">
    <button class="btn btn-secondary" type="button" id="submit234">Go!</button>
    </span>
  </div>
</form>
</div>
</div>

<script>
	$("#submit234").click(function(){
	event.preventDefault();
    $.ajax({  
         url:'<?=$form_location?>',  
         method:'POST',  
         data:$('#reg_data').serialize(),
         complete:function(data){
              $('#error_msg').html("<div class='alert alert-warning alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Igazolja vissza a feliratkozást!</div>");
        }  
    });
  });
</script>