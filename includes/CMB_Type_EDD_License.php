<?php
/**
 * CMB EDD License field type
 *
 * @since  1.0.0
 *
 * @package      CMB2\Type\EDD_License
 * @author       Tsunoa
 * @copyright    Copyright (c) Tsunoa
 */
class CMB_Type_EDD_License extends CMB2_Type_Base {

	/**
	 * The type of field
	 *
	 * @var string
	 */
	public $type = 'input';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @param CMB2_Types $types
	 * @param array      $args
	 */
	public function __construct( $types, $args = array(), $type = '' ) {

		parent::__construct( $types, $args );

		$this->type = $type ? $type : $this->type;
	}

	/**
	 * Handles outputting an 'input' element
	 *
	 * @since  1.0.0
	 * @param  array  $args Override arguments
	 * @return string       Form input element
	 */
	public function render( $args = array() ) {
		$args = empty( $args ) ? $this->args : $args;

		$field_args = $this->parse_args( $this->type, array(
			// CMB2
			'name'            => $this->_name(),
			'id'              => $this->_id(),
			'value'           => $this->field->escaped_value(),
			'desc'            => $this->_desc( true ),
			'type'            => 'text',
			'class'           => 'regular-text',
		), $args );

		$a = $this->parse_args( $this->type, array(
			// License
			'server'          => '',
			'item_id'         => '',
			'item_name'       => '',
			'file'            => '',
			'version'         => '',
			'author'          => '',
			'wp_override'     => false,
		), $args );

		$license_status = cmb2_edd_license_status( $field_args['value'] );

		if( $license_status !== false) {
			// Add the class license-{$license_status} (valid or invalid)
			$field_args['class'] .= ' license-' . $license_status;
		}

		$this->field->add_js_dependencies( array(
			'cmb-edd-license-js'
		) );

		return $this->rendered(
			sprintf( '<input%s/>%s', $this->concat_attrs( $field_args, array( 'desc', 'js_dependencies' ) ), $field_args['desc'] )
		);
	}
}
