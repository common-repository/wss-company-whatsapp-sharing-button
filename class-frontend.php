<?php

function wss_style() {
	wp_enqueue_style( 'wss-style', plugins_url('style.css' , __FILE__ ));
}

add_action( 'wp_enqueue_scripts', 'wss_style' );

//AUTO BUTTON INSERTION
function wa_btn($content) {
	$options = get_option('wa_btn');
	if (!isset($options['top'])) {$options['top'] = "off";}
	if (!isset($options['btm'])) {$options['btm'] = "off";}
	if (!isset($options['posts'])) {$options['posts'] = "off";}
	if (!isset($options['pages'])) {$options['pages'] = "off";}
	if (!isset($options['homepage'])) {$options['homepage'] = "off";}
	if (!isset($options['btn_text'])) {$options['btn_text'] = "Comparte en WhatsApp";}
	if (!isset($options['button_bg_color'])) {$options['button_bg_color'] = "#5cbe4a";}
	if (!isset($options['tracking'])) {$tracking = "";} else {$tracking='?utm_source=WhatsApp%26utm_medium=Messenger';}
	$btn='';
	if (
	   (is_single() && $options['posts'] == 'on') ||
       (is_page() && $options['pages'] == 'on') ||
       ((is_home() || is_front_page()) && $options['homepage'] == 'on')) {
		$btn = '<!--' . esc_html__('WhatsApp Share for WordPress:','wsshare') . 'https://www.wsscompany.com.ve/ --><div class="wss_container" style="background-color:'.$options['button_bg_color'].'"><a href="whatsapp://send?text='.get_the_title().' - '.urlencode_deep(get_permalink()).$tracking.'" class="wss">'.$options['btn_text'].'</a></div>';
      	if ($options['top'] == 'on' && $options['btm'] == 'on') {$output = $btn.$content.$btn;}
      	elseif ($options['top'] == 'on' && $options['btm'] != 'on') {$btn .= $content; $output = $btn;}
      	elseif ($options['top'] != 'on' && $options['btm'] == 'on') {$output = $content.$btn;}
      	else {$output = $content;}
	} else {$output = $content;}
	return $output;
}
add_filter ('the_content', 'wa_btn', 100);


function wa_btn_shortcode($waatts) {
    extract(shortcode_atts(array(
    	"waatts" => get_option('wa_btn'),
		"title" => get_the_title(),
		"url" => get_permalink(),
    ), $waatts));
    if (!empty($waatts)) {
        foreach ($waatts as $key => $option)
            $waatts[$key] = $option;
	}
	if (!isset($waatts['tracking'])) {$tracking = "";} else {$tracking='?utm_source=WhatsApp%26utm_medium=Messenger';}
	$btn = '<!--' . esc_html__('WhatsApp Share for WordPress:','wsshare') . 'https://www.wss.com.ve/ --><div class="wss_container"><a href="whatsapp://send?text='.$title.' - '.urlencode_deep($url).$tracking.'" class="wss" style="background-color:'.$waatts['button_bg_color'].'">'.$waatts['btn_text'].'</a></div>';
	return $btn;
}
add_filter('widget_text', 'do_shortcode');
add_shortcode('whatsapp_share', 'wa_btn_shortcode');


?>