<?php 

// $output .= '<section'. $block_id .' class="lift-elements lift-' . $this->name . $theme . $css_class .$classname.''.($add_box_button ? ' lift-hold-click' : '').$initial_loading_animation.'"' . str_replace('``', '', $attribute) . '>';
$output .= '<section'. $block_id .' class="lift-elements lift-' . $this->name . $theme . $css_class .$classname.$cssaddclass.''.($add_box_button ? ' lift-hold-click' : '').$initial_loading_animation.'"' . str_replace('``', '', $attribute) . '>';
include 'inc/article_top.php';
include 'inc/article_heading.php';
$image_attrs_escaped ? include 'inc/img.php' : null;
include 'inc/article_bottom.php';
$output .= $add_box_button ? '' . $this->extractLink($link, $title,false,true,false,null) . '' : null;
$output .= '</section><!-- .lift-' . $this->name . ' -->';