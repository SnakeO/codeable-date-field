/**
 * This class is responsible for setting up the functionality in the Admin
 * for the datepicker widget.
 */
var CodeableDatepickerAdminWidget = function(widget)
{	
	var self = this;
	self.last_selected_date = null;

	/**
	 * The date the user has selected, who's input value 
	 * is in the format defined by self.date_format
	 * @type {DOMObject}
	 */
	self.input_date = widget.find('input.input_date');

	/**
	 * The date the user has selected, who's input value 
	 * is in Y-m-d format
	 * @type {DOMObject}
	 */
	self.input_date_ymd = widget.find('input.input_date_ymd');

	/**
	 * The format helper dropdown
	 * @type {DOMObject}
	 */
	self.format_helper = widget.find('select.datepicker_format_helper');

	/**
	 * The raw input that will define the date format
	 * @type {DOMObject}
	 */
	self.date_format = widget.find('input.date_format');

	/**
	 * Setup the datepicker, and the format helper.
	 */
	self.construct = function()
	{
		self.setupDatepickerPreview();
		self.setupFormatHelper();
		self.date_format.bind('input', self.updatePreview);
	}

	/**
	 * The preview datepicker allows the user to see their formatted date in action,
	 * right from the admin widgets page
	 */
	self.setupDatepickerPreview = function()
	{
		self.input_date.datepicker({
			altField: self.input_date_ymd,
			altFormat: "yy-mm-dd",
			onSelect: function() {
				self.last_selected_date = self.input_date.datepicker( "getDate" );
			}
		});

		// default to the last date the user picked, or 'today' if that's unavailable
		var start_date_ymd = self.input_date_ymd.val().split('-')
		var start_date = start_date_ymd.length == 3 ? new Date(start_date_ymd[0], start_date_ymd[1]-1, start_date_ymd[2]) : new Date();

		self.input_date.datepicker( "setDate", start_date );
		self.last_selected_date = self.input_date.datepicker( "getDate" );

		// default formatter
		if( self.date_format.val() == '' ) {
			self.date_format.val(<?php echo json_encode($default_dateformat) ?>);
		}

		self.updatePreview();
	}

	/**
	 * When an item from the the format helper dropdown is chosen, we 
	 * inject that into the input field for the user.
	 * 	
	 */
	self.setupFormatHelper = function()
	{
		self.format_helper.change(function()
		{
			var date_format_part = self.format_helper.val();

			// either replace or inject
			if( self.isCommonlyUsedDateFormat(date_format_part) ) {
				self.date_format.val(date_format_part);
			}
			else {
				self.date_format.replaceSelectedText(date_format_part);
			}

			self.updatePreview();
			
			// unselect so they can pick again
			self.format_helper.val('');
		});
	}

	/**
	 * Update our datepicker previewer with the date format the user has entered
	 */
	self.updatePreview = function()
	{
		self.input_date.datepicker( "option", "dateFormat", self.date_format.val() );

		// if the date format is cleared or invalid, the selected date will become null.
		// We "restore" it here so that the preview continues to work intuitively
		if(self.input_date.datepicker("getDate") == null)
		{
			if( self.last_selected_date != null ) {
				self.input_date.datepicker( "setDate", self.last_selected_date );
			}
			else {
				self.input_date.datepicker( "setDate", new Date() );	// today
			}
		}
	}

	/**
	 * Some of our date formats presented in the dropdown "Commonly Used" formats.
	 * For these, we want to repace the entire text field with that value, so we need a 
	 * way to detect them. We'll just use the length since all the formatting "bits"
	 * are length 2 or smaller.
	 * 
	 * @param  {string}  format The date format we're checking
	 * @return {Boolean}        True if the date format is one of our "Commonly Used" ones
	 */
	self.isCommonlyUsedDateFormat = function(format)
	{
		return format.length > 2;
	}

	self.construct();
}

// here we go..
window.codeable = new CodeableDatepickerAdminWidget(widget);