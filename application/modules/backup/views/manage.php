<?php
$this->load->module('php_strap_cv');
$first_segment = $this->uri->segment(1);
$edit_account_url = "";
?>

<h1>Version Control System (backup)</h1>

<?php
if(isset($flash))
{
	echo $flash;
}
$create_account_url = base_url()."backup/create";
?>
<div id="error_msg"></div>
<p style="margin-top: 30px;">
	<!--a href="<?php echo $create_account_url ?>"--><button type="button" class="btn btn-primary margin" name="mentes">Új adatbázis mentés</button><!--/a-->
  <button type="button" class="btn btn-danger margin" name="kiurites">Adatbázis kiüresítése</button>
	</p>
<div class="row-fluid sortable">		
				<div class="box box-default">
					<div class="box-header with-border">
			          <h3 class="box-title"><i class="fa fa-fw fa-book"></i> Előzmények</h3>

			          <div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
			        </div>
					
					<div class="box-body">
						<table id="myTable" class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
							 	  <th>Dátum</th>
								  <th>Fájl</th>
								  <th class="col-xs-12 col-sm-2 col-md-2 col-lg-2">Műveletek</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  foreach($query->result() as $row){
						  	$edit_account_url = base_url()."backup/create/".$row->id;
							$view_accounts_url = base_url()."backup/view/".$row->id;
						  ?>
							<tr>
								<td data-title="Dátum"><?= $row->datum ?></td>
								<td data-title="Fájl"><?= base_url().'backups/'.$row->fajl_nev.'.sql' ?></td>								
								<td data-title="Műveletek" class="center col-xs-12 col-sm-2 col-md-2 col-lg-2">
									<button name="torles" data-id="<?= $row->id ?>" class="btn btn-primary"><i class="fa fa-fw fa-trash"></i></button>
									<button name="check" data-name="<?= $row->fajl_nev ?>" class="btn btn-primary"><i class="fa fa-fw fa-check"></i></button>
								</td>
							</tr>
							<?php
							}
							?>
						  </tbody>						  
						  <tfoot>
				            <tr>
				              <td colspan="3">
				                <?= $pagination ?>
				              </td>
				            </tr>  
				            <tr>
				              <td colspan="3">
				                <p><?= $showing_statement ?></p>
				              </td>
				            </tr>          
				          </tfoot>
					  </table>            
					</div>
				</div>
			
			</div>

<?php
//Ez itt az adatbázis mentés ablaka

  $fields = array(
    array('label' => 'hidden' ,'name' => 'fiok_id', 'type' => 'hidden', 'value' => $fiok_id),
    array('label' => 'hidden' ,'name' => 'szemelyzet_id', 'type' => 'hidden', 'value' => $szemelyzet_id),
    array('label' => 'hidden' ,'name' => 'datum', 'type' => 'hidden', 'value' => $datum),
    array('label' => 'hidden' ,'name' => 'fajl_nev', 'type' => 'hidden', 'value' => '')
  );
  $ajax_url = base_url().$first_segment."/ajax_api";
  $message = "Sikeres adatbázis mentés!";
  $custom_script = 
  "
  var random_name;

  \$(\"body\").on('click', \"button[name='mentes']\" ,function(){	
  	\$('#loader').hide();
	
  	\$.get('".base_url()."backup/new_file_name/12', function(data, status){
	\$(\"input[name='fajl_nev']\").val(data);	
	random_name = data;	
  	});
	
	datum = getActualFullDate();	
  	\$(\"input[name='datum']\").val(datum);
  	
    \$(\"#add_new_Modal\").removeData('bs.modal').modal({
        backdrop: 'static',
        keyboard: 'true',
        show: 'true'
    });    
    });

    \$('#backup_form').on(\"submit\", function(event){
  	\$(window).on('beforeunload', confirmOnPageExit);
  	

    \$.get('".base_url()."backup/print_last_id', function(data, status){
      \$(\"#myTable > tbody\").prepend('<tr><td>'+datum+'</td><td>".base_url()."database/'+random_name+'.sql</td><td class=\"center\"><button name=\"torles\" data-id=\"'+data+'\" class=\"btn btn-primary\"><i class=\"fa fa-fw fa-trash\"></i></button> <button name=\"check\" data-name=\"'+random_name+'\" class=\"btn btn-primary\"><i class=\"fa fa-fw fa-check\"></i></button> </td></tr>');
    });

	\$('#loader').show();
	\$(\"#add_new_Modal button\").prop('disabled', true);
  });";
  $modal_message = "<h5 style='color: red; display: inline;'>&nbsp;&nbsp;&nbsp;Biztos, hogy szeretné elmenteni az adatbázist?</h5>&nbsp;&nbsp;&nbsp;<img id='loader' src='".base_url()."dist/img/loader.gif' alt='loader' style='height: 20px; display: none;'><br/>";
  $this->php_strap_cv->new_modal("add_new_Modal", "Új Adatbázis mentés", "backup_form", $fields, "mentes", $ajax_url, $message, $custom_script, "", $modal_message, "", "glyphicon glyphicon-save");

  $ajax_url = base_url().$first_segment."/ajax_api/truncate";
  $message = "Sikeresen törölte az adatbázis tartalmát!";
  $modal_message = "<h5 style='color: red; display: inline;'>&nbsp;&nbsp;&nbsp;Biztos, hogy szeretné törölni az adatbázis tartalmát?</h5>&nbsp;&nbsp;&nbsp;<img id='loader3' src='".base_url()."dist/img/loader.gif' alt='loader' style='height: 20px; display: none;'><br/>";
  $custom_script = 
  "
  \$(\"body\").on('click', \"button[name='kiurites']\", function(){

  \$(\"input[name='kiurites']\").val(\$(this).data('id'));
  \$('#loader3').hide();
  
  \$(\"#truncate_Modal\").removeData('bs.modal').modal({
        backdrop: 'static',
        keyboard: 'true',
        show: 'true'
    });   
  });

  \$('#truncate_form').on(\"submit\", function(event){
  \$(window).on('beforeunload', confirmOnPageExit);
  \$('#loader3').show();
  \$(\"#truncate_Modal button\").prop('disabled', true);
  });
  ";
  $this->php_strap_cv->new_modal("truncate_Modal", "Adatbázis tisztítása", "truncate_form", array(), "kiurites", $ajax_url, $message, $custom_script, "", $modal_message, "Visszaállít", "fa fa-fw fa-eraser");

  $fields = array(
    array('label' => 'hidden' ,'name' => 'item', 'type' => 'hidden')
	);
  $ajax_url = base_url().$first_segment."/ajax_api/delete";
  $message = "Az elemet sikeresen eltávolította!";
  $custom_script = 
  "
  var obj;

  \$(\"body\").on('click', \"button[name='torles']\", function(){

  obj = \$(this);
  \$(\"input[name='item']\").val(\$(this).data('id'));
  \$('#loader2').hide();
  
  \$(\"#remove_Modal\").removeData('bs.modal').modal({
        backdrop: 'static',
        keyboard: 'true',
        show: 'true'
    });   
  });

  \$('#delete_form').on(\"submit\", function(event){

  \$(window).on('beforeunload', confirmOnPageExit);

  obj.parent().parent().remove();
  \$('#loader2').show();
  \$(\"#delete_form button\").prop('disabled', true);
  });
  ";
  $modal_message = "<h5 style='color: red; display: inline;'>&nbsp;&nbsp;&nbsp;Biztos, hogy szeretné törölni a mentést?</h5>&nbsp;&nbsp;&nbsp;<img id='loader2' src='".base_url()."dist/img/loader.gif' alt='loader' style='height: 20px; display: none;'><br/>";
  $this->php_strap_cv->new_modal("remove_Modal", "Mentés eltávolítása", "delete_form", $fields, "torles", $ajax_url, $message, $custom_script, "", $modal_message, "Törlés", "glyphicon glyphicon-trash");

  $fields = array(
    array('label' => 'hidden' ,'name' => 'item', 'type' => 'hidden')
	);
  $ajax_url = base_url().'database/import.php';
  $message = "Az adatbázist sikeresen visszaállította!";
  $custom_script = 
  "
  var obj;

  \$(\"body\").on('click', \"button[name='check']\", function(){

	  obj = \$(this);
	  \$(\"input[name='item']\").val(\$(this).data('name'));
	  \$('#loader3').hide();
	  
	  \$(\"#check_Modal\").removeData('bs.modal').modal({
	        backdrop: 'static',
	        keyboard: 'true',
	        show: 'true'
	    });
  });

  \$('#check_form').on(\"submit\", function(event){

  	\$(window).on('beforeunload', confirmOnPageExit);

    \$('#loader3').show();
    \$(\"#check_Modal button\").prop('disabled', true);
  });
  ";
  $modal_message = "<p style='color: #5f5f5f; display: inline; font-size: 15pt;'>Biztos, hogy szeretné visszaállítani az adatbázist?</p>&nbsp;&nbsp;&nbsp;<img id='loader3' src='".base_url()."dist/img/loader.gif' alt='loader' style='height: 25px; display: none;'><br/><br/><span style='color: red; font-size: 12pt;'>FONTOS: A visszaállítás ideje nem lesz elérhető a weboldal. A sikeres visszaállítást követően újból be kell jelentkezni. Ha esetleg hiba lépne fel a folyamat alatt vegye fel a kapcsolatot a weboldal üzemeltetőjével. A visszaállítást követően új bejelentkezés szükséges.</span><br/>";
  $this->php_strap_cv->new_modal("check_Modal", "Adatbázis visszaállítása", "check_form", $fields, "check", $ajax_url, $message, $custom_script, "", $modal_message, "Visszaállít", "glyphicon glyphicon-warning-sign");
?>

<script>
var confirmOnPageExit = function (e) 
{
    // If we haven't been passed the event get the window.event
    e = e || window.event;

    var message = 'Any text will block the navigation and display a prompt';

    // For IE6-8 and Firefox prior to version 4
    if (e) 
    {
        e.returnValue = message;
    }

    // For Chrome, Safari, IE8+ and Opera 12+
    return message;
}

function getActualFullDate() {
    var d = new Date();
    var day = addZero(d.getDate());
    var month = addZero(d.getMonth()+1);
    var year = addZero(d.getFullYear());
    var h = addZero(d.getHours());
    var m = addZero(d.getMinutes());
    var s = addZero(d.getSeconds());
    return year + "-" + month + "-" + day + " " + h + ":" + m + ":" + s;
}

function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
</script>