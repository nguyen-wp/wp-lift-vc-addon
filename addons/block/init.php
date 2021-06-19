<?php


if (!defined('ABSPATH')) {
	die('Silly human what are you doing here');
}


if (!class_exists('liftVC_Addons_Block')) {

	class liftVC_Addons_Block extends LIFT_Helpers
	{

		public $name = 'block';
		public $pNicename = 'LIFT Block';

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

			$randomIDGen = $this->generateRandomString(10);
			$args = array(
			'post_type'=> 'blocks',
			'orderby'    => 'ID',
			'post_status' => 'publish',
			'order'    => 'DESC',
			'posts_per_page' => -1 // this will retrive all the post that is published 
			);
			$result = new WP_Query( $args );
			$taxonomies = array();
			foreach ($result->posts as &$value) {
				array_push($taxonomies, $value->post_name);
			}
			$arrapList = array(
				'param_name'    => 'content',
				'heading'       => __('LIFT Block', 'js_composer'),
				'description' => esc_html__('Error! You need install LIFT Blocks first', 'js_composer'),
				'holder'        => 'div',
				'group' => $this->pNicename,
			);
			if($taxonomies) {
				$arrapList = array(
					'param_name'    => 'content',
					'type'          => 'dropdown',
					'value'         => $taxonomies ? $taxonomies : null, // here I'm stuck
					'heading'       => __('LIFT Block', 'js_composer'),
					'description' => esc_html__('Add LIFT Block', 'js_composer'),
					'holder'        => 'div',
					'group' => $this->pNicename,
				);
			}

			return array(
				'name'        => esc_html__($this->pNicename, 'js_composer'),
				'description' => esc_html__('Add new ' . $this->pNicename, 'js_composer'),
				'base'        => 'lift_vc_' . $this->name,
				'category' => __('LIFT Addons', 'js_composer'),
				'icon' => 'icon-lift-adminicon icon-lift-' . $this->name,
				'show_settings_on_create' => true,
				'params'      => array(
					$arrapList,
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
				),
			);
		}

		public function output($atts, $content = null)
		{

			$block_id = isset($atts['el_id']) ? ' id="'.$atts['el_id'].'"' : '';
			$attribute = isset($atts['el_attribute']) ? ' ' . $atts['el_attribute'] : '';
			$css = isset($atts["css"]) ? $atts["css"] : '';
			$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '), $this->settings['base'], $atts);
			$classname = isset($atts['el_class']) ? ' ' . $atts['el_class'] : '';

			// Admin
			$settings = shortcode_atts(array(
				'el_attribute' => '',
				'el_id' => '',
				'el_class' => '',
			), $atts);
			extract($settings);
			// FrontEnd
			$output = $css ? '<style>' . $css . '</style>' : '';
			if($block_id || $css_class || $attribute) {
				$output .= '<section'. $block_id .' class="lift-elements lift-' . $this->name . $css_class. $classname.'"' . str_replace('``', '', $attribute) . '>';
			}
			$output .= $content ?  do_shortcode('[blocks id="'.$content.'"]') : null;
			if($block_id || $css_class || $attribute) {
				$output .= '</section>';
			}
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
new liftVC_Addons_Block;
