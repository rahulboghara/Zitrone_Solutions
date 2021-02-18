<?php

if (!class_exists('ZS_ELEM_PROMO_BOX')) {

    class ZS_ELEM_PROMO_BOX extends ZITRONESOLUTIONS_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'zs_promobox_init'));
            add_shortcode('tek_promobox', array($this, 'zs_promobox_shrt'));
        }

        // Element configuration in admin

        function zs_promobox_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Promo Box", "zitronesolutions"),
                    "description" => esc_html__("Promo box with image and button.", "zitronesolutions"),
                    "base" => "tek_promobox",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/promo-box.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Box title", "zitronesolutions"),
                            "param_name" => "prb_title",
                            "value" => "",
                            "description" => esc_html__("Enter box title here.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textarea",
                            "class" => "",
                            "heading" => esc_html__("Box content text", "zitronesolutions"),
                            "param_name" => "prb_description",
                            "value" => "",
                            "description" => esc_html__("Enter box content text here.", "zitronesolutions")
                        ),
                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Upload box image", "zitronesolutions"),
                            "param_name" => "prb_image",
                            "value" => "",
                            "description" => esc_html__("Upload your own custom image.", "zitronesolutions"),
                        ),
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Image position","zitronesolutions"),
                            "param_name"	=>	"prb_image_position",
                            "value"			=>	array(
                                    "Left" => "prb_image_left",
                                    "Right" => "prb_image_right",
                                ),
                            "save_always" => true,
                            "description"	=>	esc_html__("Choose image position relative to the box title and description.", "zitronesolutions")
                        ),
                        array(
                             "type"	=>	"dropdown",
                             "class" =>	"",
                             "heading" => esc_html__("Box link type", "zitronesolutions"),
                             "param_name" => "prb_custom_link",
                             "value" =>	array(
                                    esc_html__( 'No link', 'zitronesolutions' ) => '#',
                                    esc_html__( 'Add a custom button', 'zitronesolutions' )	=> '1',
                                ),
                             "save_always" => true,
                             "description" => esc_html__("You can add or remove the custom link.", "zitronesolutions"),
                        ),
                        array(
                             "type"	=>	"vc_link",
                             "class" =>	"",
                             "heading" => esc_html__("Link settings", "zitronesolutions"),
                             "param_name" => "prb_box_link",
                             "value" =>	"",
                             "description" => esc_html__("You can add or remove the existing link from here.", "zitronesolutions"),
                             "dependency" => array(
                                "element" => "prb_custom_link",
                                "value"	=> array( "1" ),
                            ),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Button text", "zitronesolutions"),
                            "param_name" => "prb_button_text",
                            "value" => "",
                            "description" => esc_html__("Write the text displayed on the button.", "zitronesolutions"),
                            "dependency" => array(
                               "element" => "prb_custom_link",
                               "value"	=> array( "1" ),
                           ),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "zitronesolutions"),
                            "param_name" => "prb_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),

                    )
                ));
            }
        }



		// Render the element on front-end

        public function zs_promobox_shrt($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'prb_title'		            => '',
                'prb_description'		    => '',
                'prb_image'		            => '',
                'prb_image_position'		=> '',
                'prb_custom_link'		    => '',
                'prb_box_link'		        => '',
                'prb_button_text'           => '',
                'prb_extra_class'		    => '',
            ), $atts));

            $content_image = $prb_img_array = $href = $link_target = $link_title = '';

      			if(!empty($prb_image)){
        				$prb_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $prb_image, 'thumb_size' => 'full', 'class' => "" ) );
        				$content_image = '<div class="prb-img">'.$prb_img_array['thumbnail'].'</div>';
      			}

            $href = vc_build_link($prb_box_link);
        			if($href['url'] !== '') {
        				$link_target = (isset($href['target'])) ? 'target="'.$href['target'].'"' : '';
        				$link_title = (isset($href['title'])) ? 'title="'.$href['title'].'"' : '';
      			}

            $output = '<div class="zs-promobox '.$prb_image_position.' '.$prb_extra_class.'">';
              $output .= $content_image;
              $output .= '<div class="prb-content">
              <h4>'.$prb_title.'</h4>
              <p>'.$prb_description.'</p>';
              if ($prb_custom_link == "1") {
                  $output .= '<div class="prb-btncontainer">
                      <a href="'.$href['url'].'"'.$link_target.''.$link_title.' class="prb-button tt_button">'.$prb_button_text.'</a>
                  </div>';
              }
              $output .= '</div>';
            $output .= '</div>';

            return $output;

        }
    }
}

if (class_exists('ZS_ELEM_PROMO_BOX')) {
    $ZS_ELEM_PROMO_BOX = new ZS_ELEM_PROMO_BOX;
}

?>
