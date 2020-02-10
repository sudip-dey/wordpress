<?php
get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>
			
			<?php /* The loop */ ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
			<div class="event-summary">
          <a class="event-summary__date event-summary__date--beige t-center" href="#">
            <span class="event-summary__month"><?php the_date('M'); ?></span>
            <span class="event-summary__day"><?php echo get_the_date('d'); ?></span>  
          </a>
          <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
            <p><?php echo wp_trim_words(get_the_content(), 20) ?> <a href="<?php the_permalink();?>" class="nu gray">Learn more</a></p>
          </div>
        </div>
			<?php endwhile; ?>

		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
