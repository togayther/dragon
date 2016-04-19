<?php

function convertDateStr($dateStr, $format = "Y/m/d"){
	return date($format,strtotime($dateStr));
} 