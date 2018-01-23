<div class="box box-info">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <form method="post" id="quick_email_service">
              <div class="box-body">
                <div class="form-group">
                  <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea name="message" class="textarea" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;" placeholder="Message"></textarea>

                </div>
              </div>
            <div class="box-footer clearfix">
              <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
            </form>
          </div>

<script>
$(document).ready(function(){   
  $('#quick_email_service').on("submit", function(event){  
       event.preventDefault();
        $.ajax({  
             url:"<?= base_url() ?>mail_service/send_email",  
             method:"POST",  
             data:$('#quick_email_service').serialize(),                   
             success:function(data){
                  $('#error_msg').html('<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Az új emailt sikeresen elküldte!</div>');  
                  $('#add_nyelv_Modal').modal('hide');                      
            }  
        });   
    });
});    
</script>
