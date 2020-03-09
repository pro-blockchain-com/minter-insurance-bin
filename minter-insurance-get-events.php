#!/usr/bin/php
<?php


include "conf.php";

$url = $nodeUrl."/status";
$a = file_get_contents($url);
$a = json_decode($a,1);
//print_r($a);

$blk = $a[result][latest_block_height];
print "blk = $blk\n";
$t = $blk/120;
$t = floor($t);
$t *= 120;

print "t = $t\n";

$b = file_get_contents($cache_file);
$t2 = explode("\n",$b,2);
if($t != $t2[0])
{

$url = $nodeUrl."/events?height=$t";
$b = file_get_contents($url);
$a = json_decode($b,1);

if(count($a[result][events]))
{
$txt = "$t\n";
$txt .= $b;
//$cache_file = __DIR__."/last_info.txt";
file_put_contents($cache_file,$txt);
$f = __DIR__."/minter-insurance-reward-calc-flag.txt";
file_put_contents($f,1);
}

}
else
{
$b = $t2[1];
$a = json_decode($b,1);
print "file exists\n";

}

//print_r($a);



?>