<?php

// [product]

function getbowtied_mc_product_field($settings, $value) {   
    $attr = array("post_type"=>"product", "orderby"=>"name", "order"=>"asc", 'posts_per_page'   => -1);
    $products = get_posts($attr); 
    $data = '<select name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$settings['param_name'].' '.$settings['type'].'">';
    foreach($products as $product) {
        $selected = '';
        if ($value!='' && $product->ID == $value) {
             $selected = ' selected="selected"';
        }
        $data .= '<option class="'.$product->ID.'" value="'.$product->ID.'"'.$selected.'>'.$product->post_title.'</option>';
    }
    $data .= '</select>';
    return $data;
}
vc_add_shortcode_param('product_mod' , 'getbowtied_mc_product_field');

vc_map(array(
   "name" 			=> "Single Product",
   "category" 		=> 'WooCommerce',
   "description"	=> "",
   "base" 			=> "product_mod",
   "class" 			=> "",
   "icon" 			=> "icon-wpb-woocommerce",
   
   "params" 	=> array(
		
		array(
			"type" 			=> "product_mod",
			"holder" 		=> "div",
			"class"			=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" 		=> "Product",
			"param_name" 	=> "id",
		)
		
   )
   
));