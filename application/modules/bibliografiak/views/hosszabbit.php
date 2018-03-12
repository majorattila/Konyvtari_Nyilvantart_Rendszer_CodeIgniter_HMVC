<h1><?=$headline?></h1><br/>

<?php
if(isset($flash))
    {
      echo $flash;
    }
?>

<table class="table striped-table">
    <thead>
        <tr>
            <th class="col-xs-1">#</th>
            <th class="col-xs-2">Szerző</th>
            <th class="col-xs-4">Cím</th>
            <th class="col-xs-1">Dátum(tól)</th>
            <th class="col-xs-1">Dátum(ig)</th>
            <th class="col-xs-3">Műveletek</th>
        <tr>
    </thead>
    <tbody>
        <?php 
        $id = 1; 
        if($query->num_rows() > 0){
        foreach ($query->result() as $row) { 
        $hatralevo_napok = date('Y-m-d', strtotime($row->datum. ' + '.$row->hatralevo_napok.' days')) ;
        ?>
        <tr>
            <td data-title="#" class="col-xs-1"><?=$id?>.</td>
            <td data-title="Szerző" class="col-xs-2"><?=$row->szerzo?></td>
            <td data-title="Cím" class="col-xs-4"><?=$row->cim?></td>
            <td data-title="Dátum(tól)" class="col-xs-1"><?=$row->datum?></td>
            <td data-title="Dátum(ig)" class="col-xs-1"><?=$hatralevo_napok?></td>
            <td data-title="Műveletek" class="col-xs-3">
            <?php if(date('Y-m-d') < $hatralevo_napok){?>            
                <span class="badge"><?=date_diff( date_create($row->datum ), date_create($hatralevo_napok))->format("%a nap")?></span>
                <span class="badge"><?=$row->hosszabbit?> h</span>
            <?php } ?>
            <a onClick="newwindow = window.open('<?=base_url()?>bibliografiak/details/<?=$row->leltari_szam?>', '_blank', 'resizable=yes, scrollbars=yes, titlebar=yes, width=600, height=600, top=10, left=10');" href="javascript:void(0);">Részletek</a> | 
            <?php if(date('Y-m-d') < $hatralevo_napok){?>
                <a href="<?=base_url()?>bibliografiak/hosszabbit/<?=$row->leltari_szam?>">Hosszabbítás</a>
            <?php }else if(!empty($row->visszahozta)){ ?>
                <span style="color:green;">Visszahozta</span>
            <?php }else{ ?>
                <span style="color:red;">Lejárt</span>
            <?php } ?>
            </td>
        </tr>
        <?php $id++; }}else{ ?>
        <tr class="text-center"><th colspan="6" style="line-height: 50px; text-align: center;">Nincsenek kölcsönzései...</th></tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
          <td colspan="6">
            <?= $pagination ?>
          </td>
        </tr>  
        <tr>
          <td colspan="6">
            <p><?= $showing_statement ?></p>
          </td>
        </tr>          
      </tfoot>
</table>