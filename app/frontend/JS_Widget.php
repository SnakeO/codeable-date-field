<?php

/**
 * This class helps smooth out some issues with javascript on the widget/customzer page.
 * Notably, when a widget is first dragged into the sidebar, it's not ready, we must wait for the 'widget-added' event to run.
 * From https://wordpress.stackexchange.com/questions/5515/update-widget-form-after-drag-and-drop-wp-save-bug
 */

namespace codeable_datepicker_widget\app\frontend;

use \WP_Widget;

class JS_Widget extends WP_Widget 
{ 
    // For widgets using javascript in form().
    var $js_ns = 'js_widget'; // Javscript namespace.
    var $js_init_func = ''; // Name of javascript init function to call. Initialized in constructor.
    var $is_customizer = false; // Whether in customizer or not. Set on 'load-customize.php' action (if any).

    public function __construct( $id_base, $name, $widget_options = array(), $control_options = array(), $js_ns = '' ) 
    {
        parent::__construct( $id_base, $name, $widget_options, $control_options );

        if ( $js_ns ) {
            $this->js_ns = $js_ns;
        }

        $this->js_init_func = $this->js_ns . '.' . $this->id_base . '_init';
        add_action( 'load-widgets.php', array( $this, 'load_widgets_php' ) );
        add_action( 'load-customize.php', array( $this, 'load_customize_php' ) );
    }

    /**
     * Called on 'load-widgets.php' action added in constructor.
     */
    public function load_widgets_php() 
    {
        add_action( 'in_widget_form', array( $this, 'form_maybe_call_javascript_init' ) );
        add_action( 'admin_print_scripts', array( $this, 'admin_print_scripts' ), PHP_INT_MAX );
    }

    /**
     * Called on 'load-customize.php' action added in constructor.
     */
    public function load_customize_php() 
    {
        $this->is_customizer = true;
        // Don't add 'in_widget_form' action as customizer sends 'widget-added' event to existing widgets too.
        add_action( 'admin_print_scripts', array( $this, 'admin_print_scripts' ), PHP_INT_MAX );
    }

    /**
     * Form javascript initialization code here. "widget" and "widget_id" available.
     */
    public function form_javascript_init() {
    }

    /**
     * Called on 'in_widget_form' action (ie directly after form()) when in traditional widgets interface.
     * Run init directly unless we're newly added.
     */
    
    public function form_maybe_call_javascript_init( $callee_this ) 
    {
        if ( $this === $callee_this && '__i__' !== $this->number ) {
            ?>
            <script type="text/javascript">
            jQuery(function($) {
                <?php echo $this->js_init_func; ?>(null, $('#widgets-right [id$="<?php echo $this->id; ?>"]'));
            });
            </script>
            <?php
        }
    }

    /**
     * Called on 'admin_print_scripts' action added in constructor.
     */
    public function admin_print_scripts() 
    {
        ?>
        <script type="text/javascript">
        var <?php echo $this->js_ns; ?> = <?php echo $this->js_ns; ?> || {}; // Our namespace.
        jQuery(function ($) {
            <?php echo $this->js_init_func; ?> = function (e, widget) {
                var widget_id = widget.attr('id');
                if (widget_id.search(/^widget-[0-9]+_<?php echo $this->id_base; ?>-[0-9]+$/) === -1) { // Check it's our widget.
                    return;
                }
                <?php $this->form_javascript_init(); ?>
            };
            $(document).on('widget-added', <?php echo $this->js_init_func; ?>); // Call init on widget add.
        });
        </script>
        <?php
    }
}