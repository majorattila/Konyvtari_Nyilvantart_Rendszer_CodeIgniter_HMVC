<style>
li a{
    cursor: pointer;
}
</style>

<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>

<br/><h1><?=$headline?></h1>


<br/><a href="<?=base_url()?>bibliografiak/create_z3950" class="btn btn-info margin">Új szerver hozzáadása</a><br/>
<br/>
<!--form method="get">
    <input type="checkbox"
    name="host[]" value="bagel.indexdata.dk/gils" />
        GILS test
    <input type="checkbox"
    name="host[]" value="localhost:9999/Default" />
        local test
    <input type="checkbox" checked="checked"
    name="host[]" value="z3950.loc.gov:7090/voyager" />
        Library of Congress
    <br />
    RPN Query:
    <input type="text" size="30" name="query" />
    <input type="submit" name="action" value="Search" />
    </form-->
<div class="form-group">
    <div class="input-group">
        <div class="input-group-btn radiusless-dropdown">
                <button type="button" class="btn btn-default dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown">
                    <span id="dropdownfield" data-bind="bs-drp-sel-label"><?=$query->row()->nev?></span>
                    <input type="hidden" name="selected_value" data-bind="bs-drp-sel-value" value="">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <?php foreach ($query->result() as $row): ?>    
                    <li><a data-value="<?=$row->host?>:<?=$row->port?>/<?=$row->adatbazis?>"><?=$row->nev?></a></li>
                    <?php endforeach ?>
                </ul>
                <input name="selected_server" type="hidden" value="<?=$query->row()->host?>:<?=$query->row()->port?>/<?=$query->row()->adatbazis?>"/>
            </div>
        <input name="search" class="form-control" type="text">
        <div class="input-group-btn">
          <button class="btn btn-info" type="submit">
            Keresés <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
    </div>
</div>

<?php if($query->num_rows() != 0) {?>
<br/><table class="table table-hover">
    <thead>
      <tr>
        <th>Név</th>
        <th>Host</th>
        <th>Port</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    	<?php foreach ($query->result() as $row): ?>	
		<tr>
			<td><?=$row->nev?></td>
			<td><?=$row->host?></td>
			<td><?=$row->port?></td>
			<td class="col-xs-1">
				<a class="btn btn-info" href="<?=base_url()?>bibliografiak/create_z3950/<?=$row->id?>"><span class="fa fa-fw fa-pencil"></span></a>
			</td>
		</tr>
    	<?php endforeach ?>    	
	</tbody>
</table>
<?php } ?>

<?php if($query->num_rows() == 0) {?>
<br/><div class="col-xs-8 col-xs-offset-2 text-center">
	<h3><b>Nincsenek az adatbázisban z39.50-es szerverek. Új szervert az <i>"Új szerver hozzáadása"</i> opció alatt tud. (A honosításhoz minimum egy szerver megadása kötelező)</b></h3>
</div>
<?php } ?>

<script>
    $(document).on('click', '.dropdown-menu li a', function() {
        text = $(this).text();
        data = $(this).data("value");
        $('#dropdownfield').text(text);
        $('#dropdownfield').attr('width', 'max-content');
        $("input[name='selected_server']").val(data);
    });
</script>