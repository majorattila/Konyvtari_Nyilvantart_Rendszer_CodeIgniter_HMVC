<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>

<script>
  $(document).ready(function() {         
  $('#ajax_datatable').DataTable( { 
    "bDeferRender": true,     
    "sPaginationType": "full_numbers",
    "ajax": {
      "url": "<?=$url?>",
      "type": "GET"
    },          
    "columns": <?=$columns?>,
    "oLanguage": {
            "sProcessing":     "Procesando...",
        "sLengthMenu": '#oldal <select>'+
            '<option value="10">10</option>'+
            '<option value="20">20</option>'+
            '<option value="30">30</option>'+
            '<option value="40">40</option>'+
            '<option value="50">50</option>'+
            /*'<option value="-1">All</option>'+*/
            '</select>',    
        "sZeroRecords":    "Nincs találat",
        "sEmptyTable":     "Nincs adat ebben a táblázatban",
        "sInfo":           "Összesen _TOTAL_ rekord megjelenítése (_START_-_END_)",
        "sInfoEmpty":      "Összesen 0 rekord 0-ról 0-ra mutat",
        "sInfoFiltered":   "(összesen _MAX_ rekordok szűrése)",
        "sInfoPostFix":    "",
        "sSearch":         "szűrő:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Kérjük, várjon - betöltés ...",
        "oPaginate": {
            "sFirst":    "Első",
            "sLast":     "Utolsó",
            "sNext":     "Következő",
            "sPrevious": "Előző"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
        }
  });
});
</script>    


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script> 