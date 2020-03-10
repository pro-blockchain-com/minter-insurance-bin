#!/usr/bin/php
<?php

include "conf.php";

$a = __DIR__."/minter-insurance-get-candidates-stake.php.cache";
$a = file_get_contents($a);
$a = json_decode($a,1);
//print_r($a);

foreach($a[result] as $v2)
{
	$status = $v2[status];
	$out[validator][$status][$v2[pub_key]] = $v2[total_stake]/$pip_devider;

	foreach($v2[stakes] as $v3)
	{
		$amount = $v3[bip_value]/$pip_devider;
		$out[address][$v3[owner]][all] += $amount;
		$out[address][$v3[owner]][status][$status] += $amount;

		$out[address][$v3[owner]][validators][$v2[pub_key]] += $amount;
	}
}
//print_r($out);
$txt = json_encode($out);
$file = __DIR__."/address_info.json";
file_put_contents($file,$txt);
?>