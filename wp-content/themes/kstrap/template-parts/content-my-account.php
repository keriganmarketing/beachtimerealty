<?php

use Includes\Modules\MLS\FavoriteProperty;
/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */
include(locate_template('template-parts/partials/top.php'));

$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');

$favoriteProperty = new FavoriteProperty();
$listings = $favoriteProperty->getSavedListings(get_current_user_id());

if(isset($_POST['user_id']) && isset($_POST['mls_account'])){
    if(isset($_POST['action']) && $_POST['action'] == 'remove'){
        echo "<meta http-equiv='refresh' content='0'>";
        $favoriteProperty->handleFavorite($_POST['user_id'], $_POST['mls_account']);
    }
}

?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="section-wrapper support-mast">
            <div class="container">
                <h1 class="title"><?php echo $headline; ?></h1>
                <?php echo ($subhead!='' ? '<p class="subtitle">'.$subhead.'</p>' : null); ?>
            </div>
        </div>
        <?php if(is_user_logged_in()){ ?>
            <div class="container-fluid">
                <div class="entry-content">
                    <hr>
                    <div class="account-actions text-center">
                        <a class="btn btn-sm btn-primary btn-rounded mr-1" href="/my-account/edit-account/">Edit my account information</a>
                        <a class="btn btn-sm btn-primary btn-rounded" href="/my-account/change-password/">Change my password</a>
                    </div>
                    <hr>
                </div><!-- .entry-content -->
                <div class="row">
                    <?php foreach ($listings as $result) { ?>
                        <div class="col-sm-6 col-md-3 col-lg-3 text-center">
                            <?php include(locate_template('template-parts/partials/mini-listing.php')); ?>
                            <div class="favorite-item-actions">
                                <form class="form mb-2" method="post" >
                                    <input type="hidden" name="action" value="remove">
                                    <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>" />
                                    <input type="hidden" name="mls_account" value="<?php echo $result->mls_account; ?>" />
                                    <button type="submit" class="btn btn-secondary btn-rounded" >Remove from favorites</button>
                                </form>
                            </div>
                        </div>
                        <?php
                    } ?>
                </div>
                <p>&nbsp;</p>
            </div>
        <?php }else{ ?>
            <section class="content section">
                <div class="container">
                    <div class="entry-content">
                        <script>
                            window.location = '/my-account/user-login/'
                        </script>
                    </div>
                </div>
            </section>
        <?php } ?>

    </article><!-- #post-## -->
</div>
<?php
include(locate_template('template-parts/partials/bot.php'));
