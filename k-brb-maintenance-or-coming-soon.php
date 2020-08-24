<?php
/*
	Plugin Name: BRB - Maintenance or Coming Soon
	Plugin URI: https://wordpress.org/plugins/k-brb-maintenance-or-coming-soon
	Description: BRB creates a very simple maintenance mode / coming soon page for your site.
	Version: 1.0.2
	Author: Fabio Lobo
	Author URI: https://www.fabiolobo.com.br
	Text Domain: k-brb
	Domain Path: /languages
	License: GPLv2
*/

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !class_exists('K_BRB_Options') ) {

	class K_BRB_Options {

		function __construct() {
			add_action('admin_menu', array( $this, 'k_brb_menu' ) );
			add_action('admin_init', array( $this, 'k_brb_settings' ));
			add_action( 'plugins_loaded', array( $this, 'k_brb_textdomain'));
			if ( isset($_GET['page']) == 'k-brb' ) add_action('admin_enqueue_scripts', array( $this, 'k_brb_scripts' ));

			register_deactivation_hook( __FILE__, array($this, 'k_brb_deactivation') );
		}

		function k_brb_textdomain() {
			load_plugin_textdomain( 'k-brb', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
		}

		function k_brb_menu() {
			add_options_page(
				__( 'Maintenance / Coming Soon', 'k-brb' ),
				__( 'Maintenance / Coming Soon', 'k-brb' ),
				'manage_options',
				'k-brb',
				array(
					$this,
					'k_brb_page'
				)
			);
		}

		function k_brb_page() { ?>
			<div class="wrap">
				<div id="poststuff">
					<div id="post-body" class="brb metabox-holder columns-2">

						<div id="post-body-content">

							<form method="post" action="options.php">
								<h1><?php esc_html_e( 'BRB - Maintenance / Coming Soon', 'k-brb' ); ?></h1>

								<hr>

								<?php settings_fields('k_brb_fields_section');

									do_settings_sections('k-brb-fields');

								submit_button(); ?>
							</form>

						</div>

						<?php require_once( plugin_dir_path( __FILE__ ) . 'admin/sidebar.php' ); ?>

					</div>
				</div>
			</div>
		<?php }

		function k_brb_settings() {
			register_setting('k_brb_fields_section', 'k-brb-field-on');
			register_setting('k_brb_fields_section', 'k-brb-field-who');

			register_setting('k_brb_fields_section', 'k-brb-field-logo');
			register_setting('k_brb_fields_section', 'k-brb-field-title');
			register_setting('k_brb_fields_section', 'k-brb-field-text');

			register_setting('k_brb_fields_section', 'k-brb-field-facebook');
			register_setting('k_brb_fields_section', 'k-brb-field-github');
			register_setting('k_brb_fields_section', 'k-brb-field-googleplus');
			register_setting('k_brb_fields_section', 'k-brb-field-instagram');
			register_setting('k_brb_fields_section', 'k-brb-field-linkedin');
			register_setting('k_brb_fields_section', 'k-brb-field-twitter');
			register_setting('k_brb_fields_section', 'k-brb-field-youtube');
			register_setting('k_brb_fields_section', 'k-brb-field-icons-style');

			register_setting('k_brb_fields_section', 'k-brb-field-background-color');
			register_setting('k_brb_fields_section', 'k-brb-field-border-color');
			register_setting('k_brb_fields_section', 'k-brb-field-title-color');
			register_setting('k_brb_fields_section', 'k-brb-field-text-color');
			register_setting('k_brb_fields_section', 'k-brb-field-link-color');

			register_setting('k_brb_fields_section', 'k-brb-field-head');
			register_setting('k_brb_fields_section', 'k-brb-field-body');
			
			add_settings_section('k_brb_fields_section', '', null, 'k-brb-fields');
			
			add_settings_field('k-brb-field-on', __( 'Activate BRB?', 'k-brb' ), array($this, 'k_brb_field_on'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-who', __( 'Who can see the site?', 'k-brb' ), array($this, 'k_brb_field_who'), 'k-brb-fields', 'k_brb_fields_section');

			add_settings_field('k-brb-field-logo', __( 'Logo upload', 'k-brb' ), array($this, 'k_brb_field_logo'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-title', __( 'Page title', 'k-brb' ), array($this, 'k_brb_field_title'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-text', __( 'Text', 'k-brb' ), array($this, 'k_brb_field_text'), 'k-brb-fields', 'k_brb_fields_section');

			add_settings_field('k-brb-field-facebook', __( 'Facebook', 'k-brb' ), array($this, 'k_brb_field_facebook'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-github', __( 'Github', 'k-brb' ), array($this, 'k_brb_field_github'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-googleplus', __( 'Google+', 'k-brb' ), array($this, 'k_brb_field_googleplus'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-instagram', __( 'Instagram', 'k-brb' ), array($this, 'k_brb_field_instagram'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-linkedin', __( 'LinkedIn', 'k-brb' ), array($this, 'k_brb_field_linkedin'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-twitter', __( 'Twitter', 'k-brb' ), array($this, 'k_brb_field_twitter'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-youtube', __( 'YouTube', 'k-brb' ), array($this, 'k_brb_field_youtube'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-icons-style', __( 'Icons style', 'k-brb' ), array($this, 'k_brb_field_icons_style'), 'k-brb-fields', 'k_brb_fields_section');
			
			add_settings_field('k-brb-field-background-color', __( 'Background color', 'k-brb' ), array($this, 'k_brb_field_background_color'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-border-color', __( 'Border top color', 'k-brb' ), array($this, 'k_brb_field_border_color'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-title-color', __( 'Title color', 'k-brb' ), array($this, 'k_brb_field_title_color'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-text-color', __( 'Text color', 'k-brb' ), array($this, 'k_brb_field_text_color'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-link-color', __( 'Link color', 'k-brb' ), array($this, 'k_brb_field_link_color'), 'k-brb-fields', 'k_brb_fields_section');

			add_settings_field('k-brb-field-head', __( 'Head code', 'k-brb' ), array($this, 'k_brb_field_head'), 'k-brb-fields', 'k_brb_fields_section');
			add_settings_field('k-brb-field-body', __( 'Body code', 'k-brb' ), array($this, 'k_brb_field_body'), 'k-brb-fields', 'k_brb_fields_section');
		}
		
		function k_brb_deactivation() {
			delete_option('k-brb-field-on');
			delete_option('k-brb-field-who');

			delete_option('k-brb-field-logo');
			delete_option('k-brb-field-title');
			delete_option('k-brb-field-text');

			delete_option('k-brb-field-facebook');
			delete_option('k-brb-field-github');
			delete_option('k-brb-field-googleplus');
			delete_option('k-brb-field-instagram');
			delete_option('k-brb-field-linkedin');
			delete_option('k-brb-field-twitter');
			delete_option('k-brb-field-youtube');
			delete_option('k-brb-field-icons-style');

			delete_option('k-brb-field-background-color');
			delete_option('k-brb-field-border-color');
			delete_option('k-brb-field-title-color');
			delete_option('k-brb-field-text-color');
			delete_option('k-brb-field-link-color');

			delete_option('k-brb-field-head');
			delete_option('k-brb-field-body');
		}
		
		function k_brb_field_on() { ?>
			<label><input id="k-brb-field-on" type="checkbox" name="k-brb-field-on" value="1" <?php checked(1, get_option('k-brb-field-on'), true); ?>> <?php esc_html_e( 'Yes, enable it!', 'k-brb' ); ?></label>
		<?php }
		
		function k_brb_field_who() { ?>
			<label>
				<select id="k-brb-field-who" name="k-brb-field-who">
					<option value="level_10" <?php if ( get_option('k-brb-field-who') == "level_10" ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Administrators', 'k-brb' ); ?></option>
					<option value="level_7" <?php if ( get_option('k-brb-field-who') == "level_7" ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Editors', 'k-brb' ); ?></option>
					<option value="level_2" <?php if ( get_option('k-brb-field-who') == "level_2" ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Authors', 'k-brb' ); ?></option>
					<option value="level_1" <?php if ( get_option('k-brb-field-who') == "level_1" ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Contributors', 'k-brb' ); ?></option>
					<option value="level_0" <?php if ( get_option('k-brb-field-who') == "level_0" ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Subscribers', 'k-brb' ); ?></option>
				</select>
			</label>
		<?php }
		
		function k_brb_field_logo() { ?>
			<div class="brb__upload-preview">
				<?php if ( get_option('k-brb-field-logo') ) { ?>
					<img class="brb__logo-preview" src="<?php if (get_option('k-brb-field-logo')) { echo get_option('k-brb-field-logo'); } ?>" alt="<?php esc_html_e( 'Your Logo', 'k-brb' ); ?>">
				<?php } ?>
			</div>

			<input class="regular-text brb__upload-field" id="k-brb-field-logo" type="text" name="k-brb-field-logo" value="<?php echo get_option('k-brb-field-logo'); ?>">

			<button class="button-primary brb__upload-button" type="button"><?php esc_html_e( 'Upload', 'k-brb' ); ?></button>

			<button class="button-secondary brb__upload-clear" type="button"><?php esc_html_e( 'Remove', 'k-brb' ); ?></button>

			<p class="description"><?php esc_html_e( 'Recommended width: 300px. If you don\'t use a image, BRB will show the name of your site.', 'k-brb' ); ?></p>
		<?php }

		function k_brb_field_title() { ?>
			<input class="regular-text" id="k-brb-field-title" type="text" name="k-brb-field-title" value="<?php echo get_option('k-brb-field-title', __( 'Be Right Back!', 'k-brb' )); ?>">

			<p class="description"><?php esc_html_e( 'Example: "Be Right Back!"', 'k-brb' ); ?></p>
		<?php }

		function k_brb_field_text() { ?>
			<?php wp_editor(get_option('k-brb-field-text', __( 'We will be back soon!', 'k-brb' )), 'k-brb-field-text', ''); ?>
		<?php }

		function k_brb_field_facebook() { ?>
			<input class="regular-text" id="k-brb-field-facebook" type="text" name="k-brb-field-facebook" value="<?php echo get_option('k-brb-field-facebook'); ?>" placeholder="http://">

			<p class="description"><?php esc_html_e( 'Leave it blank if you don\'t want to show this icon.', 'k-brb' ); ?></p>
		<?php }

		function k_brb_field_github() { ?>
			<input class="regular-text" id="k-brb-field-github" type="text" name="k-brb-field-github" value="<?php echo get_option('k-brb-field-github'); ?>" placeholder="http://">

			<p class="description"><?php esc_html_e( 'Leave it blank if you don\'t want to show this icon.', 'k-brb' ); ?></p>
		<?php }

		function k_brb_field_googleplus() { ?>
			<input class="regular-text" id="k-brb-field-googleplus" type="text" name="k-brb-field-googleplus" value="<?php echo get_option('k-brb-field-googleplus'); ?>" placeholder="http://">

			<p class="description"><?php esc_html_e( 'Leave it blank if you don\'t want to show this icon.', 'k-brb' ); ?></p>
		<?php }

		function k_brb_field_instagram() { ?>
			<input class="regular-text" id="k-brb-field-instagram" type="text" name="k-brb-field-instagram" value="<?php echo get_option('k-brb-field-instagram'); ?>" placeholder="http://">

			<p class="description"><?php esc_html_e( 'Leave it blank if you don\'t want to show this icon.', 'k-brb' ); ?></p>
		<?php }

		function k_brb_field_linkedin() { ?>
			<input class="regular-text" id="k-brb-field-linkedin" type="text" name="k-brb-field-linkedin" value="<?php echo get_option('k-brb-field-linkedin'); ?>" placeholder="http://">

			<p class="description"><?php esc_html_e( 'Leave it blank if you don\'t want to show this icon.', 'k-brb' ); ?></p>
		<?php }

		function k_brb_field_twitter() { ?>
			<input class="regular-text" id="k-brb-field-twitter" type="text" name="k-brb-field-twitter" value="<?php echo get_option('k-brb-field-twitter'); ?>" placeholder="http://">

			<p class="description"><?php esc_html_e( 'Leave it blank if you don\'t want to show this icon.', 'k-brb' ); ?></p>
		<?php }

		function k_brb_field_youtube() { ?>
			<input class="regular-text" id="k-brb-field-youtube" type="text" name="k-brb-field-youtube" value="<?php echo get_option('k-brb-field-youtube'); ?>" placeholder="http://">

			<p class="description"><?php esc_html_e( 'Leave it blank if you don\'t want to show this icon.', 'k-brb' ); ?></p>
		<?php }

		function k_brb_field_icons_style() {
			if ( !get_option('k-brb-field-icons-style') ) add_option('k-brb-field-icons-style', 'square'); ?>
			<fieldset>
				<label><input id="k-brb-field-icons-style-rounded" type="radio" name="k-brb-field-icons-style" value="rounded" <?php if ( get_option('k-brb-field-icons-style') == "rounded" ) echo 'checked="checked"'; ?>> <?php esc_html_e( 'Rounded', 'k-brb' ); ?></label><br>
				<label><input id="k-brb-field-icons-style-square" type="radio" name="k-brb-field-icons-style" value="square" <?php if ( get_option('k-brb-field-icons-style') == "square" ) echo 'checked="checked"'; ?>> <?php esc_html_e( 'Square', 'k-brb' ); ?></label>
			</fieldset>
		<?php }

		function k_brb_field_background_color() { ?>
			<input class="regular-text color-picker" id="k-brb-field-background-color" type="text" name="k-brb-field-background-color" value="<?php echo get_option('k-brb-field-background-color', '#FFFFFF'); ?>">
		<?php }

		function k_brb_field_border_color() { ?>
			<input class="regular-text color-picker" id="k-brb-field-border-color" type="text" name="k-brb-field-border-color" value="<?php echo get_option('k-brb-field-border-color', '#333333'); ?>">
		<?php }

		function k_brb_field_title_color() { ?>
			<input class="regular-text color-picker" id="k-brb-field-title-color" type="text" name="k-brb-field-title-color" value="<?php echo get_option('k-brb-field-title-color', '#333333'); ?>">
		<?php }

		function k_brb_field_text_color() { ?>
			<input class="regular-text color-picker" id="k-brb-field-text-color" type="text" name="k-brb-field-text-color" value="<?php echo get_option('k-brb-field-text-color', '#666666'); ?>">
		<?php }

		function k_brb_field_link_color() { ?>
			<input class="regular-text color-picker" id="k-brb-field-link-color" type="text" name="k-brb-field-link-color" value="<?php echo get_option('k-brb-field-link-color', '#CC0000'); ?>">
		<?php }

		function k_brb_field_head() { ?>
			<textarea class="large-text" id="k-brb-field-head" type="text" name="k-brb-field-head" cols="80" rows="10"><?php echo get_option('k-brb-field-head'); ?></textarea>

			<p class="description"><?php esc_html_e( 'Add html inside &lt;head&gt;&lt;/head&gt;', 'k-brb' ); ?></p>
		<?php }

		function k_brb_field_body() { ?>
			<textarea class="large-text" id="k-brb-field-body" type="text" name="k-brb-field-body" cols="80" rows="10"><?php echo get_option('k-brb-field-body'); ?></textarea>

			<p class="description"><?php esc_html_e( 'Add html before &lt;/body&gt;', 'k-brb' ); ?></p>
		<?php }

		function k_brb_scripts() {
			if (function_exists('add_thickbox')) add_thickbox();
			if (function_exists('wp_editor()')) wp_editor();

			add_editor_style( plugin_dir_url( __FILE__ ) . 'admin/assets/css/tinymce.css' );
			wp_admin_css();
			
			wp_register_style('k-brb-admin', plugin_dir_url( __FILE__ ) . 'admin/assets/css/style.css', false, '1.0');
			wp_enqueue_style('k-brb-admin');
			wp_enqueue_style( 'wp-color-picker' ); 

			do_action("admin_print_styles-post-php");
			do_action('admin_print_styles');

			wp_register_script('k-logo-upload', plugin_dir_url( __FILE__ ) . 'admin/assets/js/logo-upload.js', false, '1.0');
			wp_enqueue_script('k-logo-upload');
			wp_enqueue_script('k-color-picker', plugin_dir_url( __FILE__ ) . 'admin/assets/js/color-picker.js', array( 'wp-color-picker' ), false, '1.0');
			wp_enqueue_script('common');
			wp_enqueue_script('jquery-color');
			wp_enqueue_script('utils');
			wp_print_scripts('editor');
			wp_print_scripts('media-upload');
		}
	}

	new K_BRB_Options;

}
		
function k_brb_plugin_links( $links ) {
	$links = array_merge( array(
		'<a href="' . esc_url( admin_url( '/options-general.php' ) ) . '?page=k-brb">' . __( 'Settings', 'k-brb' ) . '</a>'
	), $links );
	return $links;
}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'k_brb_plugin_links' );

require_once( plugin_dir_path( __FILE__ ) . 'template/default.php' );

add_action( 'wp_loaded', 'k_brb_template' );