Codeable Date Field Plugin
==========================

Installation
-------------
Copy the plugin into your `wp-content/plugins/` directory, and then login to your WP Admin, go to `Plugins` , find `Codeable Date Field` and click `Activate`

![Plugin Screen](https://wow-ss.s3.amazonaws.com/UjqR6H2.png)

If you wish to use `composer` you can add a dependency for our plugin from `WPackagist` at `https://packagist.org/packages/wow/codeable-datepicker-widget`

Usage
-------------
Once activated, visit `Appearance -> Widgets` and you will see a `Codeable - Date Field` widget that you can drag into your various Sidebar and Footer areas. Once added, you'll see a screen with all of the widget options.

![Widget Added](https://wow-ss.s3.amazonaws.com/EwmKKUD.png)

You are presented first with a dropdown menu titled `Formatting Options...`. The quickest way to get up and running is to select a `Commonly Used Date Format` section inside this dropdown list. This will populate the `date formatter` text field below it with letters which tell the Date Field how the date should appear. 

Under the `Build Your Own` section inside the dropdown list, you'll see all of the individual date components. You can select one and it will insert it into the `date formatter` text field as well. Use this to fine-tune your Date Field format.

![Fine Tune](https://wow-ss.s3.amazonaws.com/WnNzex3.png)

Below that you will see the <i>Datepicker Preview</i> input. Clicking on this input will bring up a Datepicker with the date formatted as you specified in the above section.

![Datepicker Preview](https://wow-ss.s3.amazonaws.com/7K0Fknn.png)

Finally, the `HTML Attributes` Section allows you to specify the `<input>`'s `name`, `class`, and `id` attributes.

![HTML Attributes](https://wow-ss.s3.amazonaws.com/Nkfwh0N.png)

Entering `number2` for the `id`, `two` for the `classname`, and `second`, for the `name` will produce this Datepicker Field on your website:

`<input id="number2" class="two" type="text" name="second">`
