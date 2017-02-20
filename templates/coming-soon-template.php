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
	<link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,400,400i,500,600" rel="stylesheet">
	<link rel='stylesheet' id='comingspoon-style'  href=<?php echo esc_url( comingspoon_plugin_dir() . 'assets/stylesheets/style.css' ); ?> type='text/css' media='all' />

</head>

<body class="coming-soon-page">
	<div id="page" class="site">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>

				<?php if ( get_custom_logo() ) :
					the_custom_logo();
				endif; ?>

				<h2 class="page-title"><?php esc_html_e( 'Coming Soon', 'comingspoon' ); ?></h2>

				<p class="site-description">
					<?php bloginfo( 'description' ); ?>
				</p>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
</body>

</html>
