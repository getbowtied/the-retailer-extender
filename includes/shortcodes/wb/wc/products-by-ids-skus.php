<?php

// [products_mixed]

/* All products dropdown */
function getbowtied_mc_products_settings_field($settings, $value) {   
    $attr = array("post_type"=>"product", "orderby"=>"name", "order"=>"asc", 'posts_per_page'   => -1);
    $categories = get_posts($attr); 
    $data = '<input type="text" value="'.$value.'" name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select vc_custom_select_custom_val '.$settings['param_name'].' '.$settings['type'].'" id="vc_custom_select_custom_prod">';
    $data .= '<div class="vc_custom_select_custom_wrapper"><ul class="vc_custom_select_custom_vals">';
    $insterted_vals = explode(',', $value);
    foreach($categories as $val) {
        if( in_array($val->ID, $insterted_vals) ) {
          $data .= '<li data-val="'.$val->ID.'">'.$val->post_title.'<button>&#215;</button></li>';
        }
    }
    $data .= '</ul>'; 
    $data .= '<ul class="vc_custom_select_custom">';
    foreach($categories as $val) {
        $selected = '';
        if( in_array($val->ID, $insterted_vals) ) {
          $selected = ' class="selected"';
        }
        $data .= '<li' . $selected . ' data-val="'.$val->ID.'">'.$val->post_title.'</li>';
    }
    $data .= '</ul></div>';
    return $data;
}
vc_add_shortcode_param('products' , 'getbowtied_mc_products_settings_field', plugins_url( 'assets/js/products_by_ids_skus.js', dirname(dirname(__FILE__)) ) );

vc_map(array(
   "name" 			=> "Products - Custom List",
   "category" 		=> 'WooCommerce',
   "description"	=> "",
   "base" 			=> "products_mixed",
   "class" 			=> "",
   "icon" 			=> "icon-wpb-woocommerce",
   
   "params" 	=> array(

   		array(
   			"type" 			=> "textfield",
			"holder" 		=> "div",
			"heading" 		=> "Widget Title",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"param_name" 	=> "widget_title"
   		),
      
		array(
			"type" 			=> "products",
			"holder" 		=> "div",
			"heading" 		=> "Products",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"param_name" 	=> "ids",
			"description" 	=> "Select the products you'd like to display."
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Layout Style",
			"param_name"	=> "layout",
			"value"			=> array(
				"List"			=> "list",
				"Masonry Style"	=> "masonry"
			),
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Columns",
			"description"	=> "",
			"param_name"	=> "columns",
			"value"			=> "4",
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Gutter",
			"description"	=> "",
			"param_name"	=> "gutter",
			"value"			=> "0",
		),

		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Order By",
			"description"	=> "",
			"param_name"	=> "orderby",
			"value"			=> array(
				"Date"		=> "date",
				"Title"		=> "title",
				"Modified"	=> "modified",
				"Random"	=> "rand"
			),
			"std"			=> "date",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Order Way",
			"description"	=> "",
			"param_name"	=> "order",
			"value"			=> array(
				"Descending"	=> "desc",
				"Ascending"	=> "asc"
			),
			"std"			=> "desc",
		),

		array(
			'type' => 'checkbox',
			'param_name' => 'show_product_details',
			'heading' => 'Show Product Details',
			'value' => 'true'
		),
   )
   
));