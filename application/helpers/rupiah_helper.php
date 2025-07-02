<?php  
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	function rupiah($nilai, $pecahan = 0){
		return number_format($nilai, $pecahan, ',', '.');
	}	