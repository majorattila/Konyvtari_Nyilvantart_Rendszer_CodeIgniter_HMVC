<?php /* ?>
<h1>Üdvözlünk a Könyvtárban!</h1>

<p>Ha nem igazodik el a könyvtárban itt van pár útmutató tanács:</p>
<ul>
	<li>Ha katalogizálni szeretne válassza a Könyvtár menüpontot.</li>
	<li>Ha a felhasználókat, vagy esetleg a kölcsönzéseket szeretné csak elérni, válassza a Forgalom menüpontot</li>
	<li>Ha oldal adminisztrációt szeretne végezni, válassza az Oldalak menüpontot.</li>
	<li>Ha egyéb dolgogkat szeretne módosítani/ megtekinteni válassza az Admin opciót.</li>
</ul>
<p>Reméljük hasznosak voltak tanácsaink.</p>
<?php */ ?>

<div id="error_msg"></div>

<section class="content">
      <div class="row">

		<div class="col-lg-3 col-xs-6">
            <?php 
		    echo Modules::run("widgets/_draw_employees");
		    ?>
    	</div>

    	<div class="col-lg-3 col-xs-6">
            <?php 
		    echo Modules::run("widgets/_draw_books");
		    ?>
    	</div>

    	<div class="col-lg-3 col-xs-6">
            <?php 
		    echo Modules::run("widgets/_draw_user_registrations");
		    ?>
    	</div>

    	<div class="col-lg-3 col-xs-6">
            <?php 
		    echo Modules::run("widgets/_draw_unique_vistors");
		    ?>
    	</div>

    </div>
    <div class="row">

        <section class="col-md-6">
			<?php
			/*echo Modules::run("diagram_konyvek/_draw_chart");*/
			/*echo Modules::run("diagram_tagok/_draw_chart");*/
			echo Modules::run("diagram_bongeszok/_draw_chart");
			/*echo Modules::run("diagram_tartozasok/_draw_chart");*/
			?>
		</section>
		<section class="col-md-6">
			<?php 
			echo Modules::run("diagram_nezettseg/_draw_chart");
			?>
		</section>
        <!-- /.col (RIGHT) -->

        <section class="col-lg-7">
        	<?php 
			echo Modules::run("widgets/_draw_quick_email");
			?>
        </section>

        <section class="hidden-xs col-lg-5">
        	<?php 
			echo Modules::run("widgets/_draw_calendar");
			?>
        </section>
    </div>
    <!-- /.row -->
</section>