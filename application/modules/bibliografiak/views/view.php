<link rel="stylesheet" href="<?= base_url() ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">  
<script src="<?= base_url() ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>bower_components/datatables.net/js/jquery.dataTables.js"></script>


<!--link rel="stylesheet" type="text/css" media="screen" href="http://saman.fszek.hu/WebPac/css/center.css" title="CorvinaWeb Style">
<link rel="stylesheet" type="text/css" href="http://saman.fszek.hu/WebPac/CorvinaWeb?action=advancedsearchpage"-->

<style>
.radiusless-dropdown .btn{
    border-radius: 0;
    margin-right: -1px;
}
input[name="q"]{
	height: min-content;
	/*border-left: 0;*/
}
.input-group-addon{
	height: max-content !important;
}
li a{
    cursor: pointer;
}

th{
	font-weight: initial;
}

#ezaz tbody td{
	max-width: 400px !important;
}

.editor-active{
	text-rendering: auto;
    color: initial;
    letter-spacing: normal;
    word-spacing: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
    display: inline-block;
    text-align: start;
    margin: 0em;
    font: 400 13.3333px Arial;
}

</style>

<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>

<h1 style="margin-bottom: 30px;">Online Katalógus</h1>

<?php
if(isset($flash))
{
	echo $flash;
}
//var_dump($query->result()); die();
$create_account_url = base_url()."Tipusok/create";
?> 

<ul class="nav nav-tabs">
    <li id="egyszeru_kereses_tab" 
    <?= $tab == 'egyszeru_kereses'?'class="active"':''?>>
    <a class="search_tab" data-toggle="tab" href="#egyszeru_kereses">Egyszerű keresés</a></li>
    <li id="osszetett_kereses_tab" 
    <?= $tab == 'osszetett_kereses'?'class="active"':''?>>
    <a class="search_tab" data-toggle="tab" href="#osszetett_kereses">Összetett keresés</a></li>
    <li id="bongeszes_tab" 
    <?= $tab == 'bongeszes'?'class="active"':''?>>
    <a class="search_tab" data-toggle="tab" href="#bongeszes">Böngészés</a></li>
    <?php if($get_user_type === "admin" || $get_user_type === "user"){ ?>
    <li id="kosar_tartalma_tab" 
    <?= $tab == 'kosar_tartalma'?'class="active"':''?>>
    <a class="search_tab" data-toggle="tab" href="#kosar_tartalma">Kosár tartalma</a></li>
    <?php } ?>
  </ul>

  <div class="tab-content">

	<div id="egyszeru_kereses" class="tab-pane fade <?=$tab == 'egyszeru_kereses'?'in active':''?>"><br/>
		<form action="<?=base_url()?>bibliografiak/view/egyszeru_kereses" method="GET">
	       <div class="input-group"> 
	       	<span class="input-group-addon"><span class="hidden-xs">Egyszerű keresés</span><span class="visible-xs">EK</span></span>
	       <div class="input-group-btn radiusless-dropdown">
	            <button type="button" class="btn btn-default dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown">
	                <span class="dropdownfield" data-bind="bs-drp-sel-label">Kulcsszó</span>
	                <input type="hidden" name="selected_value" data-bind="bs-drp-sel-value" value="">
	                <span class="caret"></span>
	                <span class="sr-only">Toggle Dropdown</span>
	            </button>
	            <ul class="dropdown-menu" role="menu">
	                <li><a data-value="kulcsszo">Kulcsszó</a></li>
	                <li><a data-value="nev">Szerző, közreműködő</a></li>
	                <li><a data-value="cim">Cím, cím szavai</a></li>
	                <li><a data-value="targyszavak">Tárgyszó</a></li>
	                <li><a data-value="kiado">Kiadó</a></li>
	                <li><a data-value="rszj">Raktári jelzet</a></li>
	                <li><a data-value="leiras">Adathordozó</a></li>
	                <li><a data-value="url">Internet cím</a></li>
	                <li><a data-value="isbn">ISBN</a></li>
	                <li><a data-value="gyari_szam">Gyáriszám (av)</a></li>
	                <li><a data-value="temacsoport">Témacsoport</a></li>
	                <li><a data-value="megjelenes">Forrásdokumentum</a></li>
	                <li><a data-value="eto">Osztályozás (ETO)</a></li>
	            </ul>
	            <input name="filter" type="hidden" value="kulcsszo"/>
	        </div>      	
		    <input name="q" type="text" value="<?=isset($q)?$q:''?>" class="form-control" placeholder="Search">
		    <div class="input-group-btn">
		      <button class="btn btn-default" type="submit">
		        <i class="glyphicon glyphicon-search"></i>
		      </button>
		    </div>
	  	  </div>
    	</form>
	</div>

    <div id="osszetett_kereses" class="tab-pane fade <?=$tab == 'osszetett_kereses'?'in active':''?>">
	<?php
    $this->load->module("bibliografiak");
    echo $this->bibliografiak->_draw_search_toolkit();
    ?>
    </div>

    <div id="bongeszes" class="tab-pane fade <?=$tab == 'bongeszes'?'in active':''?>"><br/>
		<form action="<?=base_url()?>bibliografiak/view/bongeszes" method="GET">
	       <div class="input-group"> 
	       	<span class="input-group-addon"><span class="hidden-xs">Böngészés</span><span class="visible-xs">B</span></span>
	       <div class="input-group-btn radiusless-dropdown">
	            <button type="button" class="btn btn-default dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown">
	                <span class="dropdownfield" data-bind="bs-drp-sel-label"><?=!empty($terem)?$terem:'Szerző'?>, közreműködő</span>
	                <input type="hidden" name="selected_value" data-bind="bs-drp-sel-value" value="">
	                <span class="caret"></span>
	                <span class="sr-only">Toggle Dropdown</span>
	            </button>
	            <ul class="dropdown-menu" role="menu">
	                <li><a data-value="nev">Szerző, közreműködő</a></li>
	                <li><a data-value="cim">Cím, cím szavai</a></li>
	                <li><a data-value="targyszavak">Tárgyszó</a></li>
	                <li><a data-value="eto">ETO jelzet</a></li>
	            </ul>
	            <input name="filter" type="hidden" value="kulcsszo"/>
	        </div>      	
		    <input name="q" type="text" value="<?=isset($q)?$q:''?>" class="form-control" placeholder="Search">
	        <input name="type" type="hidden" value="bongeszes"/>
		    <div class="input-group-btn">
		      <button class="btn btn-default" type="submit">
		        <i class="glyphicon glyphicon-search"></i>
		      </button>
		    </div>
	  	  </div>
    	</form>

    </div>
    <div id="kosar_tartalma" class="tab-pane fade  <?=$tab == 'kosar_tartalma'?'in active':''?>"><br/>
    	<form id="elofoglalas_torlese_form">
		<table id="ezaz" class="table table-striped" style="width: 100%;">
			<thead>
				<th class="col-xs-2"><span style="display: inline-flex;"><input class="checkAll" type="checkbox">&nbsp;<a class="elofoglalas_torlese" href="javascript:void(0)">Töröl</a></span></th>
				<th class="col-xs-3">Dátum</th>
				<th class="col-xs-3">Szerző</th>
				<th class="col-xs-3">Cím</th>
				<th class="col-xs-1">Részletek</th>
			</thead>
			<tbody>		
      	<?php
      	//foreach ($elofofglalasok_list->result() as $row) {
      	?>
			<tr>
				<td data-title="Töröl" class="col-xs-2"></td>
				<td data-title="Dátum" class="col-xs-3  hidden-xs"></td>
				<td data-title="Szerző" class="col-xs-3"></td>
				<td data-title="Cím" class="col-xs-3"></td>
				<td data-title="Részletek" class="col-xs-1"></td>
			</tr>			
      	</tbody>
		</table>
		<div class="hidden-xl hidden-lg hidden-md hidden-sm">
	     	 <td colspan="4"><b><i>Műveletek:</i></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="checkAll" type="checkbox">&nbsp;<a class="elofoglalas_torlese" href="javascript:void(0)">Törlés</a></td>
	     	</div>
		</form>
    </div>
<br/>
<div class="row-fluid sortable">
	<?php if(isset($query)){ ?>
	<form id="elofoglalas_form" method="post">
	<table id="talalatok" class="table table-hover table-bordered">
	  <thead>
		  <tr>
			  <th class="col-xs-1">#</th>
    		  <?php if($get_user_type === "admin" || $get_user_type === "user"){ ?>
			  <th class="col-xs-1"><input class="checkAll" type="checkbox">&nbsp;<a class="elofoglalas" href="javascript:void(0)">Kosár</a></th>
			  <?php } ?>
			  <th>Leírás</th>
			  <th class="col-xs-1"></th>
		  </tr>
	  </thead>   
	  <tbody>
	  <?php }
	  $id = 1;
	  if(isset($query) and !empty($query)){
	  foreach($query->result() as $row){
	  	$more_detais = base_url()."bibliografiak/details/".$row->id;
	  ?>
		<tr>
			<td data-title="#"><?= $id ?>.</td>	
    		<?php if($get_user_type === "admin" || $get_user_type === "user"){ ?>
			<td data-title="Kosár"><input type="checkbox" name="elofoglal(<?= $id ?>)" value="<?= $row->id ?>"></td>
			<?php } ?>
			<td data-title="Leírás"><?= $row->cim ?></td>					
			<td data-title="Részletek" class="tools">
				<a onClick="newwindow = window.open('<?= $more_detais ?>', '_blank', 'resizable=yes, scrollbars=yes, titlebar=yes, width=600, height=600, top=10, left=10');" href="javascript:void(0);">Részletek</a>
			</td>
		</tr>
		<?php 
		$id++;
		} if(isset($query)){ ?>
	  </tbody>
	  <tfoot>
        <tr>
          <td colspan="4">
            <?= $pagination ?>
          </td>
        </tr>  
        <tr>
          <td colspan="4">
            <p><?= $showing_statement ?></p>
          </td>
	     <tr class="hidden-xl hidden-lg hidden-md hidden-sm">
	     	 <td colspan="4"><b><i>Műveletek:</i></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="checkAll" type="checkbox">&nbsp;<a class="elofoglalas" href="javascript:void(0)">Kosár</a></td>
	     </tr>
        </tr>          
      </tfoot>  
      <?php } }
      if(isset($query) and $query->num_rows() == 0){?>
      	<tbody class="text-center">
		    <tr>
		    	<td colspan="4"><b>Sajnos nincs ilyen találat... - Próbálkozzon újból</b></td>
		    </tr>
	    </tbody>
	  <?php } if(isset($query)){ ?>
  </table>
  </form>
  <?php } ?>
</div><!--/row-->
</div>


<script>
    $(document).ready(function(){
		var table = $('#ezaz').DataTable( {	
			"bDeferRender": true,			
			"sPaginationType": "full_numbers",
			"ajax": {
				"url": "<?=base_url() . 'bibliografiak/get_elofoglalasok_to_datatable'?>",
	        	"type": "GET"
			},					
			"columns": [
				{ "data": "actions" },
				{ "data": "datum" },
				{ "data": "nev" },
				{ "data": "cim" },
				{ "data": "reszletek" }
				],
			"oLanguage": {
	            "sProcessing":     "Folyamatban...",
			    "sLengthMenu": '<select>'+
			        '<option value="10">10</option>'+
			        '<option value="20">20</option>'+
			        '<option value="30">30</option>'+
			        '<option value="40">40</option>'+
			        '<option value="50">50</option>'+
			        '<option value="-1">All</option>'+
			        '</select> rekord',    
			    "sZeroRecords":    "Nincs találat",
			    "sEmptyTable":     "Nincs adat ebben a táblázatban",
			    "sInfo":           "Összesen (_START_ - _END_) rekord megjelenítése a(z) _TOTAL_ rekordból",
			    "sInfoEmpty":      "Megjelenítve 0 a(z) 0 összesen 0 rekordból",
			    "sInfoFiltered":   "(összesen _MAX_ találat)",
			    "sInfoPostFix":    "",
			    "sSearch":         "keresés:",
			    "sUrl":            "",
			    "sInfoThousands":  ",",
			    "sLoadingRecords": "Kérjük, várjon - betöltés ...",
			    "oPaginate": {
			        "sFirst":    "Első",
			        "sLast":     "Utolsó",
			        "sNext":     "Következő",
			        "sPrevious": "Előzző"
			    },
			    "oAria": {
			        "sSortAscending":  ": Aktiválja az oszlop növekvő sorrendjét",
			        "sSortDescending": ": Aktiváld az oszlopot csökkenő sorrendben"
			    }
	        }
		});

		$('#ezaz').on( 'change', 'input.editor-active', function () {
	        editor
	            .edit( $(this).closest('tr'), false )
	            .set( 'active', $(this).prop( 'checked' ) ? 1 : 0 )
	            .submit();
	    } );
/*
		setInterval( function () {
		    table.ajax.reload();
		}, 3000 );
*/
		$(document).on('click', '.elofoglalas_torlese', function(){			
			$('#elofoglalas_torlese_form').submit();
			table.ajax.reload();
			$('input:checkbox').not(this).prop('checked', false);
		});
	    $('#elofoglalas_torlese_form').on("submit", function(event){  
	       event.preventDefault();
	        $.ajax({  
	             url:"<?= base_url() ?>bibliografiak/elofoglalas_torlese",  
	             method:"POST",  
	             data:$('#elofoglalas_torlese_form').serialize(),                   
	             success:function(data){}  
	        });
	        table.ajax.reload();
	    });

	    $(document).on('click','.search_tab',function(){
	    	table.ajax.reload();
	    	$('#talalatok').fadeOut();
	    });

	    $(document).on('click','#egyszeru_kereses_tab',function(){
	    	$('#talalatok').fadeIn();
	    });

	    $(document).on('click','#osszetett_kereses_tab',function(){
	    	$('#talalatok').fadeIn();
	    });

	    $(document).on('click','#bongeszes_tab',function(){
	    	$('#talalatok').fadeIn();
	    });

	    $(document).on('click', '.dropdown-menu li a', function() {
		    text = $(this).text();
		    data = $(this).data("value");
		    $('.dropdownfield').text(text);
		    $('.dropdownfield').attr('width', 'max-content');
		    $("input[name='filter']").val(data);
		});

		$(document).on('click', '.elofoglalas', function(){
			$('#elofoglalas_form').submit();
			//table.ajax.reload();
			$('input:checkbox').not(this).prop('checked', false);
		});
		$('#elofoglalas_form').on("submit", function(event){  
	       event.preventDefault();
	        $.ajax({  
	             url:"<?= base_url() ?>bibliografiak/elofoglalas",  
	             method:"POST",  
	             data:$('#elofoglalas_form').serialize(),                   
	             success:function(data){}  
	        });
	        table.ajax.reload();
	    });

	    $(".checkAll").click(function(){
		    $('input:checkbox').not(this).prop('checked', this.checked);
		});
	});

    $(document).ready(function(){
      $('.pagination a').click(function(){
        var url = $(this).attr('href');
        var filter = "<?= isset($_GET['filter'])?$_GET['filter']:'' ?>";
        var q = "<?= isset( $_GET['q'])?$_GET['q']:'' ?>";
        var add_filter = 'filter='+filter;
        var add_q = 'q='+q;
        var add_variables = "";

        /*
        if(add_filter!='filter=' && add_q!='q='){
          add_variables += '?'+add_filter+'&'+add_q;
        }else if(add_filter!='filter='){
          add_variables += '?'+add_filter;
        }else if(add_q!='q='){
          add_variables += '?'+add_q;
        }
        */

      if(<?= (isset($_GET['filter'])||isset($_GET['q']))?"true":"false" ?>){
        add_variables += '?'+add_filter+'&'+add_q
      }

        $(this).attr('href',url+add_variables);
      });
    });
</script>