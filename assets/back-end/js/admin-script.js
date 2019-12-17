/**
 * Project   : Yugen WordPress Theme
 * Purpose   : Custom Admin Script
 * Author    : precisethemes
 * Theme URI : https://precisethemes.com/
 *
 * File admin-script.js.
 * @package yugen
 */

( function( $ ) {

    "use strict";

    // Welcome Page Menu Tab
    $('ul.about-theme-tab-nav li').click(function (e) {
        window.localStorage.setItem('about_active_tab', $(e.target).data('tab'));
        var about_tab_id = $(this).data('tab');

        $('ul.about-theme-tab-nav li').removeClass('active');
        $('.about-theme-tab').removeClass('active');

        $(this).addClass('active');
        $("#" + about_tab_id).addClass('active');
    });

    // Store tab data value in local storage
    var about_active_tab = window.localStorage.getItem('about_active_tab');

    // Add Active Class in both tab and content with browser refresh
    if (about_active_tab) {
        $('ul.about-theme-tab-nav li').removeClass('active');
        $('.tab-link').removeClass('active');
        $('ul.about-theme-tab-nav li[data-tab="'+about_active_tab+'"]').addClass('active');
        $("#"+about_active_tab).addClass('active');
    } else {
        $('ul.about-theme-tab-nav li[data-tab="getting_started"]').addClass('active');
        $("#getting_started").addClass('active');
    }

    // add active class on tabs with click event
    $('ul.metabox-tab-nav li').on( 'click', function (e) {
        window.localStorage.setItem('metabox_active_tab', $(e.target).data('tab'));
        var tab_id = $(this).data('tab');
        $('ul.metabox-tab-nav li').removeClass('active');
        $('.setting-tab').removeClass('active');

        $(this).addClass('active');
        $("#" + tab_id).addClass('active');
    });

    // Store tab data value in local storage
    var metabox_active_tab = window.localStorage.getItem('metabox_active_tab');

    // Add Active Class in both tab and content with browser refresh
    if (metabox_active_tab) {
        $('ul.metabox-tab-nav li').removeClass('active');
        $('.setting-tab').removeClass('active');
        $('ul.metabox-tab-nav li[data-tab="'+metabox_active_tab+'"]').addClass('active');
        $("#"+metabox_active_tab).addClass('active');
    } else {
        $('ul.metabox-tab-nav li[data-tab="setting-tab-1"]').addClass('active');
        $("#setting-tab-1").addClass('active');
    }

} ) ( jQuery );  