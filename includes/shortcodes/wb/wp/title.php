<?php 

/*
**	TITLE
*/
	
vc_map(array(
   
   "name"			=> "Title",
   "category"		=> 'Content',
   "description"	=> "Place Title",
   "base"			=> "title",
   "class"			=> "",
   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Title",
			"param_name"	=> "text",
			"value"			=> "Title",
		),

		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Tag",
			"param_name"	=> "tag",
			"value"			=> array(
				"H1"		=> "h1",
				"H2"		=> "h2",
				"H3"		=> "h3",
				"H4"		=> "h4",
				"H5"		=> "h5",
				"H6"		=> "h6",
			),
			"std"			=> "h3",
		),

		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Font Family",
			"param_name"	=> "font",
			"value"			=> array(
				"Main Font"			=> "main_font",
				"Secondary Font"	=> "secondary_font"
			),
			"std"			=> "secondary_font",
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Font Size (rem, px, em)",
			"param_name"	=> "font_size",
			"value"			=> "",
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Line Height (rem, px, em)",
			"param_name"	=> "line_height",
			"value"			=> "",
		),

		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Color",
			"param_name"	=> "color",
			"value"			=> "",
		),

		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Text Align",
			"param_name"	=> "text_align",
			"value"			=> array(
				"Left"		=> "left",
				"Center"	=> "center",
				"Right"		=> "right",
			),
			"std"			=> "",
		),

		array(
            'type' => 'css_editor',
            'heading' => "Css",
            'param_name' => 'css',
            'group' => "Design Options",
        ),
        

		array(
			"type" => "textfield",
			"heading" => "Extra Class Name",
			"param_name" => "el_class",
			"value" => "",
			"description" => "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file."
		)

   )
   
));