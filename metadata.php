<?php

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = array(
    'id'            => 'pr_custom_search',
    'title'         => 'Custom search',
    'description'   => 'Custom search',
    'thumbnail'     => '../logo.png',
    'version'       => '1.0',
    'author'        => 'Hleb Prakhnitski',
    'email'         => 'thane.crios@gmail.com',
    'blocks'        => [
        [
            'template' => 'layout/header.tpl',
            'block' => 'pr_custom_search',
            'file' => '/Application/views/blocks/search.tpl'
        ]
    ],
    'settings' => [
        [
            'group' => 'settings',
            'name' => 'customSearchURL',
            'type' => 'str',
            'value' => 'https://elastic.pr1.run/baywa/custom_search_test/'
        ],
        [
            'group' => 'settings',
            'name' => 'prFacebookPixelStatus',
            'type' => 'str',
            'value' => 'Basic cHIxLWtpYmFuYTpwcjFraWJhbmE='
        ]
    ]
);
