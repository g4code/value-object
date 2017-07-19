<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidBirthdayException;

class Birthday
{

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

        if($year > $currentYear || ($year + 130 < $currentYear)){
            throw new InvalidBirthdayException($year);
        }
        if(checkdate($month,$day,$year) === false){
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
     * @return \DateTime
     */
    public static function get18()
    {
        return (new \DateTime(date('Y-m-d',strtotime('18 years ago'))));
    }

}