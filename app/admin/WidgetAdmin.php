<?php

namespace codeable_datepicker_widget\app\admin;

/**
 * This class is responsible for handling the
 * administrative settings of the widget.
 */
class WidgetAdmin
{
	/**
	 * Handle back to our WP_Widget
	 * @var WP_Widget
	 */
	protected $wp_widget;

	public function __construct($wp_widget)
	{
		$this->wp_widget = $wp_widget;

		// include jquery ui
		add_action('admin_enqueue_scripts', function($hook)
		{
			// only load it in widgets/customizer pages
			 if( !in_array($hook, array('widgets.php', 'customize.php')) ) {
				return;
			}

			$this->wp_widget->enqueueDatepickerScripts();

		}, 10, 1);
	}

	/**
	 * Javascript code that runs when the widget is initialized
	 */
	public function jsInit()
	{
		$is_customizer = $this->wp_widget->is_customizer;
		$default_dateformat = $this->wp_widget->default_dateformat;

		include CDP_ADMIN_VIEWS . 'widget-js-init.php';
	}

	/**
	 * Shows the settings form for our DatepickerWidget.
	 * 
	 * @param array $instance Current settings.
	 */
	public function showSettings($instance)
	{
		$is_customizer = $this->wp_widget->is_customizer;
		$field_names = array(
			'date_format'	=> $this->wp_widget->get_field_name('date_format'),
			'input_date_ymd'	=> $this->wp_widget->get_field_name('input_date_ymd'),

			'classname'	=> $this->wp_widget->get_field_name('classname'),
			'name'	=> $this->wp_widget->get_field_name('name'),
			'id'	=> $this->wp_widget->get_field_name('id')
		);

		$common_date_formats = array(
			'mm/dd/yy'	=> date('m/d/Y') . ' | USA (mm/dd/yy)',
			'dd/mm/yy'	=> date('d/m/Y') . ' | EUROPE (dd/mm/yy)',
			'yy-mm-dd'	=> date('Y-m-d') . ' | ISO 8601 (yy-mm-dd)',
			'MM d, yy'	=> date('F j, Y') . ' | TEXTUAL (MM d, yy)'
		);

		include CDP_ADMIN_VIEWS . 'widget-settings.php';
	}

	/**
	 * Handles updating settings for the current DatepickerWidget instance.
	 * 
	 * @param array $new_instance New settings for this instance.
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function updateSettings($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['date_format'] = $new_instance['date_format'];
		$instance['input_date_ymd'] = $new_instance['input_date_ymd'];
		$instance['classname'] = $new_instance['classname'];
		$instance['name'] = $new_instance['name'];
		$instance['id'] = $new_instance['id'];
		return $instance;
	}


}