<?php
/**
 * The template for displaying Comments.
 * @package zitronesolutions
 * by ZitroneSolutions
 */

   if (post_password_required()) {
       return;
   }
?>
<div id="comments" class="comments-area">
   <?php if (have_comments()): ?>
   <div class="reply-title"><?php esc_html_e('Comments', 'zitronesolutions'); ?></div>
   <?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
   <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
      <h1 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'zitronesolutions'); ?></h1>
      <div class="nav-previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'zitronesolutions')); ?></div>
      <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'zitronesolutions')); ?></div>
   </nav>
   <?php endif; // check for comment navigation ?>
   <ul class="comment-list">
      <?php
         wp_list_comments(array(
             'style' => 'ul',
             'short_ping' => true,
             'avatar_size' => 70
         ));
      ?>
   </ul>
   <?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
   <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
      <h1 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'zitronesolutions'); ?></h1>
      <div class="nav-previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'zitronesolutions')); ?></div>
      <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'zitronesolutions')); ?></div>
   </nav>
   <?php endif; // check for comment navigation ?>
   <?php endif; // have_comments() ?>

   <?php if ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) && ! is_page() ) : ?>
      <h5 class="no-comments"><?php esc_html_e('Comments are closed.', 'zitronesolutions'); ?></h5>
   <?php endif; ?>

   <?php comment_form(); ?>
</div>
