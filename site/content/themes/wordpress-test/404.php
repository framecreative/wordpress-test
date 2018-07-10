<?php
get_header();

$title = get_the_title();
$subtitle = get_field('subtitle');
$header_image = get_field( 'header_image' );
$content = get_field('content');

?>

    <div class="panel panel--light">

        <div class="panel_header">

            <h1 class="t-heading">Page Not Found</h1>

        </div>

    </div>

<?php
get_footer();
