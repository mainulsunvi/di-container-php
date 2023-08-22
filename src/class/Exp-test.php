<?php

namespace Inc\Class;

class Exp_Test {

	function printExplode() {
		$str = "facilisis volutpat est velit egestas dui id ornare arcu odio";
		$words = explode(" ", $str);

		echo "\n";
		print_r($words);
	}
}