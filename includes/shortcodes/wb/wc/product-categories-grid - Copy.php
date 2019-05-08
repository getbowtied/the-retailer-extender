<?php

// [product_categories_grid]

vc_map(array(
   "name"			=> "Product Categories",
   "category"		=> 'WooCommerce',
   "description"	=> "",
   "base"			=> "product_categories_grid",
   "class"			=> "",
   "icon"			=> "icon-wpb-woocommerce",
   //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
   //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
   
   "params" 	=> array(
      
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Layout",
			"param_name"	=> "layout",
			"value"			=> array(
				"Default"		=> "default",
				"Layout 1"		=> "layout_1",
				"Layout 2"		=> "layout_2",
				"Layout 3"		=> "layout_3",
				"Layout 4"		=> "layout_4",
			),
			//"std"			=> "default",
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "How many product categories to display?",
			"param_name"	=> "number",
			"value"			=> "12",
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Columns",
			"param_name"	=> "columns",
			"value"			=> "4",
			"dependency"	=> array(
				"element" 	=> "layout",
				"value"		=> array('default'),
			),
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
			"dependency"	=> array(
				"element" 	=> "layout",
				"value"		=> array('default'),
			),
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Order By",
			"param_name"	=> "orderby",
			"value"			=> array(
				"None"			=> "none",
				"ID"			=> "ID",
				"Name"			=> "name",
				"Date"			=> "date",
				"Menu Order"	=> "menu_order",
				"Rand"			=> "rand"
			),
			//"std"			=> "date",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Order",
			"param_name"	=> "order",
			"value"			=> array(
				"Desc"	=> "desc",
				"Asc"	=> "asc"
			),
			//"std"			=> "desc",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Hide Empty",
			"param_name"	=> "hide_empty",
			"value"			=> array(
				"Yes"	=> "1",
				"No"	=> "0"
			),
			//"std"			=> "1",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Parent",
			"description"	=> "Set the parent paramater to 0 to only display top level categories.",
			"param_name"	=> "parent",
			"value"			=> "",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "IDs",
			"description"	=> "Set ids to a comma separated list of category ids to only show those.",
			"param_name"	=> "ids",
			"value"			=> "",
		),
   )
   
));