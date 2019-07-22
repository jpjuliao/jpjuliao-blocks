import './style.scss';
import './editor.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { InspectorControls } = wp.editor;
const { PanelBody, SelectControl } = wp.components;
const {
	registerBlockType,
} = wp.blocks; // Import registerBlockType() from wp.blocks

/**
 * Register: JPJuliao Tabs Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType( 'jpjuliao-blocks/tabs', {
	// Block name. Block names must be string that contains a namespace prefix. Example: jpjuliao-block-tabs/my-custom-block.
	title: __( 'Tabs - JPJuliao Blocks' ), // Block title.
	icon: 'shield', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'JPJuliao' ),
		__( 'Tabs' ),
	],
	attributes: {
		postType: {
			type: 'string',
			default: 'post',
		},
		postTypeOptions: {
			type: 'array',
		},
	},

	// eslint-disable-next-line valid-jsdoc
	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	edit: function( props ) {
		// console.log( props );

		const {
			attributes: {
				postType,
				postTypeOptions,
			},
			setAttributes,
			className,
			name,
		} = props;

		if ( ! postTypeOptions ) {
			fetch('/wp-json/wp/v2/types')
				.then(res => res.json())
				.then((types) => {
					console.log(types);
					let options = [];
					for (let i in types) {
						options.push( { value: types[i].slug, label: types[i].name } );
					}
					setAttributes( { postTypeOptions: options } );
					return options;
				});
		}

		// Creates a <p class='wp-block-jpjuliao-block-tabs'></p>.
		return (
			<div className={ className }>
				<InspectorControls>
					<PanelBody
						title={__('Options')}
						initialOpen={true}
					>
						<SelectControl
							label={ __( 'Select post type:' ) }
							value={ postType } // e.g: value = [ 'a', 'c' ]
							onChange={ ( value ) => {
								setAttributes( { postType: value } );
							} }
							options={ postTypeOptions }
						/>
					</PanelBody>
				</InspectorControls>
				<p>— Hello from the backend.</p>
				<p>
					BLOCK: <code>{ name }</code> is a new Gutenberg block
				</p>
			</div>
		);
	},

	// eslint-disable-next-line valid-jsdoc
	/**
	 * The save function defines the way in which the different attributes should be combined
	 * into the final markup, which is then serialized by Gutenberg into post_content.
	 *
	 * The "save" property must be specified and must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	save: function( props ) {
		return (
			<div className={ props.className }>
				<p>— Hello from the frontend.</p>
				<p>
					BLOCK: <code>{ props.name } jpjuliao-blocks/tabs</code> is a new Gutenberg block
				</p>
				<p>
					Selected post type: { props.attributes.postType }
				</p>
			</div>
		);
	},
} );
