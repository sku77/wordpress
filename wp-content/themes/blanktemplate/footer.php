		<div id="footer">
			&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?>
		</div>
<script src="<?php bloginfo('template_url'); ?>/assets/js/jquery.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/jquery.ui.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/bootstrap.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/transition.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/collapse.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/moment.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/cycle.js"></script>
<script src="<?php bloginfo('template_url'); ?>/libraries/jquery.bxslider/jquery.bxslider.js"></script>
<script src="<?php bloginfo('template_url'); ?>/libraries/easy-tabs/lib/jquery.easytabs.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/libraries/chosen/chosen.jquery.js"></script>
<script src="<?php bloginfo('template_url'); ?>/libraries/star-rating/jquery.rating.js"></script>
<script src="<?php bloginfo('template_url'); ?>/libraries/colorbox/jquery.colorbox-min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/libraries/jslider/bin/jquery.slider.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/libraries/ezMark/js/jquery.ezmark.js"></script>
<script src="<?php bloginfo('template_url'); ?>/libraries/flot/jquery.flot.js"></script>
<script src="<?php bloginfo('template_url'); ?>/libraries/flot/jquery.flot.canvas.js"></script>
<script src="<?php bloginfo('template_url'); ?>/libraries/flot/jquery.flot.resize.js"></script>
<script src="<?php bloginfo('template_url'); ?>/libraries/flot/jquery.flot.time.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=true&amp;v=3.13"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/carat.js"></script>
<script type="text/javascript">
    $(function() {
        $('#datetimePicker1').datetimepicker({
            pickTime: false
        });

        $('#datetimePicker2').datetimepicker({
            pickTime: false
        });

        $('#timePicker1').datetimepicker({
            pickDate: false
        });

        $('#timePicker2').datetimepicker({
            pickDate: false
        });
    });
</script>
	</div>
        
	<?php wp_footer(); ?>
	
	<!-- Don't forget analytics -->	
</body>

</html>
