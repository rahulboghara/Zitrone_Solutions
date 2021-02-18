<?php
if (!class_exists('ZS_ELEM_PRICING_TABLE')) {
    class ZS_ELEM_PRICING_TABLE extends ZITRONESOLUTIONS_ADDON_CLASS {
        function __construct() {
            add_action('init', array($this, 'zs_pricingtable_init'));
            add_shortcode('tek_pricing', array($this, 'zs_pricingtable_shrt'));
        }
        // Element configuration in admin
        function zs_pricingtable_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Pricing Table", "zitronesolutions"),
                    "description" => esc_html__("Pricing table with extended settings.", "zitronesolutions"),
                    "base" => "tek_pricing",
                    "class" => "",
                    "icon" => plugins_url("assets/element_icons/pricing-table.png", dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Plan title", "zitronesolutions"),
                            "param_name" => "pricing_title",
                            "admin_label" => true,
                            "value" => "",
                            "description" => esc_html__("Enter your pricing plan title.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Plan value", "zitronesolutions"),
                            "param_name" => "pricing_price",
                            "value" => "",
                            "description" => esc_html__("Enter price for this plan.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Plan period", "zitronesolutions"),
                            "param_name" => "pricing_time",
                            "value" => "",
                            "description" => esc_html__("Enter your pricing plan period (ex. /month)", "zitronesolutions")
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Plan currency", "zitronesolutions"),
                            "param_name" => "pricing_currency",
                            "value" => array(
                                "Dollar" => "currency-dollar",
                                "Euro" => "currency-euro",
                                "Pound" => "currency-pound"
                            ),
                            "save_always" => true,
                            "description" => esc_html__("Select pricing plan currency.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Other currency", "zitronesolutions"),
                            "param_name" => "pricing_other_currency",
                            "value" => "",
                            "description" => esc_html__("Pricing plan custom currency.", "zitronesolutions")
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Currency position", "zitronesolutions"),
                            "param_name" => "pricing_currency_position",
                            "value" => array(
                                "Left" => "currency-position-left",
                                "Right" => "currency-position-right"
                            ),
                            "save_always" => true,
                            "description" => esc_html__("Select pricing plan currency.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Pricing subtitle", "zitronesolutions"),
                            "param_name" => "pricing_other_text",
                            "value" => "",
                            "description" => esc_html__("Pricing plan subtitle", "zitronesolutions")
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Highlight plan", "zitronesolutions"),
                            "param_name" => "highlight_plan",
                            "value" => array(
                                "No" => "",
                                "Yes" => "active"
                            ),
                            "save_always" => true,
                            "description" => esc_html__("Select if pricing plan is highlighted", "zitronesolutions")
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Color Scheme", "zitronesolutions"),
                            "param_name" => "pricing_scheme",
                            "value" => array(
                                "Dark Scheme" => "",
                                "Light Scheme" => "light-scheme"
                            ),
                            "save_always" => true,
                            "description" => esc_html__("Pricing Plan Color Scheme", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Button text", "zitronesolutions"),
                            "param_name" => "pricing_button_text",
                            "value" => "",
                            "description" => esc_html__("Pricing table submit button text.", "zitronesolutions")
                        ),
            						array(
            							 "type" => "vc_link",
            							 "class" => "",
            							 "heading" => esc_html__("Button link", "zitronesolutions"),
            							 "param_name" => "pricing_button_link",
            							 "value" => "",
            							 "description" => esc_html__("Set link address, title and target.", "zitronesolutions"),
            						),
                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Pricing Plan Image", "zitronesolutions"),
                            "param_name" => "pricing_img",
                            "value" => "",
                            "description" => esc_html__("Upload your own custom image.", "zitronesolutions"),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("List Title", "zitronesolutions"),
                            "param_name" => "list_title",
                            "value" => "",
                            "description" => esc_html__("Pricing plan list title", "zitronesolutions")
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Button CSS Animation", "zitronesolutions"),
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
                            "save_always" => true,
                            "description" => esc_html__("Select type of animation for element to be animated when it enters the browsers viewport (Note: works only in modern browsers).", "zitronesolutions"),
                        ),
                         array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Button Animation Delay:", "zitronesolutions"),
                            "param_name" => "elem_animation_delay",
                            "value" => array(
                                "0 ms"              => "",
                                "200 ms"            => "200",
                                "400 ms"            => "400",
                                "600 ms"            => "600",
                            ),
                            "save_always" => true,
                            "dependency" =>	array(
                                "element" => "css_animation",
                                "value" => array("zs-animated fadeIn", "zs-animated fadeInDown", "zs-animated fadeInLeft", "zs-animated fadeInRight", "zs-animated fadeInUp", "zs-animated zoomIn")
                            ),
                            "description" => esc_html__("Enter animation delay in ms", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 1 value", "zitronesolutions"),
                            "param_name" => "pricing_option1_value",
                            "value" => "",
                            "description" => esc_html__("Enter your option 1 value.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 2 value", "zitronesolutions"),
                            "param_name" => "pricing_option2_value",
                            "value" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 3 value", "zitronesolutions"),
                            "param_name" => "pricing_option3_value",
                            "value" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 4 value", "zitronesolutions"),
                            "param_name" => "pricing_option4_value",
                            "value" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 5 value", "zitronesolutions"),
                            "param_name" => "pricing_option5_value",
                            "value" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 6 value", "zitronesolutions"),
                            "param_name" => "pricing_option6_value",
                            "value" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 7 value", "zitronesolutions"),
                            "param_name" => "pricing_option7_value",
                            "value" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 8 value", "zitronesolutions"),
                            "param_name" => "pricing_option8_value",
                            "value" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 9 value", "zitronesolutions"),
                            "param_name" => "pricing_option9_value",
                            "value" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 10 value", "zitronesolutions"),
                            "param_name" => "pricing_option10_value",
                            "value" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 11 value", "zitronesolutions"),
                            "param_name" => "pricing_option11_value",
                            "value" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 12 value", "zitronesolutions"),
                            "param_name" => "pricing_option12_value",
                            "value" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 13 value", "zitronesolutions"),
                            "param_name" => "pricing_option13_value",
                            "value" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 14 value", "zitronesolutions"),
                            "param_name" => "pricing_option14_value",
                            "value" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Option 15 value", "zitronesolutions"),
                            "param_name" => "pricing_option15_value",
                            "value" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "zitronesolutions"),
                            "param_name" => "pricing_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),
                    )
                ));
            }
        }

		// Render the element on front-end
        public function zs_pricingtable_shrt($atts, $content = null)
        {

			      $output = $link_target = $link_title = $pricing_button_link = $secodary_link = $tt_pricing_img = $tt_pricing_img_array = $animation_delay = $currency_symbol = '';

            extract(shortcode_atts(array(
                'pricing_title'                 => '',
                'pricing_price' 			          => '',
                'pricing_time' 				          => '',
                'pricing_currency' 			        => '',
                'pricing_other_currency'        => '',
                'pricing_currency_position'     => '',
                'pricing_other_text' 	          => '',
                'pricing_button_text' 		      => '',
                'pricing_button_link'           => '',
                'highlight_plan'                => '',
                'pricing_scheme'                => '',
                'pricing_img'                   => '',
                'list_title' 	           	      => '',
                'css_animation'                 => '',
                'elem_animation_delay'          => '',
                'pricing_option1_value' 	      => '',
                'pricing_option2_value' 	      => '',
                'pricing_option3_value' 	      => '',
                'pricing_option4_value' 	      => '',
                'pricing_option5_value'         => '',
                'pricing_option6_value'         => '',
                'pricing_option7_value'         => '',
                'pricing_option8_value'         => '',
                'pricing_option9_value'         => '',
                'pricing_option10_value'        => '',
                'pricing_option11_value'        => '',
                'pricing_option12_value'        => '',
                'pricing_option13_value'        => '',
                'pricing_option14_value'        => '',
                'pricing_option15_value' 	      => '',
                'pricing_extra_class'           => ''
            ), $atts));

            switch($pricing_currency){
      				case 'currency-dollar':
      					$currency_symbol = "&#36;";
      				break;

      				case 'currency-euro':
      					$currency_symbol = "&#128;";
      				break;

              case 'currency-pound':
      					$currency_symbol = "&#163;";
      				break;

      				default:
      			}

            if (!empty($pricing_other_currency)) {
                $currency_symbol = $pricing_other_currency;
            }

           if (($highlight_plan) != "active") {
                $secodary_link = "secondary-button-inverse";
            }

      			$href = vc_build_link($pricing_button_link);
      			if($href['url'] !== '') {
      				$link_target = (isset($href['target'])) ? 'target="'.$href['target'].'"' : '';
      				$link_title = (isset($href['title'])) ? 'title="'.$href['title'].'"' : '';
      			}

            if (!empty($pricing_img)) {
            $tt_pricing_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $pricing_img, 'thumb_size' => 'full', 'class' => "" ) );
            $tt_pricing_img = '<div class="pricing-image">'. $tt_pricing_img_array['thumbnail'].'</div>';
            }

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            $output = '
				<div class="pricing-table '.$highlight_plan.' '.$pricing_scheme.' ' .$pricing_extra_class.'">
					<div class="row pricing-title">
					<div class="row pricing-title-content">'.$pricing_title.'</div>
						<div class="other-text">'.$pricing_other_text.'</div>
					</div>
					<div class="row pricing">
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="row">
								<div class="pricing-img">'.$tt_pricing_img.'</div>';
                if ($pricing_currency_position == "currency-position-left") {
				          $output .= '<span class="pricing-price"><span class="currency">'.$currency_symbol.'</span>'.$pricing_price.'</span>';
                } elseif ($pricing_currency_position == "currency-position-right") {
                  $output .= '<span class="pricing-price">'.$pricing_price.'<span class="currency">'.$currency_symbol.'</span></span>';
                }
							$output .= '</div>
						</div>
						<div class="pricing-meta">
							<span class="pricing-time">'.$pricing_time.'</span>';
						if ($pricing_button_text) $output .= '<a href="'.$href['url'].'"'.$link_target.''.$link_title.' class="tt_button '.$css_animation.'" '.$animation_delay.'>'.$pricing_button_text.'</a>';
					$output .=	'</div>
						<div class="pricing-options-container">';

						if ($list_title)  $output .= '<div class="pricing-row pricing-list-title">'.$list_title.'</div>';
						if ($pricing_option1_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option1_value.'</span></span></div>';
						if ($pricing_option2_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option2_value.'</span></span></div>';
						if ($pricing_option3_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option3_value.'</span></span></div>';
						if ($pricing_option4_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option4_value.'</span></span></div>';
						if ($pricing_option5_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option5_value.'</span></span></div>';
						if ($pricing_option6_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option6_value.'</span></span></div>';
						if ($pricing_option7_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option7_value.'</span></span></div>';
						if ($pricing_option8_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option8_value.'</span></span></div>';
						if ($pricing_option9_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option9_value.'</span></span></div>';
						if ($pricing_option10_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option10_value.'</span></span></div>';
						if ($pricing_option11_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option11_value.'</span></span></div>';
						if ($pricing_option12_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option12_value.'</span></span></div>';
						if ($pricing_option13_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option13_value.'</span></span></div>';
						if ($pricing_option14_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option14_value.'</span></span></div>';
						if ($pricing_option15_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option15_value.'</span></span></div>';

						$output .= '</div>
					</div>
				</div>';

			return $output;
        }
    }
}
if (class_exists('ZS_ELEM_PRICING_TABLE')) {
    $ZS_ELEM_PRICING_TABLE = new ZS_ELEM_PRICING_TABLE;
}
?>
