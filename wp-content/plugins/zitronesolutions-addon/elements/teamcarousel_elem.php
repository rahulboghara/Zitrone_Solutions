<?php
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_tek_teamcarousel extends WPBakeryShortCodesContainer {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_tek_teamcarousel_single extends WPBakeryShortCode {
    }
}
if (!class_exists('tek_teamcarousel')) {
    class tek_teamcarousel extends ZITRONESOLUTIONS_ADDON_CLASS
    {
        function __construct() {
            add_action('init', array($this, 'zs_teamcarousel_init'));
            add_shortcode('tek_teamcarousel', array($this, 'zs_teamcarousel_container'));
            add_shortcode('tek_teamcarousel_single', array($this, 'zs_teamcarousel_single'));
        }
        // Element configuration in admin
        function zs_teamcarousel_init() {
            // Container element configuration
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Team Carousel", "zitronesolutions"),
                    "description" => esc_html__("List all your team members in a carousel.", "zitronesolutions"),
                    "base" => "tek_teamcarousel",
                    "class" => "",
                    "show_settings_on_create" => true,
                    "content_element" => true,
                    "as_parent" => array('only' => 'tek_teamcarousel_single'),
                    "icon" => plugins_url('assets/element_icons/team-carousel.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "js_view" => 'VcColumnView',
                    "params" => array(
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Elements per row", "zitronesolutions"),
                            "param_name"	=>	"tc_elements",
                            "value"			=>	array(
                                    "3 items" => "3",
                                    "4 items" => "4",
                                ),
                            "save_always" => true,
                            "description" => esc_html__("Amount of items displayed at a time with the widest browser width.", "zitronesolutions")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Enable autoplay","zitronesolutions"),
                            "param_name"    =>  "tc_autoplay",
                            "value"         =>  array(
                                    "Off"   => "auto_off",
                                    "On"    => "auto_on"
                                ),
                            "save_always" => true,
                            "description"   =>  esc_html__("Carousel autoplay settings.", "zitronesolutions")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Autoplay speed","zitronesolutions"),
                            "param_name"    =>  "tc_autoplay_speed",
                            "value"         =>  array(
                                    "10s"   => "10000",
                                    "9s"   => "9000",
                                    "8s"   => "8000",
                                    "7s"   => "7000",
                                    "6s"   => "6000",
                                    "5s"   => "5000",
                                    "4s"   => "4000",
                                    "3s"   => "3000",
                                ),
                            "save_always" => true,
                            "dependency" =>	array(
                                "element" => "tc_autoplay",
                                "value" => array("auto_on")
                            ),
                            "description"   =>  esc_html__("Carousel autoplay speed.", "zitronesolutions")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Stop on hover","zitronesolutions"),
                            "param_name"    =>  "tc_stoponhover",
                            "value"         =>  array(
                                    "Off"   => "hover_off",
                                    "On"    => "hover_on"
                                ),
                            "save_always" => true,
                            "dependency" =>	array(
                                "element" => "tc_autoplay",
                                "value" => array("auto_on")
                            ),
                            "description"   =>  esc_html__("Stop sliding carousel on mouse over.", "zitronesolutions")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "zitronesolutions"),
                            "param_name" => "tc_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),
                    )
                ));
                // Shortcode configuration
                vc_map(array(
                    "name" => esc_html__("Team member", "zitronesolutions"),
                    "base" => "tek_teamcarousel_single",
                    "content_element" => true,
                    "as_child" => array('only' => 'tek_teamcarousel'),
                    "icon" => plugins_url('assets/element_icons/team-member.png', dirname(__FILE__)),
                    "params" => array(
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Team member name", "zitronesolutions"),
                            "param_name" => "tm_title",
                            "value" => "",
                            "admin_label" => true,
                            "description" => esc_html__("Enter team member name.", "zitronesolutions")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Team member position", "zitronesolutions"),
                            "param_name" => "tm_position",
                            "value" => "",
                            "description" => esc_html__("Enter team member position.", "zitronesolutions")
                        ),

                        array(
                            "type" => "textarea",
                            "class" => "",
                            "heading" => esc_html__("Team member description", "zitronesolutions"),
                            "param_name" => "tm_description",
                            "value" => "",
                            "description" => esc_html__("Enter team member short description.", "zitronesolutions")
                        ),

                        array(
                             "type" => "vc_link",
                             "class" => "",
                             "heading" => esc_html__("View More Link", "zitronesolutions"),
                             "param_name" => "more_link_url",
                             "value" => "",
                             "description" => esc_html__("Add extra link button", "zitronesolutions"),
                        ),

                        array(
                            "type" => "attach_image",
                            "heading" => esc_html__("Team member image", "zitronesolutions"),
                            "param_name" => "tm_image",
                            "description" => esc_html__("Upload team member image.")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Team member color", "zitronesolutions"),
                            "param_name" => "tm_color",
                            "value" => "",
                            "description" => esc_html__("Choose team member color ( default is theme main color )", "zitronesolutions")
                        ),

                        array(
            							 "type" => "href",
            							 "class" => "",
            							 "heading" => esc_html__("Facebook Link", "zitronesolutions"),
            							 "param_name" => "tm_facebook",
            							 "value" => "",
            							 "description" => esc_html__("Set Facebook link.", "zitronesolutions"),
            						),

                        array(
            							 "type" => "href",
            							 "class" => "",
            							 "heading" => esc_html__("Twitter Link", "zitronesolutions"),
            							 "param_name" => "tm_twitter",
            							 "value" => "",
            							 "description" => esc_html__("Set Twitter link.", "zitronesolutions"),
            						),

                        array(
            							 "type" => "href",
            							 "class" => "",
            							 "heading" => esc_html__("Google Plus Link", "zitronesolutions"),
            							 "param_name" => "tm_google",
            							 "value" => "",
            							 "description" => esc_html__("Set Google Plus link.", "zitronesolutions"),
            						),

                        array(
            							 "type" => "href",
            							 "class" => "",
            							 "heading" => esc_html__("LinkedIn Link", "zitronesolutions"),
            							 "param_name" => "tm_linkedin",
            							 "value" => "",
            							 "description" => esc_html__("Set LinkedIn link.", "zitronesolutions"),
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
                            "param_name" => "tmc_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),

                    )
                ));
            }
        }

        public function zs_teamcarousel_container($atts, $content = null) {
            extract(shortcode_atts(array(
                    'tc_elements'           => '',
                    'tc_autoplay'           => '',
                    'tc_autoplay_speed'     => '',
                    'tc_stoponhover'        => '',
                    'tc_extra_class'        => '',
                ), $atts));

                $output = '';

                $zs_tcunique_id = "zs-teamc-".uniqid();

                $output = '
                <div class="team-carousel '.$zs_tcunique_id.' tc-parent '.$tc_extra_class.'">
                    <div class="tc-content">'.do_shortcode($content).'</div>
                </div>';

                $output .= '<script type="text/javascript">
          				jQuery(document).ready(function($){
                    if ($(".team-carousel.'.$zs_tcunique_id.' .tc-content").length) {
                      $(".team-carousel.'.$zs_tcunique_id.' .tc-content").owlCarousel({
                        itemsDesktop: [1199,3],
                    	  itemsTablet: [768,2],
                    	  itemsMobile: [479,1],
                          navigation: false,
                          pagination: true,';

                        if($tc_autoplay == "auto_on" && $tc_autoplay_speed !== "") {
                  				$output .= 'autoPlay: '.$tc_autoplay_speed.',';
                  			} else {
                  				$output .= 'autoPlay: false,';
                        }

                        if($tc_autoplay == "auto_on" && $tc_stoponhover == "hover_on") {
                          $output .= 'stopOnHover: true,';
                        } else {
                  				$output .= 'stopOnHover: false,';
                        }

                        if($tc_elements !== "") {
                          $output .= 'items: '.$tc_elements.',';
                        }

                        $output .='
                        addClassActive: true,
                      });
                    }
          				});
          			</script>';

                return $output;
        }

        public function zs_teamcarousel_single($atts, $content = null) {
            extract(shortcode_atts(array(
                'tm_title' => '',
                'tm_position' => '',
                'tm_description' => '',
                'more_link_url' => '',
                'tm_image' => '',
                'tm_color' => '',
                'tm_facebook' => '',
                'tm_twitter' => '',
                'tm_google' => '',
                'tm_linkedin' => '',
                'css_animation' => '',
                'elem_animation_delay' => '',
                'tmc_extra_class' => '',
            ), $atts));

            $team_image = $href_more = $link_target_more = $link_title_more = $animation_delay = '';

            $team_image  = wpb_getImageBySize($params = array(
                'post_id' => NULL,
                'attach_id' => $tm_image,
                'thumb_size' => 'full',
                'class' => ""
            ));

            $href_more = vc_build_link($more_link_url);
            if($href_more['url'] !== '') {
              $link_target_more = (isset($href_more['target'])) ? 'target="'.$href_more['target'].'"' : '';
              $link_title_more = (isset($href_more['title'])) ? 'title="'.$href_more['title'].'"' : '';
            }

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            $output = '<div class="team-member '.$css_animation.' '.$tmc_extra_class.'" '.$animation_delay.'>
                            <div class="team-content">
                                <div class="team-image">'.$team_image['thumbnail'].'
                                <div class="team-content-hover">
                                <div class="gradient-overlay"></div>
                                <h5>'.$tm_title.'</h5>
                                <span class="team-subtitle">'.$tm_position.'</span>
                                <p>'.$tm_description.'</p>';
                                if(isset($more_link_url) && $more_link_url !== '' &&  $href_more['url'] !== '') {
                                  $output .='<a class="team-more-link" href="'.$href_more['url'].'"'.$link_target_more.''.$link_title_more.'>'.$href_more['title'].'</a>';
                                }
                                $output .='<div class="team-socials">';
                                  if(isset($tm_facebook) && $tm_facebook !== '') {
                                    $output .='<a href="'.$tm_facebook.'" target="_blank"><span class="fa fa-facebook"></span></a>';
                                  }
                                  if(isset($tm_twitter) && $tm_twitter !== '') {
                                    $output .='<a href="'.$tm_twitter.'" target="_blank"><span class="fa fa-twitter"></span></a>';
                                  }
                                  if(isset($tm_google) && $tm_google !== '') {
                                    $output .='<a href="'.$tm_google.'" target="_blank"><span class="fa fa-google-plus"></span></a>';
                                  }
                                  if(isset($tm_linkedin) && $tm_linkedin !== '') {
                                    $output .='<a href="'.$tm_linkedin.'" target="_blank"><span class="fa fa-linkedin"></span></a>';
                                  }
                                $output .='</div>
                            </div></div>
                                <h5>'.$tm_title.'</h5>
                                <span class="team-subtitle">'.$tm_position.'</span>
                            </div>
                        </div>';
            return $output;
        }
    }
}
if (class_exists('tek_teamcarousel')) {
    $tek_teamcarousel = new tek_teamcarousel;
}
?>
