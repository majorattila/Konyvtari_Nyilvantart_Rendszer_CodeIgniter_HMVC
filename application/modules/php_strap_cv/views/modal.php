
<?php //print_r(array_keys(get_defined_vars())); ?>

<form method="post" id="<?=$form_id?>">
  <div id="<?=$modal_id?>" class="modal fade">  
        <div class="modal-dialog">  
            <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title"><span class="fa fa-fw fa-plus"></span> <?=$modal_name?></h4>  
                </div>  
                <div class="modal-body"> 

                <?php foreach ($fields as $parent_row => $row): ?>
  					
                	<div class="form-group">
                    <label for="<?=$row['name']?>" class="col-sm-4 control-label"><?=$row['label']?></label>
                    <div class="col-sm-8">
                      <input type="<?=$row['type']?>" name="<?=$row['name']?>" id="<?=$row['name']?>" <?php if($row['type'] == "datalist"){ ?> list="<?=$row['name']?>_list" <?php } ?> class="form-control" autocomplete="off"/>
                      <?php if($row['type'] == "datalist"){ ?>
                        <datalist id="<?=$row['name']?>_list">                          
                        </datalist>
                      <?php } ?>
                    </div>
  	            </div>
  	            <br/><br/>

                <?php endforeach ?>
              </div>
  		        <div class="modal-footer">
  			        <button type="submit" name="insert" id="insert" value="Insert" class="btn btn-success">Mentés</button>
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
             success:function(data){
                  $('#error_msg').html('<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?=$message?></div>');  
                  $('#<?=$modal_id?>').modal('hide');                      
            }  
        });   
    });
});    
</script>