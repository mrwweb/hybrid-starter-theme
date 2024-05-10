<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _mrw
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'no-js' ); ?>>
<script>document.body.className = document.body.className.replace(' no-js ', ' ');</script>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_mrw' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			$_mrw_title_tag = is_front_page() || is_home() ? 'h1' : 'div';
			?>
			<<?php echo $_mrw_title_tag; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"<?php echo $_mrw_title_tag === 'h1' ? ' aria-current="page"' : ''; ?>>
					<?php echo _mrw_get_svg( 'logo', array() ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
				</a>
			</<?php echo $_mrw_title_tag; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		</div><!-- .site-branding -->

		<?php get_template_part( 'template-parts/navigation-main' ); ?>
	</header><!-- #masthead -->
