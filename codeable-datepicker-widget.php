<?php
/**
 * Codeable Datepicker Widget
 *
 * @package     Codeable
 * @copyright   2016 Websites on Wheels
 *
 * @wordpress-plugin
 * Plugin Name: Codeable Datepicker Widget
 * Plugin URI:  http://one.codeable.websitesonwheels.net/
 * Description: Adds a "Date Field" widget that utilizes jQuery UI Datepicker.
 * Version:     0.1
 * Author:      Jake Chapa
 * Author URI:  https://websitesonwheels.net/
 * Text Domain: codeable-datepicker-widget
 * License:     Unlicense 
 * License URI: http://unlicense.org/UNLICENSE
 */

require_once __DIR__ . '/vendor/autoload.php';

define('CDP_URL', plugin_dir_url(__FILE__));
define('CDP_ADMIN_VIEWS', __DIR__ . '/app/admin/views/');
define('CDP_FRONTEND_VIEWS', __DIR__ . '/app/frontend/views/');

use codeable_datepicker_widget\app\frontend\DatepickerWidget;
DatepickerWidget::init();