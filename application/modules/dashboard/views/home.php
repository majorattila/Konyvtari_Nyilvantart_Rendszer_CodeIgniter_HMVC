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
		    echo Modules::run("widgets/_draw_subscribers");
		    ?>
    	</div>

    </div>
    <div class="row">

        <section class="col-md-6">
			<?php
			echo Modules::run("diagram_bongeszok/_draw_chart");
			?>
		</section>
		<section class="col-md-6">
			<?php 
			echo Modules::run("diagram_nezettseg/_draw_chart");
			?>
		</section>
        <!-- /.col (RIGHT) -->
<!--
        <section class="col-lg-7">
        	<?php 
			//echo Modules::run("widgets/_draw_quick_email");
			?>
        </section>

        <section class="hidden-xs col-lg-5">
        	<?php 
			//echo Modules::run("widgets/_draw_calendar");
			?>
        </section>
-->
    </div>
    <!-- /.row -->
</section>