<?php
use Gibbon\Module\RankModule\Domain\ClassAverageRankGateway;

$moduleVersion = '1.0.00';
$moduleName = 'Rank Module';
$moduleAuthor = 'Your Name';
$moduleDescription = 'A module to rank students by class average and school-wide.';
$moduleURL = 'https://yourwebsite.com';

// Define the module
$module = [
    'name' => $moduleName,
    'version' => $moduleVersion,
    'author' => $moduleAuthor,
    'description' => $moduleDescription,
    'url' => $moduleURL,
    'global' => true,
    'actions' => [
        'viewRanks' => 'View Student Ranks'
    ]
];

return $module;
?>
