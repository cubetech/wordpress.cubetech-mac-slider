<?php
function cubetech_mac_slider_shortcode($atts)
{
	extract(shortcode_atts(array(
		'orderby' 		=> 'menu_order',
		'order'			=> 'asc',
		'numberposts'	=> 999,
		'offset'		=> 0,
		'poststatus'	=> 'publish',
	), $atts));
	
	$return = '';
	$leftcontent = '<div class="cubetech-mac-slider-container">';
	$return .= '<div class="cubetech-mac-slider-container">';
	
	if ( get_option('cubetech_mac_slider_show_groups') != false )
		$return .= '<h2>' . $tax->name . '</h2>';
	
	$args = array(
		'posts_per_page'  	=> 999,
		'numberposts'     	=> $numberposts,
		'offset'          	=> $offset,
		'orderby'         	=> $orderby,
		'order'           	=> $order,
		'post_type'       	=> 'cubetech_mac_slider',
		'post_status'     	=> $poststatus,
		'suppress_filters' 	=> true,
	);
		
	$posts = get_posts($args);
	
	$slidercontents = cubetech_mac_slider_content($posts);
	$leftcontent .= $slidercontents[0];
	$return .= $slidercontents[1];
	
	$return .= '<div class="cubetech-mac-slider-clear">';
	
	if ( get_option('cubetech_mac_slider_show_hr') != false )
		$return .= '<hr />';
	
	$return .= '</div></div>';
	$leftcontent .= '</div>';
	
	return $leftcontent . $return;

}

add_shortcode('cubetech-mac-slider', 'cubetech_mac_slider_shortcode');

function cubetech_mac_slider_content($posts) {

	$contentreturn = '<div class="cubetech-mac-slider-background"><ul class="cubetech-mac-slider">';
	$slidercontent = '<div class="cubetech-mac-slider-content">';
	$controls = '<div class="cubetech-mac-slider-menu"><ul>';
	
	$i = 1;
	
	foreach ($posts as $post) {
	
		$post_meta_data = get_post_custom($post->ID);
		$terms = wp_get_post_terms($post->ID, 'cubetech_mac_slider_group');
		$function = $post_meta_data['cubetech_mac_slider_function'][0];
		$edu = $post_meta_data['cubetech_mac_slider_edu'][0];
		$mail = $post_meta_data['cubetech_mac_slider_mail'][0];
		$phone = $post_meta_data['cubetech_mac_slider_phone'][0];
		
		$titlelink = array('', '');
		
		$title = '<h2 class="cubetech-mac-slider-title">' . $post->post_title . '</h2>';
		
		$image = get_the_post_thumbnail( $post->ID, 'cubetech-mac-slider-thumb', array('class' => 'cubetech-mac-slider-thumb cubetech-mac-slider-slide-' . $i ) );
		$secondimage = false;
		
		$link = '';

		if(isset($post_meta_data['cubetech_mac_slider_externallink'][0]) && $post_meta_data['cubetech_mac_slider_externallink'][0] != '')
			$link = '<span class="cubetech-mac-slider-link"><a href="' . $post_meta_data['cubetech_mac_slider_externallink'][0] . '" target="_blank">' . get_option('cubetech_mac_slider_link_title') . '</a></span>';
		elseif ( $post_meta_data['cubetech_mac_slider_links'][0] != '' && $post_meta_data['cubetech_mac_slider_links'][0] != 'nope' && $post_meta_data['cubetech_mac_slider_links'][0] > 0 )
			$link = '<span class="cubetech-mac-slider-link"><a href="' . get_permalink( $post_meta_data['cubetech_mac_slider_links'][0] ) . '">' . get_option('cubetech_mac_slider_link_title') . '</a></span>';

		$args = array(
		    'post_type' => 'attachment',
		    'numberposts' => null,
		    'post_status' => null,
		    'post_parent' => $post->ID,
		    'exclude' => get_post_thumbnail_id($post->ID),
		);
		$attachments = get_posts($args);
			
		if ( count($attachments) > 0 ) {
			foreach($attachments as $a) {
				$attachments = (Array)$a;
				break;
			}
			$secondimage .= wp_get_attachment_image($attachments['ID'], 'cubetech-mac-slider-thumb', false, array('class' => 'cubetech-mac-slider-thumb-second cubetech-mac-slider-slide-' . $i . '-second' ) );
		}

		$contentreturn .= '
		<li class="cubetech-mac-slider-icon" id="cubetech-mac-slider-icon-' . $i . '">
			' . $image . '
			' . $secondimage . '
		</li>';
		
		$controls .= '<li class="cubetech-mac-slider-control" id="cubetech-mac-slider-control-' . $i . '">xxxx</li>';
		
		if($post->post_content != '' || $post->post_title != '') {
			$slidercontent .= '
			<div class="cubetech-mac-slider-slide" id="cubetech-mac-slider-slide-' . $i . '">
				<p>' . $post_meta_data['cubetech_mac_slider_imagetitle'][0] . '</p>
				' . $title . '
				<p>' . __(nl2br($post->post_content)) . '</p>
				<p>' . $link . '</p>
			</div>';
		}
		
		$i++;

	}
	
	$controls .= '</ul></div>';
	$slidercontent .= '</div>';
	
	if(get_option('cubetech_mac_slider_show_content')!='checked') {
		$slidercontent = '';
	}
	
	return array(0 => $slidercontent, 1 => $contentreturn . '</ul></div> ' . $controls);
	
}
?>
