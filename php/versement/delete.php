<?php 

$datetab = array(
    "lundi" => "monday this week",
    "mardi" => "tuesday this week",
    "mercredi" => "wednesday this week",
    "jeudi" => "thursday this week",
    "vendredi" => "friday this week",
    "samedi" => "saturday this week",
    "dimanche" => "sunday this week"
);

$date = new DateTime();



foreach ($datetab as $key => $value) {
    $date->modify($value);
    echo $key.'  '.$date->format('Y-m-d');
    echo '<br>';
}
?>