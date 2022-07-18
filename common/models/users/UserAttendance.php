<?php
namespace common\models\users;

use Yii;
use yii\db\ActiveRecord;

class UserAttendance extends ActiveRecord
{
    const REGULAR_WORKTIME = 1; // regularny pracovny cas - 8hod + 30m prestavka na obed
    const SICKNESS_ABSENCE = 2; // PN
    const DOCTOR_VISIT = 3;
    const UNVERIFIED_ABSENCE = 4;
    const ABSENCE = 5;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userAttendance';
    }

    /**
     * @param int $id
     * @return string
     */
    public static function workType(int $id): string
    {
        $type = [
            1 => Yii::t('app','Regulárny pracovný čas'),
            2 => Yii::t('app','Práce neschopný'),
            3 => Yii::t('app','Návšteva lekára'),
            4 => Yii::t('app','Neospravedlnené meškanie'),
            5 => Yii::t('app','Ospravedlnené meškanie'),
        ];

        return $type[$id];
    }

    /**
     * @param int $userId
     * @return array|\yii\db\DataReader
     * @throws \yii\db\Exception
     */
    public function getListByUserId(int $userId)
    {
        $sql = "
            select
                ua.id, ua.uaDate, ua.inTime, ua.outTime, ua.note, ua.uaType,  
                concat(a.name_first,' ',a.name_last) as meno, ua.uaAction, ua.inIP, ua.outIP,
                SEC_TO_TIME(ua.diffTime) as diffTime   
            from
                " . self::tableName() . " ua
            join
                agent a on a.user_id=ua.userId
            where
                ua.userId=:uid
            GROUP BY
	            ua.uaDate, ua.userId, ua.id, a.name_first, a.name_last 
	        ORDER BY
	            ua.uaDate desc
        ";
        return Yii::$app->db->createCommand($sql)->bindParam(':uid',$userId)->queryAll();
    }

    /**
     * @param int $userId
     * @param bool $useLetters
     * @param int|null $year
     * @return false|string|\yii\db\DataReader|null
     * @throws \yii\db\Exception
     */
    public function getYearlyWorkedHoursByUserId(int $userId, bool $useLetters = false, ?int $year=null)
    {
        if (is_null($year)) {
            $year = (new \DateTime('now'))->format('Y');
        }
        $sql = "
            select
                SEC_TO_TIME(sum(diffTime)) as diffTime
            from " . self::tableName() . " 
            where uaDate between :date1 and :date2 and userId=:uid
        ";
        $date1 = "$year-01-01";
        $date2 = "$year-12-31";
        $result = Yii::$app
                    ->db
                    ->createCommand($sql)
                    ->bindParam(':date1',$date1)
                    ->bindParam(':date2', $date2)
                    ->bindParam(':uid', $userId)
                    ->queryScalar();

        if ($useLetters) {
            return $this->convertTimeToTimeWithLetters($result);
        }

        return $result;
    }

    /**
     * @param int $userId
     * @param bool $useLetters
     * @param int|null $month
     * @param int|null $year
     * @return false|string|\yii\db\DataReader|null
     * @throws \yii\db\Exception
     */
    public function getMonthlyWorkedHoursByUserId(int $userId, bool $useLetters = false, ?int $month=null, ?int $year=null)
    {
        if (is_null($year)) {
            $year = (new \DateTime('now'))->format('Y');
        }
        if (is_null($month)) {
            $month = (new \DateTime('now'))->format('m');
        }

        $sql = "
            select
                SEC_TO_TIME(sum(diffTime)) as diffTime
            from " . self::tableName() . " 
            where uaDate like :date1 and userId=:uid
        ";
        $date1 = "$year-$month-%";
        $result = Yii::$app
            ->db
            ->createCommand($sql)
            ->bindParam(':date1',$date1)
            ->bindParam(':uid', $userId)
            ->queryScalar();

        if ($useLetters) {
            return $this->convertTimeToTimeWithLetters($result);
        }

        return $result;
    }

    /**
     * @param int $userId
     * @param bool $useLetters
     * @param string|null $date
     * @return false|string|\yii\db\DataReader|null
     * @throws \yii\db\Exception
     */
    public function getDailyWorkedHoursByUserId(int $userId, bool $useLetters = false, ?string $date=null)
    {
        if (is_null($date)) {
            $date = (new \DateTime('now'))->format('Y-m-d');
        }
        $sql = "
            select
                SEC_TO_TIME(sum(diffTime)) as diffTime
            from " . self::tableName() . " 
            where uaDate=:date1 and userId=:uid
        ";
        $result = Yii::$app
            ->db
            ->createCommand($sql)
            ->bindParam(':date1',$date)
            ->bindParam(':uid', $userId)
            ->queryScalar();

        if ($useLetters) {
            return $this->convertTimeToTimeWithLetters($result);
        }

        return $result;
    }

    /**
     * @param string|null $time
     * @param bool $useSeconds
     * @return string
     */
    private function convertTimeToTimeWithLetters(?string $time, bool $useSeconds = false): string
    {
        if (is_null($time)) {
            return "0h 0m";
        }
        list($hour,$minute,$second) = explode(":",$time);
        $result = "{$hour}h {$minute}m";
        if ($useSeconds) {
            $result .= " {$second}s";
        }
        return $result;
    }

    /**
     * @return array
     * @throws \yii\db\Exception
     */
    public function getListForAdmin(): array
    {
        $sql = "
            SELECT 
                id,
                (select concat(name_first, ' ', name_last) FROM agent WHERE user_id=ua.userId LIMIT 1) AS meno,
                uaDate, inTime, outTime, SEC_TO_TIME(diffTime) AS diffTime, uaType,
                (select group_concat(item_name) from auth_assignment where user_id=ua.userId) as user_groups
            FROM 
                userAttendance ua
            ORDER BY 
                uaDate DESC
        ";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * @param string $group
     * @param string $startDate
     * @param string $endDate
     * @return array
     * @throws \yii\db\Exception
     */
    public function getListForAdminByOptions(string $group='', string $startDate='', string $endDate=''): array
    {
        $groupFilter = " AND ua.userId IN (select user_id from auth_assignment where item_name='{$group}')";
        if ('' == $group) {
            $groupFilter = '';
        }
        $dateFilter = " AND ua.uaDate between '{$startDate}' AND '{$endDate}'";
        if ('' == $startDate) {
            $dateFilter = '';
        }
        $sql = "SELECT 
                id,
                (select concat(name_first, ' ', name_last) FROM agent WHERE user_id=ua.userId LIMIT 1) AS meno,
                uaDate, inTime, outTime, SEC_TO_TIME(diffTime) AS diffTime, uaType,
                (select group_concat(item_name) from auth_assignment where user_id=ua.userId) as user_groups
            FROM 
                userAttendance ua
            WHERE 
                1=1{$groupFilter}{$dateFilter}
            ORDER BY 
                uaDate DESC";

        return Yii::$app->db->createCommand($sql)->queryAll();
    }

}
