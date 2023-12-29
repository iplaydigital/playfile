<?
	//// Datetime ///////////////////////////////
	function DateThai($strDate){
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate))-1;
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}
	//$today  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
	$strDate = date("Y-m-d H:i:s");
	$date_now = DateThai($strDate);
	///////////////////////////////////////////
	
	function microtime_float()
	{
		list($msec, $sec) = explode(" ", microtime());
		return ((float)$msec + (float)$sec);
	}
?>

	
	
