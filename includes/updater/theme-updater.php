<?php
/**
 * Easy Digital Downloads Theme Updater.
 *
 * @package Forest.
 */

// Includes the files needed for the theme updater.
if ( ! class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include dirname( __FILE__ ) . '/theme-updater-admin.php';
}

// Loads the updater classes.
$updater = new EDD_Theme_Updater_Admin(

	// Config settings.
	$config = array(
		'remote_api_url' => 'https://codestag.com', // Site where EDD is hosted.
		'item_name'      => 'Forest', // Name of theme.
		'theme_slug'     => 'forest', // Theme slug.
		'version'        => STAG_THEME_VERSION, // The current version of this theme.
		'author'         => 'Codestag', // The author of this theme.
		'download_id'    => '9391', // Optional, used for generating a license renewal link.
		'renew_url'      => '', // Optional, allows for a custom license renewal link.
		'beta'           => false, // Optional, set to true to opt into beta versions.
	),
	// Strings.
	$strings = array(
		'theme-license'             => __( 'Theme License', 'forest' ),
		'enter-key'                 => __(
			'Enter your theme license key received upon purchase from <a target="_blank" href="https://codestag.com/account/">Codestag</a>.<br><br>
											If you\'re coming from ThemeForest, please download <a href="https://envato.com/market-plugin/" target="_blank">Envato Market</a> plugin instead to receive automatic updates.', 'forest'
		),
		'license-key'               => __( 'License Key', 'forest' ),
		'license-action'            => __( 'License Action', 'forest' ),
		'deactivate-license'        => __( 'Deactivate License', 'forest' ),
		'activate-license'          => __( 'Activate License', 'forest' ),
		'status-unknown'            => __( 'License status is unknown.', 'forest' ),
		'renew'                     => __( 'Renew?', 'forest' ),
		'unlimited'                 => __( 'unlimited', 'forest' ),
		'license-key-is-active'     => __( 'License key is active.', 'forest' ),
		'expires%s'                 => __( 'Expires %s.', 'forest' ),
		'expires-never'             => __( 'Lifetime License.', 'forest' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'forest' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'forest' ),
		'license-key-expired'       => __( 'License key has expired.', 'forest' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'forest' ),
		'license-is-inactive'       => __( 'License is inactive.', 'forest' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'forest' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'forest' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'forest' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'forest' ),
		'update-available'          => __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'forest' ),
	)
);
