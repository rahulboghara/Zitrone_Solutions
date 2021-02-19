<?php
/**
 * Default Sidebar for Blog
 * @package zitronesolutions
 * by ZitroneSolutions
 */
?>

<?php if( is_active_sidebar('blog-sidebar') ) : ?>
            <?php dynamic_sidebar('blog-sidebar'); ?>
<?php endif; ?>
