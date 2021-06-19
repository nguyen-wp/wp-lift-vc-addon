<?php

if (!defined('ABSPATH')) {
	die('Silly human what are you doing here');
}


if (!class_exists('liftVC_Addons_Boiler')) {

	class liftVC_Addons_Boiler extends LIFT_Helpers
	{

		public $name = 'boiler';
		public $pNicename = 'LIFT Boiler';

		public function __construct()
		{

			add_action('wp_enqueue_scripts', array($this, 'load_scripts'));
			add_shortcode('lift-' . $this->name . '-shortcode', array($this, 'output'));

			// Map shortcode to Visual Composer
			if (function_exists('vc_lean_map')) {
				vc_lean_map('lift-' . $this->name . '-shortcode', array($this, 'functionLoader'));

			}
		}

		public function load_scripts()
		{
			wp_enqueue_script(
				'lift-' . $this->name,
				plugin_dir_url(__FILE__) . 'js/dist/main.prod.js',
				array('jquery'),
				LIFT_VERSION
			);
			wp_enqueue_style(
				'lift-' . $this->name,
				plugin_dir_url(__FILE__) . 'css/dist/main.min.css',
				array(),
				LIFT_VERSION
			);
		}

		public function functionLoader()
		{

			return array(
				'name'        => esc_html__($this->pNicename, 'js_composer'),
				'description' => esc_html__('Add new ' . $this->pNicename, 'js_composer'),
				'base'        => 'lift_vc_' . $this->name,
				'is_container' => true,
				'category' => __('LIFT Addons', 'js_composer'),
				'icon' => 'icon-lift-adminicon icon-lift-' . $this->name,
				'show_settings_on_create' => true,
				'params'      => array(
					array(
						'type' => 'textfield',
						'holder' => 'h2',
						'class' => 'lift-title',
						'heading' => __('Heading', 'js_composer'),
						'param_name' => 'title',
						'value' => __('', 'js_composer'),
						'weight' => 0,
						'edit_field_class' => 'vc_col-sm-8 admin-lift-col',
						'group' => $this->pNicename,
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Heading Tag', 'js_composer' ),
						'param_name' => 'tag',
						'value' => 'h3',
						'save_always' => true,
						'not_empty' => true,
						'value' => array(
							esc_html__( 'Default', 'js_composer' ) => 'h3',
							esc_html__( 'h2', 'js_composer' ) => 'h2',
							esc_html__( 'h3', 'js_composer' ) => 'h3',
							esc_html__( 'h4', 'js_composer' ) => 'h4',
							esc_html__( 'h5', 'js_composer' ) => 'h5',
							esc_html__( 'h6', 'js_composer' ) => 'h6',
							esc_html__( 'p', 'js_composer' ) => 'p',
							esc_html__( 'div', 'js_composer' ) => 'div',
						),
						'edit_field_class' => 'vc_col-sm-4 admin-lift-col pt-0',
						'group' => $this->pNicename,
					),
					array(
						'type' => 'attach_image',
						'holder' => 'img',
						'class' => 'lift-img',
						'heading' => __('Image', 'js_composer'),
						'param_name' => 'img_single',
						'edit_field_class' => 'vc_col-sm-12 admin-lift-col',
						'group' => $this->pNicename,
					),
					array(
						'type' => 'attach_images',
						'heading' => __('Image Group', 'js_composer'),
						'param_name' => 'img_group',
						'admin_label' => false,
						'edit_field_class' => 'vc_col-sm-12 admin-lift-col',
						'group' => $this->pNicename,
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Box layout', 'js_composer' ),
						'param_name' => 'theme',
						'admin_label' => true,
						'value' => array(
							esc_html__( 'Default', 'js_composer' ) => 'default',
							esc_html__( 'Hover', 'js_composer' ) => 'style-1',
						),
						'description' => esc_html__( 'Select box layout.', 'js_composer' ),
						'edit_field_class' => 'vc_col-sm-6 admin-lift-col pt-0',
						'group' => __('General', 'js_composer')
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Add box click', 'js_composer' ) . '?',
						'description' => esc_html__( 'Add box click.', 'js_composer' ),
						'param_name' => 'add_box_button',
						'edit_field_class' => 'vc_col-sm-6 admin-lift-col pt-0',
						'group' => __('General', 'js_composer')
					),
					array(
						'type' => 'animation_style',
						'heading' => __( 'Animation Style', 'text-domain' ),
						'param_name' => 'css_animation',
						'description' => __( 'Choose your animation style', 'text-domain' ),
						'admin_label' => false,
						'weight' => 0,
						'group' => __('General', 'js_composer')
					),
					
					array(
						"type" => "textfield",
						"heading" => esc_html__("Animation Delay", "salient-core"),
						"param_name" => "delay",
						"admin_label" => false,
						"description" => esc_html__("Enter delay (in milliseconds) if needed e.g. 150. This parameter comes in handy when creating the animate in \"one by one\" effect.", "salient-core"),
						'group' => __('General', 'js_composer')
					),
					array(
						"type" => "lift_group_header",
						"class" => "",
						"heading" => esc_html__("Element", "js_composer" ),
						"param_name" => "group_header_1",
						"edit_field_class" => "",
						"value" => '',
						'group' => __('General', 'js_composer')
					),
					array(
						'type' => 'el_id',
						'heading' => esc_html__('Element ID', 'js_composer'),
						'param_name' => 'el_id',
						'group' => __('General', 'js_composer')
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Extra class name', 'js_composer'),
						'param_name' => 'el_class',
						'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer'),
						'group' => __('General', 'js_composer')
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('HTML Attribute', 'js_composer'),
						'param_name' => 'el_attribute',
						'description' => esc_html__('Enter html attr (Example: "data-bg").', 'js_composer'),
						'group' => __('General', 'js_composer')
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Content Padding', 'js_composer' ),
						'param_name' => 'content_padding',
						'value' => '',
						'description' => esc_html__( 'e.g. 40px 20px or 1rem or 1rem 2rem .5rem 10px', 'js_composer' ),
						'edit_field_class' => 'vc_col-sm-6 pt-0 admin-lift-col',
						'group' => __('Design Options', 'js_composer')
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Content Margin', 'js_composer' ),
						'param_name' => 'content_margin',
						'value' => '',
						'description' => esc_html__( 'e.g. 40px 20px or 1rem or 1rem 2rem .5rem 10px', 'js_composer' ),
						'edit_field_class' => 'vc_col-sm-6 pt-0 admin-lift-col',
						'group' => __('Design Options', 'js_composer')
					),
					array(
						'type' => 'css_editor',
						'heading' => esc_html__('CSS box', 'js_composer'),
						'param_name' => 'css',
						'group' => esc_html__('Design Options', 'js_composer'),
					),
				),
			);
		}
		public function output($atts, $content = null)
		{

			$block_id = isset($atts['el_id']) ? ' id="'.$atts['el_id'].'"' : '';
			$attribute = isset($atts['el_attribute']) ? ' ' . $atts['el_attribute'] : '';
			$css = isset($atts["css"]) ? $atts["css"] : '';
			$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '), $this->settings['base'], $atts);
			$theme = isset($atts['theme']) ? ' lift-' . $atts['theme'] : '';
			$classname = isset($atts['el_class']) ? ' ' . $atts['el_class'] : '';
			$css_animation = isset($atts['css_animation']) ? ' wpb_animate_when_almost_visible wpb_' . $atts['css_animation'] . ' animate__animated animate__' . $atts['css_animation']. ' ' . $atts['css_animation'] : null;
			$content_padding = isset($atts['content_padding']) ? $atts['content_padding'] : null;
			$content_margin = isset($atts['content_margin']) ? $atts['content_margin'] : null;
			$title = isset($atts['title']) ? $atts['title'] : null;
			$img_single = isset($atts['img_single']) ? $atts['img_single'] : null;
			$img_group = isset($atts['img_group']) ? $atts['img_group'] : null;
			$add_box_button = $atts['add_box_button'] ? true: false;
			$tag = isset($atts["tag"]) ? $atts["tag"] : 'h2';

			// Admin
			$settings = shortcode_atts(array(
				'el_attribute' => '',
				'el_id' => '',
				'el_class' => '',
			), $atts);
			extract($settings);
			
			// CSSBUILD 
			$randomNumClass = $this->generateRandomString(10);
			$cssname = $atts['css'] ? vc_shortcode_custom_css_class($css, '.') : '.lift_'.$randomNumClass;
			$cssaddclass = $atts['css'] ? '' : ' lift_'.$randomNumClass;
			$css_build = '';
			$css_build .= $content_padding ? ''. $cssname.'{padding:'.$content_padding.'!important;}' : null;
			$css_build .= $content_margin ? ''. $cssname.'{margin:'.$content_margin.'!important;}' : null;


			// FrontEnd
			$output = ($css || $css_build) ? '<style>' . $css .$css_build. '</style>' : '';
			$output .= '<section'. $block_id .' class="lift-elements lift-' . $this->name . $css_class.$theme. $classname.$cssaddclass.'"' . str_replace('``', '', $attribute) . '>';
			$output .= $title ? $this->applyHeadingCustomPost($title,$tag,'#') : null;
			$output .= $content ?  do_shortcode($content) : null;
			$output .= $add_box_button ? '' . $this->extractLinkCustomPost('#',$title,false) . '' : null;
			$output .= '</section>';
			$output .= '<!-- .lift-' . $this->name . ' -->';

			return apply_filters(
				'lift_' . $this->name . '_output',
				$output,
				$content,
				$settings
			);
		}

	}
}
new liftVC_Addons_Boiler;
