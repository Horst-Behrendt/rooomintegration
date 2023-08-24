<?php

/**
 * Copyright © Smar Commerce SE. All rights reserved.
 * See LICENSE file for license details.
 */

use SmartCommerceSE\RooomIntegration\Controller\Admin\ArticleRooom;
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
              ]
];
