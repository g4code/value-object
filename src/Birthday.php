<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidBirthdayException;

class Birthday
{
    const OUTPUT_DATE_FORMAT = 'Y-m-d';

    private $year;
    private $month;
    private $day;

    /**
     * Birthday constructor.
     * @param $year
     * @param $month
     * @param $day
     * @throws InvalidBirthdayException
     */
    public function __construct($year, $month, $day)
    {
        $currentYear = getdate(time())['year'];

        if ($year > $currentYear || ($year + 130 < $currentYear)) {
            throw new InvalidBirthdayException($year);
        }
        if (checkdate($month, $day, $year) === false) {
            $month = 1;
            $day = 1;
        }
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday()
    {
        return (new \DateTime())->setDate($this->year, $this->month, $this->day);
    }

    /**
     * @return Birthday
     */
    public static function get18()
    {
        $aDate = (new \DateTime(date('Y-m-d', strtotime('18 years ago'))));
        return new self(
            $aDate->format('Y'),
            $aDate->format('m'),
            $aDate->format('d')
        );
    }

    /**
     * Calculate the age of a person
     */
    public function getAge()
    {
        $wasBorn = \DateTime::createFromFormat("Y", $this->year);
        $now = new \DateTime();
        $interval = $now->diff($wasBorn);
        return $interval->y;
    }

    /**
     * @param string $dateFormat
     * @return string
     */
    public function format($dateFormat = self::OUTPUT_DATE_FORMAT)
    {
        $aDate = (new \DateTime())->setDate($this->year, $this->month, $this->day);
        return $aDate->format($dateFormat);
    }
}
