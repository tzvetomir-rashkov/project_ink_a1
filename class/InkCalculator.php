<?php

class InkCalculator
{

    private $provider;
    private $printer;

    public function __construct(ProviderInterface $provider, PrinterInterface $printer)
    {
        $this->provider	 = $provider;
        $this->printer	 = $printer;
    }

    public function setInitialCharging($initialCharging)
    {
        $this->printer->setInitialCharging(htmlspecialchars($initialCharging));
    }

    public function setSecondCharging($secondCharging = null)
    {
        $providerDate = $this->provider->getProviderChangeDate();
        if(strtotime($secondCharging) > strtotime($providerDate)){
            $this->printer->setSecondCharging(null);
        } else {
            $this->printer->setSecondCharging(htmlspecialchars($secondCharging));
        }
    }

    public function setThirdCharging($thirdCharging = null)
    {
        $providerDate = $this->provider->getProviderChangeDate();
        if(strtotime($thirdCharging) < strtotime($providerDate)){
            $this->printer->setThirdCharging(null);
        } else {
            $this->printer->setThirdCharging(htmlspecialchars($thirdCharging));
        }
    }

    public function runAndGetData()
    {
        $inkDateByProvider	 = $this->calculateByDate();
        return $jsonData			 = [
            "initialCharging"	 => $this->printer->getInitialCharging(),
            "secondCharging"	 => $this->printer->getSecondCharging(),
            "thirdCharging"		 => $this->printer->getThirdCharging(),
            "bestBefore"		 => $inkDateByProvider['bestBefore'],
            "upTo"				 => $inkDateByProvider['upTo']
        ];
    }

    private function calculateByDate()
    {
        $secondCharging		 = strtotime($this->printer->getSecondCharging());
        $thirdCharging		 = strtotime($this->printer->getThirdCharging());
        $hasInk				 = $this->printer->hasInkInPrinter();
        $inkDateByProvider	 = [];

        if ($hasInk)
        {
            if ($secondCharging != null && $thirdCharging != null)
            {
                $inkDateByProvider = $this->provider->calculateProviderDates($this->printer->getSecondCharging());
            }
        }
        else
        {
            if ($secondCharging > $thirdCharging)
            {
                $inkDateByProvider = $this->provider->calculateProviderDates($this->printer->getSecondCharging());
            }
            else if ($secondCharging < $thirdCharging)
            {
                $inkDateByProvider = $this->provider->calculateProviderDates($this->printer->getThirdCharging());
            }
            else if ($secondCharging == null && $thirdCharging == null)
            {
                $inkDateByProvider = $this->provider->calculateProviderDates($this->printer->getInitialCharging());
            }
        }

        return $inkDateByProvider;
    }
}
