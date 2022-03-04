<?php
namespace common\models\users;

use Yii;
use yii\db\ActiveRecord;

class UserAttendance extends ActiveRecord
{
    const REGULAR_WORKTIME = 1; // regularny pracovny cas - 8hod + 30m prestavka na obed
    const SICKNESS_ABSENCE = 2; // PN
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
            1   =>  Yii::t('app','Regulárny pracovný čas'),
            2   =>  Yii::t('app','Práce neschopný')
        ];

        return $type[$id];
    }

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
	            ua.uaDate, ua.userId
        ";
        return Yii::$app->db->createCommand($sql)->bindParam(':uid',$userId)->queryAll();
    }

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
}
