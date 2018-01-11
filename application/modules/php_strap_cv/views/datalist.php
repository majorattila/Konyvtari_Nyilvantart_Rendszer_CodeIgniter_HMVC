<script >
$(document).ready(function(){
  $("#<?=$name?>").keyup(function(){
    $.get("<?=$url?>", {<?=$data_name?>: $(this).val()}, function(data){
      $("datalist").empty();
      $("datalist").html(data);
    });
  });
});
</script>