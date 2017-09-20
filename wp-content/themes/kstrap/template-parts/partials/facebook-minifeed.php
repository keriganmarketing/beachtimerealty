<?php

use Includes\Modules\Facebook\FacebookFeed;

$feed    = new FacebookFeed();
$results = $feed->fetch(2);
$now = time();

?>
<div class="facebook-feed">
	<?php foreach ($results->data as $result) {
		$trimmed = wp_trim_words( $result->message, $num_words = 25, '...' );
		?>

        <div class="facebook-feed-item" id="<?php echo $result->id; ?>" >

            <div class="row">
                <div class="col-4">
                    <img src="<?php echo $result->picture; ?>" class="img-fluid" alt="<?php echo $result->caption; ?>" >
                </div>
                <div class="col-8">
                    <p class="time-posted">posted <?php echo human_time_diff($now,strtotime($result->created_time)); ?> ago</p>
                    <p style="margin:0;"><?php echo $trimmed; ?></p>
                    <p><a target="_blank" href="<?php echo $result->link; ?>" >read more</a></p>
                </div>
            </div>
            <hr>
        </div>

	<?php } ?>
</div>

<div class="section-bottom">
	<div class="section-button text-center text-md-left">
		<a class="btn btn-primary btn-outlined btn-reversed" href="#" >Follow us on Facebook</a>
	</div>
</div>