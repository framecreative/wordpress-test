<?php
get_header();

$image = get_field( 'hero_image' );
$text = get_field( 'hero_text' );

?>

<div class="hero">

    <?php if ( $image ) : ?>
        <img class="hero_image" src="<?php echo $image['url'] ?>" alt="">
    <?php endif ?>

    <?php if ( $text ) : ?>
        <div class="hero_text t-small-upper">
            <?php echo $text ?>
        </div>
    <?php endif ?>

</div>

<?php
get_footer();
