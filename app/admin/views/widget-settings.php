<div class="datepicker-widget-settings">

	<h2>Date Format</h2>
	<p>Type into the text field below to tell us how you'd like the date to be formatted.</p>
	<p>You can pick formatting options from the dropdown menu to help you out.</p>

	<p>
		<select class="datepicker_format_helper" style="width:100%">
			<option value="">Formatting Options...</option>
			<optgroup label="Commonly Used Date Formats">
				<?php foreach($common_date_formats as $value => $label): ?>
					<option value="<?php echo $value?>"><?php echo $label?></option>
				<?php endforeach; ?>
			</optgroup>
			<optgroup label="Build Your Own">
				<option value="d">d - day of month (no leading zero)</option>
				<option value="dd">dd - day of month (two digit)</option>
				<option value="o">o - day of the year (no leading zeros)</option>
				<option value="oo">oo - day of the year (three digit)</option>
				<option value="D">D - day name short</option>
				<option value="DD">DD - day name long</option>
				<option value="m">m - month of year (no leading zero)</option>
				<option value="mm">mm - month of year (two digit)</option>
				<option value="M">M - month name short</option>
				<option value="MM">MM - month name long</option>
				<option value="y">y - year (two digit)</option>
				<option value="yy">yy - year (four digit)</option>
				<option value="@">@ - Unix timestamp (ms since 01/01/1970)</option>
				<option value="!">! - Windows ticks (100ns since 01/01/0001)</option>
			</optgroup>
		</select>
	</p>

	<p>
		<input class="date_format" type="text" name="<?php echo $field_names['date_format'] ?>" value="<?php echo esc_attr($instance['date_format']) ?>" />
	</p>

	<?php if(!$is_customizer): // customizer has it's own preview ?>
		<p><em>Datepicker Preview:</em></p>
		<p>
			<input class="input_date" type="text" />
			<input class="input_date_ymd" type="hidden" name="<?php echo $field_names['input_date_ymd'] ?>" value="<?php echo esc_attr($instance['input_date_ymd']) ?>" name="input_date_ymd" />
		</p>
	<?php endif; ?>

	<h2>HTML Attributes</h2>
	<p>Enter optional class name, id, and name for your input field:</p>
	<input type="text" placeholder="classname" name="<?php echo $field_names['classname'] ?>" value="<?php echo esc_attr($instance['classname']) ?>" />
	<input type="text" placeholder="name" name="<?php echo $field_names['name'] ?>" value="<?php echo esc_attr($instance['name']) ?>" />
	<input type="text" placeholder="id" name="<?php echo $field_names['id'] ?>" value="<?php echo esc_attr($instance['id']) ?>" />
</div>