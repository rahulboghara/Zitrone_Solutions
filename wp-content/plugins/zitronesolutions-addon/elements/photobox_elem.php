<?php

if (!class_exists('ZS_ELEM_PHOTO_BOX')) {

    class ZS_ELEM_PHOTO_BOX extends ZITRONESOLUTIONS_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'zs_photobox_init'));
            add_shortcode('tek_photobox', array($this, 'zs_photobox_shrt'));
        }

        // Element configuration in admin

        function zs_photobox_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Photo Box", "zitronesolutions"),
                    "description" => esc_html__("Simple photo box with link.", "zitronesolutions"),
                    "base" => "tek_photobox",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/photo-box.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Box title", "zitronesolutions"),
                            "param_name" => "phb_title",
                            "value" => "",
                            "admin_label" => true,
                            "description" => esc_html__("Enter box title here.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textarea",
                            "class" => "",
                            "heading" => esc_html__("Box content text", "zitronesolutions"),
                            "param_name" => "phb_description",
                            "value" => "",
                            "description" => esc_html__("Enter box content text here.", "zitronesolutions")
                        ),
                        array(
                             "type"	=>	"dropdown",
                             "class" =>	"",
                             "heading" => esc_html__("Box text align", "zitronesolutions"),
                             "param_name" => "phb_text_align",
                             "value" =>	array(
                                    esc_html__( 'Left aligned', 'zitronesolutions' ) => 'text-left',
                                    esc_html__( 'Center aligned', 'zitronesolutions' )	=> 'text-center',
                                ),
                             "save_always" => true,
                             "description" => esc_html__("Text alignment in box.", "zitronesolutions"),
                        ),
                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Upload box image", "zitronesolutions"),
                            "param_name" => "phb_image",
                            "value" => "",
                            "description" => esc_html__("Upload your own custom image.", "zitronesolutions"),
                        ),
                        array(
                             "type"	=>	"dropdown",
                             "class" =>	"",
                             "heading" => esc_html__("Box link type", "zitronesolutions"),
                             "param_name" => "phb_custom_link",
                             "value" =>	array(
                                    esc_html__( 'No link', 'zitronesolutions' ) => '#',
                                    esc_html__( 'Button link', 'zitronesolutions' )	=> 'box-button-link',
                                    esc_html__( 'Full box link', 'zitronesolutions' )	=> 'box-link',
                                ),
                             "save_always" => true,
                             "description" => esc_html__("You can add or remove the custom link.", "zitronesolutions"),
                        ),
                        array(
                             "type"	=>	"vc_link",
                             "class" =>	"",
                             "heading" => esc_html__("Link settings", "zitronesolutions"),
                             "param_name" => "phb_box_link",
                             "value" =>	"",
                             "description" => esc_html__("You can add or remove the existing link from here.", "zitronesolutions"),
                             "dependency" => array(
                                "element" => "phb_custom_link",
                                "value"	=> array( "box-button-link", "box-link" ),
                            ),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Button text", "zitronesolutions"),
                            "param_name" => "phb_button_text",
                            "value" => "",
                            "description" => esc_html__("Write the text displayed on the button.", "zitronesolutions"),
                            "dependency" => array(
                               "element" => "phb_custom_link",
                               "value"	=> array( "box-button-link" ),
                           ),
                        ),
                        array(
                             "type"	=>	"dropdown",
                             "class" =>	"",
                             "heading" => esc_html__("Image hover effect", "zitronesolutions"),
                             "param_name" => "phb_image_effect",
                             "value" =>	array(
                                    esc_html__( 'No effect', 'zitronesolutions' ) => 'no-effect',
                                    esc_html__( 'Shine', 'zitronesolutions' )	=> 'shine-effect',
                                    esc_html__( 'Circle', 'zitronesolutions' )	=> 'circle-effect',
                                    esc_html__( 'Flash', 'zitronesolutions' )	=> 'flash-effect',
                                    esc_html__( 'Opacity', 'zitronesolutions' )	=> 'opacity-effect',
                                    esc_html__( 'Gray scale', 'zitronesolutions' )	=> 'grayscale-effect'
                                ),
                             "save_always" => true,
                             "description" => esc_html__("Choose a image effect.", "zitronesolutions"),
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("CSS Animation", "zitronesolutions"),
                            "param_name" => "css_animation",
                            "value" => array(
                                "No"              => "no_animation",
                                "Fade In"         => "zs-animated fadeIn",
                                "Fade In Down"    => "zs-animated fadeInDown",
                                "Fade In Left"    => "zs-animated fadeInLeft",
                                "Fade In Right"   => "zs-animated fadeInRight",
                                "Fade In Up"      => "zs-animated fadeInUp",
                                "Zoom In"         => "zs-animated zoomIn",
                            ),
                            "description" => esc_html__("Select type of animation for element to be animated when it enters the browsers viewport (Note: works only in modern browsers).", "zitronesolutions"),
                         ),
                         array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Animation Delay:", "zitronesolutions"),
                            "param_name" => "elem_animation_delay",
                            "value" => array(
                                "0s"              => "",
                                "0.2s"            => "200",
                                "0.4s"            => "400",
                                "0.6s"            => "600",
                                "0.8s"            => "800",
                                "1s"              => "1000",
                            ),
                            "dependency" =>	array(
                                "element" => "css_animation",
                                "value" => array("zs-animated fadeIn", "zs-animated fadeInDown", "zs-animated fadeInLeft", "zs-animated fadeInRight", "zs-animated fadeInUp", "zs-animated zoomIn")
                            ),
                            "description" => esc_html__("Enter animation delay in ms", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "zitronesolutions"),
                            "param_name" => "phb_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),

                    )
                ));
            }
        }



		// Render the element on front-end

        public function zs_photobox_shrt($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'phb_title'		               => '',
                'phb_description'		         => '',
                'phb_text_align'		         => '',
                'phb_image'		               => '',
                'phb_custom_link'		         => '',
                'phb_box_link'		           => '',
                'phb_button_text'            => '',
                'phb_image_effect'           => '',
                'css_animation'              => '',
                'elem_animation_delay'       => '',
                'phb_extra_class'		         => '',
            ), $atts));

            $content_image = $phb_img_array = $href = $link_target = $link_title = $animation_delay = '';

      			if(!empty($phb_image)){
      				$phb_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $phb_image, 'thumb_size' => 'full', 'class' => "" ) );
      				$content_image = '<div class="photobox-img">'.$phb_img_array['thumbnail'].'</div>';
      			}

            $href = vc_build_link($phb_box_link);
      			if($href['url'] !== '') {
      				$link_target = (isset($href['target'])) ? 'target="'.$href['target'].'"' : '';
      				$link_title = (isset($href['title'])) ? 'title="'.$href['title'].'"' : '';
      			}

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            $output = '<div class="zs-photobox '.$phb_image_effect.' '.$css_animation.' '.$phb_extra_class.'" '.$animation_delay.'>';
              if ($phb_custom_link == "box-link") {
                  $output .= '<a href="'.$href['url'].'"'.$link_target.''.$link_title.'>';
              }
                $output .= $content_image;
                $output .= '<div class="phb-content '.$phb_text_align.'">
                  <h4>'.$phb_title.'</h4>
                  <p>'.$phb_description.'</p>';
                  if ($phb_custom_link == "box-button-link") {
                      $output .= '<div class="phb-btncontainer">
                          <a href="'.$href['url'].'"'.$link_target.''.$link_title.' class="phb-button">'.$phb_button_text.'</a>
                      </div>';
                  }
                $output .= '</div>';
              if ($phb_custom_link == "box-link") {
                  $output .= '</a>';
              }
            $output .= '</div>';

            return $output;

        }
    }
}

if (class_exists('ZS_ELEM_PHOTO_BOX')) {
    $ZS_ELEM_PHOTO_BOX = new ZS_ELEM_PHOTO_BOX;
}

?>
