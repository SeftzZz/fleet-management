<?php
class Fppfunction {

    function Fppfunctions() {
        $this->obj =& get_instance();                  
    }
        
    // potong kalimat per kata
	function limitWord($string, $word_limit) {
        $words = explode(" ", $string);
        return implode(" ", array_splice($words, 0, $word_limit));
    }

    function format_angka($angka) {
        if ($angka > 1) {
            $hasil =  number_format($angka,0, ",",".");
        }
        else {
            $hasil = 0; 
        }
        return $hasil;
    }
	
    function format_tgl1($parameter){
               $tanggal = substr($parameter,8,2);
               $bln_angka = substr($parameter,5,2);
               switch ($bln_angka){
                   case 1:
                       $bln_angka = "Jan";
                       break;
                   case 2:
                       $bln_angka = "Feb";
                       break;
                    case 3:
                       $bln_angka = "Mar";
                       break;
                    case 4:
                       $bln_angka = "Apr";
                       break;
                    case 5:
                       $bln_angka = "Mei";
                       break;
                    case 6:
                       $bln_angka = "Jun";
                       break;
                    case 7:
                       $bln_angka = "Jul";
                       break;
                    case 8:
                       $bln_angka = "Aug";
                       break;
                    case 9:
                       $bln_angka = "Sep";
                       break;
                    case 10:
                       $bln_angka = "Okt";
                       break;
                    case 11:
                       $bln_angka = "Nov";
                       break;
                    case 12:
                       $bln_angka = "Des";
                       break;
               }
            $tahun = substr($parameter,0,4);
            return $tanggal.' '.$bln_angka.' '.$tahun;
    }
    function format_tgl2($parameter){
             $tanggal = substr($parameter,8,2);
             $bln_angka = substr($parameter,5,2);
             $tahun = substr($parameter,0,4);
             return $tanggal.'/'.$bln_angka.'/'.$tahun;
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
           
    
    
    function formatFullDTfromMysql($dt) {
        $MONTH_NAME    = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus",
                                "September","Oktober","November","Desember");
        $date = '';
        
        if ($dt!='') {
            $tmp =  explode(" ", $dt);
            $date = explode("-", $tmp[0]);
            $date = $date[2] . " " . $MONTH_NAME[intval($date[1])-1] . " " . $date[0];            
        }

        return $date;            
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

    function tgltime_indo_eng($dt) {
        $MONTH_NAME    = array("January","February","March","April","May","June","July","August",
                                "September","October","November","December");
        $date = '';
        
        if ($dt!='') {
            $tmp =  explode(" ", $dt);
            $date = explode("-", $tmp[0]);
            $date = $date[2] . " " . $MONTH_NAME[intval($date[1])-1] . " " . $date[0]." - ".$tmp[1];            
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
	
	function tgl_indo_angka($dt) {
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
	
	function formatFullDTAngkaterbalikfromMysql($dt) {
        $MONTH_NAME    = array("01","02","03","04","05","06","07","08",
                                "09","10","11","12");
        $date = '';
        
        if ($dt!='') {
            $tmp =  explode(" ", $dt);
            $date = explode("-", $tmp[0]);
            $date = $date[0] . "-" . $MONTH_NAME[intval($date[1])-1] . "-" . $date[2];            
        }

        return $date;            
    }
	
	function formatFullDTtandaikutsertafromMysql($dt) {
        $MONTH_NAME    = array("I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII");
        $date = '';
        
        if ($dt!='') {
            $tmp =  explode(" ", $dt);
            $date = explode("-", $tmp[0]);
            $date = $MONTH_NAME[intval($date[1])-1] . "/" . $date[0];            
        }

        return $date;            
    }
    
    function formatFullDTTimefromMysql($dt) {
        $MONTH_NAME    = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus",
                                "September","Oktober","November","Desember");
        $date = '';
        
        if ($dt!='') {
            $tmp =  explode(" ", $dt);
            $date = explode("-", $tmp[0]);
            $date = $date[2] . " " . $MONTH_NAME[intval($date[1])-1] . " " . $date[0]." - ".$tmp[1];            
        }

        return $date;            
    }
	
	function remove_first_paragraph($desc='') {
		$new_desc = $desc;
		
		$tmp = substr($desc,0,3);
		if ($tmp=='<p>') {
			$new_desc = substr($desc,3,strlen($desc)-7);
		}
		
		return $new_desc;
	}
    
    
    function left_substr($str, $length) {
        return ;       
    }
    
    function getMonthIdFromIndonesianMonthName($monthName)
    {
        $rtn = 0;
        switch(strtolower($monthName))
        {
            case "januari" : $rtn = 1; break;
            case "februari" : $rtn = 2; break;
            case "maret" : $rtn = 3; break;
            case "april" : $rtn = 4; break;
            case "mei" : $rtn = 5; break;
            case "juni" : $rtn = 6; break;
            case "juli" : $rtn = 7; break;
            case "agustus" : $rtn = 8; break;
            case "september" : $rtn = 9; break;
            case "oktober" : $rtn = 10; break;
            case "november" : $rtn = 11; break;
            case "desember" : $rtn = 12; break;        
        }
        
        return $rtn;        
    }
    
    function getIndonesianMonthNameFromMonthId($monthId)
    {
        $rtn = "";
        
        switch((int)$monthId) {
            case 1: $rtn = "Januari"; break;
            case 2: $rtn = "Februari"; break;
            case 3: $rtn = "Maret"; break;
            case 4: $rtn = "April"; break;
            case 5: $rtn = "Mei"; break; 
            case 6: $rtn = "Juni"; break;
            case 7: $rtn = "Juli"; break;
            case 8: $rtn = "Agustus"; break;
            case 9: $rtn = "September"; break;
            case 10: $rtn = "Oktober"; break;
            case 11: $rtn = "November"; break;
            case 12: $rtn = "Desember"; break;
        }
        
        return $rtn;
    }


	
	var $tingkatpendidikan = array("D3","S1","S2","S3");
	var $yatidak = array("Ya","Tidak");
	var $jeniskelamin = array("Laki-Laki","Perempuan");
	var $tanggal = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31");
	var $bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	var $bulanangka = array("01","02","03","04","05","06","07","08","09","10","11","12");
	var $hari = array("Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Minggu");
	var $status = array("Aktif","Tidak Aktif");
}
?>
