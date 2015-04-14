<?php
require_once "config.php";
$query=" select*from `timecon` ";

$result=$connection->query($query);
$country_list=$result->fetch_all(MYSQLI_ASSOC);
?>



<!DOCTYPE html>
<html>
<body style="background-size: cover" background="bgimage.gif">
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" type="text/css" href="submit.css">
    <title>Time Converter</title>
</head>


<body>
<h1 style="text-align: center">Time Converter</h1>



<div class="form" role="form">
    <form action="submit.php" method="get">


        <div class="form-group">
        <label for="countryEntered">Please Select The Country Of Known Time:</label>
            <?php  if($_GET) {
                if ($_GET['error2'] == 1) {
                    echo '<span style="color: red">*Please Select A Country</span>';
                }
            }
            ?>
        <select  class="form-control" name="countryEntered" id="countryEntered">
            <?php
            foreach($country_list as $country_db) {

                ?>
                <option> <?= $country_db["country"] ?> </option>
            <?php } ?>
        </select>
        </div>

        <div class="form-group">
        <label for="countryToConvert">Please Select The Country Of Unknown Time:</label>
            <?php  if($_GET) {
                if ($_GET['error3'] == 1) {
                    echo '<span style="color: red">*Please Select A Country</span>';
                }
            }
            ?>
        <select  class="form-control" name="countryToConvert" id="countryToConvert">
            <?php
            foreach($country_list as $country_db) {

                ?>
                <option> <?= $country_db["country"] ?> </option>
            <?php }

            ?>
        </select>
        </div>

        <div class="form-group">
        <label for="time">Enter Time:</label>
        <input id="time" type="text" name="time" placeholder="Enter Time as HH:MM:SS"/>
            <?php if($_GET) {
                if ($_GET['error'] == 1) {
                    echo '<span style="color: red">*Please Enter Time In Correct Format</span>';
                }
                if ($_GET['error'] == 2) {
                    echo '<span style="color: red">*Please Enter Possible Values</span>';
                }
            }
            ?>
        </div>


        <button type="submit" class="btn btn-default">Submit</button>


    </form>
</div>


</div>
<div>
    <p class="footer">About Us | Contact Us | Policy | Terms of Service</p>
</div>
</body>
</html>