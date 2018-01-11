<style type="text/css">
.sort{
	list-style: none;
	border: 1px #aaa solid;
	color: #333;
	padding: 10px;
	margin-bottom: 4px;
	margin-right:40px;
}
</style>

<ul id="sortlist">
<?php
	$this->load->module('navbar');

	foreach($query->result() as $row){
		$alkategoriak_szama = $this->navbar->_alkategoriak_szama($row->id);
		$edit_item_url = base_url()."navbar/create/".$row->id;
		$view_item_url = base_url()."store_accounts/view/".$row->id;
		if($row->szulo_kategoria_id==0){
			$szulo_kategoria_cime = "&nbsp;";
		}else{
			$szulo_kategoria_cime = $this->navbar->_kategoria_cime($row->szulo_kategoria_id);
		}
	?>
	<li class="sort" id="<?=$row->id ?>" style="
	height: 55px; line-height: 35px;"><i class="fa fa-fw fa-sort"></i><?=$row->kategoria_cim ?>

	<?= $szulo_kategoria_cime ?>

	<?php
	
	if($alkategoriak_szama<1)
	{
		echo "&nbsp;";
	}
	else
	{
		if($alkategoriak_szama==1)
		{
			$egyseg = "kategória";
		}
		else
		{
			$egyseg = "kategóriák";
		}
		$alkategoria_url = base_url()."navbar/manage/".$row->id;
	?>
	<a class="btn btn-default" href="<?= $alkategoria_url ?>">
		<i class="fa fa-fw fa-eye"></i> <?php
		echo $alkategoriak_szama." Al".$egyseg;
		?>
	</a>

	<a class="btn btn-info" href="<?= $edit_item_url ?>">
		<i class="fa fa-fw fa-edit"></i>  
	</a>

	<?php
	}
	?>

	</li>
	<?php
	}
	?>
</ul>