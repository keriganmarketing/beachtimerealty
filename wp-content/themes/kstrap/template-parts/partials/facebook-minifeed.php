<?php

use Includes\Modules\KMAFacebook\FacebookController;

$facebook = new FacebookController();
$feed = $facebook->getFbPosts(2);
$now     = time();

?>
<?php if(count($feed) > 0){ ?>
    <div class="facebook-feed">
        <?php foreach ($feed as $result) {
            $message = $result->post_content ?? 'This just in...';
            $trimmed = wp_trim_words( $message, $num_words = 22, '...' );
            $photo_url = (! isset($result->full_image_url) || $result->full_image_url == '') ? 'https://beachtimerealty.com/wp-content/uploads/2018/09/Laketown-Wharf-real-estate-sales-team-Desiree-Gardner-Photography-Oct-2017-print-quality-30-e1536949164524-300x281.jpg' : $result->full_image_url;
            ?>

            <div class="facebook-feed-item" id="<?php echo $result->id; ?>" >

                <div class="row">
                    <div class="col-4">
                        <img src="<?php echo $photo_url; ?>" class="img-fluid" alt="<?php echo $message ?? 'The photo'; ?>" >
                    </div>
                    <div class="col-8">
                        <p class="time-posted">posted <?php echo human_time_diff($now,strtotime($result->post_date)); ?> ago</p>
                        <p style="margin:0;"><?php echo $trimmed; ?> <a target="_blank" href="<?php echo $result->post_link; ?>" >read more</a></p>
                    </div>
                </div>
                <hr>
            </div>

        <?php } ?>
    </div>
<?php } ?>

<div class="section-bottom">
	<div class="section-button text-center text-md-left">
		<a class="btn btn-primary btn-outlined btn-reversed" href="https://www.facebook.com/beachtimerealtypcb/" >Follow us on Facebook</a>
	</div>
</div>
