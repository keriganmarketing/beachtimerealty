<?php
/**
 * Created by PhpStorm.
 * User: Bryan
 * Date: 9/21/2017
 * Time: 3:58 PM
 */

namespace Includes\Modules\CPT;


class VirtualPage {

	private $slug;

	public function __construct( $slug ) {

		$this->slug = $slug;
		$this->addQueryVars();
		$this->addRewriteRules();
		$this->assignTemplate();

	}

	private function addQueryVars() {
		add_filter( 'query_vars', function ( $vars ) {
			$vars[] = $this->slug;

			return $vars;
		} );
	}

	private function addRewriteRules() {

		add_action('init', function () {
			add_rewrite_tag('%'.$this->slug.'%', '([^&]+)');
//			add_rewrite_rule(
//				'interesting-things/?$',
//				'index.php?'.$this->slug.'=interesting-things',
//				'top'
//			);

			// An alternative approach.
			 add_rewrite_rule(
			   '^[0-9]{1,6}$',
			   'index.php?'.$this->slug.'=$matches[1]',
			   'top'
			 );

		});

	}

	private function assignTemplate(){

		add_filter('template_include', function ($template) {
			global $wp_query;
			$new_template = '';

			if (array_key_exists($this->slug, $wp_query->query_vars)) {

				get_header();
				include locate_template('template-parts/content-listing.php');
				get_footer();

				if ($new_template != '') {
					return $new_template;
				} else {
					// This is not a valid virtualpage value, so set the header and template
					// for a 404 page.
					$wp_query->set_404();
					status_header(404);
					return get_404_template();
				}
			}

			return $template;
		});

	}
}