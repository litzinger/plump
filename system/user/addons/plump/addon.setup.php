<?php

$plumpConfig = [
    'author'      => 'BoldMinded',
    'author_url'  => 'http://boldminded.com/',
    'name'        => 'Plump',
    'description' => 'Make the CP a little wider.',
    'version'     => '1.0',
    'settings_exist' => false,
    'namespace'   => 'BoldMinded\Plump',
];

if (! defined('PLUMP_VERSION')) {
    define('PLUMP_AUTHOR', $plumpConfig['version']);
    define('PLUMP_VERSION', $plumpConfig['version']);
    define('PLUMP_NAME', $plumpConfig['name']);
    define('PLUMP_EXT', $plumpConfig['name'].'_ext');
    define('PLUMP_DESC', $plumpConfig['description']);
    define('PLUMP_DOCS', $plumpConfig['author_url']);
}

return $plumpConfig;
