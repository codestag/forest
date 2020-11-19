<?php
/**
 * The template for displaying searchform.
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Forest
 */

?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>/">
	<input type="text" name="s" id="s" placeholder="<?php esc_html_e( 'Enter your query here...', 'forest' ); ?>" />
</form>
