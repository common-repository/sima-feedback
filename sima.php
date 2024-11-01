<?php
/*
Plugin Name: Sima Feedback
Description: Get visual feedback on any WordPress site.
Version: 1.1
Author: Paul Breslin
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Enqueue the external Sima script with a dynamic version to bypass caching
function sima_feedback_add_script() {
    $script_url = 'https://www.simafeedback.com/sima.js';
    $version = time(); // Use the current timestamp as the version number
    
    wp_enqueue_script(
        'sima-feedback', // Handle for the script
        add_query_arg('ver', $version, $script_url), // Append version query to the script URL
        array(), // Dependencies, if any
        $version, // Version number to satisfy WordPress's expectations
        true // Load in footer
    );
    
    // Add the data-direct-integration attribute
    $script = 'document.querySelector("script[src^=\'https://www.simafeedback.com/sima.js\']").setAttribute("data-direct-integration", "true");';
    wp_add_inline_script('sima-feedback', $script);
}

add_action('wp_enqueue_scripts', 'sima_feedback_add_script');
?>