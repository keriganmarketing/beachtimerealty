<?php

use Includes\Modules\MLS\FavoriteProperty;
/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */

$numberOfFavorites = FavoriteProperty::getNumberOfFavorites(is_user_logged_in() ? get_current_user_id() : -1);
?>
<div id="top-top">
    <?php if (is_user_logged_in()) {
    ?>
        <div class="user-nav">
            <p class="nav-item"><span class="num-saved-props"><?= $numberOfFavorites ?> </span><span class="saved-props-label">saved properties</span></p>
            <a class="nav-item" href="/my-account/">My Account</a>
            <a class="nav-item" href="<?php echo wp_logout_url('/'); ?>">Log Out</a>
        </div>
    <?php
    } else {
        ?>
        <p class="text-center nav-item"><a href="/my-account/user-login/">login to save properties</a></p>
    <?php
    }
    ?>
</div>
