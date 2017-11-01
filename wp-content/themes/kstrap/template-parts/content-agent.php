<?php

use Includes\Modules\Agents\Agents;
use Includes\Modules\Social\SocialSettingsPage;

/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 * B0678
 */
include(locate_template('template-parts/partials/top.php'));

$agents = new Agents();
$agentData = $agents->assembleAgentData( $post->post_title );
$agents->setAgentSeo($agentData);
$agentData['listings'] = ($agentData['short_ids'] != '' ? $wpTeam->getAgentListings($agentData['short_ids']) : '' );

$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="section-wrapper support-mast">
        </div>
        <section id="content" class="content section agent-profile">
            <div class="container">
                <div class="entry-content">
                    <div class="row">
                        <div class="col-sm-6 col-lg-4">
                            <img class="img-fluid" src="<?php echo ($agentData['thumbnail'] != '' ? $agentData['thumbnail'] : get_template_directory_uri().'/img/beachybeach-placeholder.jpg' ); ?>" alt="<?php echo $agentData['name']; ?>" style="width:500px;">
                            <div class="mini-agent">
                                <ul class="contact-info">
					                <?php if($agentData['cell_phone'] != ''){?><li class="phone"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:<?php echo $agentData['cell_phone']; ?>" ><?php echo $agentData['cell_phone']; ?></a> <span class="label">Cell</span></li><?php } ?>
					                <?php if($agentData['office_phone'] != ''){?><li class="phone"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:<?php echo $agentData['office_phone']; ?>" ><?php echo $agentData['office_phone']; ?></a> <span class="label">Office</span></li><?php } ?>
					                <?php if($agentData['email_address'] != ''){?><li class="email"><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:<?php echo $agentData['email_address']; ?>" ><?php echo $agentData['email_address']; ?></a></li><?php } ?>
					                <?php if($agentData['website'] != ''){?><li class="web"><i class="fa fa-link" aria-hidden="true"></i><a target="_blank" href="<?php echo $agentData['website']; ?>" ><?php echo str_replace('http://','',$agentData['website']); ?></a></li><?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-8">
                            <div class="row">
                                <div class="col-md-7">
                                    <h1><?php echo ($agentData['name'] != '' ? $agentData['name'] : '' ); ?></h1>
                                    <h4><?php echo ($agentData['title'] != '' ? $agentData['title'] : 'Realtor' ); ?></h4>
                                    <div class="social agent">
	                                    <?php
	                                    $socialLinks = new SocialSettingsPage();
	                                    $socialIcons = $socialLinks->getSocialLinks('svg', 'circle', $agentData['social']);
	                                    if (is_array($socialIcons)) {
		                                    foreach ($socialIcons as $socialId => $socialLink) {
			                                    echo '<a class="' . $socialId . '" href="' . $socialLink[0] . '" target="_blank" >' . $socialLink[1] . '</a>';
		                                    }
	                                    }
	                                    ?>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="text-md-right">
                                        <form class="form form-inline" action="/contact/" method="get" style="display:inline-block;" >
                                            <input type="hidden" name="reason" value="Just reaching out" />
                                            <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>" />
                                            <input type="hidden" name="selected_agent" value="<?php echo $agentData['name']; ?>" />
                                            <button type="submit" class="btn btn-primary btn-rounded" style="margin-top: .5rem" >Contact Me</button>
                                        </form>
                                        <a href="#mylistings" style="margin-top: .5rem" class="btn btn-primary btn-rounded">See My Listings</a>
                                    </div>
                                </div>
                            </div>

                            <hr>

			                <?php the_content(); ?>

                        </div>
                    </div>

                </div><!-- .entry-content -->
            </div>
        </section>
        <section id="mylistings" class="section-wrapper featured-properties" >
            <div class="container-fluid">
                <h2 class="section-title text-center line-left line-right">My&nbsp;Listings</h2>
                <div div class="row">

                    <?php foreach($agentData['listings'] as $result){ ?>
                        <div class="col-sm-6 col-lg-3 text-center">
                            <?php include( locate_template( 'template-parts/partials/mini-listing.php' ) ); ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </section>
    </article><!-- #post-## -->
</div>
<?php
include(locate_template('template-parts/partials/bot.php'));
