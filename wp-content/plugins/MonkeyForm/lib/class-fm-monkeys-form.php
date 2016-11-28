<?php
if ( !class_exists( 'FM_Monkey_Form' ) ) :
	class FM_Monkey_Form {
		private static $instance;
		private function __construct() {
		}
		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new FM_Monkey_Form;
				self::$instance->setup();
			}
			return self::$instance;
		}
		public function setup() {
			Monkey_Form_Structure() -> add_post_type( 'monkeys-form', array( 'singular' => 'Monkey Form' ) );
			add_action( 'fm_post_monkeys-form', array( $this, 'init' ) );
		}
		public function init() {
			$fm = new Fieldmanager_Group( array(
				'name' => 'config-data',
				'children' => array(
					'contact-mail' => new Fieldmanager_TextField( array(
						'name' => 'contact-mail',
						'label' => 'Ingrese el Mail que recibira el formulario',
						'attributes' => array(
							'required' => true,
						),
					) ),
					'captcha' => new Fieldmanager_Checkbox( array(
						'label' => 'Captcha Requerido',
					) ),
				),
			) );
			$fm->add_meta_box( 'Información de Configuración', 'monkeys-form', 'side' );
			$fm = new Fieldmanager_Group( array(
				'name' => 'form_fields',
				'label' => 'Campos del Formulario',
				'limit' => 20,
				'add_more_label' => 'Agregar Campo',
				'add_more_position' => 'bottom',
				'children' => array(
					'name-field' => new Fieldmanager_TextField( array(
						'attributes' => array(
							'placeholder' => 'Nombre del Campo',
							'size' => 30,
						),
					) ),
					'obligatorio' => new Fieldmanager_Checkbox( array(
						'label' => 'Campo Obligatorio',
					) ),
					'type-field' => new Fieldmanager_Select( array(
						'label' => 'Elige Tipo de Dato',
						'first_empty' => false,
						'options' => array(
							'input' => 'Caja de Texto Generico',
							'email' => 'Caja de Texto para Email',
							'textarea' => 'Cuadro de Texto para Mensaje',
							
						),
					) ),
				),
			) );
			$fm->add_meta_box( 'Agregue los campos necesarios para su Formulario', 'monkeys-form' );
		}
	}
	FM_Monkey_Form::instance();
endif;