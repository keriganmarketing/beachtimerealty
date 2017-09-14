<?php
/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */
?>
<header id="top" class="header">
    <div class="collapse justify-content-center hidden-md-up" id="mobilemenu">
        <?php wp_nav_menu( [
            'theme_location' => 'mobile-menu',
            'container_class' => 'navbar',
            'container_id'    => 'navbarLeft',
            'menu_class'      => 'navbar-nav mr-auto text-left',
            'fallback_cb'     => '',
            'menu_id'         => 'mobile-menu',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ] ); ?>
    </div>
    <?php include(locate_template('template-parts/partials/account-bar.php')); ?>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5 hidden-sm-down">
		        <?php wp_nav_menu( [
			        'theme_location' => 'main-menu-left',
			        'container_class' => 'navbar',
			        'container_id'    => 'navbarMainLeft',
			        'menu_class'      => 'nav justify-content-end',
			        'fallback_cb'     => '',
			        'menu_id'         => 'main-menu-left',
			        'walker'          => new WP_Bootstrap_Navwalker(),
		        ] ); ?>
            </div>
            <div class="col-9 col-md-2 text-center">
                <a class="navbar-brand" href="/">
                    <img src="<?php echo get_template_directory_uri() . '/img/beachtime-logo.svg'; ?>" alt="Beach Time Realty" height="132">
                </a>
            </div>
            <div class="col-3 hidden-md-up">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobilemenu" aria-controls="mobilemenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-box">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </span>
                </button>
            </div>
            <div class="col-md-5 hidden-sm-down">
                <?php wp_nav_menu( [
                    'theme_location' => 'main-menu-right',
                    'container_class' => 'navbar',
                    'container_id'    => 'navbarMainRight',
                    'menu_class'      => 'nav justify-content-start',
                    'fallback_cb'     => '',
                    'menu_id'         => 'main-menu-right',
                    'walker'          => new WP_Bootstrap_Navwalker(),
                ] ); ?>
            </div>
        </div>
    </div>
</header>
