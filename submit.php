<?php
require_once "config.php";
//var_dump($_GET);

//Extracting TimeZone of Country to be converted
$query1=" select*from `timecon` where `country`='{$_GET['countryToConvert']}'";
$result1=$connection->query($query1);
$timeZoneToConvert=$result1->fetch_row();
//var_dump($timeZoneToConvert);

//Extracting TimeZone of Country Entered
$query1=" select*from `timecon` where `country`='{$_GET['countryEntered']}'";
$result1=$connection->query($query1);
$timeZoneEntered=$result1->fetch_row();
//var_dump($timeZoneEntered);

//Finding difference in terms of minutes
$timeToAdd = $timeZoneToConvert[1] - $timeZoneEntered[1];
$timeToAdd*=60;
//var_dump($timeToAdd);


if ($_GET['time']) {
    $time = explode(":", $_GET['time']);
    $hour = $time[0];
    $min = $time[1];
    $sec = $time[2];
    if ($sec>60 || $min>60 || $hour>24)
    {
        $error=2;
    }
    $timeEntered = ($time[0] * 60) + $time[1];
}



if ($_GET['countryEntered'] === "--Please Choose a Country--")
    $error2=1;

if ($_GET['countryToConvert'] === "--Please Choose a Country--")
    $error3 = 1;

if($_GET['time']!=0) {
    $timeFinal=$timeEntered+$timeToAdd;

    if ($timeFinal <0) {
        $timeFinal*=-1;
        $timeFinal=(24*60)-$timeFinal;
        $hour=intval($timeFinal/60);
        $min=$timeFinal%60;

        //Properly Displaying ot output time

        if($hour<10 || $min<10) {
            if($hour<10 && $min<10)
                $kush= 'Time in ' . $_GET['countryToConvert'] . ' is 0' . $hour . ':0' . $min . ':' . $sec.' , Previous Day';
            else if($hour<10)
                $kush= 'Time in ' . $_GET['countryToConvert'] . ' is 0' . $hour . ':' . $min . ':' . $sec.' , Previous Day';
            else
                $kush= 'Time in ' . $_GET['countryToConvert'] . ' is ' . $hour . ':0' . $min . ':' . $sec.' , Previous Day';
        }
        else
            $kush= 'Time in '.$_GET['countryToConvert'].' is '.$hour.':'.$min.':'.$sec.' , Previous Day';

    }

    else if ($timeFinal >(24*60)) {
        $timeFinal=$timeFinal-(24*60);
        $hour=intval($timeFinal/60);
        $min=$timeFinal%60;

        //Properly Displaying ot output time
        echo "Time in";
        if($hour<10 || $min<10) {
            if($hour<10 && $min<10)
                $kush= 'Time in ' . $_GET['countryToConvert'] . ' is 0' . $hour . ':0' . $min . ':' . $sec.' , Next Day';
            else if($hour<10)
                $kush= 'Time in ' . $_GET['countryToConvert'] . ' is 0' . $hour . ':' . $min . ':' . $sec.' , Next Day';
            else
                $kush= 'Time in ' . $_GET['countryToConvert'] . ' is ' . $hour . ':0' . $min . ':' . $sec.' , Next Day';
        }
        else
            $kush= ' '.$_GET['countryToConvert'].' is '.$hour.':'.$min.':'.$sec.' , Next Day';

    }

    else {
        $hour=intval($timeFinal/60);
        $min=$timeFinal%60;

        //Properly Displaying ot output time
        if($hour<10 || $min<10) {
            if($hour<10 && $min<10)
                $kush= 'Time in ' . $_GET['countryToConvert'] . ' is 0' . $hour . ':0' . $min . ':' . $sec;
            else if($hour<10)
                $kush= 'Time in ' . $_GET['countryToConvert'] . ' is 0' . $hour . ':' . $min . ':' . $sec;
            else
                $kush= 'Time in ' . $_GET['countryToConvert'] . ' is ' . $hour . ':0' . $min . ':' . $sec;
        }
        else
            $kush= 'Time in '.$_GET['countryToConvert'].' is '.$hour.':'.$min.':'.$sec;

    }

}



else{$error=1;
}

if(isset($error2) || isset($error3) || isset($error)){
    if(!isset($error2))
        $error2=0;
    if(!isset($error3))
        $error3=0;
    if(!isset($error))
        $error=0;

    $dump="index.php?error=".$error."&error2=".$error2."&error3=".$error3;
    header("Location: $dump");
}
//$currentTime=time();
//var_dump($currentTime);
//$date=date('d-m-y');
//var_dump($date);
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="submit.css">
    <title>Time Converter</title>
</head>
<body style="background-size:cover" background="bgimage.gif">
<h1 style="text-align: center">Time Coverter</h1>
<p class="disp"><?= $kush ?></p>
<p class="disp">Your time in <?= $_GET['countryEntered']?> is <?= $_GET['time'] ?></p>
<br>

<a class="link" href="index.php">
    <img src="Screen-Shot-2013-03-09-at-22.13.01-600x367.png" /
    >
</a>
</body>
</html>