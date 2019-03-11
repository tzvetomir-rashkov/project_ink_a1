<?php

class Provider implements ProviderInterface
{

    const firstProviderBestMonth	 = 12;
    const firstProviderUpToMonth	 = 13;
    const secondProviderBestDays	 = 90;
    const secondProviderUpToDays	 = 396;
    const newProviderDate			 = "27.04.2019";

    public function getProviderChangeDate()
    {
        return self::newProviderDate;
    }

    public function calculateProviderDates($date)
    {
        if (strtotime($date) <= strtotime(self::newProviderDate))
        {
            $dateBestBefore	 = strtotime("+" . self::firstProviderBestMonth . " months", strtotime($date));
            $dateUpTo		 = strtotime("+" . self::firstProviderUpToMonth . " months", strtotime($date));
        }
        else
        {
            $dateBestBefore	 = strtotime("+" . self::secondProviderBestDays . " days", strtotime($date));
            $dateUpTo		 = strtotime("+" . self::secondProviderUpToDays . " days", strtotime($date));
        }

        return [
            "bestBefore" => date("d.m.Y", $dateBestBefore),
            "upTo"		 => date("d.m.Y", $dateUpTo)
        ];
    }

}
