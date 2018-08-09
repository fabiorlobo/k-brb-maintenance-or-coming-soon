<?php
/*
	Template for BRB.
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function k_brb_template() {
	global $pagenow;

	if ( !( defined( 'WP_CLI' ) && WP_CLI ) && $pagenow !== 'wp-login.php' && !current_user_can( get_option('k-brb-field-who') ) && !is_admin() && get_option('k-brb-field-on') == 1 ) { ?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
			<head>
				<meta charset="<?php bloginfo( 'charset' ); ?>">
				<meta name="viewport" content="width=device-width">

				<title><?php if ( get_option('k-brb-field-title') ) echo get_option('k-brb-field-title') . ' | ' . get_bloginfo( 'name' ); ?></title>

				<link href="https://fonts.googleapis.com/css?family=Roboto:300,900" rel="stylesheet">
				<link href="<?php echo plugin_dir_url( __FILE__ ) . 'assets/css/style.css'; ?>" rel="stylesheet">

				<style>
					body {
						background-color: <?php echo get_option('k-brb-field-background-color'); ?>;
						border-top-color: <?php echo get_option('k-brb-field-border-color'); ?>;
						color: <?php echo get_option('k-brb-field-text-color'); ?>;
					}

					a {
						color: <?php echo get_option('k-brb-field-link-color'); ?>;
					}

					.brb__header__title {
						color: <?php echo get_option('k-brb-field-title-color'); ?>;
					}
				</style>

				<?php if ( get_option('k-brb-field-head') ) echo get_option('k-brb-field-head'); ?>
			</head>

			<body>
				<div class="brb">

					<header class="brb__header">
						<?php if ( get_option('k-brb-field-logo') ) { ?>
							<img class="brb__header__logo" src="<?php echo get_option('k-brb-field-logo'); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
						<?php } else { ?>
							<h1 class="brb__header__title"><?php echo get_bloginfo( 'name' ); ?></h1>
						<?php } ?>
					</header>

					<main class="brb__main">
						<div class="brb__main__content">

							<?php if ( get_option('k-brb-field-title') ) echo '<h2>' . get_option('k-brb-field-title') . '</h2>'; ?>

							<?php if ( get_option('k-brb-field-text') ) echo wpautop( get_option('k-brb-field-text') ); ?>

						</div>

						<?php $icons = array(
							'facebook' => 'Facebook',
							'github' => 'Github',
							'googleplus' => 'Google+',
							'instagram' => 'Instagram',
							'linkedin' => 'LinkedIn',
							'twitter' => 'Twitter',
							'youtube' => 'YouTube'
						);
						
						function k_use_icons ($icons) {
							foreach ( $icons as $social=>$socialName ) get_option('k-brb-field-'. $social);
						}

						if ( !k_use_icons ($icons) ) echo '<ul class="brb__main__social">';
						
							foreach ( $icons as $social=>$socialName ) {

								if ( get_option('k-brb-field-'. $social) ) echo '<li><a href="' . get_option('k-brb-field-'. $social) . '"><img src="' . plugin_dir_url( __FILE__ ) . 'assets/img/icons/' . get_option('k-brb-field-icons-style') . '/'. $social .'.svg" alt="'. $socialName .'"></a></li>';

							}

						if ( !k_use_icons ($icons) ) echo '</ul>'; ?>
					</main>

				</div>

				<?php if ( get_option('k-brb-field-body') ) echo get_option('k-brb-field-body'); ?>
			</body>
		</html>
	<?php	die(); }
}