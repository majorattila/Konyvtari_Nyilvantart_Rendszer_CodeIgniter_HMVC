
<?php //print_r(array_keys(get_defined_vars())); ?>

<form method="post" id="<?=$form_id?>">
  <div id="<?=$modal_id?>" class="modal fade" role="dialog">  
        <div class="modal-dialog">  
            <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title"><span class="<?= isset($modal_icon)&&!empty($modal_icon)?$modal_icon:'fa fa-fw fa-plus'?>"></span> <?=$modal_name?></h4>  
                </div>  
                <div class="modal-body"> 

                <?php if(!empty($modal_message)){ ?>
                <?= $modal_message ?>
                <?php } ?>

                <?php foreach ($fields as $parent_row => $row): ?>
  					
                  <?php if($row['label']!="hidden"){?>
                	<div class="form-group">
                    <label for="<?=$row['name']?>" class="col-sm-4 control-label"><?=$row['label']?></label>
                    <div class="col-sm-8">
                    <?php } ?>
                      <input type="<?=$row['type']?>" name="<?=$row['name']?>" id="<?=$row['name']?>" <?= (isset($row['value']))? "value='".$row['value']."'":"" ?> <?php if($row['type'] == "datalist"){ ?> list="<?=$row['name']?>_list" <?php } ?> class="form-control" autocomplete="off"/>
                      <?php if($row['type'] == "datalist"){ ?>
                        <datalist id="<?=$row['name']?>_list">                          
                        </datalist>
                      <?php } ?><?php if($row['label']!='hidden'){ ?>
                    </div>
  	            </div>
  	            <br/><br/><?php } ?>

                <?php endforeach ?>
              </div>
  		        <div class="modal-footer">
  			        <button type="submit" name="insert" id="insert" value="Insert" class="btn btn-success"><?= isset($button_text)&&!empty($button_text)?$button_text:"Mentés" ?></button>
  			        <button type="button" <?php if($enable_back){?> name="back" <?php } ?> class="btn btn-secondary" data-dismiss="modal">Mégse</button>
  	      		</div>
        	</div>  
      	</div>  
    </div>
  </div>
</form>

<script>
$(document).ready(function(){   
<?php if($custom_script == null){?>
  $("button[name='<?=$action_btn_name?>']").click(function(){
    $('#<?=$form_id?>')[0].reset();
	  $('#<?=$modal_id?>').modal('show');
	});
<?php }else{ echo $custom_script; } ?>
	$('#<?=$form_id?>').on("submit", function(event){  
       event.preventDefault();
        $.ajax({  
             url:"<?=$ajax_url?>",  
             method:"POST",  
             data:$('#<?=$form_id?>').serialize(),                   
             complete:function(data){
                  $('#error_msg').html('<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?=$message?></div>');  
                  $('#<?=$modal_id?>').modal('hide'); 
                  $(window).off('beforeunload');
                  $("button").prop('disabled', false);                    
            }  
        });   
    });
});    
</script>