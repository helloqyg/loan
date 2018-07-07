<?php

function get_hall_area($hall_id){
	$hall_area = M('Hall')->field('area')->where(array('id'=>$hall_id))->find();
	if(empty($hall_area['area'])) return "";
	$hall_area = explode(',', $hall_area['area']);
	return $hall_area;
}