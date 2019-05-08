<?php

/*
**	BANNER 
*/

vc_map(array(
   
   "name"			=> "Banner",
   "base"			=> "banner",
   "class"			=> "",
   "category"		=> 'Content',
   "description"	=> "Place Banner", 
   
   "params" 	=> array(

		array(
			'type' => 'checkbox',
			'param_name' => 'advanced_options',
			'heading' => 'Advanced Options',
		),
      
 		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Title",
			"param_name"	=> "title",
			"value"			=> "",
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "half_width hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Title Font Size",
			"param_name"	=> "title_font_size",
			"value"			=> "64px",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "half_width hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Title Line Height",
			"param_name"	=> "title_line_height",
			"value"			=> "",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Title Font Family",
			"param_name"	=> "title_font_family",
			"value"			=> array(
				"Primary Font"		=> "primary_font",
				"Secondary Font"	=> "secondary_font",
			),
			"std"			=> "",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Title Color",
			"param_name"	=> "title_color",
			"value"			=> "#000000",
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Subtitle",
			"param_name"	=> "subtitle",
			"value"			=> "",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "half_width hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Subtitle Font Size",
			"param_name"	=> "subtitle_font_size",
			"value"			=> "21px",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "half_width hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Subtitle Line Height",
			"param_name"	=> "subtitle_line_height",
			"value"			=> "",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Subtitle Font Family",
			"param_name"	=> "subtitle_font_family",
			"value"			=> array(
				"Primary Font"		=> "primary_font",
				"Secondary Font"	=> "secondary_font",
			),
			"std"			=> "",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Subtitle Color",
			"param_name"	=> "subtitle_color",
			"value"			=> "#000000",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Button Text",
			"param_name"	=> "button_text",
			"value"			=> "",
		),

		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Button Color",
			"param_name"	=> "button_color",
			"value"			=> "#000000",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Button Text Color",
			"param_name"	=> "button_text_color",
			"value"			=> "#FFF",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Banner / Button URL",
			"param_name"	=> "button_url",
			"value"			=> "",
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Inner Stroke Thickness",
			"param_name"	=> "inner_stroke",
			"value"			=> "2px",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Inner Stroke Color",
			"param_name"	=> "inner_stroke_color",
			"value"			=> "#ffffff",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Background Color",
			"param_name"	=> "bg_color",
			"value"			=> "#000000",
		),
		
		array(
			"type"			=> "attach_image",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Background Image",
			"param_name"	=> "bg_image",
			"value"			=> "",
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Height",
			"param_name"	=> "height",
			"value"			=> "300px",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Separator Padding",
			"param_name"	=> "sep_padding",
			"value"			=> "5px",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Separator Color",
			"param_name"	=> "sep_color",
			"value"			=> "#ffffff",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),
		
   )
   
));