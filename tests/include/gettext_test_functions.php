<?php

// Simulate helper function
if (!function_exists('log_message')) {
	function log_message($level, $message)
	{
		echo "\n\r" . $level . '|' . $message;
	}
}