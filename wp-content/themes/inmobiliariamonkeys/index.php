	<?php get_header(); ?>
		<?php //get_template_part( 'parts/monkeys-slide', 'slide' ); ?>
		<?php
  			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'parts/content', get_post_format() );
				endwhile;
			else :
				get_template_part( 'parts/content', 'none' );
			endif;
		?>
	<?php get_footer(); ?>