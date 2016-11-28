<?php
if ( !class_exists( 'FM_Monkey_Sucursal' ) ) :
	class FM_Monkey_Sucursal {
		private static $instance;
		private function __construct() {
		}
		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new FM_Monkey_Sucursal;
				self::$instance->setup();
			}
			return self::$instance;
		}
		public function setup() {
			Monkey_Sucursal_Structure() -> add_post_type( 'monkeys-sucursal', array( 'singular' => 'Monkey Sucursal' ) );
			add_action( 'fm_post_monkeys-sucursal', array( $this, 'init' ) );
		}
		public function init() {
			$fm = new Fieldmanager_Group( array(
				'name' => 'sucursal_information',
				'children' => array(
					'nombre' => new Fieldmanager_TextField( array(
						'label' => 'Nombre de Sucursal',
						'attributes' => array(
							'required' => true,
						),
					) ),
					'telefono' => new Fieldmanager_TextField( array(
						'label' => 'Telefono de la Sucursal',
						'attributes' => array(
							'required' => true,
						),
					) ),
					'email' => new Fieldmanager_TextField( array(
						'label' => 'E-mail de la sucursal',
						'attributes' => array(
							'required' => true,
						),
					) ),
					'principal' => new Fieldmanager_Checkbox( array(
						'label' => 'Marcar como sucursal Principal',
					) ),
				),
			) );
			$fm->add_meta_box( 'Información de Sucursal', 'monkeys-sucursal' );
		}
	}
	FM_Monkey_Sucursal::instance();
endif;