<?php

namespace codeable_datepicker_widget\app\frontend;

use \WP_Widget;
use \codeable_datepicker_widget\app\admin\WidgetAdmin;

/**
 * This class is responsible for displaying the widget
 * on the frontend
 */
class DatepickerWidget extends JS_Widget
{
	/**
	 * Object which handles all administrative tasks for this widget
	 * @var WidgetAdmin
	 */
	protected $admin;

	/**
	 * Default format for the date when none is provided, or if left blank
	 * @var string
	 */
	public $default_dateformat = 'MM d, yy';

	/**
	 * Register the widget with Wordpress.
	 */
	public static function init()
	{
		add_action('widgets_init', function() {
			register_widget(__CLASS__);
		});
	}

	/**
	 * Widget Construction sends our info up to the parent WP_Widget class
	 */
	function __construct() 
	{
		$this->admin = new WidgetAdmin($this);

		parent::__construct( 'codeable_datepicker', 'Codeable - Date Field', array(
			'description' => __( 'Adds a "Date Field" input that utilizes jQuery UI Datepicker.' )
		));

		if( !is_admin() ) {
			add_action('wp_enqueue_scripts', array($this, 'enqueueDatepickerScripts'), 10, 1);
		}
	}

	/**
	 * Enqueue all scripts necessary for the widget to function
	 */
	public function enqueueDatepickerScripts()
	{
		wp_enqueue_script('rangyinputs', CDP_URL . 'vendor/rangyinputs/rangyinputs-jquery.js', array('jquery'), '1.2.0');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-datepicker');
		
		// wordpress doesn't have a built-in jquery ui stylesheet, pull one from google's CDN
		wp_enqueue_style('jquery-ui-smoothness', "//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.min.css", false, null);
	}

	public function widget($args, $instance) 
	{
		$id = $instance['id'] ?: $this->id;
		$default_dateformat = $this->default_dateformat;

		include CDP_FRONTEND_VIEWS . 'widget.php';
	}
	
	public function update($new_instance, $old_instance) 
	{
		return $this->admin->updateSettings($new_instance, $old_instance);
	}

	public function form($instance) 
	{
		$this->admin->showSettings($instance);
	}

	public function form_javascript_init() 
	{
		$this->admin->jsInit();
	}
}