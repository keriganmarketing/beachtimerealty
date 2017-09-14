<?php

namespace Includes\Modules\Testimonials;

use Includes\Modules\CPT\CustomPostType;

/**
 * Testimonials
 */

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

class Testimonials
{
    /**
     * Testimonials constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return null
     */
    public function createPostType()
    {
        $quote = new CustomPostType('Testimonial', [
                'supports'           => [ 'title', 'editor', 'revisions' ],
                'menu_icon'          => 'dashicons-format-quote',
                'rewrite'            => [ 'slug' => 'testimonials' ],
                'has_archive'        => false,
                'menu_position'      => null,
                'public'             => true,
                'publicly_queryable' => true,
            ]);

        $quote->addTaxonomy('Testimonial Category');

        $quote->addMetaBox('Author Info', [
                'Name'          => 'text',
                'Company'       => 'text',
                'Short Version' => 'longtext',
                'Featured'      => 'boolean'
            ]);
    }

    /**
     * @return null
     */
    public function createAdminColumns()
    {

        //TODO: make this work...
    }

    /**
     * @return null
     */
    public function createShortcode()
    {
        function gettestimonials_func($atts, $content = null)
        {
            $a = shortcode_atts([
                'category'     => '',
                'truncate'     => 0,
                'count'        => '-1',
                'featuredonly' => false,
                'sortby'       => 'date_posted',
                'sort'         => 'DESC',
                'class'        => ''
            ], $atts);

            $request = [
                'posts_per_page' => $a['count'],
                'offset'         => 0,
                'order'          => $a['sort'],
                'orderby'        => $a['sortby'],
                'post_type'      => 'testimonial',
                'post_status'    => 'publish',
            ];

            if ($a['category'] != '') {
                $categoryarray        = [
                    [
                        'taxonomy'         => 'testimonial_category',
                        'field'            => 'slug',
                        'terms'            => $a['category'],
                        'include_children' => false,
                    ],
                ];
                $request['tax_query'] = $categoryarray;
            }

            if ($a['featuredonly']) {
                $metaarray             = [
                    [
                        'key'     => 'author_info_featured',
                        'value'   => '1',
                        'compare' => '!='
                    ],
                ];
                $request['meta_query'] = $metaarray;
            }

            $testimoniallist = get_posts($request);

            $output = '';
            foreach ($testimoniallist as $testimonial) {
                $testimonial_id = $testimonial->ID;
                $copy           = $testimonial->post_content;
                $author         = get_post_meta($testimonial_id, 'author_info_name', true);
                $company        = get_post_meta($testimonial_id, 'author_info_company', true);
                $featured       = get_post_meta($testimonial_id, 'author_info_featured', true);
                $shorttext      = get_post_meta($testimonial_id, 'author_info_short_version', true);

                if ($a['truncate']) {
                    if ($shorttext != '') {
                        $copy = $shorttext;
                    }
                }

                $output .= '<div id="testimonial-' . $testimonial_id . '" class="full-quotes '.$a['class'].' '.$featured.'">
					<div class="testimonial-content">
						<p class="quote-content">' . $copy . '</p>
						<p class="quote-author" >' . $author . ', ' . $company . '</p>
					</div>
				</div>';
            }

            return $output;
        }

        add_shortcode('gettestimonials', 'gettestimonials_func');
    }
}
