<?php
return array(
    'modules' => array(
        'Common',
        'Fish',
        'Api',
        'News',
        'Admin',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);
