<?php

if (!class_exists('ZS_ELEM_BOOK_PREVIEW')) {

    class ZS_ELEM_BOOK_PREVIEW extends ZITRONESOLUTIONS_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'zs_bookpreview_init'));
            add_shortcode('tek_bookpreview', array($this, 'zs_bookpreview_shrt'));
        }

        // Element configuration in admin

        function zs_bookpreview_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Book Preview", "zitronesolutions"),
                    "description" => esc_html__("Book chapter preview in a device mockup.", "zitronesolutions"),
                    "base" => "tek_bookpreview",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/book-preview.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(
                        array(
                            "type" =>	"dropdown",
                            "class" =>	"",
                            "heading" =>	esc_html__("Enable content scrolling", "zitronesolutions"),
                            "param_name" =>	"bp_scroll",
                            "value"	 =>	array(
                                    "On" => "scroll-on",
                                    "Off" => "scroll-off",
                                ),
                            "save_always" => true,
                            "description" => esc_html__("When active the content in the book mockup area will smoothly scroll down.", "zitronesolutions")
                        ),

                        array(
                            "type" => "attach_image",
			                      "class" => "",
                            "heading" => esc_html__("Upload device mockup", "zitronesolutions"),
                            "param_name" => "bp_mockup",
	                          "value" => "",
                            "description" => esc_html__("Upload container mockup.", "zitronesolutions")
                        ),

                        array(
                            "type" => "textarea_html",
                            "class" => "",
                            "heading" => esc_html__("Book text", "zitronesolutions"),
                            "param_name" => "content",
                            "value" => "",
                            "description" => esc_html__("Enter a short presentation of the book. HTML tags are allowed.", "zitronesolutions"),
                        ),
                    )
                ));
            }
        }



		// Render the element on front-end

        public function zs_bookpreview_shrt($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'bp_mockup'			=> '',
                'bp_scroll'     => '',
            ), $atts));

            $mockup_img = $output = '';

      			if ( !empty($bp_mockup) ) {
      				$mockup_img = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $bp_mockup, 'thumb_size' => 'full', 'class' => "" ) );
      			}

            if ( $bp_scroll != "scroll-off" ) {
              $output .= '<script type="text/javascript">
                jQuery(document).ready(function($){
                  if ($(".bp-content").length) {
                    setInterval(function(){
                      var pos = $(".bp-content").scrollTop();
                      $(".bp-content").scrollTop(pos + 1);
                    }, 30)
                  }
                });</script>';
            }

            $output .= '<div class="bp-container">
      				<div class="bp-device">'.$mockup_img['thumbnail'].'</div>
      				<div class="bp-content">'.do_shortcode($content).'</div>
      			</div>';

            return $output;

        }
    }
}

if (class_exists('ZS_ELEM_BOOK_PREVIEW')) {
    $ZS_ELEM_BOOK_PREVIEW = new ZS_ELEM_BOOK_PREVIEW;
}

?>
