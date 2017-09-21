<?php
/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */
?>
<div id="top-top">
    <?php if (is_user_logged_in()) {
    ?>
        <div class="user-nav">
            <p class="nav-item"><span class="num-saved-props">3</span><span class="saved-props-label">saved properties</span></p>
            <a class="nav-item" href="/my-account/">My Account</a>
            <a class="nav-item" href="<?php echo wp_logout_url('/'); ?>">Log Out</a>
        </div>
    <?php
    } else {
        ?>
        <p class="text-center nav-item"><a href="/my-account/user-login/">login</a> to save properties</p>
    <?php
    }
    ?>
</div>
