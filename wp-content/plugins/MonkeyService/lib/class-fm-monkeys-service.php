<?php
if ( !class_exists( 'FM_Monkey_Service' ) ) :
	class FM_Monkey_Service {
		private static $instance;
		private function __construct() {
		}
		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new FM_Monkey_Service;
				self::$instance->setup();
			}
			return self::$instance;
		}
		public function setup() {
			Monkey_Service_Structure() -> add_post_type( 'servicios', array( 'singular' => 'Monkey Servicio' ) );
			add_action( 'fm_post_servicios', array( $this, 'init' ) );
		}
		public function init() {
			$fm = new Fieldmanager_Group( array(
				'name' => 'service-info',
				'children' => array(
					'description' => new Fieldmanager_RichTextArea( array(
						'attributes' => array(
							'required' => true,
						),
					) ),
					'img-principal' => new Fieldmanager_Media( array(
						'button_label' => 'Elegir Imagen',
						'modal_title' => 'Elije la Imagen Principal de la Propiedad',
						'label' => 'Elije la Imagen para la Propiedad',
						'modal_button_label' => 'Usar imagen para la Propiedad',
						'attributes' => array(
							'required' => true,
						),
					) ),
					'status' => new Fieldmanager_Select( array(
						'first_empty' => false,
						'label' => 'Elija Estatus de la Propiedad',
						'inline_label' => true,
						'options' => array(
							'Venta' => 'Venta',
							'Renta' => 'Renta',
							'Venta y Renta' => 'Venta y Renta',
							'Preventa' => 'Preventa',
							'Renta Vacacional' => 'Renta Vacacional',
						)
					) ),
					'year' => new Fieldmanager_TextField( 'Año de Construcción' ),
					'floor' => new Fieldmanager_TextField( 'Numero de Pisos' ),
					'id' => new Fieldmanager_TextField( 'ID de la Propiedad' ),
					'rooms' => new Fieldmanager_TextField( 'Numero de Recamaras' ),
					'units' => new Fieldmanager_TextField( 'Numero de Unidades' ),
					'video' => new Fieldmanager_Checkbox( 'Activar Video demostrativo' ),
					'tvideo' => new Fieldmanager_Select( array(
						'first_empty' => false,
						'inline_label' => true,
						'label' => 'Elija Tipo de Video',
						'display_if' => array(
							'src' => 'video',
							'value' => 1,
						),
						'options' => array(
							'youtube' => 'Youtube',
							'vimeo' => 'Vimeo',
						)
					) ),
					'idvideo' => new Fieldmanager_TextField( array(
						'label' => 'Ingrese el ID del Video',
						'display_if' => array(
							'src' => 'video',
							'value' => 1,
						),
					) ),
					'map' => new Fieldmanager_TextField( 'URL EMBED de Google Maps para ubicación' ),
				),
			) );
			$fm->add_meta_box( 'Información de Configuración', 'servicios' );
			$fm = new Fieldmanager_Group( array(
				'name' => 'gallery',
				'label' => 'Imagenes de la Galeria',
				'limit' => 20,
				'add_more_label' => 'Agregar Imagen',
				'add_more_position' => 'bottom',
				'children' => array(
					'img-gallery' => new Fieldmanager_Media( array(
						'button_label' => 'Elegir Imagen',
						'modal_title' => 'Elije la Imagen de la Galeria',
						'label' => 'Elije la Imagen para la Galeria',
						'modal_button_label' => 'Usar imagen para la Galeria',
					) ),
				),
			) );
			$fm->add_meta_box( 'Agregue las imagenes de la Galeria', 'servicios' );
			$fm = new Fieldmanager_Group( array(
				'name' => 'comodities',
				'label' => 'Comodidades del Servicio',
				'limit' => 20,
				'add_more_label' => 'Agregar Comodidad',
				'add_more_position' => 'bottom',
				'children' => array(
					'comodidad' => new Fieldmanager_TextField( 'Texto de la Comodidad' ),
				),
			) );
			$fm->add_meta_box( 'Agregue las comodidades con que cuenta el servicio', 'servicios' );
		}
	}
	FM_Monkey_Service::instance();
endif;