<?php
// Ensure the file is being accessed through Gibbon
if (!defined('GIBBON')) {
    die('This file cannot be accessed directly.');
}

use Gibbon\Module\RankModule\Domain\ClassAverageRankGateway;

$sql = "CREATE TABLE IF NOT EXISTS `gibbonClassAverageRank` (
    `rankID` int(11) NOT NULL AUTO_INCREMENT,
    `studentID` int(11) NOT NULL,
    `classAverage` float NOT NULL,
    `classRank` int(11) NOT NULL,
    `schoolRank` int(11) NOT NULL,
    `yearGroupID` int(11) NOT NULL,
    PRIMARY KEY (`rankID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$pdo->exec($sql);
?>
