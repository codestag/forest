<?php
/**
 * Get a sanitized value for a Theme Mod setting.
 *
 * @param var $setting_id Setting ID.
 *
 * @return mixed
 */
function forest_get_thememod_value( $setting_id ) {
	global $forest_settings;

	return $forest_settings->get_value( $setting_id );
}
