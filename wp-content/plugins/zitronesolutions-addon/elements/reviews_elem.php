<?php

if (!class_exists('ZS_ELEM_REVIEWS')) {

    class ZS_ELEM_REVIEWS extends ZITRONESOLUTIONS_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'zs_reviews_init'));
            add_shortcode('tek_reviews', array($this, 'zs_reviews_shrt'));
        }

        // Element configuration in admin

        function zs_reviews_init() {

            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Reviews", "zitronesolutions"),
                    "description" => esc_html__("Display reviews with ratings.", "zitronesolutions"),
                    "base" => "tek_reviews",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/reviews.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Author name", "zitronesolutions"),
                            "param_name" => "rw_author_name",
                            "admin_label" => true,
                            "value" => "",
	                          "description" => esc_html__("Write the review author name.", "zitronesolutions"),
                         ),

                         array(
                             "type" => "colorpicker",
                             "class" => "",
                             "heading" => esc_html__("Author name text color", "zitronesolutions"),
                             "param_name" => "rw_author_name_color",
                             "value" => "",
                             "description" => esc_html__("Choose author name text color. If none selected, the default theme color will be used.", "zitronesolutions"),
                         ),

                         array(
                             "type" => "textfield",
                             "class" => "",
                             "heading" => esc_html__("Author description", "zitronesolutions"),
                             "param_name" => "rw_author_desc",
                             "value" => "",
				                     "description" => esc_html__("Write the review author description.", "zitronesolutions"),
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Author description text color", "zitronesolutions"),
                            "param_name" => "rw_author_desc_color",
                            "value" => "",
                            "description" => esc_html__("Choose author description text color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),

                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Author profile image", "zitronesolutions"),
                            "param_name" => "rw_author_image",
                            "value" => "",
                            "description" => esc_html__("Upload author profile image.", "zitronesolutions"),
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Review title", "zitronesolutions"),
                            "param_name" => "rw_review_title",
                            "value" => "",
                           "description" => esc_html__("This message will be displayed under the rating stars.", "zitronesolutions"),
                       ),

                       array(
                           "type" => "colorpicker",
                           "class" => "",
                           "heading" => esc_html__("Review title text color", "zitronesolutions"),
                           "param_name" => "rw_review_title_color",
                           "value" => "",
                           "description" => esc_html__("Choose review title text color. If none selected, the default theme color will be used.", "zitronesolutions"),
                       ),

                        array(
                            "type" => "textarea",
                            "class" => "",
                            "heading" => esc_html__("Review message", "zitronesolutions"),
                            "param_name" => "rw_review_message",
                            "value" => "",
                            "description" => esc_html__("Write the review message.", "zitronesolutions")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Review message text color", "zitronesolutions"),
                            "param_name" => "rw_review_message_color",
                            "value" => "",
                            "description" => esc_html__("Choose review message text color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),

                        array(
                             "type"	=>	"dropdown",
                             "class" =>	"",
                             "heading" => esc_html__("Link type", "zitronesolutions"),
                             "param_name" => "rw_custom_link",
                             "value" =>	array(
                                    esc_html__( "No link", "zitronesolutions" ) => "disable-link",
                                    esc_html__( "Add a custom link", "zitronesolutions" )	=> "enable-link",
                                ),
                             "save_always" => true,
                             "description" => esc_html__("Enable box link from here.", "zitronesolutions"),
                        ),

                        array(
                             "type"	=>	"vc_link",
                             "class" =>	"",
                             "heading" => esc_html__("Link settings", "zitronesolutions"),
                             "param_name" => "rw_link_settings",
                             "value" =>	"",
                             "description" => esc_html__("The link will be added below the review message.", "zitronesolutions"),
                             "dependency" => array(
                                "element" => "rw_custom_link",
                                "value"	=> array( "enable-link" ),
                            ),
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Show star rating","zitronesolutions"),
                            "param_name"    =>  "rw_show_review_rating",
                            "value"         =>  array(
                                    "Show star rating"   => "show_stars",
                                    "Hide star rating"   => "hide_stars"
                                ),
                            "save_always" => true,
                            "description"   =>  esc_html__("Display stars rating.", "zitronesolutions")
                        ),

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Review rating","zitronesolutions"),
                            "param_name"	=>	"rw_review_rating",
                            "value"			=>	array(
                                    "1 star"   => "one_star",
                                    "2 stars"  => "two_stars",
                                    "3 stars"  => "three_stars",
                                    "4 stars"  => "four_stars",
                                    "5 stars"  => "five_stars",
                                ),
                            "save_always" => true,
                            "dependency" =>	array(
                                "element" => "rw_show_review_rating",
                                "value" => array("show_stars")
                            ),
                            "description"	=>	esc_html__("Select review rating.", "zitronesolutions")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Star color", "zitronesolutions"),
                            "param_name" => "rw_star_color",
                            "value" => "",
                            "dependency" =>	array(
                                "element" => "rw_show_review_rating",
                                "value" => array("show_stars")
                            ),
                            "description" => esc_html__("Choose star color.", "zitronesolutions")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Box background color", "zitronesolutions"),
                            "param_name" => "rw_box_background",
                            "value" => "",
                            "description" => esc_html__("Choose review box background color. If none selected, the default theme color will be used.", "zitronesolutions")
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
                            "param_name" => "rw_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),

                    )
                ));
            }
        }



		// Render the element on front-end

        public function zs_reviews_shrt($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'rw_author_name' => '',
                'rw_author_name_color' => '',
                'rw_author_desc' => '',
                'rw_author_desc_color' => '',
                'rw_author_image' => '',
                'rw_review_title' => '',
                'rw_review_title_color' => '',
                'rw_review_message' => '',
                'rw_review_message_color' => '',
                'rw_custom_link' => '',
                'rw_link_settings' => '',
                'rw_show_review_rating' => '',
                'rw_review_rating' => '',
                'rw_star_color' => '',
                'rw_box_background' => '',
                'css_animation' => '',
                'elem_animation_delay' => '',
                'rw_extra_class' => '',
            ), $atts));

            $author_img = $full_star = $empty_star = $rating_stars = $rw_author_img_array = $author_image = $link_target = $link_title = $href = $animation_delay = '';

            $full_star = '<span class="fa fa-star" '.(!empty($rw_star_color) ? 'style="color: '.$rw_star_color.';"' : '').'></span>';
            $empty_star = '<span class="fa fa-star-o" '.(!empty($rw_star_color) ? 'style="color: '.$rw_star_color.';"' : '').'></span>';

            switch($rw_review_rating){
      				case 'one_star':
      					$rating_stars = $full_star.str_repeat($empty_star, 4);
      				break;

                      case 'two_stars':
      					$rating_stars = str_repeat($full_star, 2).str_repeat($empty_star, 3);
      				break;

                      case 'three_stars':
      					$rating_stars = str_repeat($full_star, 3).str_repeat($empty_star, 2);
      				break;

                      case 'four_stars':
      					$rating_stars = str_repeat($full_star, 4).$empty_star;
      				break;

                      case 'five_stars':
      					$rating_stars = str_repeat($full_star, 5);
      				break;

      				default:
      			}

      			if(!empty($rw_author_image)){
      				$rw_author_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $rw_author_image, 'thumb_size' => 'full', 'class' => "" ) );
                      $author_image = $rw_author_img_array['thumbnail'];
      			}

            /* Link settings */
            if ($rw_custom_link  == 'enable-link') {
              $href = vc_build_link($rw_link_settings);
              if ($href['target'] == "") { $href['target'] = "_self"; }

        			if($href['url'] !== '') {
        				$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : 'target="_self"';
        				$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
        			}
            }

            /* CSS Animation */
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            /* Animation delay */
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            $output = '
                <div class="key-reviews '.$css_animation.' '.$rw_extra_class.'" '.(!empty($rw_box_background) ? 'style="background-color: '.$rw_box_background.';"' : '').' '.$animation_delay.'>
                    <div class="rw_header">
                        <div class="rw-authorimg">'.$author_image.'</div>
                        <div class="rw-author-details">
                            <h4 '.(!empty($rw_author_name_color) ? 'style="color: '.$rw_author_name_color.';"' : '').'>'.$rw_author_name.'</h4>
                            <p '.(!empty($rw_author_desc_color) ? 'style="color: '.$rw_author_desc_color.';"' : '').'>'.$rw_author_desc.'</p>
                        </div>
                    </div>
                    <div class="rw_message" '.(!empty($rw_review_message_color) ? 'style="color: '.$rw_review_message_color.';"' : '').'>'.$rw_review_message;
                    if ($rw_custom_link == "enable-link" && $href['title'] != '') {
                      $output .= '<div class="rw-link"><a href="'.$href['url'].'"'.$link_target.''.$link_title.'>'.$href['title'].'</a></div>';
                    }
                    $output .= '</div>';
                    if ( $rw_show_review_rating !== "hide_stars" ) {
                      $output .= '<div class="rw_rating">
                         '.$rating_stars.'
                         <p class="rw-title" '.(!empty($rw_review_title_color) ? 'style="color: '.$rw_review_title_color.';"' : '').'>'.$rw_review_title.'</p>
                      </div>';
                    }
                $output .= '</div>';

            return $output;

        }
    }
}

if (class_exists('ZS_ELEM_REVIEWS')) {
    $ZS_ELEM_REVIEWS = new ZS_ELEM_REVIEWS;
}

?>
