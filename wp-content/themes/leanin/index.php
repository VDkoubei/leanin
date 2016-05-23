<?php get_header() ?>

<div id="primary" class="site-content" style="width: auto;">
		<div id="content" role="main">
			<section class="floor clearfix">

			<div class="community-callout">
				<?php _e( '<span class="icon-leanin-dark"><strong>Join a Lean In Circle.</strong> Get the support and skills you need to go for it!</span>', 'leanin' ); ?>
			    
			    <a href="mailto:thinktankbeijing@yahoo.com" class="btn btn-primary btn-large"><?php _e( 'Join a Circle', 'leanin' ); ?></a>

			    <?php _e( 'ABCDE', 'leanin' ); ?>
			</div>

			</section><!-- 一层/floor -->

			<section class="floor clearfix floor-2-index">

				<section class="story-teaser index-videos index-activities">
					<?php 
						$category = $h_option['index']['index_activities'];
						$posts_limit= $h_option['index']['index_activities_limit'];

						// h_cms_list($category, $posts_limit,12);
					 ?>

					<header class="clearfix">
						<h2><?php echo get_cat_name($category) ?></h2>
						<a class="more" href="<?php echo get_category_link($category) ?>" title="More About [ <?php echo get_cat_name($category) ?> ]"><?php _e( 'More', 'leanin' ); ?></a>
					</header><!-- 分类标题/lists-title -->

					<ul>
					<?php 
						$i=1;
						$args  = array('category__in' => $category ,'showposts' => $posts_limit);
						query_posts($args);
						 if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); 
						if ( $i <= $posts_limit) {
					?>
						<li  <?php post_class(); ?>>
							<figure class="item-picture">
								<a href="<?php echo $pic_link ?>" title="<?php the_title() ?>">
									<?php leanin_get_thumb_image('show')?>
								</a>
							</figure>
							<time class="item-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_time("Y-m-d") ?></time>
							<h3 class="item-title">
								<a href="<?php echo $post_url; ?>" title="<?php the_title() ?>">
									<?php the_title(); //echo h_get_title($num); ?>
								</a>
							</h3>
							<p><?php if (has_excerpt()) echo h_mb_strimwidth(get_the_excerpt(), 0, 160, '…') ; ?></p>
						</li>
					<?php
						}
						$i++;
					 endwhile; endif;wp_reset_query()?>
					</ul>
				</section><!-- 新闻快报/index-news -->


			</section><!-- / -->

			


	</div><!-- #content -->
	</div><!-- #primary -->
<?php //get_sidebar() ?>
<?php get_footer() ?>
