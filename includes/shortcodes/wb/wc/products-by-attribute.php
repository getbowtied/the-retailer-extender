<?php

// // [product_attribute_mixed]

// $attributes_tax = wc_get_attribute_taxonomies();
// $attributes = array();
// foreach ( $attributes_tax as $attribute ) {
// 	$attributes[ $attribute->attribute_label ] = $attribute->attribute_name;
// }

// if (!empty($attributes))
// {
// 	$first = reset($attributes);
// 	$terms = get_terms("pa_" . reset($attributes));
// 	$filters = array();

// 	foreach ($terms as $term)
// 	{
// 		$filters[ $term->name ] = $term->slug;
// 	}
// }

// vc_map(array(
//    "name" 			=> "Products by Attribute",
//    "category" 		=> 'WooCommerce',
//    "description"	=> "",
//    "base" 			=> "product_attribute_mixed",
//    "class" 			=> "",
//    "icon" 			=> "icon-wpb-woocommerce",
   
//    "params" 	=> array(

//    		array(
// 			"type"			=> "textfield",
// 			"holder"		=> "div",
// 			"class" 		=> "hide_in_vc_editor",
// 			"admin_label" 	=> true,
// 			"heading"		=> "Widget Title",
// 			"param_name"	=> "widget_title",
// 			"value"			=> "",
// 		),
      
// 		// array(
// 		// 	"type"			=> "textfield",
// 		// 	"holder"		=> "div",
// 		// 	"class" 		=> "hide_in_vc_editor",
// 		// 	"admin_label" 	=> true,
// 		// 	"heading"		=> "Attribute",
// 		// 	"description"	=> "",
// 		// 	"param_name"	=> "attribute",
// 		// 	"value"			=> "",
// 		// ),

// 		array(
// 			'type' => 'dropdown',
// 			'heading' => esc_html__( 'Attribute', 'js_composer' ),
// 			'param_name' => 'attribute',
// 			'value' => $attributes,
// 			'save_always' => true,
// 			'description' => "",
// 		),

// 		array(
// 			'type' => 'checkbox',
// 			'heading' => esc_html__( 'Filter', 'js_composer' ),
// 			'param_name' => 'filter',
// 			'value' => array( 'empty' => 'empty' ),
// 			'save_always' => true,
// 			'description' => esc_html__( 'Taxonomy values', 'js_composer' ),
// 			'dependency' => array(
// 				'callback' => 'vcWoocommerceProductAttributeFilterDependencyCallback',
// 			),
// 		),
		
// 		// array(
// 		// 	"type"			=> "textfield",
// 		// 	"holder"		=> "div",
// 		// 	"class" 		=> "hide_in_vc_editor",
// 		// 	"admin_label" 	=> true,
// 		// 	"heading"		=> "Filter",
// 		// 	"description"	=> "",
// 		// 	"param_name"	=> "filter",
// 		// 	"value"			=> "",
// 		// ),
		
// 		array(
// 			"type"			=> "textfield",
// 			"holder"		=> "div",
// 			"class" 		=> "hide_in_vc_editor",
// 			"admin_label" 	=> true,
// 			"heading"		=> "No. of Products to display",
// 			"description"	=> "",
// 			"param_name"	=> "per_page",
// 			"value"			=> "4",
// 		),

// 		array(
// 			"type"			=> "dropdown",
// 			"holder"		=> "div",
// 			"class" 		=> "hide_in_vc_editor",
// 			"admin_label" 	=> true,
// 			"heading"		=> "Layout Style",
// 			"param_name"	=> "layout",
// 			"value"			=> array(
// 				"List"			=> "list",
// 				"Masonry Style"	=> "masonry"
// 			),
// 		),
		
// 		array(
// 			"type"			=> "textfield",
// 			"holder"		=> "div",
// 			"class" 		=> "hide_in_vc_editor",
// 			"admin_label" 	=> true,
// 			"heading"		=> "Columns",
// 			"description"	=> "",
// 			"param_name"	=> "columns",
// 			"value"			=> "4",
// 		),

// 		array(
// 			"type"			=> "textfield",
// 			"holder"		=> "div",
// 			"class" 		=> "hide_in_vc_editor",
// 			"admin_label" 	=> true,
// 			"heading"		=> "Gutter",
// 			"description"	=> "",
// 			"param_name"	=> "gutter",
// 			"value"			=> "0",
// 		),
		
// 		array(
// 			"type"			=> "dropdown",
// 			"holder"		=> "div",
// 			"class" 		=> "hide_in_vc_editor",
// 			"admin_label" 	=> true,
// 			"heading"		=> "Order By",
// 			"description"	=> "",
// 			"param_name"	=> "orderby",
// 			"value"			=> array(
// 				"None"	=> "none",
// 				"ID"	=> "ID",
// 				"Title"	=> "title",
// 				"Date"	=> "date",
// 				"Rand"	=> "rand"
// 			),
// 			"std"			=> "date",
// 		),
		
// 		array(
// 			"type"			=> "dropdown",
// 			"holder"		=> "div",
// 			"class" 		=> "hide_in_vc_editor",
// 			"admin_label" 	=> true,
// 			"heading"		=> "Order",
// 			"description"	=> "",
// 			"param_name"	=> "order",
// 			"value"			=> array(
// 				"Desc"	=> "desc",
// 				"Asc"	=> "asc"
// 			),
// 			"std"			=> "desc",
// 		),

// 		array(
// 			'type' => 'checkbox',
// 			'param_name' => 'show_product_details',
// 			'heading' => 'Show Product Details',
// 			'value' => 'true',
// 			'value' => 'true'
// 		),
//    )
   
// ));


// [product_attribute_mixed]

vc_map(array(
   "name" 			=> "Products by Attribute",
   "category" 		=> 'WooCommerce',
   "description"	=> "",
   "base" 			=> "product_attribute_mixed",
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
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Attribute",
			"description"	=> "",
			"param_name"	=> "attribute",
			"value"			=> "",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Filter",
			"description"	=> "",
			"param_name"	=> "filter",
			"value"			=> "",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "No. of Products to display",
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
				"None"	=> "none",
				"ID"	=> "ID",
				"Title"	=> "title",
				"Date"	=> "date",
				"Rand"	=> "rand"
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
			'value' => 'true',
			'value' => 'true'
		),
   )
   
));