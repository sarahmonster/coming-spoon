<?php
/**
 * The template for displaying a "Coming Soon" page.
 *
 * This can be overridden by any theme by including a file called
 * coming-soon-template.php in your theme.
 *
 * @package ComingSpoon
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<title><?php bloginfo( 'name' ); ?>: <?php esc_html_e( 'Coming Soon', 'comingspoon' ); ?></title>
</head>

<body class="coming-soon-page">
	<div id="page" class="site">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php if ( get_custom_logo() ) :
						// Show the custom logo if one's been uploaded via wp-admin.
						the_custom_logo();
				endif; ?>

				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

				<p class="site-description">
					<?php bloginfo( 'description' ); ?>
				</p>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
</body>

</html>
