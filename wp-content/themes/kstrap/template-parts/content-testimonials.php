<?php

use Includes\Modules\Testimonials\Testimonials;

/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */
include(locate_template('template-parts/partials/top.php'));

$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="section-wrapper support-mast">
            <div class="container">
                <h1 class="title"><?php echo $headline; ?></h1>
                <?php echo ($subhead!='' ? '<p class="subtitle">'.$subhead.'</p>' : null); ?>
            </div>
        </div>
        <section id="content" class="content section all-testimonials">
            <div class="container">
                <div class="entry-content">
                    <?php
                    the_content();

                    $testimonials = new Testimonials();
                    $request = $testimonials->getTestimonials([]);

                    foreach($request as $testimonial){ ?>
                        <div class="testimonial" >
                            <div class="open-quote">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129.86 91.81">
                                    <path d="M61,64.33Q61,76.1,53.45,84T33.82,91.81a30.66,30.66,0,0,1-24.31-11Q0,69.76,0,54.36,0,32,16.61,16T56.78,0l.6,4.53q-14.5,0-26.58,10.18T18.72,38.05a10.48,10.48,0,0,0,.75,4.53,2.41,2.41,0,0,0,2.27,1.51q2.11,0,6.49-2a18.86,18.86,0,0,1,7.4-2A25.93,25.93,0,0,1,53.3,47,22.12,22.12,0,0,1,61,64.33Zm68.86,0q0,11.78-7.55,19.63t-19.63,7.85a30.67,30.67,0,0,1-24.31-11q-9.51-11-9.51-26.42Q68.86,32,85.47,16T125.63,0l.6,4.53q-14.5,0-26.58,10.18T87.58,38.05a10.47,10.47,0,0,0,.76,4.53,2.41,2.41,0,0,0,2.26,1.51q2.11,0,6.49-2a18.86,18.86,0,0,1,7.4-2A25.93,25.93,0,0,1,122.16,47,22.12,22.12,0,0,1,129.86,64.33Z"/>
                                </svg>
                            </div>
                            <div class="testimonial-content">
                                <?php echo $testimonial['content']; ?>
                            </div>
                            <div class="testimonial-author">
                                <p>&mdash;<?php echo $testimonial['author']; ?>
                                    <?php echo ($testimonial['company'] != '' ? '<br>' . $testimonial['company'] : '');?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>
<?php
include(locate_template('template-parts/partials/bot.php'));
