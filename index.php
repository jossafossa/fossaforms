<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/includes/FossaForms/Bootstrap.php';
require __DIR__ . '/includes/FossaForms/Forms.php';

require __DIR__ . '/api/helpers.php';
require __DIR__ . '/api/theme.php';


// Initialize the plugin.
FF_Bootstrap::init();

$form = get_form();
print_r($form);
