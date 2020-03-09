#!/usr/bin/php
<?php

include "conf.php";

if($argv[1])$debug = 1;

$flag_file = __DIR__."/minter-insurance-reward-calc-flag.txt";
$a = file_get_contents($f);

if($a || $debug)
{
$a = file_get_contents($cache_file);
$t = explode("\n",$a,2);
$blk = $t[0];
$a = json_decode($t[1],1);

//print_r($a);

	$out[blk] = $blk;
foreach($a[result][events] as $mas)
{
	extract($mas[value],EXTR_OVERWRITE);
	$amount = $amount/1000000000000000000;
//	print_r($mas);die;
	$k = $mas[type];
	$k = explode("/",$k);
	$k = $k[1];
	$out[$k][all] += $amount;

//	$out[$k][role][$role] += $amount;
	$out[$k][$role] += $amount;
	$out[$k][wals]++;
	$out[$k][val][validator_pub_key] += $amount;

	$out[$k][addr][$address] += $amount;

}

arsort($out[RewardEvent][addr]);
print_r($out);
$f = __FILE__.".json";
$txt = json_encode($out);
file_put_contents($f,$txt);

file_put_contents($flag_file,"");
}

?>