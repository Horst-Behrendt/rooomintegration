<?php

/**
 * Copyright © Smar Commerce SE. All rights reserved.
 * See LICENSE file for license details.
 */

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

/**
 * Module information
 */
$aModule = [
    'id'          => 'r3d_rooomintegrationmodule',
    'title'       => 'Rooom 3D animations for articles',
    'description' => 'Module to add rooom 3D animations to shop articles',
    'thumbnail'   => 'pictures/logo.png',
    'version'     => '2.0.0',
    'author'      => 'Smart Commerce SE',
    'url'         => 'http://smartcommerce.de',
    'email'       => 'info@smartcommerce.de',
    'controllers' => [
              'article_rooom'=> ArticleRooom::class
              ],
     'templates'  => [
              'article_rooom.html.twig','r3d/rooomintegrationmodule/views/admin/tpl/article_rooom.html.twig' 
              ],
    'settings' => [
        [
            'group' => 'rooom-configuration',
            'name' => 'RooomDefaultImage',
            'type' => 'str',
            'value' => '',
            ],
         ],
 
];
