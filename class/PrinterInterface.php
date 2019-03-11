<?php

interface PrinterInterface
{

    public function setInitialCharging($initialCharging);

    public function getInitialCharging();

    public function setSecondCharging($secondCharging);

    public function getSecondCharging();

    public function setThirdCharging($thirdCharging);

    public function getThirdCharging();

    public function hasInkInPrinter();
}
