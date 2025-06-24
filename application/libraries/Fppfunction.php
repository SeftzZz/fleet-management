<<<<<<< HEAD
<?php
class Fppfunction {

    /* function Fppfunction() {
        $this->obj =& get_instance();                  
    } */
	
	function __construct() {
        $this->ci = & get_instance();
    } 
        
    // potong kalimat per kata
	function limitWord($string, $word_limit) {
        $words = explode(" ", $string);
        return implode(" ", array_splice($words, 0, $word_limit));
    }
	
	
	function randompassword($len)
    {
    $pass = '';
    $lchar = 0;
    $char = 0;
    for($i = 0; $i < $len; $i++)
    {
        while($char == $lchar)
        {
         $char = rand(48, 109);
         if($char > 57) $char += 7;
         if($char > 90) $char += 6;
        }
        $pass .= chr($char);
        $lchar = $char;
    }
    return $pass;
    }
    
    function getRomeMonth($m) {
    switch($m) {
        case "01": return "I";break;
        case "02": return "II";break;
        case "03": return "III";break;
        case "04": return "IV";break;
        case "05": return "V";break;
        case "06": return "VI";break;
        case "07": return "VII";break;
        case "08": return "VIII";break;
        case "09": return "IX";break;
        case "10": return "X";break;
        case "11": return "XI";break;
        case "12": return "XII";break;
    }
    }

    function getMonthName($m) {
    switch($m) {
        case "1": return "January";break;
        case "2": return "February";break;
        case "3": return "March";break;
        case "4": return "April";break;
        case "5": return "May";break;
        case "6": return "June";break;
        case "7": return "July";break;
        case "8": return "August";break;
        case "9": return "September";break;
        case "10": return "October";break;
        case "11": return "November";break;
        case "12": return "December";break;
    }
    }
    
    function countdim($array)
    {
       if (is_array(reset($array))) 
         $return = $this->countdim(reset($array)) + 1;
       else
         $return = 1;
     
       return $return;
    }
	
	function tgl_indo_eng($dt) {
        $MONTH_NAME    = array("January","February","March","April","May","June","July","August",
                                "September","October","November","December");
        $date = '';
        
        if ($dt!='') {
            $tmp =  explode(" ", $dt);
            $date = explode("-", $tmp[0]);
            $date = $date[2] . " " . $MONTH_NAME[intval($date[1])-1] . " " . $date[0];            
        }

        return $date;            
    }

    function blnthn_indo_eng($dt) {
        $MONTH_NAME    = array("January","February","March","April","May","June","July","August",
                                "September","October","November","December");
        $date = '';
        
        if ($dt!='') {
            $tmp =  explode(" ", $dt);
            $date = explode("-", $tmp[0]);
            $date = $MONTH_NAME[intval($date[1])-1] . " " . $date[0];            
        }

        return $date;            
    }
	
    function haritgl_ind($date) {
        // array hari bulan tahun
        $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $Bulan = array("Januari","Februari","Maret","April","Mei","Juni",
                       "Juli","Agustus","September","Oktober","November","Desember");
        
        // pemisahan tahun, bulan, hari
        $tahun = substr($date,0,4);
        $bulan = substr($date,5,2);
        $tgl = substr($date,8,2);
        $hari = date("w",strtotime($date));
        $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun;
        return $result;
    }

    function tglblnthn_ind($date) {
        // array bulan tahun
        $Bulan = array("Januari","Februari","Maret","April","Mei","Juni",
                       "Juli","Agustus","September","Oktober","November","Desember");
        
        // pemisahan tahun, bulan, hari
        $tahun = substr($date,0,4);
        $bulan = substr($date,5,2);
        $tgl = substr($date,8,2);
        $hari = date("w",strtotime($date));
        $result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun;
        return $result;
    }

    function haritgljam_ind($date) { 
        // array hari bulan tahun jam
        $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $Bulan = array("Januari","Februari","Maret","April","Mei","Juni",
                       "Juli","Agustus","September","Oktober","November","Desember");
        
        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date,0,4);
        $bulan = substr($date,5,2);
        $tgl = substr($date,8,2);
        $waktu = substr($date,11,5);
        $hari = date("w",strtotime($date));
        $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." - ".$waktu." "."WIB";
        return $result;
    }

	function tglangka_ind($dt) {
        $MONTH_NAME    = array("01","02","03","04","05","06","07","08",
                                "09","10","11","12");
        $date = '';
        
        if ($dt!='') {
            $tmp =  explode(" ", $dt);
            $date = explode("-", $tmp[0]);
            $date = $date[2] . "-" . $MONTH_NAME[intval($date[1])-1] . "-" . $date[0];            
        }

        return $date;            
    }

    function tglangkajam_ind($date) { 
        // array hari bulan tahun jam
        $Bulan = array("01","02","03","04","05","06",
                       "07","08","09","10","11","12");
        
        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date,2,2);
        $bulan = substr($date,5,2);
        $tgl = substr($date,8,2);
        $waktu = substr($date,11,5);
        $hari = date("w",strtotime($date));
        $result = $tgl."/".$Bulan[(int)$bulan-1]."/".$tahun." - ".$waktu;
        return $result;
    }
	
	function remove_first_paragraph($desc='') {
		$new_desc = $desc;
		
		$tmp = substr($desc,0,3);
		if ($tmp=='<p>') {
			$new_desc = substr($desc,3,strlen($desc)-7);
		}
		
		return $new_desc;
	}

    function rupiah_ind($angka) {
        $rupiah = "Rp " . number_format($angka,0,',','.');
        
        return $rupiah;
    }

    function rupiah_ind2($angka) {
        $rupiah = number_format($angka,0,',','.');
        
        return $rupiah;
    }
}
?>
=======
<?php
class Fppfunction {

    /* function Fppfunction() {
        $this->obj =& get_instance();                  
    } */
	
	function __construct() {
        $this->ci = & get_instance();
    } 
        
    // potong kalimat per kata
	function limitWord($string, $word_limit) {
        $words = explode(" ", $string);
        return implode(" ", array_splice($words, 0, $word_limit));
    }
	
	
	function randompassword($len)
    {
    $pass = '';
    $lchar = 0;
    $char = 0;
    for($i = 0; $i < $len; $i++)
    {
        while($char == $lchar)
        {
         $char = rand(48, 109);
         if($char > 57) $char += 7;
         if($char > 90) $char += 6;
        }
        $pass .= chr($char);
        $lchar = $char;
    }
    return $pass;
    }
    
    function getRomeMonth($m) {
    switch($m) {
        case "01": return "I";break;
        case "02": return "II";break;
        case "03": return "III";break;
        case "04": return "IV";break;
        case "05": return "V";break;
        case "06": return "VI";break;
        case "07": return "VII";break;
        case "08": return "VIII";break;
        case "09": return "IX";break;
        case "10": return "X";break;
        case "11": return "XI";break;
        case "12": return "XII";break;
    }
    }

    function getMonthName($m) {
    switch($m) {
        case "1": return "January";break;
        case "2": return "February";break;
        case "3": return "March";break;
        case "4": return "April";break;
        case "5": return "May";break;
        case "6": return "June";break;
        case "7": return "July";break;
        case "8": return "August";break;
        case "9": return "September";break;
        case "10": return "October";break;
        case "11": return "November";break;
        case "12": return "December";break;
    }
    }
    
    function countdim($array)
    {
       if (is_array(reset($array))) 
         $return = $this->countdim(reset($array)) + 1;
       else
         $return = 1;
     
       return $return;
    }
	
	function tgl_indo_eng($dt) {
        $MONTH_NAME    = array("January","February","March","April","May","June","July","August",
                                "September","October","November","December");
        $date = '';
        
        if ($dt!='') {
            $tmp =  explode(" ", $dt);
            $date = explode("-", $tmp[0]);
            $date = $date[2] . " " . $MONTH_NAME[intval($date[1])-1] . " " . $date[0];            
        }

        return $date;            
    }

    function blnthn_indo_eng($dt) {
        $MONTH_NAME    = array("January","February","March","April","May","June","July","August",
                                "September","October","November","December");
        $date = '';
        
        if ($dt!='') {
            $tmp =  explode(" ", $dt);
            $date = explode("-", $tmp[0]);
            $date = $MONTH_NAME[intval($date[1])-1] . " " . $date[0];            
        }

        return $date;            
    }
	
    function haritgl_ind($date) {
        // array hari bulan tahun
        $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $Bulan = array("Januari","Februari","Maret","April","Mei","Juni",
                       "Juli","Agustus","September","Oktober","November","Desember");
        
        // pemisahan tahun, bulan, hari
        $tahun = substr($date,0,4);
        $bulan = substr($date,5,2);
        $tgl = substr($date,8,2);
        $hari = date("w",strtotime($date));
        $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun;
        return $result;
    }

    function tglblnthn_ind($date) {
        // array bulan tahun
        $Bulan = array("Januari","Februari","Maret","April","Mei","Juni",
                       "Juli","Agustus","September","Oktober","November","Desember");
        
        // pemisahan tahun, bulan, hari
        $tahun = substr($date,0,4);
        $bulan = substr($date,5,2);
        $tgl = substr($date,8,2);
        $hari = date("w",strtotime($date));
        $result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun;
        return $result;
    }

    function haritgljam_ind($date) { 
        // array hari bulan tahun jam
        $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $Bulan = array("Januari","Februari","Maret","April","Mei","Juni",
                       "Juli","Agustus","September","Oktober","November","Desember");
        
        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date,0,4);
        $bulan = substr($date,5,2);
        $tgl = substr($date,8,2);
        $waktu = substr($date,11,5);
        $hari = date("w",strtotime($date));
        $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." - ".$waktu." "."WIB";
        return $result;
    }

	function tglangka_ind($dt) {
        $MONTH_NAME    = array("01","02","03","04","05","06","07","08",
                                "09","10","11","12");
        $date = '';
        
        if ($dt!='') {
            $tmp =  explode(" ", $dt);
            $date = explode("-", $tmp[0]);
            $date = $date[2] . "-" . $MONTH_NAME[intval($date[1])-1] . "-" . $date[0];            
        }

        return $date;            
    }

    function tglangkajam_ind($date) { 
        // array hari bulan tahun jam
        $Bulan = array("01","02","03","04","05","06",
                       "07","08","09","10","11","12");
        
        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date,2,2);
        $bulan = substr($date,5,2);
        $tgl = substr($date,8,2);
        $waktu = substr($date,11,5);
        $hari = date("w",strtotime($date));
        $result = $tgl."/".$Bulan[(int)$bulan-1]."/".$tahun." - ".$waktu;
        return $result;
    }
	
	function remove_first_paragraph($desc='') {
		$new_desc = $desc;
		
		$tmp = substr($desc,0,3);
		if ($tmp=='<p>') {
			$new_desc = substr($desc,3,strlen($desc)-7);
		}
		
		return $new_desc;
	}

    function rupiah_ind($angka) {
        $rupiah = "Rp " . number_format($angka,0,',','.');
        
        return $rupiah;
    }

    function rupiah_ind2($angka) {
        $rupiah = number_format($angka,0,',','.');
        
        return $rupiah;
    }
}
?>
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
