<?php

// [product_category_mixed]


// getbowtied_mc_product_category_field
function getbowtied_mc_product_category_field($settings, $value) {   
    $categories = get_terms('product_cat'); 
    $data = '<select name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$settings['param_name'].' '.$settings['type'].'">';
    foreach($categories as $category) {
        $selected = '';
        if ($value!=='' && $category->slug === $value) {
             $selected = ' selected="selected"';
        }
        $data .= '<option class="'.$category->slug.'" value="'.$category->slug.'"'.$selected.'>' . $category->name . ' (' . $category->count . ' products)</option>';
    }
    $data .= '</select>';
    return $data;
}
vc_add_shortcode_param('product_category' , 'getbowtied_mc_product_category_field');



vc_map(array(
   "name" 			=> "Products by Category",
   "category" 		=> 'WooCommerce',
   "description"	=> "",
   "base" 			=> "product_category_mixed",
   "class" 			=> "",
   "icon" 			=> "icon-wpb-woocommerce",
   
   "params" 	=> array(

   		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Widget Title",
			"param_name"	=> "widget_title",
			"value"			=> "",
		),
		
		array(
			"type" 			=> "product_category",
			"holder" 		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" 		=> "Category",
			"param_name" 	=> "category"
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Number of Products",
			"description"	=> "",
			"param_name"	=> "per_page",
			"value"			=> "4",
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
			"heading"		=> "Order",
			"description"	=> "",
			"param_name"	=> "order",
			"value"			=> array(
				"Desc"	=> "desc",
				"Asc"	=> "asc"
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