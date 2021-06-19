<?php
$output .= $content ? '<div class="lift-content'.$applyClass.'">' . do_shortcode($content) . '</div>' : null;
$output .= $add_button ? '<p class="lift-button">' . $this->extractLink($link, $title,false,false,true,$btn_font_size) . '</p>' : null;
$output .= '</article>';
if($box_bg) {
    $output .= '<div class="box-bg"></div>';
}