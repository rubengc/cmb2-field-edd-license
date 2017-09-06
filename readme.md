CMB2 Field Type: EDD License
==================

Custom field for [CMB2](https://github.com/WebDevStudios/CMB2) to automatically handle [EDD Software Licensing](https://easydigitaldownloads.com/downloads/software-licensing/) license activation and item updates.

## Parameters

Field accepts same paramaters as field type text, with the addition of the next one:
- server (string, Required) : Server URL to the EDD SL API (by default, http://your-site.com/edd-sl-api)
- file (string, Required) : Path to the item main file (for example if you call it from your main plugin file, then you can use __FILE__)
- item_id (string, Optional) : Item ID from the server
- item_name (string, Optional) : Item name (same as returned by the function plugin_basename(), example my-plugin/my-plugin.php)
- version (string, Optional) : Item version of the installed one to check for updates (by default will get the one provided in the main file header)
- author (string, Optional) : Item author (by default will get the one provided in the main file header)
- wp_override (bool, Optional) : Set it to true to override WordPress plugin information to get the one provided by your server (false by default)

## Examples

```php
add_action( 'cmb2_admin_init', 'cmb2_edd_license_metabox' );
function cmb2_edd_license_metabox() {

	$prefix = 'your_prefix_demo_';

	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'EDD License Sample', 'cmb2' ),
		'object_types'  => array( 'page', 'post' ), // Post type
	) );

	// Sample 1
	$cmb_demo->add_field( array(
		'name'          => __( 'License 1', 'cmb2' ),
		'desc'          => __( 'Field description (optional)', 'cmb2' ),
		'id'            => $prefix . 'license_one',
		'type'          => 'edd_license',
		'server'        => 'http://your-site.com/edd-sl-api',
		'file'          => __DIR__,
	) );

	// Sample 2
	$cmb_demo->add_field( array(
		'name'          => __( 'License 2', 'cmb2' ),
		'desc'          => __( 'Field description (optional)', 'cmb2' ),
		'id'            => $prefix . 'license_two',
		'type'          => 'edd_license',
		'server'        => 'http://your-site.com/edd-sl-api',
        'file'          => __DIR__,
        'item_id'       => 123,
        'item_name'     => 'my-plugin/my-plugin.php',
        'version'       => '1.0.0',
        'author'        => 'rubengc',
        'wp_override'   => true,
	) );

}
```

## Retrieve the license status

You can use the function `cmb2_edd_license_status( $license_key )` to see the status of this license (valid, invalid or false if not license key or license not checked)

## Changelog

### 1.0.0
* Initial release
