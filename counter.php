<?php
session_start();
if (isset($_SESSION['targetdate'])) {
    // session variable_exists, use that
    $targetDate = $_SESSION['targetdate'];
} else {
    // No session variable, red from mysql
    $result=mysql_query("select * from test where testid='29' LIMIT 1");
    $time=mysql_fetch_array($result);
    $dateFormat = "d F Y -- g:i a";
    $targetDate = time() + ($time['duration']*60);
    $_SESSION['targetdate'] = $targetDate;
}

$actualDate = time();
$secondsDiff = $targetDate - $actualDate;
$remainingDay     = floor($secondsDiff/60/60/24);
$remainingHour    = floor(($secondsDiff-($remainingDay*60*60*24))/60/60);
$remainingMinutes = floor(($secondsDiff-($remainingDay*60*60*24)-         ($remainingHour*60*60))/60);
$remainingSeconds = floor(($secondsDiff-($remainingDay*60*60*24)-    ($remainingHour*60*60))-($remainingMinutes*60));
$actualDateDisplay = date($dateFormat,$actualDate);
$targetDateDisplay = date($dateFormat,$targetDate);

?>

