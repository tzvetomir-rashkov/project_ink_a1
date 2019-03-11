<?php

spl_autoload_register(function ($class_name)
{

    $dir		 = dirname(__FILE__);
    $filename	 = $dir . DIRECTORY_SEPARATOR . "class/" . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
    include $filename;
});


$first	 = $_POST['datepickerFirst'];
$second	 = $_POST['datepickerSecond'];
$third	 = $_POST['datepickerThird'];

$inkCalculator = new InkCalculator(new Provider(), new Printer());

$inkCalculator->setInitialCharging($first);
$inkCalculator->setSecondCharging($second);
$inkCalculator->setThirdCharging($third);


$jsonData = $inkCalculator->runAndGetData();

echo json_encode($jsonData);
?>