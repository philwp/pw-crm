<?php

namespace pw\crm;

use pw\crm\admin\Editor;
use pw\crm\Form;

class Start {



	/**
	 * Defines the post type's name
	 *
	 * @since 0.0.1
	 */
	const POST_TYPE = 'customers';


	public function __construct() {
		if( is_admin() ) {
			$this->start_admin();
		}
		$this->add_form();
	}

	protected function start_admin() {
		$this->add_cmb2();
	}


	protected function add_cmb2() {
		$editor = new Editor();
		add_action( 'cmb2_admin_init', [ $editor, 'run' ] );
	}

	protected function add_form() {
		$form = new Form();
		add_action( 'init', [ $form, 'run' ] );
	}

}
