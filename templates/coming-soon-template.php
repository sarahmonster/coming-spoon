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

				<?php if ( array_key_exists( 'mailchimp-signup-url', get_option( 'comingspoon_options' ) ) ) : ?>
					<?php if ( get_option( 'comingspoon_options' )['mailchimp-signup-url'] ) : ?>
						<form action="<?php echo esc_url( get_option( 'comingspoon_options' )['mailchimp-signup-url'] ); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<label for="mce-EMAIL">Email address</label>
							<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">

							<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
						</form>
					<?php endif; ?>
				<?php endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
</body>

</html>
