<style>
body {
  font: 600 14px/24px "Open Sans", "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", Sans-Serif;
}
.card-container {
  cursor: pointer;
  height: 200px;
  perspective: 600;
  position: relative;
  width: 100%;
}
.card {
  height: 100%;
  position: absolute;
  transform-style: preserve-3d;
  transition: all 0.5s ease-in-out;
  width: 100%;
}
.card:hover {
  transform: rotateY(180deg);
}
.card .side {
  backface-visibility: hidden;
  border-radius: 6px;
  height: 200px;
  position: absolute;
  overflow: hidden;
  width: 100%;
}
.card .back {
  background: #2f2f2f; /*#eaeaed*/
  color: #0087cc;
  line-height: 200px;
  text-align: center;
  transform: rotateY(180deg);
  font-size:25pt;
}
.card .back a {
  color: #fff;
}
</style>

<div class="card-container">
  <div class="card">
    <div class="side"><img style="width:100%; height:100%;" src="<?=base_url()?>dist/img/advert.jpg" alt="Reklám Blokk"></div>
    <div class="side back"><a href="<?=base_url()?>hirdess">KossuthKonyvtar.hu</a></div>
  </div>
</div>