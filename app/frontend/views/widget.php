<input id="<?php echo esc_attr($id) ?>" class="<?php echo esc_attr($instance['classname']) ?>" type="text" name="<?php echo esc_attr($instance['name']) ?>" />

<script type="text/javascript">
jQuery(function($)
{
	// default dateformat
	var dateFormat = <?php echo json_encode($instance['date_format']) ?>;
	if( dateFormat == '' ) {
		dateFormat = <?php echo json_encode($default_dateformat) ?>;
	}

	$('#<?php echo $id ?>').datepicker({
		dateFormat: dateFormat
	});
});
</script>
