<?php
/**
 * Register Post Types and Taxonomies
 */
if ( !class_exists( 'Monkey_Social_Structure' ) ) :
	class Monkey_Social_Structure {
		private static $instance;
		private $post_types = array();
		private $taxonomies = array();
		private function __construct() {
			/* Don't do anything, needs to be initialized via instance() method */
		}
		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new Monkey_Social_Structure;
				self::$instance->setup();
			}
			return self::$instance;
		}
		public function setup() {
			add_action( 'init', array( $this, 'register' ) );
		}
		public function add_post_type( $type, $args ) {
			$this->post_types[ $type ] = $args;
		}
		public function add_taxonomy( $taxonomy, $args ) {
			$this->taxonomies[ $taxonomy ] = $args;
		}
		public function register() {
			foreach ( $this->post_types as $type => $args ) {
				$singular = ( ! empty( $args['singular'] ) ) ? $args['singular'] : $this->titleize( $type );
				$plural = ( ! empty( $args['plural'] ) ) ? $args['plural'] : $singular . 's';
				register_post_type( $type, array_merge( array(
					'public' => true,
					'supports' => array( 'title' ),
					'labels' => array(
						'name'               => $singular,
						'singular_name'      => $singular,
						'add_new'            => 'Agregar Nuevo',
						'add_new_item'       => 'Agregar Nuevo ' . $singular,
						'edit_item'          => 'Editar ' . $singular,
						'new_item'           => 'Nuevo ' . $singular,
						'all_items'          => 'Lista ' . $singular,
						'view_item'          => 'Ver ' . $singular,
						'search_items'       => 'Burcar ' . $singular,
						'not_found'          => 'No ' . $singular . ' found',
						'not_found_in_trash' => 'No ' . $singular . ' found in Trash',
						'parent_item_colon'  => '',
						'menu_name'          => $singular
					),
					'menu_icon' => 'dashicons-share'
				), $args ) );
			}
			foreach ( $this->taxonomies as $taxonomy => $args ) {
				$singular = ( ! empty( $args['singular'] ) ) ? $args['singular'] : $this->titleize( $taxonomy );
				$plural = ( ! empty( $args['plural'] ) ) ? $args['plural'] : $singular . 's';
				register_taxonomy( $taxonomy, $args['post_type'], array_merge( $args, array(
					'labels' => array(
						'name'                       => $singular,
						'singular_name'              => $singular,
						'search_items'               => 'Search ' . $singular,
						'popular_items'              => 'Popular ' . $singular,
						'all_items'                  => 'All ' . $singular,
						'parent_item'                => 'Parent ' . $singular,
						'parent_item_colon'          => "Parent {$singular}:",
						'edit_item'                  => 'Edit ' . $singular,
						'update_item'                => 'Update ' . $singular,
						'add_new_item'               => 'Add New ' . $singular,
						'new_item_name'              => "New {$singular} Name",
						'separate_items_with_commas' => "Separate {$singular} with commas",
						'add_or_remove_items'        => "Add or remove {$singular}",
						'choose_from_most_used'      => "Choose from the most used {$singular}",
						'not_found'                  => "No {$singular} found.",
						'menu_name'                  => $singular
					)
				) ) );
			}
		}
		public static function titleize( $field ) {
			$search = array( '-', '_' );
			$replace = array( ' ', ' ' );
			return ucwords( str_replace( $search, $replace, $field ) );
		}
	}
	function Monkey_Social_Structure() {
		return Monkey_Social_Structure::instance();
	}
endif;