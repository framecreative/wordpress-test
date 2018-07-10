<?php

$menu = WordPressTestTheme()->get_menu_items('contact-menu');

?>

<div class="panel panel--dark" id="contact" >

    <div class="panel_header">

        <div class="t-small-upper">Contact</div>
        <h2 class="t-heading" >Get in Touch</h2>

    </div>

    <div class="panel_content">

        <div class="contact">

            <div class="contact_sections">

                <div class="contact_section t-center t-copy t-small-upper">

                    <p>
                        West Oak Hotel<br>
                        208 Hindley St, Adelaide SA 5000<br>
                    </p>
                    <p>
                        West Oak Hotel will be shortening our opening times until July 23rd due to minor Winter renovations. Open MON-WED, SAT 4:00pm —  Late, THU &amp; FRI 7:30am — Late<br>(Sunday available for functions)
                    </p>
                    <p>
                        <a href="tel:0884105084">Phone 08 8410 5084</a><br>
                        <a href="mailto:hello@westoakhotel.com.au">hello@westoakhotel.com.au</a>
                    </p>

                </div>

                <div class="contact_section">
                    <a href="https://www.google.com.au/maps/dir//208+Hindley+St,+Adelaide+SA+5000" target="_blank" >
                        <img src="<?php echo WordPressTestTheme()->get_asset_url('images/map.jpg') ?>" alt="">
                    </a>
                </div>

            </div>

            <?php if ( count( $menu ) ) : ?>
                <nav class="contact_menu t-small-upper">

                    <?php foreach ( $menu as $menu_item ) : ?>
                        <a href="<?php echo $menu_item->url ?>" target="<?php echo $menu_item->target ?>" >
                            <?php echo $menu_item->title ?>
                        </a>
                    <?php endforeach ?>

                </nav>
            <?php endif ?>

        </div>

    </div>

</div>