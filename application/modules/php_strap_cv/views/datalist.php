<script >
$(document).ready(function(){
  $("#<?=$name?>").keyup(function(){
    $.get("<?=$url?>", {<?=$data_name?>: $(this).val()}, function(data){
      $("datalist#<?=$data_name?>").empty();
      $("datalist#<?=$data_name?>").html(data);
    });
  });
});
</script>