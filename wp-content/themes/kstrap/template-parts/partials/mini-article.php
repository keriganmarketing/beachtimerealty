<div class="card text-center">
    <div class="article-image">
        <?php if($result->type != 'video') { ?>
            <div class="card-image embed-responsive embed-responsive-4by3">
                <a href="<?php echo $result->link; ?>" target="_blank">
                    <img src="<?php echo $photo_url; ?>" alt="<?php echo isset($result->caption) ? $result->caption : ''; ?>" class="embed-responsive-item" >
                </a>
            </div>
        <?php } else { ?>
            <figure class="image video is-4by3">
                <iframe
                    src="<?php echo 'https://www.facebook.com/plugins/video.php?href='.$result->link ?>"
                    style="border:none;overflow:hidden"
                    scrolling="no"
                    frameborder="0"
                    allowTransparency="true"
                    allowFullScreen="true"
                    class="article-image"
                    width="100%"
                    height="460">

                </iframe>
            </figure>
        <?php } ?>
    </div>
    <div class="card-block">
        <p>posted <?php echo human_time_diff($now, strtotime($result->created_time)); ?> ago</p>
        <p><?php echo $trimmed; ?></p>
    </div>
    <div class="card-footer">
        <a class="article-footer-item" href="<?php echo $result->link; ?>" target="_blank" >Read more on Facebook</a>
    </div>
</div>

