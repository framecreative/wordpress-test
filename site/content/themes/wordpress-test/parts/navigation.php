<?php

$menu = WordPressTestTheme()->get_menu_items('main-menu');

$middlePoint = ceil( count($menu) / 2 );

$menu_left = array_slice( $menu, 0, $middlePoint );
$menu_right = array_slice( $menu, $middlePoint );

?>
<header class="navigation">
    <div class="navigation_inner">

        <div class="navigation_logo">
            <a href="<?php echo home_url() ?>">
                <img src="<?php echo WordPressTestTheme()->get_asset_url('images/logo.svg') ?>" alt="West Oak Hotel">
            </a>
        </div>

        <nav class="navigation_items navigation_items--left t-small-upper">

            <?php foreach ( $menu_left as $menu_item ) : ?>
                <a href="<?php echo $menu_item->url ?>" class="navigation_item" >
                    <?php echo $menu_item->title ?>
                </a>
            <?php endforeach ?>

        </nav>

        <nav class="navigation_items navigation_items--right t-small-upper">

            <?php foreach ( $menu_right as $menu_item ) : ?>
                <a href="<?php echo $menu_item->url ?>" class="navigation_item" >
                    <?php echo $menu_item->title ?>
                </a>
            <?php endforeach ?>

        </nav>

    </div>
</header>