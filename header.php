<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bhari
 * @since   1.0
 */

?><!DOCTYPE html>
<?php bhari_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php bhari_head_top(); ?>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php bhari_head_bottom(); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php bhari_body_top(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'bhari'); ?></a>

    <?php bhari_header_before(); ?>
    <header id="masthead" class="site-header" role="banner">
    <?php bhari_header_top(); ?>

        <div class="site-branding">
            <?php the_custom_logo(); ?>
            <?php if (is_front_page() && is_home() ) : ?>
                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php else : ?>
                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
            <?php endif; ?>

            <?php $description = get_bloginfo('description', 'display'); ?>
            <?php if ($description || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
            <?php endif; ?>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation" role="navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <?php if (BHARI_SUPPORT_FONTAWESOME ) : ?>
                    <i class="fa fa-reorder" aria-hidden="true"></i>
                <?php endif; ?>
                <?php esc_html_e('Primary Menu', 'bhari'); ?>
            </button>
            <?php wp_nav_menu(array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' )); ?>
        </nav><!-- #site-navigation -->

    <?php bhari_header_bottom(); ?>
    </header><!-- #masthead -->

    <?php bhari_header_after(); ?>

    <?php if (get_header_image() ) : ?>
    <div class="custom-headers">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
            <img src="<?php header_image(); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" alt="">
        </a>
    </div>
    <?php endif; // End header image check. ?>

    <?php bhari_content_before(); ?>
    <div id="content" class="site-content">
    <?php bhari_content_top(); ?>
