<?php
/*
	Sidebar for BRB Panel.
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<div id="postbox-container-1" class="postbox-container">

	<div class="meta-box-sortables">

		<div class="postbox">
			<h2><?php esc_html_e( 'How it works?', 'k-brb' ); ?></h2>

			<div class="inside">
				<p><?php esc_html_e('Activate BRB to put your site in maintenance mode.', 'k-brb' ); ?></p>
				<p><?php esc_html_e('Customize BRB page by changing the settings here.', 'k-brb' ); ?></p>
				<p><?php esc_html_e('Do you want to reset settings to defaults? Just deactivate BRB in Plugins menu!', 'k-brb' ); ?></p>
				<p><a href="https://wordpress.org/plugins/k-brb-maintenance-or-coming-soon" class="button" target="_blank"><?php esc_html_e('Read more', 'k-brb' ); ?></a></p>
			</div>
		</div>

		<div class="postbox">
			<h2><?php esc_html_e( 'About BRB', 'k-brb' ); ?></h2>

			<div class="inside">
				<p><?php esc_html_e('BRB was developed by', 'k-brb' ); ?> <a href="https://www.fabiolobo.com.br" target="_blank">Fabio Lobo</a>.</p>
				<p><?php esc_html_e('If you have seen any bugs,', 'k-brb' ); ?> <a href="https://github.com/fabiorlobo/k-brb-maintenance-or-coming-soon/issues" target="_blank"><?php esc_html_e('please let me know!', 'k-brb' ); ?></a></p>

				<h4><?php esc_html_e( 'More about the author:', 'k-brb' ); ?></h4>
				<ul>
					<li><a href="https://github.com/fabiorlobo" target="_blank">Github @fabiorlobo</a></li>
					<li><a href="https://www.reznd.com" target="_blank"><?php esc_html_e( 'Web Design & Development', 'k-brb' ); ?></a></li>
				</ul>

				<h4><?php esc_html_e( 'Looking for hosting?', 'k-brb' ); ?></h4>
				<ul>
					<li><a href="https://www.portofacil.net/?ref=375" target="_blank">PortoFácil</a></li>
					<li><a href="https://superspecialservers.com" target="_blank">Super Special Servers</a></li>
					<li><a href="https://www.wowf.com.br/" target="_blank">WOWF</a></li>
				</ul>
			</div>
		</div>

		<a href="https://alkteia.net" target="_blank"><img class="k" src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/img/k.svg'; ?>" alt="alKteia"></a>

	</div>

</div>