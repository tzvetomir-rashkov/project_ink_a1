<?php

interface ProviderInterface
{

    public function getProviderChangeDate();

    public function calculateProviderDates($date);
}
