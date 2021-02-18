<?php

if (!class_exists('ZS_ELEM_ICON_BOX')) {

    class ZS_ELEM_ICON_BOX extends ZITRONESOLUTIONS_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'zs_iconbox_init'));
            add_shortcode('tek_iconbox', array($this, 'zs_iconbox_shrt'));
        }

        // Element configuration in admin

        function zs_iconbox_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Icon Box", "zitronesolutions"),
                    "description" => esc_html__("Simple text box with icon.", "zitronesolutions"),
                    "base" => "tek_iconbox",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/icon-box.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Box title", "zitronesolutions"),
                            "param_name" => "title",
                            "value" => "",
                            "admin_label" => true,
                            "description" => esc_html__("Enter box title here.", "zitronesolutions"),
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Title color", "zitronesolutions"),
                            "param_name" => "title_color",
                            "value" => "",
                            "description" => esc_html__("Choose title color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Box content type","zitronesolutions"),
                            "param_name"	=>	"box_content_type",
                            "value"			=>	array(
                                "Simple text" => "simple_text",
                                "HTML content" => "html_content",
                            ),
                            "save_always" => true,
                            "description"	=>	esc_html__("Select box content type.", "zitronesolutions"),
                        ),

	                      array(
                            "type" => "textarea",
                            "class" => "",
                            "heading" => esc_html__("Box description - simple text", "zitronesolutions"),
                            "param_name" => "text_box",
                            "value" => "",
                            "description" => esc_html__("Enter box content text here.", "zitronesolutions"),
		                        "dependency" =>	array(
                                "element" => "box_content_type",
                                "value" => array("simple_text")
                            ),
                        ),

                        array(
                            "type" => "textarea_html",
                            "class" => "",
                            "heading" => esc_html__("Box description - HTML content", "zitronesolutions"),
                            "param_name" => "content",
                            "value" => "",
                            "description" => esc_html__("Enter box content text here.", "zitronesolutions"),
			                      "dependency" =>	array(
                                "element" => "box_content_type",
                                "value" => array("html_content")
                            ),
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Content text color", "zitronesolutions"),
                            "param_name" => "text_color",
                            "value" => "",
                            "description" => esc_html__("Choose content text color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Display icon","zitronesolutions"),
                            "param_name"	=>	"icon_type",
                            "value"			=>	array(
                                    "Icon Browser" => "icon_browser",
                                    "Custom Icon" => "custom_icon",
                                ),
                            "save_always" => true,
                            "description"	=>	esc_html__("Select icon source.", "zitronesolutions"),
                        ),

                        array(
              							"type" => "dropdown",
              							"heading" => esc_html__( "Icon library", "zitronesolutions" ),
              							"value" => array(
              								esc_html__( "Font Awesome", "zitronesolutions" ) => "fontawesome",
              								esc_html__( "Linecons", "zitronesolutions" ) => "linecons",
              							),
              							"param_name" => "icon_library",
                                          "dependency" =>	array(
                                              "element" => "icon_type",
                                              "value" => array("icon_browser")
                                          ),
              							"description" => esc_html__( "Select icon library.", "zitronesolutions" ),
          					    ),

            						array(
            							"type" => "iconpicker",
            							"heading" => esc_html__( "Icon", "zitronesolutions" ),
            							"param_name" => "icon_fontawesome",
            							"settings" => array(
            								 "iconsPerPage" => 100,
            							),
            							"dependency" => array(
            								"element" => "icon_library",
            								"value" => "fontawesome",
            							),
            							"description" => esc_html__( "Select icon from library.", "zitronesolutions" ),
            						),

            						array(
            							"type" => "iconpicker",
            							"heading" => esc_html__( "Icon", "zitronesolutions" ),
            							"param_name" => "icon_linecons",
            							"settings" => array(
            									"type" => "linecons",
            									"iconsPerPage" => 100,
            							),
            							"dependency" => array(
            									"element" => "icon_library",
            									"value" => "linecons",
            							),
            							"description" => esc_html__( "Select icon from library.", "zitronesolutions" ),
            						),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Icon color", "zitronesolutions"),
                            "param_name" => "icon_color",
                            "value" => "",
                            "dependency" =>	array(
                                "element" => "icon_type",
                                "value" => array("icon_browser")
                            ),
                            "description" => esc_html__("Choose icon color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),

                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Upload image icon", "zitronesolutions"),
                            "param_name" => "icon_img",
                            "value" => "",
                            "description" => esc_html__("Upload your own custom image.", "zitronesolutions"),
                            "dependency" => array(
                                "element" => "icon_type",
                                "value" => array("custom_icon"),
                            ),
                        ),

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Image size","zitronesolutions"),
                            "param_name"	=>	"icon_img_size",
                            "value"			=>	array(
                                    "Small size" => "img_small_size",
                                    "Medium size" => "img_medium_size",
                                    "Big size" => "img_big_size",
                                ),
                            "save_always" => true,
                            "dependency" => array(
                                "element" => "icon_type",
                                "value" => array("custom_icon"),
                            ),
                            "description"	=>	esc_html__("Select image size.", "zitronesolutions"),
                        ),

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Icon background style", "zitronesolutions"),
                            "param_name"	=>	"icon_style",
                            "value"			=>	array(
                                    "Default" => "icon_default",
                                    "Circle" => "icon_circle",
                                ),
                            "save_always" => true,
                            "dependency" => array(
                                "element" => "icon_type",
                                "value" => array("icon_browser", "custom_icon"),
                            ),
                            "description"	=>	esc_html__("Select icon background style.", "zitronesolutions"),
                        ),

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Icon position","zitronesolutions"),
                            "param_name"	=>	"icon_position",
                            "value"			=>	array(
                                    "Top" => "icon_top",
                                    "Left" => "icon_left",
                                ),
                            "save_always" => true,
                            "dependency" => array(
                                "element" => "icon_type",
                                "value" => array("icon_browser", "custom_icon"),
                            ),
                            "description"	=>	esc_html__("Select icon position relative to the content.", "zitronesolutions"),
                        ),

                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Content alignment", "zitronesolutions"),
                            "param_name" => "content_alignment",
                            "value" => array(
                                "Align center"      => "content_center",
                                "Align left"        => "content_left",
                                "Align right"       => "content_right"
                            ),
                            "description" => esc_html__("Choose content alignment.", "zitronesolutions"),
                            "dependency" => array(
                                "element" => "icon_position",
                                "value" => array("icon_top"),
                            ),
                        ),

                        array(
                             "type"	=>	"dropdown",
                             "class" =>	"",
                             "heading" => esc_html__("Link type", "zitronesolutions"),
                             "param_name" => "custom_link",
                             "value" =>	array(
                                    esc_html__( "No link", "zitronesolutions" ) => "#",
                                    esc_html__( "Add a custom link", "zitronesolutions" )	=> "1",
                                    esc_html__( "Full box link", "zitronesolutions" )	=> "full-box-link",
                                ),
                             "save_always" => true,
                             "description" => esc_html__("You can add/remove custom link", "zitronesolutions"),
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Link text", "zitronesolutions"),
                            "param_name" => "link_text",
                            "value" => "",
                            "description" => esc_html__("Enter link text here.", "zitronesolutions"),
                            "dependency" => array(
                               "element" => "custom_link",
                               "value"	=> array( "1" ),
                           ),
                        ),

                        array(
                             "type"	=>	"vc_link",
                             "class" =>	"",
                             "heading" => esc_html__("Link settings", "zitronesolutions"),
                             "param_name" => "iconbox_link",
                             "value" =>	"",
                             "description" => esc_html__("You can add or remove the existing link from here.", "zitronesolutions"),
                             "dependency" => array(
                                "element" => "custom_link",
                                "value"	=> array( "1", "full-box-link" ),
                            ),
                        ),

                        array(
              							"type" => "dropdown",
              							"class" => "",
              							"heading" => esc_html__("Box background type", "zitronesolutions"),
              							"param_name" =>	"background_type",
              							"value" =>	array(
              								esc_html__( 'None', 'zitronesolutions' ) => 'none',
              								esc_html__( 'Select color', 'zitronesolutions' )	=> 'custom_bg_color',
              							),
              							"save_always" => true,
              							"dependency" => array(
                                            "element" => "icon_style",
                                            "value" => array("icon_default"),
              							),
              							"description" => esc_html__("Select box background type.", "zitronesolutions"),
              						),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Background color", "zitronesolutions"),
                            "param_name" => "background_color",
                            "value" => "",
                            "dependency" =>	array(
              								"element" => "background_type",
              								"value" => array( "custom_bg_color" ),
              							),
                            "description" => esc_html__("Choose box background color.", "zitronesolutions"),
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
                            "param_name" => "ib_animation_delay",
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
                            "param_name" => "ib_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),

                    )
                ));
            }
        }



		// Render the element on front-end

        public function zs_iconbox_shrt($atts, $content = null)
        {

            // Declare empty vars
            $output = $content_icon = $icons = $icon_style_type = $icon_position_class = $content_alignment_class = $link_title = $link_target = $normal_bg = $animation_delay = '';

            extract(shortcode_atts(array(
                'icon_type' => '',
                'title' => '',
                'title_color' => '',
	              'box_content_type' => '',
                'text_box' => '',
                'text_color' => '',
                'icon_type' => '',
                'icon_library' => '',
                'icon_fontawesome' => '',
                'icon_linecons' => '',
                'icon_color' => '',
                'icon_img' => '',
                'icon_img_size' => '',
                'icon_style' => '',
                'icon_position' => '',
                'content_alignment' => '',
                'custom_link' => '',
                'link_text' => '',
                'iconbox_link' => '',
                'background_type' => '',
                'background_color' => '',
                'css_animation' => '',
                'ib_animation_delay' => '',
                'ib_extra_class' => '',
            ), $atts));


            if( $icon_type == 'icon_browser' ) {
              // Enqueue needed icon font.
              vc_icon_element_fonts_enqueue( $icon_library );

              if (strlen($icon_fontawesome) > 0) {
                  $icons = $icon_fontawesome;
              } elseif (strlen($icon_linecons) > 0) {
                  $icons = $icon_linecons;
              }
            }

            $href = vc_build_link($iconbox_link);
            if ($href['target'] == "") { $href['target'] = "_self"; }

      			if($href['url'] !== '') {
      				$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : 'target="_self"';
      				$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
      			}

            if ( $icon_type == 'icon_browser' ) {
				          $content_icon = '<i class="'.$icons .' fa" '.(!empty($icon_color) ? 'style="color: '.$icon_color.';"' : '').'></i> ';
            } elseif ( $icon_type == 'custom_icon' && !empty($icon_img) ) {
				          $tt_iconbox_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $icon_img, 'thumb_size' => 'full', 'class' => "" ) );
			            $content_icon = '<div class="tt-iconbox-customimg '.$icon_img_size.'">'.$tt_iconbox_img_array['thumbnail'].'</div>';
			      }

            // Icon background style
            if( $icon_style == 'icon_circle' ) {
                $icon_style_type = 'icon-circle';
            }
            elseif ( $icon_style == 'icon_default' ) {
                $icon_style_type = 'icon-default';
            }

            // Icon position relative to the content
            if( $icon_position == 'icon_top' ) {
                $icon_position_class = 'icon-top';

                // Content alignment in box
                if( $content_alignment == 'content_center' ) {
                    $content_alignment_class = 'cont-center';
                }
                elseif ( $content_alignment == 'content_left' ) {
                    $content_alignment_class = 'cont-left';
                }
                elseif ( $content_alignment == 'content_right' ) {
                    $content_alignment_class = 'cont-right';
                }
            }
            elseif ( $icon_position == 'icon_left' ) {
                $icon_position_class = 'icon-left';
                $content_alignment_class = '';
            }

            //Background type
            switch($background_type){
      				case 'none':
      					$normal_bg = 'none';
      				break;

      				case 'custom_bg_color':
      					$normal_bg = $background_color;
      				break;

      				default:
      			}

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($ib_animation_delay) {
                $animation_delay = 'data-animation-delay='.$ib_animation_delay;
            }

            $output .= '<div class="key-icon-box '.$icon_style_type.' '.$icon_position_class.' '.$content_alignment_class.' '.$css_animation.' '.$ib_extra_class.'" '.(!empty($background_type) ? 'style="background-color: '.$normal_bg.';"' : '').' '.$animation_delay.'>';
              if ($custom_link == "full-box-link") {
                $output .= '<a href="'.$href['url'].'"'.$link_target.''.$link_title.'>';
              }
              if ($background_type == "custom_bg_color") {
                $output .= '<div class="ib-wrapper">';
              }
              $output .= $content_icon;
                if ( !empty($title) ) {
                  $output .= '<h4 class="service-heading" '.(!empty($title_color) ? 'style="color: '.$title_color.';"' : '').'>'.$title.'</h4>';
                }

                if ($box_content_type == "html_content") {
        					if($content != '') {
        						$output .= '<p '.(!empty($text_color) ? 'style="color: '.$text_color.';"' : '').'>'.do_shortcode($content).'</p>';
        					}
        				} else {
                  if ( !empty($text_box) ) {
        					  $output .= '<p '.(!empty($text_color) ? 'style="color: '.$text_color.';"' : '').'>'.$text_box.'</p>';
        					}
                }

              if ($custom_link == "1") {
                $output .= '<p class="ib-link"><a href="'.$href['url'].'"'.$link_target.''.$link_title.'>'.$link_text.'</a></p>';
              }
              if ($background_type == "custom_bg_color") {
                $output .= '</div>';
              }
              if ($custom_link == "full-box-link") {
                $output .= '</a>';
              }
            $output .= '</div>';

            return $output;

        }
    }
}

if (class_exists('ZS_ELEM_ICON_BOX')) {
    $ZS_ELEM_ICON_BOX = new ZS_ELEM_ICON_BOX;
}

?>
