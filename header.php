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
			$title_tag = is_front_page() || is_home() ? 'h1' : 'div';
			?>
			<<?php echo $title_tag; //phpcs:ignore ?> class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"<?php echo $title_tag === 'h1' ? ' aria-current="page"' : ''; ?>>
					<?php echo get_svg( 'logo', array() ); //phpcs:ignore ?>
					<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
				</a>
			</<?php echo $title_tag; //phpcs:ignore ?>>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation js-toggleWrapper">
			<button class="menu-toggle js-toggleButton" data-aria-controls="menu-container">
				<?php
				echo get_svg( //phpcs:ignore
					'menu',
					array(
						'width'  => '16',
						'height' => '16',
					)
				);
				?>
				<?php
				echo get_svg( //phpcs:ignore
					'close',
					array(
						'width'  => '16',
						'height' => '16',
					)
				);
				?>
				<?php esc_html_e( 'Menu', '_mrw' ); ?>
			</button>
			<div id="menu-container" class="menu-container">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'main-menu',
						'menu_class'     => 'main-menu clicky-menu no-js',
						'container'      => '',
						'fallback_cb'    => false,
					)
				);
				get_search_form();
				?>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
