function getAllStudents() {
    global $pdo;

    $sql = "SELECT gibbonPersonID AS studentID, yearGroupID FROM gibbonPerson WHERE roleIDStudent IS NOT NULL";
    $result = $pdo->executeQuery($sql);

    return $result->fetchAll();
}

function calculateClassAverage($studentID) {
    global $pdo;

    // Example calculation - adjust based on actual logic
    $sql = "SELECT AVG(attainmentValue) AS classAverage FROM gibbonInternalAssessment WHERE studentID = :studentID";
    $params = ['studentID' => $studentID];
    $result = $pdo->executeQuery($sql, $params);

    $row = $result->fetch();

    return $row['classAverage'];
}
