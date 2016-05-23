<?php
global $h_option;

?>
        </div><!-- #main > .section-wrapper -->
	</div><!-- #main .wrapper -->
    <section class="floor clearfix">
        <section id="index-professional" class="lists" style="overflow: hidden;">
            <div class="section-wrapper">
                <?php 
                    $category = $h_option['index']['index_professional'];
                    $posts_limit= $h_option['index']['index_professional_limit'];

                    ?>
                <h3><?php echo get_cat_name($category) ?></h3>
                <ul id="index-professional-content">
                    
                <?php 
                    $args = array(
                                        'category__in' => $category,
                                        'ignore_sticky_posts' => 1,
                                        'showposts' => $posts_limit
                                    );
                        query_posts($args);
                         if ( have_posts() ) :
                             $i=1;   ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <li><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title(); ?></a></li>
                            <?php  endwhile; endif;wp_reset_query()?>
                </ul><!-- / -->
                
            </div>
        </section><!-- 荣誉获奖/index_honor -->

    </section>
	<footer id="colophon" role="contentinfo">
		


		<div class="site-info">

			<?php echo $h_option['general']['site_info'] ?>


		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>