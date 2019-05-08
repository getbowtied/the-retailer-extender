<?php

// [top_rated_products_mixed]

vc_map(array(
   "name" 			=> "Top Rated Products",
   "category" 		=> 'WooCommerce',
   "description"	=> "",
   "base" 			=> "top_rated_products_mixed",
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
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Number of Products",
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
			'type' => 'checkbox',
			'param_name' => 'show_product_details',
			'heading' => 'Show Product Details',
			'value' => 'true'
		),
   )
   
));