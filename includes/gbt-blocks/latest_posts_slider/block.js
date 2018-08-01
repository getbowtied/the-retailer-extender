( function( blocks, i18n, element ) {

	var el = element.createElement;

	/* Blocks */
	var registerBlockType   = wp.blocks.registerBlockType;

	var InspectorControls 	= wp.editor.InspectorControls;

	var TextControl 		= wp.components.TextControl;
	var RadioControl        = wp.components.RadioControl;
	var SelectControl		= wp.components.SelectControl;
	var ToggleControl		= wp.components.ToggleControl;
	var RangeControl		= wp.components.RangeControl;

	var categories_list = [];

	function escapeHtml(text) {
	  	return text
	    	.replace("&amp;", '&')
	    	.replace("&lt;", '<')
	    	.replace("&gt;", '>')
	     	.replace("&quot;", '"')
	    	.replace("&#039;", "'");
	}

	async function getCategories(categories_list) { 
	 	const categories = await wp.apiRequest( { path: '/wp/v2/categories?per_page=-1' } );

	 	var i;
	 	categories_list[0] = {value: '0', label: "All Categories"};
	 	for(i = 0; i < categories.length; i++) {
	 		var category = {value: categories[i]['id'], label: escapeHtml(categories[i]['name'])};
	 		categories_list[i+1] = category;
	 	}
	 } 

	getCategories(categories_list);

	/* Register Block */
	registerBlockType( 'getbowtied/tr-latest-posts-slider', {
		title: i18n.__( 'Latest Posts Slider' ),
		icon: 'slides',
		category: 'theretailer',
		supports: {
			align: [ 'center', 'wide', 'full' ],
		},
		attributes: {
			number: {
				type: 'number',
				default: '12'
			},
			title: {
				type: 'string',
				default: 'Latest Posts'
			},
			category: {
				type: 'string',
				default: 'All Categories'
			},
			categories : {
				type: 'array',
				default: categories_list
			},
			grid: {
				type: 'string',
				default: ''
			}
		},

		edit: function( props ) {

			var attributes = props.attributes;

			return [
				el(
					InspectorControls,
					{
						key: 'latest-posts-inspector'
					},
					el('hr', {} ),
					el(
						TextControl,
						{
							key: 'latest-posts-title',
							type: 'string',
							label: i18n.__( 'Title' ),
							value: attributes.title,
							onChange: function( newTitle ) {
								props.setAttributes( { title: newTitle } );
							},
						}
					),
					el(
						RangeControl,
						{
							key: "latest-posts-number",
							value: attributes.number,
							allowReset: false,
							label: i18n.__( 'Number of Posts' ),
							onChange: function( newNumber ) {
								props.setAttributes( { number: newNumber } );
							},
						}
					),
					el(
						SelectControl,
						{
							key: "latest-posts-category",
							options: attributes.categories,
              				label: i18n.__( 'Category' ),
              				value: attributes.category,
              				onChange: function( newCat ) {
              					props.setAttributes( { category: newCat } );
							},
						}
					),
				),
				el(
					"div",
					{
						key: "wp-block-gbt-posts-slider",
						className: "wp-block-gbt-posts-slider"
					},
					el(
						"div",
						{
							key: "from-the-blog-section",
							className: "from-the-blog-section"
						},
						el(
							"div",
							{
								key: "gbtr_items_sliders_header",
								className: "gbtr_items_sliders_header"
							},
							el(
								"div",
								{
									key: "gbtr_items_sliders_title",
									className: "gbtr_items_sliders_title"
								},
								el(
									"div",
									{
										key: "gbtr_featured_section_title",
										className: "gbtr_featured_section_title"
									},
									el(
										"strong",
										{
											key: "gbtr_featured_section_title_strong",
											className: "gbtr_featured_section_title_strong"
										},
										i18n.__(attributes.title)
									),
								),
							),
							el(
								"div",
								{
									key: "gbtr_items_sliders_nav",
									className: "gbtr_items_sliders_nav"
								},
								el(
									"a",
									{
										key: "big_arrow_right", 
										className: "big_arrow_right"
									}
								),
								el(
									"a",
									{
										key: "big_arrow_left", 
										className: "big_arrow_left"
									}
								),
								el(
									"div",
									{
										key: "clr",
										className: "clr"
									}
								),
							),
						),
						el(
							"div",
							{
								key: "gbtr_bold_sep",
								className: "gbtr_bold_sep"
							}
						),
						el(
							"div",
							{
								key: "from-the-blog-wrapper",
								className: "slider-wrapper from-the-blog-wrapper"
							},
							el(
								"div",
								{
									key: "from-the-blog-slider",
									className: "slider"
								},
								el(
									"ul",
									{
										key: "from_the_blog_ul",
										className: "from_the_blog_ul"
									},
									el(
										"li",
										{
											key: "from_the_blog_item",
											className: "from_the_blog_item"
										},
										el(
											"a",
											{
												key: "from_the_blog_img",
												className: "from_the_blog_img img_zoom_in"
											},
											el(
												"div",
												{
													key: "from_the_blog_noimg_div"
												},
												el(
													"span",
													{
														key: "from_the_blog_noimg",
														className: "from_the_blog_noimg"
													}
												),
											),
											el(
												"span",
												{
													key: "from_the_blog_date",
													className: "from_the_blog_date"
												},
												el(
													"span",
													{
														key: "from_the_blog_date_day",
														className: "from_the_blog_date_day"
													},
													i18n.__('21')
												),
												el(
													"span",
													{
														key: "from_the_blog_date_month",
														className: "from_the_blog_date_month"
													},
													i18n.__('SEP')
												),
											),
										),
										el(
											"div",
											{
												key: "from_the_blog_content",
												className: "from_the_blog_content"
											},
											el(
												"a",
												{
													key: "from_the_blog_title",
													className: "from_the_blog_title"
												},
												el(
													"h3",
													{
														key: "from_the_blog_title_h3"
													},
													i18n.__("Hello World!")
												),
											),
											el(
												"div",
												{
													key: "from_the_blog_excerpt",
													className: "from_the_blog_excerpt"
												},
												el(
													"p",
													{
														key: "from_the_blog_excerpt_p"
													},
													i18n.__("Lorem Ipsum is simply dummy text of the printing and typesetting industry...")
												),
											),
										),
									),
									el(
										"li",
										{
											key: "from_the_blog_item2",
											className: "from_the_blog_item"
										},
										el(
											"a",
											{
												key: "from_the_blog_img2",
												className: "from_the_blog_img img_zoom_in"
											},
											el(
												"div",
												{
													key: "from_the_blog_noimg_div2"
												},
												el(
													"span",
													{
														key: "from_the_blog_noimg2",
														className: "from_the_blog_noimg"
													}
												),
											),
											el(
												"span",
												{
													key: "from_the_blog_date2",
													className: "from_the_blog_date"
												},
												el(
													"span",
													{
														key: "from_the_blog_date_day2",
														className: "from_the_blog_date_day"
													},
													i18n.__('13')
												),
												el(
													"span",
													{
														key: "from_the_blog_date_month2",
														className: "from_the_blog_date_month"
													},
													i18n.__('MAY')
												),
											),
										),
										el(
											"div",
											{
												key: "from_the_blog_content2",
												className: "from_the_blog_content"
											},
											el(
												"a",
												{
													key: "from_the_blog_title2",
													className: "from_the_blog_title"
												},
												el(
													"h3",
													{
														key: "from_the_blog_title_h32"
													},
													i18n.__("Dummy Title!")
												),
											),
											el(
												"div",
												{
													key: "from_the_blog_excerpt2",
													className: "from_the_blog_excerpt"
												},
												el(
													"p",
													{
														key: "from_the_blog_excerpt_p2"
													},
													i18n.__("Lorem Ipsum is simply dummy text of the printing and typesetting industry...")
												),
											),
										),
									),
								),
							),
						),
					),
				),
			];
		},

		save: function( props ) {
			return '';
		},
	} );

} )(
	window.wp.blocks,
	window.wp.i18n,
	window.wp.element,
	jQuery
);