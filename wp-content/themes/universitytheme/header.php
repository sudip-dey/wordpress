<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php echo bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>  
</head>
<body <?php body_class(); ?>>
  
  <header class="site-header">
    <div class="container">
      <h1 class="school-logo-text float-left"><a href="<?php echo site_url(); ?>"><strong>Fictional</strong> University</a></h1>
      <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
        <?php wp_nav_menu('primary'); ?>
        </nav>
        <div class="site-header__util">
          <a href="#" class="btn btn--small btn--orange float-left push-right">Login</a>
          <a href="#" class="btn btn--small  btn--dark-orange float-left">Sign Up</a>
          <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
      </div>
    </div>
  </header>

  <?php 
    if( is_home() ) { 
  ?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg');?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h1 class="headline headline--large">Welcome!</h1>
      <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
      <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
      <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
    </div>
  </div>
  <?php
    } else {
  ?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg'); ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">
      <?php
        if ( is_single() || is_page()) {
          the_title();
        } elseif ( is_day() ) {
					/* translators: %s: Date. */
					printf( __( 'Daily Archives: %s', 'twentythirteen' ), get_the_date() );
				} elseif ( is_month() ) {
					/* translators: %s: Date. */
					printf( __( 'Monthly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentythirteen' ) ) );
				} elseif ( is_year() ) {
					/* translators: %s: Date. */
					printf( __( 'Yearly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentythirteen' ) ) );
				} else {
					_e( 'Archives', 'twentythirteen' );
				}
				?>  
      </h1>
      <div class="page-banner__intro">
        <p><?php 
        if(is_archive() ) {
          the_archive_description(); 
        } elseif (is_single() ) {
          echo wp_trim_words(get_the_excerpt(), 10); 
        }
        ?></p>
      </div>
    </div>  
  </div>

  <?php
    }
  ?>


<header class="archive-header">
				<h1 class="archive-title">
				
				</h1>
			</header><!-- .archive-header -->