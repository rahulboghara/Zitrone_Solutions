<?php
   $redux_ThemeTek = get_option( 'redux_ThemeTek' );
   get_header();
?>
<?php if( is_home() ) : ?>
<div id="posts-content"  class="container" >
   <?php if ($redux_ThemeTek['tek-blog-sidebar']) { ?>
   <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
      <?php } else { ?>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <?php } ?>
      <?php
         if (have_posts()) :
         while (have_posts()) :
         the_post();
         ?>
      <div <?php post_class('section'); ?> id="post-<?php  the_ID(); ?>" >
         <a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('large'); ?></a>
         <a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><h2 class="blog-single-title"><?php the_title(); ?></h2></a>
         <div class="entry-content">
            <?php if(has_excerpt()) : ?>
            <?php the_excerpt(); ?>
            <?php else : ?>
            <div class="page-content"><?php the_content(); ?></div>
            <?php endif; ?>
            <?php wp_link_pages(); ?>
         </div>
         <div class="entry-meta">
            <?php  if ( is_sticky() ) echo '<span class="fa fa-thumb-tack"></span> Sticky <span class="blog-separator">|</span>  '; ?>
            <span class="published"><span class="fa fa-clock-o"></span><a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php the_time( get_option('date_format') ); ?></a></span>
            <span class="author"><span class="fa fa-keyboard-o"></span><?php the_author_posts_link(); ?></span>
            <span class="blog-label"><span class="fa fa-folder-open-o"></span><?php the_category(', '); ?></span>
            <span class="comment-count"><span class="fa fa-comment-o"></span><?php comments_popup_link( esc_html__('No comments yet', 'zitronesolutions'), esc_html__('1 comment', 'zitronesolutions'), esc_html__('% comments', 'zitronesolutions') ); ?></span>
         </div>
      </div>
      <?php endwhile; ?>
      <?php the_posts_pagination( array('mid_size' => 1,'prev_text' => esc_html__( 'Previous', 'zitronesolutions' ),'next_text' => esc_html__( 'Next', 'zitronesolutions' ),) ); ?>
   </div>
   <?php if ($redux_ThemeTek['tek-blog-sidebar']) { ?>
   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
      <?php get_sidebar(); ?>
   </div>
   <?php } ?>
</div>
<?php else : ?>
<div id="posts-content" class="container" >
   <div id="post-not-found" <?php post_class(); ?>>
      <h2 class="entry-title"><?php esc_html_e('Error 404 - Not Found', 'zitronesolutions') ?></h2>
      <div class="entry-content">
         <p><?php esc_html_e("Sorry, no posts matched your criteria.", "zitronesolutions") ?></p>
      </div>
   </div>
</div>
<?php endif; ?>
<?php else : ?>
<?php
   $zitronesolutions_homePageID=get_the_ID();
   $zitronesolutions_args=array('post_type'=>'page','posts_per_page'=>-1,'post_parent'=>$zitronesolutions_homePageID,'post__not_in'=>array($zitronesolutions_homePageID),'order'=>'ASC','orderby'=>'menu_order');
   $zitronesolutions_parent=new WP_Query($zitronesolutions_args);
?>
<?php if($zitronesolutions_parent->have_posts()): ?>
<?php
   while($zitronesolutions_parent->have_posts()):
   $zitronesolutions_parent->the_post();
?>
<?php $zitronesolutions_page_template=str_replace('page_','',str_replace('.php','',basename(get_page_template()))); ?>
<?php if($zitronesolutions_page_template&&$zitronesolutions_page_template!='page'): ?>
<?php get_template_part($zitronesolutions_page_template,get_post_format()); ?>
<?php wp_reset_postdata(); ?>
<?php else : ?>
<?php get_template_part( 'loop', get_post_format() ); ?>
<?php wp_reset_postdata(); ?>
<?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>
