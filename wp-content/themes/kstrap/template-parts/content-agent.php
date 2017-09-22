<?php

use Includes\Modules\Agents\Agents;
use Includes\Modules\Social\SocialSettingsPage;

/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */
include(locate_template('template-parts/partials/top.php'));

$agents = new Agents();
$agent = $agents->getSingleAgent($post->post_title);

$agentMLSInfo = false;

$metaTitle = $agent['name'] . ' | ' . $agent['title'] . ' | ' . get_bloginfo('name');
$metaDescription = strip_tags($post->post_content);
$ogPhoto = ($agent['thumbnail'] != '' ? $agent['thumbnail'] : get_template_directory_uri().'/img/beachybeach-placeholder.jpg' );
$ogUrl = get_the_permalink();

$agentEmail = ( $agentMLSInfo != false ? $agentMLSInfo->email : '' );
$agentEmail = ( $agent['email'] != '' ? $agent['email'] : $agentEmail );

$agentCellPhone    = ($agentMLSInfo != false ? $agentMLSInfo->cell_phone : '');
$agentOfficePhone    = ($agentMLSInfo != false ? $agentMLSInfo->office_phone : '');
$agentCellPhone = ( $agent['phone'] != '' ? $agent['phone'] : $agentCellPhone );

$agentWebsite  = ($agentMLSInfo != false ? $agentMLSInfo->url : '');
$agentWebsite = ( $agent['website'] != '' ? $agent['website'] : $agentWebsite );

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
                            <img class="img-fluid" src="<?php echo ($agent['thumbnail'] != '' ? $agent['thumbnail'] : get_template_directory_uri().'/img/beachybeach-placeholder.jpg' ); ?>" alt="<?php echo $agent['name']; ?>" style="width:500px;">
                            <div class="mini-agent">
                                <ul class="contact-info">
					                <?php if($agentCellPhone != ''){?><li class="phone"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:<?php echo $agentCellPhone; ?>" ><?php echo $agentCellPhone; ?></a> <span class="label">Cell</span></li><?php } ?>
					                <?php if($agentOfficePhone != ''){?><li class="phone"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:<?php echo $agentOfficePhone; ?>" ><?php echo $agentOfficePhone; ?></a> <span class="label">Office</span></li><?php } ?>
					                <?php if($agentEmail != ''){?><li class="email"><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:<?php echo $agentEmail; ?>" ><?php echo $agentEmail; ?></a></li><?php } ?>
					                <?php if($agentWebsite != ''){?><li class="web"><i class="fa fa-link" aria-hidden="true"></i><a target="_blank" href="<?php echo $agentWebsite; ?>" ><?php echo str_replace('http://','',$agentWebsite); ?></a></li><?php } ?>
                                </ul>
                            </div>
			                <?php echo '<!--<pre>',print_r($agentMLSInfo),'</pre>-->'; ?>
                        </div>
                        <div class="col-sm-6 col-lg-8">
                            <div class="row">
                                <div class="col-md-7">
                                    <h1><?php echo ($agent['name'] != '' ? $agent['name'] : '' ); ?></h1>
                                    <h4><?php echo ($agent['title'] != '' ? $agent['title'] : 'Realtor' ); ?></h4>
                                    <div class="social agent">
	                                    <?php
	                                    $socialLinks = new SocialSettingsPage();
	                                    $socialIcons = $socialLinks->getSocialLinks('svg', 'circle', $agent['social']);
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
                                            <input type="hidden" name="selected_agent" value="<?php echo $agent['name']; ?>" />
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
                    <div id="mylistings">
                        <h2>My Listings</h2>
                        <?php //TODO ?>
                    </div>
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>
<?php
include(locate_template('template-parts/partials/bot.php'));
