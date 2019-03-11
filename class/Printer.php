<?php

class Printer implements PrinterInterface
{

    private $initialCharging;
    private $secondCharging;
    private $thirdCharging;

    public function setInitialCharging($initialCharging)
    {
        $this->initialCharging = $initialCharging;
    }

    public function getInitialCharging()
    {
        return $this->initialCharging;
    }

    public function setSecondCharging($secondCharging)
    {
        $this->secondCharging = $secondCharging;
    }

    public function getSecondCharging()
    {
        return $this->secondCharging;
    }

    public function setThirdCharging($thirdCharging)
    {
        $this->thirdCharging = $thirdCharging;
    }

    public function getThirdCharging()
    {
        return $this->thirdCharging;
    }

    public function hasInkInPrinter()
    {
        if ($this->secondCharging == null || $this->thirdCharging == null)
        {
            return false;
        }

        $date1	 = date_create($this->secondCharging);
        $date2	 = date_create($this->thirdCharging);

        $diff = date_diff($date1, $date2);

        // 10.04.2019-10.05.2019 - has ink if diff <= 1 month
        if ($diff->m == 1 && $diff->y == 0)
        {
            return true;
        }

        return false;
    }

}
