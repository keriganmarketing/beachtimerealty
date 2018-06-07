<?php

use KeriganSolutions\FacebookFeed\FacebookFeed;

$feed    = new FacebookFeed();
$results = $feed->fetch(2);
$now     = time();

?>
<?php if (! property_exists($results, 'error')) { ?>
    <div class="facebook-feed">
        <?php foreach ($results->posts as $result) {
            $message = $result->message ?? 'This just in...';
            $trimmed = wp_trim_words( $message, $num_words = 22, '...' );
            $photo_url = (! isset($result->full_picture) || $result->full_picture == '') ? 'https://beachtimerealty.com/wp-content/uploads/2017/09/Laketown-Wharf-real-estate-sales-team-Desiree-Gardner-Photography-Oct-2017-print-quality-30-e1510248636284-288x300.jpg' : $result->full_picture;
            ?>

            <div class="facebook-feed-item" id="<?php echo $result->id; ?>" >

                <div class="row">
                    <div class="col-4">
                        <img src="<?php echo $photo_url; ?>" class="img-fluid" alt="<?php echo $result->caption ?? 'The photo'; ?>" >
                    </div>
                    <div class="col-8">
                        <p class="time-posted">posted <?php echo human_time_diff($now,strtotime($result->created_time)); ?> ago</p>
                        <p style="margin:0;"><?php echo $trimmed; ?> <a target="_blank" href="<?php echo $result->permalink_url; ?>" >read more</a></p>
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
