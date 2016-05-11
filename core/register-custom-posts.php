<?php
/**
  * Register custom post types, done in shortcodes
  */

    class SHRegisterCustomPosts {
        // properties

        // methods
        public function __construct() {
            add_action('init', array($this, 'register_posts'));

		}

		public function register_posts() {
            // portfolio 
            $portfolio_labels = array(
                'name'               => __('Portfolio Item', 'shcreate'),
                'menu_name'          => __('Portfolio Entries', 'shcreate'),
                'add_new'            => __('Add new', 'shcreate'),
                'add_new_item'       => __('Add New Portfolio Entry', 'shcreate'),
                'edit_item'          => __('Edit Portfolio Entry', 'shcreate'),
                'new_item'           => __('New Portfolio Entry', 'shcreate'),
                'view_item'          => __('View Portfolio Entry', 'shcreate'),
                'search_items'       => __('Search Portfolio', 'shcreate'),
                'not_found'          => __('No Portfolio Entries Found', 'shcreate'),
                'not_found_in_trash' => __('No Portfolio Entries found in Trash', 'shcreate'),
                'parent_item_colon'  => ''
            );

            $portfolio_args = array(
                'labels'             => $portfolio_labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'query_var'          => true,
                'rewrite'            => true,
                'hierarchical'       => false,
                'menu_position'      => null,
                'capability_type'    => 'post',
                'taxonomies'         => array('portfolio_entry'),
                'supports'           => array('title', 'editor', 'thumbnail', 'author', 'comments' ),
                'exclude_from_search'=> true,
                'menu_icon'          => 'dashicons-list-view'
            );

            register_post_type('portfolio_entry', $portfolio_args);

            // register the custom portfolio taxonomy
            register_taxonomy('portcat',
                'portfolio_entry',
                array(
                    'label' => __('Portfolio Category', 'shcreate'),
                    'rewrite' => array(),
                    'capabilities' => array(),
					'show_admin_column' => true,
                )
            );

            // People
            $people_labels = array(
                'name'               => __('People', 'shcreate'),
                'menu_name'          => __('People', 'shcreate'),
                'add_new'            => __('Add New', 'shcreate'),
                'add_new_item'       => __('Add New Person', 'shcreate'),
                'edit_item'          => __('Edit Person', 'shcreate'),
                'new_item'           => __('New Person', 'shcreate'),
                'view_item'          => __('View Persons', 'shcreate'),
                'search_items'       => __('Search Persons', 'shcreate'),
                'not_found'          => __('No People found', 'shcreate'),
                'not_found_in_trash' => __('No People found in trash', 'shcreate'),
                'parent_item_colon'  => ''
            );

            $people_args = array(
                'labels'             => $people_labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'query_var'          => true,
                'rewrite'            => true,
                'hierarchical'       => false,
                'menu_position'      => null,
                'capability_type'    => 'post',
                'taxonomies'         => array('peoplecat'),
                'supports'           => array('title', 'editor', 'thumbnail'),
                'exclude_from_search'=> true,
                'menu_icon'          => 'dashicons-groups'
            );

            register_post_type('people', $people_args);
            register_taxonomy('peoplecat',
                'people',
                array(
                    'label' => __('People Category', 'shcreate'),
                    'rewrite' => array(),
                    'capabilities' => array(),
					'show_admin_column' => true,
                )
            );
        }
	} // end class

    new SHRegisterCustomPosts();	
