// Fetch all students and their class averages
$students = getAllStudents(); // Fetches all students enrolled
$studentAverages = [];
$classAverages = [];
$schoolAverages = [];

foreach ($students as $student) {
    $studentID = $student['studentID'];
    $yearGroupID = $student['yearGroupID'];
    $average = calculateClassAverage($studentID); // Custom function to calculate class average
    $studentAverages[$studentID] = ['average' => $average, 'yearGroupID' => $yearGroupID];
    
    // Organize averages by class and school
    $classAverages[$yearGroupID][] = $average;
    $schoolAverages[] = $average;
}

// Sort and rank students within their classes
foreach ($classAverages as $yearGroupID => $averages) {
    arsort($averages);
    $rank = 1;
    foreach ($averages as $average) {
        foreach ($studentAverages as $studentID => $data) {
            if ($data['average'] == $average && $data['yearGroupID'] == $yearGroupID) {
                $studentAverages[$studentID]['classRank'] = $rank;
                $rank++;
            }
        }
    }
}

// Sort and rank students school-wide
arsort($schoolAverages);
$rank = 1;
foreach ($schoolAverages as $average) {
    foreach ($studentAverages as $studentID => $data) {
        if ($data['average'] == $average) {
            $studentAverages[$studentID]['schoolRank'] = $rank;
            $rank++;
        }
    }
}

// Insert ranks into the database
$rankGateway = new ClassAverageRankGateway($pdo);
foreach ($studentAverages as $studentID => $data) {
    $rankGateway->insertRank($studentID, $data['average'], $data['classRank'], $data['schoolRank'], $data['yearGroupID']);
}

// Display the ranks
$ranks = $rankGateway->getAllRanks($yearGroupID);

echo '<table class="w-full table" cellspacing="0" cellpadding="10">';
echo '<thead><tr><td>Student ID</td><td>Class Average</td><td>Class Rank</td><td>School Rank</td></tr></thead><tbody>';

foreach ($ranks as $rank) {
    echo '<tr>';
    echo '<td>' . $rank['studentID'] . '</td>';
    echo '<td>' . $rank['classAverage'] . '</td>';
    echo '<td>' . $rank['classRank'] . '</td>';
    echo '<td>' . $rank['schoolRank'] . '</td>';
    echo '</tr>';
}

echo '</tbody></table>';
