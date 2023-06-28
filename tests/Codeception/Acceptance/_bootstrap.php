<?php

/**
 * Copyright © Smar Commerce SE[D[D[D[D[D[D[D[D[D[D[D[Dt Commerce SE. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

// This is acceptance bootstrap
use Symfony\Component\Filesystem\Path;

require_once Path::join((new \OxidEsales\Facts\Facts())->getShopRootPath(), 'source', 'bootstrap.php');

$helper = new \OxidEsales\Codeception\Module\FixturesHelper();
$helper->loadRuntimeFixtures(__DIR__ . '/../_data/fixtures.php');
