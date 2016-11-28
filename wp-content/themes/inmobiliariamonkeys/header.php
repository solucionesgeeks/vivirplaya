<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<title><?php bloginfo( 'name' ); ?></title>
		<meta name="viewport" content="width=device-width, minimum-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<meta name="author" content="Monkey Web">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
		<script src="<?php bloginfo('template_directory'); ?>/js/jquery.bxslider.js"></script>
		<link href="<?php bloginfo('template_directory'); ?>/css/jquery.bxslider.css" rel="stylesheet" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>	
		<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap-notify.js"></script>
		<link rel="stylesheet" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<?php wp_head(); ?>
	</head>
	<body>
		<header>
			<div class="row scolor">
				<div class="col-xs-12 col-sm-5 col-md-5 dlogoc"></div>
				<div class="col-xs-12 col-sm-7 col-md-7 dcontactc"></div>
			</div>
			<div class="principal cheader">
				<div class="row">
					<div class="col-xs-12 col-sm-5 col-md-5 dlogo">
						<a href="<?php echo get_option('home'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="Bienvenido a <?php bloginfo('name'); ?>" class="logo"></a>
					</div>
					<div class="col-xs-12 col-sm-7 col-md-7 dcontact">
						<div class="col-xs-12 col-sm-4 col-md-4">
							<i class="fa fa-mobile-phone"></i> 998 / 2754554
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4">
							<i class="fa fa-mobile-phone"></i> 998 / 2410336
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 mailtext">
							<i class="fa fa-envelope"></i> info@vivirplaya.com
						</div>
					</div>
				</div>
			</div>
			<div class="row dmenu">
				<div class="principal">
					<div class="col-xs-12 col-sm-12 col-md-12 pc">
						<?php wp_nav_menu( array('menu' => 'Main', 'container' => 'nav' )); ?>
					</div>
					<div class="movil">
						<i class="fa fa-align-justify"></i>
					</div>
				</div>
			</div>
		</header>