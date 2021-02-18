<?php

if (!class_exists('ZS_ELEM_PIE_CHART')) {

    class ZS_ELEM_PIE_CHART extends ZITRONESOLUTIONS_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'zs_piechart_init'));
            add_shortcode('tek_piechart', array($this, 'zs_piechart_shrt'));
        }

        // Element configuration in admin

        function zs_piechart_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Pie chart", "zitronesolutions"),
                    "description" => esc_html__("Animated pie chart.", "zitronesolutions"),
                    "base" => "tek_piechart",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/pie-chart.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Title", "zitronesolutions"),
                            "param_name" => "pc_title",
                            "value" => "",
                            "admin_label" => true,
                            "description" => esc_html__("Enter pie chart title here.", "zitronesolutions")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Title color", "zitronesolutions"),
                            "param_name" => "pc_title_color",
                            "value" => "",
                            "description" => esc_html__("Select title color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),

                        array(
                            "type" => "textarea",
                            "class" => "",
                            "heading" => esc_html__("Description", "zitronesolutions"),
                            "param_name" => "pc_description",
                            "value" => "",
                            "description" => esc_html__("Enter pie chart description here.", "zitronesolutions")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Description color", "zitronesolutions"),
                            "param_name" => "pc_description_color",
                            "value" => "",
                            "description" => esc_html__("Select description color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Pie bar thickness","zitronesolutions"),
                            "param_name"	=>	"pc_thickness",
                            "value"			=>	array(
                                    "Thin line"             => "thin_solid",
                                    "Medium line"           => "medium_solid",
                                    "Thick line"            => "thick_solid"
                                ),
                            "save_always" => true,
                            "description"	=>	esc_html__("Select pie chart bar width.", "zitronesolutions")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" =>	esc_html__("Pie percent", "zitronesolutions"),
                            "param_name"	=>	"pc_value",
                            "value" => "",
                            "description" => esc_html__("Pie chart percent value %. Only 1-100 values accepted.", "zitronesolutions"),
                            "save_always" => true,
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Filling bar color", "zitronesolutions"),
                            "param_name" => "pc_main_color",
                            "value" => "",
                            "description" => esc_html__("Choose filling bar color. If none selected, the default theme color will be used.", "zitronesolutions")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Track color", "zitronesolutions"),
                            "param_name" => "pc_track_color",
                            "value" => "",
                            "description" => esc_html__("Choose track color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Pie center content","zitronesolutions"),
                            "param_name"	=>	"pc_center_content",
                            "value"			=>	array(
                                    "No content"                => "no_content",
                                    "Percent value"             => "percent_value",
                                    "Icon"                      => "center_icon",
                                    "Image"                     => "center_image",
                                ),
                            "save_always" => true,
                            "description" => esc_html__("Select pie chart center content.", "zitronesolutions")
                        ),

                        array(
                    				"type" => "dropdown",
                    				"heading" => esc_html__( "Icon library", "zitronesolutions" ),
                    				"value" => array(
                      					esc_html__( "Font Awesome", "zitronesolutions" ) => "fontawesome",
                      					esc_html__( "Linecons", "zitronesolutions" ) => "linecons",
                    				),
                    				"param_name" => "pc_icon_library",
                            "dependency" =>	array(
                                "element" => "pc_center_content",
                                "value" => array("center_icon")
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
                      					"element" => "pc_icon_library",
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
                          					"element" => "pc_icon_library",
                          					"value" => "linecons",
                      				),
                      				"description" => esc_html__( "Select icon from library.", "zitronesolutions" ),
                  			),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Icon color", "zitronesolutions"),
                            "param_name" => "pc_icon_color",
                            "value" => "",
                            "dependency" => array(
                                  "element" => "pc_center_content",
                                  "value" => "center_icon",
                            ),
                            "description" => esc_html__("Select icon color. If none selected, the default theme color will be used.", "zitronesolutions")
                        ),

                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Upload image icon", "zitronesolutions"),
                            "param_name" => "pc_icon_img",
                            "value" => "",
                            "description" => esc_html__("Upload your own custom image.", "zitronesolutions"),
                            "dependency" => array(
                                "element" => "pc_center_content",
                                "value" => array("center_image"),
                            ),
                        ),

                        array(
                             "type"	=>	"dropdown",
                             "class" =>	"",
                             "heading" => esc_html__("Pie link type", "zitronesolutions"),
                             "param_name" => "pc_custom_link",
                             "value" =>	array(
                                    esc_html__( 'No link', 'zitronesolutions' ) => '#',
                                    esc_html__( 'Add custom link', 'zitronesolutions' )	=> '1',
                                ),
                             "save_always" => true,
                             "description" => esc_html__("You can add or remove the custom link.", "zitronesolutions"),
                        ),
                        array(
                             "type"	=>	"vc_link",
                             "class" =>	"",
                             "heading" => esc_html__("Link settings", "zitronesolutions"),
                             "param_name" => "pc_link",
                             "value" =>	"",
                             "description" => esc_html__("You can add or remove the existing link from here.", "zitronesolutions"),
                             "dependency" => array(
                                "element" => "pc_custom_link",
                                "value"	=> array( "1" ),
                            ),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Link text", "zitronesolutions"),
                            "param_name" => "pc_link_text",
                            "value" => "",
                            "description" => esc_html__("Enter link text here.", "zitronesolutions"),
                            "dependency" => array(
                               "element" => "pc_custom_link",
                               "value"	=> array( "1" ),
                           ),
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
                            "param_name" => "pc_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),

                    )
                ));
            }
        }



		// Render the element on front-end

        public function zs_piechart_shrt($atts, $content = null)
        {
            // Include required JS files
            wp_enqueue_script('zs_jquery_appear');
            wp_enqueue_script('zs_easing_script');
            wp_enqueue_script('zs_easypiechart_script');

            // Declare empty vars
            $output = $content_icon = $pc_icons = $zs_piechart_img_array = $pc_unique_id = $animation_delay = '';

            extract(shortcode_atts(array(
                'pc_title' => '',
                'pc_title_color' => '',
                'pc_description' => '',
                'pc_description_color' => '',
                'pc_thickness' => '',
                'pc_value' => '',
                'pc_main_color' => '',
                'pc_track_color' => '',
                'pc_center_content' => '',
                'pc_icon_library' => '',
                'icon_fontawesome' => '',
                'icon_linecons' => '',
                'pc_icon_color' => '',
                'pc_icon_img' => '',
                'pc_custom_link' => '',
                'pc_link' => '',
                'pc_link_text' => '',
                'css_animation' => '',
                'elem_animation_delay' => '',
                'pc_extra_class' => ''
            ), $atts));

            if( $pc_center_content == 'center_icon' ) {
                // Enqueue needed icon font.
                vc_icon_element_fonts_enqueue( $pc_icon_library );

                if (strlen($icon_fontawesome) > 0) {
                    $pc_icons = $icon_fontawesome;
                } elseif (strlen($icon_linecons) > 0) {
                    $pc_icons = $icon_linecons;
                }
            }

            $bar_width = '2';
            if( $pc_thickness == 'thin_solid' ) { $bar_width = '2'; }
            if( $pc_thickness == 'medium_solid' ) { $bar_width = '4'; }
            if( $pc_thickness == 'thick_solid' ) { $bar_width = '7'; }

            if( $pc_center_content == 'center_icon' && !empty($pc_icons) ) {
      				$content_icon = '<i class="'.$pc_icons .' fa" '.(!empty($pc_icon_color) ? 'style="color: '.$pc_icon_color.';"' : '').'></i>';
      			}
      			elseif($pc_center_content == 'center_image' && !empty($pc_icon_img)){
      				$zs_piechart_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $pc_icon_img, 'thumb_size' => 'full', 'class' => "" ) );
      				$content_icon = $zs_piechart_img_array['thumbnail'];
      			}

            $href = vc_build_link($pc_link);
            if ($href['target'] == "") { $href['target'] = "_self"; }

      			if($href['url'] !== '') {
      				$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : 'target="_self"';
      				$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
      			}

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            $output .= '<div class="zs_pie_chart '.$css_animation.' '.$pc_extra_class.'" '.$animation_delay.'>';
              $output .='<span class="zs_chart" data-bar-color="'.$pc_main_color.'" '.(!empty($pc_track_color) ? 'data-track-color="'.$pc_track_color.'"' : '').' data-line-width="'.$bar_width.'" data-percent="'.$pc_value.'">';
      					  if($pc_center_content == 'percent_value') {
                    $output .='<span class="pc_percent_container"><span class="pc_percent"></span>%</span>';
                  } elseif ($pc_center_content == 'center_icon') {
                    $output .= '<div class="zs-piechart-icon">';
                      $output .= $content_icon;
                    $output .= '</div>';
                  } elseif ($pc_center_content == 'center_image') {
                    $output .= '<div class="zs-piechart-customimg">';
                      $output .= $content_icon;
                    $output .= '</div>';
                  } elseif ($pc_center_content == 'no_content') {
                    $output .= '';
                  }
      				$output .='</span>';
      				if(!empty($pc_title)) { $output .= '<h4 class="zs_pc_title" '.(!empty($pc_title_color) ? 'style="color: '.$pc_title_color.';"' : '').'>'.esc_html__($pc_title).'</h4>'; }
      				if(!empty($pc_description)) { $output .= '<p class="zs_pc_desc" '.(!empty($pc_description_color) ? 'style="color: '.$pc_description_color.';"' : '').'>'.esc_html__($pc_description).'</p>'; }
              if ($pc_custom_link == "1") {
                $output .= '<p class="pc-link"><a href="'.$href['url'].'"'.$link_target.''.$link_title.'>'.$pc_link_text.'</a></p>';
              }
        	  $output .= '</div>';

            return $output;

        }
    }
}

if (class_exists('ZS_ELEM_PIE_CHART')) {
    $ZS_ELEM_PIE_CHART = new ZS_ELEM_PIE_CHART;
}

?>
