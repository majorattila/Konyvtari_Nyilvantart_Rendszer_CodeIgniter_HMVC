<style>
/*
  body{
    background-image:url("<?=base_url()?>dist/img/background/reg_panel.jpg");
    background-size:cover;
    background-repeat: no-repeat;
  }
  */
  /*
  h1{    
    font-family: 'Expletus Sans';
    text-transform: uppercase;
    font-weight: bold;
  }
  */
  /*
  footer{
    position: fixed;
    bottom: 0;
  }
  */
  #reg_panel{
    margin: 0 auto;
    float: none;
  }
  .panel-ocean{
    border-radius: 0px;
    border: 1px solid #b0b6bb;
  }
  .panel-ocean .panel-heading{
    color: #808080 !important
    font-family: 'Open Sans Light';
    background-color: #eaeaea;
    border-radius: 0px;
  }
  .btn{    
    font-family: Open Sans !important;
    border-radius: 0px;
  }
  .btn-primary{
    border: 1px solid #392ff9;
    background-color: #0770fe;
  }
  .btn-primary:hover{
    background-color: #0457C8;
  }
  .btn-secondary{
    border: 1px solid #c5c5c5;
    color: #000;
  }
  .btn-secondary:hover{
    color: #000;
    background-color: #BEBEBE;
  }
  #reg_panel h1{
    color: #0a52a9;
  }
  textarea,
  input[type="text"],
  input[type="password"],
  input[type="datetime"],
  input[type="datetime-local"],
  input[type="date"],
  input[type="month"],
  input[type="time"],
  input[type="week"],
  input[type="number"],
  input[type="email"],
  input[type="url"],
  input[type="search"],
  input[type="tel"],
  input[type="color"],
  .uneditable-input {
    border-radius: 0px;
  }
  textarea:focus,
  input[type="text"]:focus,
  input[type="password"]:focus,
  input[type="datetime"]:focus,
  input[type="datetime-local"]:focus,
  input[type="date"]:focus,
  input[type="month"]:focus,
  input[type="time"]:focus,
  input[type="week"]:focus,
  input[type="number"]:focus,
  input[type="email"]:focus,
  input[type="url"]:focus,
  input[type="search"]:focus,
  input[type="tel"]:focus,
  input[type="color"]:focus,
  .uneditable-input:focus {   
    border-color: #0a52a9 !important;
    box-shadow: none !important;
    outline: 0 none;
}
#reg_panel .lightgrey{
  font-size: 10pt;
  font-family: Open Sans Light !important;
  color: #000 !important;  
}
</style>

<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

<?php
$form_location = base_url().'fiok/submit';
?>
<br/>
<div id="reg_panel" class="col-xs-12 col-sm-11 col-md-9 col-lg-7 col-xl-5">
<div class="panel panel-ocean">
  <div class="panel-heading">INGYENES REGISZTRÁCIÓ</div>
  <div class="panel-body">

  <!--h1 class="text-center">Regisztráció</h1><br/-->

<?php
echo validation_errors("<p style='color:red'>","</p>");
?>

<form method="POST" action="<?=$form_location?>">
<fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="control-label" for="vezeteknev"><span class="lightgrey">Vezetéknév</span> <span class="required"></span></label>  
  <input id="vezeteknev" name="vezeteknev" value="<?=$vezeteknev?>" type="text" class="form-control input-md" required>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="control-label" for="keresztnev"><span class="lightgrey">Keresztnév</span> <span class="required"></span></label>  
  <input id="keresztnev" name="keresztnev" value="<?=$keresztnev?>" type="text" class="form-control input-md" required>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="control-label" for="username1"><span class="lightgrey">Felhasználónév</span> <span class="required"></span></label>  
  <input id="username1" name="username1" value="<?=$username1?>" type="text" class="form-control input-md" required minlength="7">
</div>

<!-- Text input-->
<div class="form-group">
  <label class="control-label" for="email"><span class="lightgrey">E-mail</span> <span class="required"></span></label>  
  <input id="email" name="email" value="<?=$email?>" type="email" class="form-control input-md" required>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="control-label" for="pword"><span class="lightgrey">Jelszó</span> <span class="required"></span></label>  
  <input id="pword" name="pword" value="<?=$pword?>" type="password" class="form-control input-md" required minlength="7">
</div>

<!-- Text input-->
<div class="form-group">
  <label class="control-label" for="repeat_pword"><span class="lightgrey">Jelszó Ismétlése</span> <span class="required"></span></label>  
  <input id="repeat_pword" name="repeat_pword" value="<?=$repeat_pword?>" type="password" class="form-control input-md" required>
</div>

<?php 
$accept = $this->input->post('accept',TRUE);
$fk_nev = "Központi Könyvtár";

foreach ($query->result() as $row) { 
  if($fiok_id == $row->fiok_id){
    $fk_nev = $row->nev;
  }
}
?>

<!-- Dropdown -->
<div class="form-group">
  <label class="control-label" for="fiok_konyvtar"><span class="lightgrey">Fiók Könyvtár</span></label>  
  <div class="dropdown">
    <button style="width: 210px; min-width: max-content;" id="fiok_konyvtar" class="dropdown-toggle form-control" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span id="dropdownfield"><?= $fk_nev ?></span>
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
      <?php       
      foreach ($query->result() as $row) { 
      ?>
        <li><a data-value="<?= $row->fiok_id ?>"><?= $row->nev ?></a></li>
      <?php } ?>
    </ul>
    <input name="fiok_konyvtar" type="hidden" value="<?= $fiok_id ?>"/>
  </div>
</div>

<div class="reg_form_box">

<!-- Checkbox -->
<div class="checkbox">
  <label><input name="hirlevel" type="checkbox" value="1" <?= !isset($hirlevel)?"checked":($hirlevel==0)?"":"checked"?>>Feliratkozás Hírlevélre</label>
</div>

<!-- Checkbox -->
<div class="checkbox">
  <label><input type="checkbox" value="1" required style="
    height: 100%;" <?= !isset($accept)?"":($accept!=1)?"":"checked"?>>Elfogadom a feltételeket <span class="required"></span></label>
</div>

</div>

<!--p>FONTOS: A későbbiekben is lehtősége van lemondani a feliratkozását a "fiók beállítások" alatt. A feliratkozás csak akkor lesz érvényes, amikor vissza igazolja a regisztrációt.</p--><br/>


<!-- Button -->
<div class="form-group">
    <button id="singlebutton" name="submit" value="Submit" class="btn btn-secondary">Regisztrálás</button>&nbsp;
    <a href="<?=base_url()?>"><button type="button" class="btn btn-secondary">Mégse</button></a>
</div>

</fieldset>
</form>
</div>
</div>
</div>

<script>
$(document).on('click', '.dropdown-menu li a', function() {
  text = $(this).text();
  data = $(this).data("value");
  $('#dropdownfield').text(text);
  $('#dropdownfield').attr('width', 'max-content');
  $("input[name='fiok_konyvtar']").val(data);
});
</script>