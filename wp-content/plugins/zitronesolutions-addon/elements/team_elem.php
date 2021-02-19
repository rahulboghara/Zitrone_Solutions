<?php

if (!class_exists('ZS_ELEM_TEAM')) {

    class ZS_ELEM_TEAM extends ZITRONESOLUTIONS_ADDON_CLASS {
        function __construct() {
            add_action('init', array($this, 'zs_team_init'));
            add_shortcode('tek_team', array($this, 'zs_team_shrt'));
        }

        // Element configuration in admin

        function zs_team_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Team Member", "zitronesolutions"),
                    "description" => esc_html__("Team member element", "zitronesolutions"),
                    "base" => "tek_team",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/team-member.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Team member name", "zitronesolutions"),
                            "param_name" => "title",
                            "value" => "",
                            "admin_label" => true,
                            "description" => esc_html__("Enter Team member name.", "zitronesolutions")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Team member position", "zitronesolutions"),
                            "param_name" => "position",
                            "value" => "",
                            "description" => esc_html__("Enter Team member position.", "zitronesolutions")
                        ),

                        array(
                            "type" => "textarea",
                            "class" => "",
                            "heading" => esc_html__("Team member description", "zitronesolutions"),
                            "param_name" => "description",
                            "value" => "",
                            "description" => esc_html__("Enter Team member description.", "zitronesolutions")

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
                            "param_name" => "image",
                            "description" => esc_html__("Upload Team member image.")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Team member color", "zitronesolutions"),
                            "param_name" => "hover_color",
                            "value" => "",
                            "description" => esc_html__("Choose team member color ( default is theme main color )", "zitronesolutions")
                        ),

                        array(
                             "type" => "href",
                             "class" => "",
                             "heading" => esc_html__("Facebook Link", "zitronesolutions"),
                             "param_name" => "facebook_url",
                             "value" => "",
                             "description" => esc_html__("Set Facebook link.", "zitronesolutions"),
                        ),

                        array(
                             "type" => "href",
                             "class" => "",
                             "heading" => esc_html__("Twitter Link", "zitronesolutions"),
                             "param_name" => "twitter_url",
                             "value" => "",
                             "description" => esc_html__("Set Twitter link.", "zitronesolutions"),
                        ),

                        array(
                             "type" => "href",
                             "class" => "",
                             "heading" => esc_html__("Google Link", "zitronesolutions"),
                             "param_name" => "google_url",
                             "value" => "",
                             "description" => esc_html__("Set Google Plus link.", "zitronesolutions"),
                        ),

                        array(
                             "type" => "href",
                             "class" => "",
                             "heading" => esc_html__("Linkedin Link", "zitronesolutions"),
                             "param_name" => "linkedin_url",
                             "value" => "",
                             "description" => esc_html__("Set Linkedin link.", "zitronesolutions"),
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
                            "param_name" => "team_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),
                    )
                ));
            }
        }



        // Render the element on front-end

        public function zs_team_shrt($atts, $content = null) {
            extract(shortcode_atts(array(
                'description' => '',
                'title' => '',
                'position' => '',
                'hover_color' => '',
                'more_link_url' => '',
                'image' => '',
                'facebook_url' => '',
                'twitter_url' => '',
                'google_url' => '',
                'linkedin_url' => '',
                'css_animation' => '',
                'elem_animation_delay' => '',
                'team_extra_class' => '',
            ), $atts));

            $animation_delay = $href_more = $link_target_more = $link_title_more = '';

            $image  = wpb_getImageBySize($params = array(
                'post_id' => NULL,
                'attach_id' => $image,
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

            $output = '<div class="team-member '.$css_animation.' '.$team_extra_class.'" '.$animation_delay.'>
              <div class="team-content">
                  <div class="team-image">'.$image['thumbnail'].'
                  <div class="team-content-hover" style="background:'.$hover_color.';">
                  <div class="gradient-overlay"></div>
                  <h5>'.$title.'</h5>
                  <span class="team-subtitle">'.$position.'</span>
                  <p>'.$description.'</p>';
                  if(isset($more_link_url) && $more_link_url !== '' &&  $href_more['url'] !== '') {
                    $output .='<a class="team-more-link" href="'.$href_more['url'].'"'.$link_target_more.''.$link_title_more.'>'.$href_more['title'].'</a>';
                  }
                  $output .='<div class="team-socials">';
                    if(isset($facebook_url) && $facebook_url !== '') {
                      $output .='<a href="'.$facebook_url.'" target="_blank"><span class="fa fa-facebook"></span></a>';
                    }
                    if(isset($twitter_url) && $twitter_url !== '') {
                      $output .='<a href="'.$twitter_url.'" target="_blank"><span class="fa fa-twitter"></span></a>';
                    }
                    if(isset($google_url) && $google_url !== '') {
                      $output .='<a href="'.$google_url.'" target="_blank"><span class="fa fa-google-plus"></span></a>';
                    }
                    if(isset($linkedin_url) && $linkedin_url !== '') {
                      $output .='<a href="'.$linkedin_url.'" target="_blank"><span class="fa fa-linkedin"></span></a>';
                    }
                  $output .='</div>
                  </div></div>
                  <h5>'.$title.'</h5>
                  <span class="team-subtitle">'.$position.'</span>
                </div>
            </div>';
            return $output;
        }
    }
}

if (class_exists('ZS_ELEM_TEAM')) {
    $ZS_ELEM_TEAM = new ZS_ELEM_TEAM;
}
?>
