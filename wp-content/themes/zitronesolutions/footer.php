<?php $redux_ThemeTek = get_option( 'redux_ThemeTek' ); ?>
</div>
<footer id="footer" class="<?php if (isset($redux_ThemeTek['tek-footer-fixed'])) { if ($redux_ThemeTek['tek-footer-fixed'] == '1') { echo esc_html('fixed'); } else { echo esc_html('classic');} } ?>">
      <?php get_sidebar( 'footer' ); ?>
      <div class="lower-footer">
          <div class="container">
             <div class="footer-align">
               <span><?php echo isset($redux_ThemeTek['tek-footer-text']) ? $redux_ThemeTek['tek-footer-text'] : '&copy; 2017 Zitronesolutions All rights reserved'; ?></span>
            </div>
            <div class="pull-right">
               <?php if ( has_nav_menu( 'zitronesolutions-footer-menu' ) ) {
                     wp_nav_menu( array( 'theme_location' => 'zitronesolutions-footer-menu', 'menu' => 'Footer Menu', 'depth' => 1, 'container' => false, 'menu_class' => 'nav navbar-footer', 'fallback_cb' => 'false' ) );
                  }
               ?>
            </div>
         </div>
      </div>
</footer>
      <?php if (!isset($redux_ThemeTek['tek-coming-soon-page'])) $redux_ThemeTek['tek-coming-soon-page'] = '';
      if (is_page($redux_ThemeTek['tek-coming-soon-page']) && $redux_ThemeTek['tek-coming-soon-page'] != '') { ?> </div> <?php } ?>
<?php if (isset($redux_ThemeTek['tek-backtotop']) && $redux_ThemeTek['tek-backtotop'] == "1") : ?>
      <div class="back-to-top">
         <i class="fa fa-angle-up"></i>
      </div>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
