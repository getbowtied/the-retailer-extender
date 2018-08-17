( function( blocks, i18n, element ) {

	var el = element.createElement;

	/* Blocks */
	var registerBlockType   = wp.blocks.registerBlockType;
		
	var InspectorControls 	= wp.editor.InspectorControls;
	var RichText			= wp.editor.RichText;
	var BlockControls		= wp.editor.BlockControls;

	var TextControl 		= wp.components.TextControl;
	var ToggleControl		= wp.components.ToggleControl;
	var RangeControl		= wp.components.RangeControl;
	var SelectControl		= wp.components.SelectControl;

	var categories_list = [];

	function getCategories()
	{
		var data = {
			action : 'getbowtied_tr_render_portfolio_categories'
		};

		jQuery.post( 'admin-ajax.php', data, function(response) { 
			response = jQuery.parseJSON(response);
			categories_list = response;
		});	
	}

	getCategories();

	/* Register Block */
	registerBlockType( 'getbowtied/tr-portfolio', {
		title: i18n.__( 'Portfolio' ),
		icon: 'format-gallery',
		category: 'theretailer',
		supports: {
			align: [ 'center', 'wide', 'full' ],
		},
		attributes: {
			itemsNumber: {
				type: 'integer',
				default: 12,
			},
			category: {
				type: 'string',
				default: 'All',
			},
			showFilters: {
				type: 'boolean',
				default: true,
			},
			orderBy: {
				type: 'string',
				default: 'date',
			},
			order: {
				type: 'string',
				default: 'ASC',
			},
			itemsPerRow: {
				type: 'number',
				default: 3,
			},
			categories : {
				type: 'array',
				default: []
			},
			preview_grid: {
				type: 'string',
				default: '',
			},
		},

		edit: function( props ) {

			var attributes = props.attributes;
			setTimeout(function(){ 
				props.setAttributes( { categories: categories_list } );
			}, 1000 );

			function getPreviewGrid( itemsNumber, category, orderBy, order, itemsPerRow ) {

				itemsNumber		= itemsNumber || attributes.itemsNumber;
				category 		= category || attributes.category;
				orderBy 		= orderBy || attributes.orderBy;
				order 			= order || attributes.order;
				itemsPerRow 	= itemsPerRow || attributes.itemsPerRow;

				var data = {
					action 		: 'getbowtied_tr_get_preview_grid',
					attributes  : { 
						'itemsNumber' 	: itemsNumber,
						'category' 		: category,
						'orderBy' 		: orderBy,
						'order' 		: order,
						'itemsPerRow' 	: itemsPerRow,
					}
				};

				jQuery.post( 'admin-ajax.php', data, function(response) { 
					response = jQuery.parseJSON(response);
					props.setAttributes( { preview_grid: response } );
				});	
			}

			return [
				el(
					InspectorControls,
					{ key: 'inspector' },
					el( 'hr', { key: 'portfolio-hr' } ),
					el(
						TextControl,
						{
							key: 'portfolio-items',
							type: 'number',
							label: i18n.__( 'How many portfolio items would you like to show?' ),
							value: attributes.itemsNumber,
							onChange: function( newNumber ) {
								props.setAttributes( { itemsNumber: newNumber } );
								getPreviewGrid( newNumber, null, null, null, null );
							},
						}
					),
					el(
						SelectControl,
						{
							key: 'portfolio-category',
							options: attributes.categories,
              				label: i18n.__( 'Portfolio Category' ),
              				value: attributes.category,
              				onChange: function( newCategory ) {
              					props.setAttributes( { category: newCategory } );
              					getPreviewGrid( null, newCategory, null, null, null );
							},
						}
					),
					attributes.category == 'All' && el(
						ToggleControl,
						{
							key: "portfolio-filters-toggle",
              				label: i18n.__( 'Show Filters?' ),
              				checked: attributes.showFilters,
              				onChange: function() {
								props.setAttributes( { showFilters: ! attributes.showFilters } );
							},
						}
					),
					el(
						SelectControl,
						{
							key: 'portfolio-orderby',
							options: [{ value: 'date', label: 'Date' }, { value: 'title', label: 'Alphabetical' }, { value: 'rand', label: 'Random' }],
              				label: i18n.__( 'Order By' ),
              				value: attributes.orderBy,
              				onChange: function( newOrderBy ) {
              					props.setAttributes( { orderBy: newOrderBy } );
              					getPreviewGrid( null, null, newOrderBy, null, null );
							},
						}
					),
					attributes.orderBy != 'rand' && el(
						SelectControl,
						{
							key: 'portfolio-order',
							options: [{ value: 'ASC', label: 'Ascending' }, { value: 'DESC', label: 'Descending' }],
              				label: i18n.__( 'Order' ),
              				value: attributes.order,
              				onChange: function( newOrder ) {
              					props.setAttributes( { order: newOrder } );
              					getPreviewGrid( null, null, null, newOrder, null );
							},
						}
					),
					el(
						TextControl,
						{
							key: 'portfolio-items-per-row',
							type: 'number',
							min: 2,
							max: 4,
							label: i18n.__( 'Items per Row' ),
							value: attributes.itemsPerRow,
							onChange: function( newNumber ) {
								props.setAttributes( { itemsPerRow: newNumber } );
								getPreviewGrid( null, null, null, null, newNumber );
							},
						}
					),
				),
				el(
					'div',
					{
						key: 'wp-block-gbt-portfolio',
						className: 'wp-block-gbt-portfolio',
					},
					el( 
						'div',
						{
							key: 'portfolio-preview',
							className: 'portfolio-preview'
						},
						eval( attributes.preview_grid ),
						attributes.preview_grid == '' && getPreviewGrid( null, null, null, null, null )
					)
				)
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
);