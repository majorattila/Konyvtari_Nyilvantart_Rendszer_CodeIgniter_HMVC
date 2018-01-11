<link rel="stylesheet" href="<?= base_url() ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">  
<script src="<?= base_url() ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>bower_components/datatables.net/js/jquery.dataTables.js"></script>


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
/*
td{
	width: fit-content;
}
*/
table.dataTable thead .sorting_asc:after {
    content: none !important;
}

.sorting_desc:after {
    content: none !important;
}

#ezaz tbody td{
	max-width: 400px !important;
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
    <?= (isset($_GET['type']) and ($_GET['type'] == 'egyszeru_kereses'))?'class="active"':''?>>
    <a class="search_tab" data-toggle="tab" href="#egyszeru_kereses">Egyszerű keresés</a></li>
    <li id="osszetett_kereses_tab" 
    <?= (isset($_GET['type']) and ($_GET['type'] == 'osszetett_kereses'))?'class="active"':''?>>
    <a class="search_tab" data-toggle="tab" href="#osszetett_kereses">Összetett keresés</a></li>
    <li id="bongeszes_tab" 
    <?= (isset($_GET['type']) and ($_GET['type'] == 'bongeszes'))?'class="active"':''?>>
    <a class="search_tab" data-toggle="tab" href="#bongeszes">Böngészés</a></li>
    <li id="kosar_tartalma_tab" 
    <?= (isset($_GET['type']) and ($_GET['type'] == 'kosar_tartalma'))?'class="active"':''?>>
    <a class="search_tab" data-toggle="tab" href="#kosar_tartalma">Kosár tartalma</a></li>
  </ul>

  <div class="tab-content">

	<div id="egyszeru_kereses" class="tab-pane fade in active"><br/>
		<form action="<?=base_url()?>bibliografiak/view" method="GET">
	       <div class="input-group"> 
	       	<span class="input-group-addon"><span class="hidden-xs">Egyszerű keresés</span><span class="visible-xs">EK</span></span>
	       <div class="input-group-btn radiusless-dropdown">
	            <button type="button" class="btn btn-default dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown">
	                <span id="dropdownfield" data-bind="bs-drp-sel-label">Kulcsszó</span>
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
		    <input name="q" type="text" class="form-control" placeholder="Search">
		    <input name="type" type="hidden" value="egyszeru_kereses"/>
		    <div class="input-group-btn">
		      <button class="btn btn-default" type="submit">
		        <i class="glyphicon glyphicon-search"></i>
		      </button>
		    </div>
	  	  </div>
    	</form>
	</div>

    <div id="osszetett_kereses" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="bongeszes" class="tab-pane fade">

    	<div id="egyszeru_kereses" class="tab-pane fade in active"><br/>
			<form action="<?=base_url()?>bibliografiak/view" method="GET">
		       <div class="input-group"> 
		       	<span class="input-group-addon"><span class="hidden-xs">Böngészés</span><span class="visible-xs">B</span></span>
		       <div class="input-group-btn radiusless-dropdown">
		            <button type="button" class="btn btn-default dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown">
		                <span id="dropdownfield" data-bind="bs-drp-sel-label">Szerző, közreműködő</span>
		                <input type="hidden" name="selected_value" data-bind="bs-drp-sel-value" value="">
		                <span class="caret"></span>
		                <span class="sr-only">Toggle Dropdown</span>
		            </button>
		            <ul class="dropdown-menu" role="menu">
		                <li><a data-value="cim">Szerző, közreműködő</a></li>
		                <li><a data-value="cim">Cím, cím szavai</a></li>
		                <li><a data-value="nev">Tárgyszó</a></li>
		                <li><a data-value="cim">ETO jelzet</a></li>
		            </ul>
		            <input name="filter" type="hidden" value="kulcsszo"/>
		        </div>      	
			    <input name="q" type="text" class="form-control" placeholder="Search">
		        <input name="type" type="hidden" value="bongeszes"/>
			    <div class="input-group-btn">
			      <button class="btn btn-default" type="submit">
			        <i class="glyphicon glyphicon-search"></i>
			      </button>
			    </div>
		  	  </div>
	    	</form>
		</div>

    </div>
    <div id="kosar_tartalma" class="tab-pane fade"><br/>
    	<form id="elofoglalas_torlese_form">
		<table id="ezaz" class="table table-striped" style="width: 100%;">
			<thead>
				<th class="col-xs-2"><span style="display: inline-flex;"><input class="checkAll" type="checkbox">&nbsp;<a class="elofoglalas_torlese" href="javascript:void(0)">Töröl</a></span></th>
				<th class="col-xs-3">Dátum</th>
				<th class="col-xs-3">Szerző</th>
				<th class="col-xs-4">Cím</th>
			</thead>
			<tbody>		
      	<?php
      	//foreach ($elofofglalasok_list->result() as $row) {
      	?>
			<tr>
				<td class="col-xs-2"></td>
				<td class="col-xs-3"></td>
				<td class="col-xs-3"></td>
				<td class="col-xs-4"></td>
			</tr>
      	</tbody>
		</table>
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
			  <th class="col-xs-1"><input class="checkAll" type="checkbox">&nbsp;<a class="elofoglalas" href="javascript:void(0)">Kosár</a></th>
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
			<td><?= $id ?>.</td>	
			<td><input type="checkbox" name="elofoglal(<?= $id ?>)" value="<?= $row->id ?>"></td>
			<td><?= $row->cim ?></td>					
			<td class="tools">
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
				{ "data": "cim" }
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
		    $('#dropdownfield').text(text);
		    $('#dropdownfield').attr('width', 'max-content');
		    $("input[name='filter']").val(data);
		});

		$(document).on('click', '.elofoglalas', function(){
			$('#elofoglalas_form').submit();
			table.ajax.reload();
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
</script>