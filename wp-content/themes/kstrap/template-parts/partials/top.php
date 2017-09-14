<?php

use Includes\Modules\NavWalker\NavWalker;

/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */
?>
<div class="sticky-header">
    <div class="collapse justify-content-center hidden-md-up" id="mobilemenu">
        <?php wp_nav_menu([
            'theme_location'  => 'mobile-menu',
            'container_class' => 'navbar',
            'menu_class'      => 'navbar-nav mr-auto text-left',
            'fallback_cb'     => '',
            'menu_id'         => 'mobile-menu',
            'walker'          => new NavWalker(),
        ]); ?>
    </div>
    <?php include(locate_template('template-parts/partials/account-bar.php')); ?>
    <header id="top" class="header">

        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-5 hidden-md-down">
                    <?php wp_nav_menu([
                        'theme_location'  => 'main-menu-left',
                        'container_class' => 'navbar',
                        'menu_class'      => 'nav justify-content-end',
                        'fallback_cb'     => '',
                        'menu_id'         => 'main-menu-left',
                        'walker'          => new NavWalker(),
                    ]); ?>
                </div>
                <div class="col-9 col-lg-2 text-center">
                    <a class="navbar-brand" href="/">
                        <img src="<?php echo get_template_directory_uri() . '/img/beachtime-logo.svg'; ?>"
                             alt="<?php echo get_bloginfo(); ?>" >
                    </a>
                </div>
                <div class="col-3 hidden-lg-up">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobilemenu"
                            aria-controls="mobilemenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-box">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </span>
                    </button>
                </div>
                <div class="col-lg-5 hidden-md-down">
                    <?php wp_nav_menu([
                        'theme_location'  => 'main-menu-right',
                        'container_class' => 'navbar',
                        'menu_class'      => 'nav justify-content-start',
                        'fallback_cb'     => '',
                        'menu_id'         => 'main-menu-right',
                        'walker'          => new NavWalker(),
                    ]); ?>
                </div>
            </div>
        </div>
    </header>
</div>
