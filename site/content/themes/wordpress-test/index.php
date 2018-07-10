<?php
get_header();

$title = get_the_title();
$subtitle = get_field('subtitle');
$header_image = get_field( 'header_image' );
$content = get_field('content');

?>

    <div class="panel panel--light">

        <div class="panel_header">

            <h1 class="t-heading"><?php echo $title ?></h1>

            <?php if ( $subtitle ) : ?>
                <div class="t-small-upper"><?php echo $subtitle ?></div>
            <?php endif ?>

        </div>

        <div class="panel_content s-vert-4">

            <?php if ( $header_image ) : ?>
                <img class="panel_image" src="<?php echo $header_image['url'] ?>" alt="">
            <?php endif ?>

            <div class="panel_copy t-copy">
                <?php echo $content ?>
            </div>

        </div>

    </div>

<?php
get_footer();
