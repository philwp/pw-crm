<?php

namespace pw\crm\admin;


use pw\crm\Meta;
use pw\crm\Start;

class Editor {
	/**
	 * @var \CMB2
	 */
	protected $cmb2;

	/**
	 * Run system
	 *
	 * @since 0.0.1
	 */
	public function run() {
		$this->make_box();
		$this->add_fields();
	}

	/**
	 * Create metabox object
	 *
	 * @since 0.0.1
	 */
	protected function make_box() {
		$this->cmb2 = new_cmb2_box( [
			'id'            => 'pw_meta',
			'title'         => __( 'Customer Information', 'pw-crm' ),
			'object_types'  => array( start::POST_TYPE, ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		]);
	}

	/**
	 * Add fields to box
	 */
	protected function add_fields() {

		$this->cmb2->add_field( [
			'name'       => __( 'Phone Number', 'pw-crm' ),
			'id'         => Meta::PHONE,
			'type'       => 'text',
			'sanitization_cb' => 'absint',
			'column'	 => [ 'position' => 2 ]
		] );
		$this->cmb2->add_field( [
			'name'       => __( 'Email', 'pw-crm' ),
			'id'         => Meta::EMAIL,
			'type'       => 'text_email',
			'column'	 => [ 'position' => 3 ]
		] );
		$this->cmb2->add_field( [
			'name'       => __( 'Desired Budget', 'pw-crm' ),
			'id'         => Meta::BUDGET,
			'type'       => 'text',
			'sanitization_cb' => 'absint',
			'column'	 => [ 'position' => 4 ]
		] );
		$this->cmb2->add_field( [
			'name'       => __( 'Submitted', 'pw-crm' ),
			'id'         => Meta::TIME,
			'type'       => 'text',
			'column'	 => [ 'position' => 5 ]
		] );

		$this->cmb2->add_field( [
			'name'       => __( 'Message', 'pw-crm' ),
			'id'         => Meta::MESSAGE,
			'type'       => 'textarea',
			'column'	 => [ 'position' => 6 ]
		] );
	}
}
