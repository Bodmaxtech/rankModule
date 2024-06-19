namespace Gibbon\Module\RankModule\Domain;

use Gibbon\Domain\Traits\TableAware;
use Gibbon\Contracts\Database\Connection;

class ClassAverageRankGateway {
    use TableAware;

    private static $tableName = 'gibbonClassAverageRank';
    
    public function __construct(Connection $connection) {
        $this->setConnection($connection);
    }

    public function insertRank($studentID, $classAverage, $classRank, $schoolRank, $yearGroupID) {
        $data = [
            'studentID' => $studentID,
            'classAverage' => $classAverage,
            'classRank' => $classRank,
            'schoolRank' => $schoolRank,
            'yearGroupID' => $yearGroupID
        ];

        return $this->insert($data);
    }

    public function getAllRanks($yearGroupID) {
        $sql = "SELECT * FROM gibbonClassAverageRank WHERE yearGroupID = :yearGroupID ORDER BY classRank";
        $params = ['yearGroupID' => $yearGroupID];

        return $this->select($sql, $params);
    }
}
