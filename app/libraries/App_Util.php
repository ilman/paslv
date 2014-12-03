<?php 

class App_Util{

	public static function fileSuffix($file, $suffix, $path=''){
		if($file){
			$path_part = pathinfo($file);
			$file_name = SG_Util::val($path_part, 'filename');
			$file_ext  = SG_Util::val($path_part, 'extension');

			return $path.'/'.$file_name.'_'.$suffix.'.'.$file_ext;
		}
		else{
			return false;
		}
	}

	public static function getCompares($haystack, $needle, $return=true){
		if(strpos($haystack, $needle)!==false){
			return $return;
		}
	}

	public static function urlCompares($haystack, $needle, $wildcard=false){
		if(!$haystack){
			$haystack = Request::url();
		}

		$needle = sg_url($needle);

		if($wildcard){
			return self::getCompares($haystack, $needle);
		}

		return ($haystack == $needle);
	}

	public static function formatPrice($price){
		return number_format($price,0,',','.');
	}

	public static function validatePrice($price){
		return (int) preg_replace('/[(Rp). ,-]*/i','', $price);
	}

	public static function formatWeight($to_unit, $weight, $unit, $return=false){
		if(strtolower($to_unit)=='kg' && strtolower($unit)=='gram'){
			$weight = $weight/1000;	
		}
		
		if($return){
			return $weight;	
		}
		else{
			return $weight.' '.$to_unit;
		}
	}

	public static function imageFirst($images){		
		$primary_image = explode(', ', $images);
		
		return $primary_image[0]; 
	}

	public static function imageJoin($images){		
		$return_string = ($images) ? join(', ', $images) : '';
		
		return $return_string; 
	}

	public static function formatImageUrl($image, $size = 'thumb', $params=array()){
		extract((array)$params);

		$default_image = 'default_image.gif';

		if(isset($flag)){
			if($flag=='store'){
				$default_image = 'default_store.gif';
			}
			elseif($flag=='user'){
				$default_image = 'default_user.gif';
			}
			elseif($flag=='product'){
				$default_image = 'default_product.gif';
			}
		}
		
		$path = (isset($path)) ? $path : '';
		$default_path = 'assets/images/default';
		
		if(!$image){
			$path = $default_path;
			$image = $default_image;	
		}
		
		$image = self::fileSuffix($image, $size, $path);
		
		if(!file_exists(public_path().'/'.$image)){
			$image = self::fileSuffix($default_image, 'not_found_'.$size, $default_path);
		}
			
		return asset($image); 
	}

	public static function commissionCalc($aff_id, $row_price, $row_commission){
		if($aff_id){
			$commission = $row_commission;								
			//if aff_id doesnt set commission then commission is 5%
			if(!$row_commission){
				$commission = $row_price /100 *5;
				$commission = ceil($commission/500) * 500;
			}
		}
		else{
			$commission = 0;
		}
		return $commission;
	}


	public static function formatDateID($date, $format='tanggal-waktu')
	{
		$date = strtotime($date);
		
		$hari = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
		$hari_ke = date('N', $date);
		
		$tanggal = date('j', $date);
		
		$bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$bulan_ke = date('n',$date);
		
		$tahun = date('Y',$date);
		
		$jam = date('H:i:s',$date);
		
		if($format=='hari'){
			return $hari[$hari_ke-1].', '.$tanggal.' '.$bulan[$bulan_ke-1].' '.$tahun.' '.$jam;
		}
		elseif($format=='tanggal'){
			return $tanggal.' '.$bulan[$bulan_ke-1].' '.$tahun;
		}
		else{
			return $tanggal.' '.$bulan[$bulan_ke-1].' '.$tahun.' '.$jam;
		}	
	}

	public static function dateMonthID($month_id)
	{
		$month = array(
			1 => 'Januari',
			2 => 'Februari',
			3 => 'Maret',
			4 => 'April',
			5 => 'Mei',
			6 => 'Juni',
			7 => 'Juli',
			8 => 'Agustus',
			9 => 'September',
			10 => 'Oktober',
			11 => 'November',
			12 => 'Desember' 
		);

		$month_id = (int) $month_id;

		return $month[$month_id];
	}


	public static function timeDiff($date)
	{
		$difference = floor(abs(time()-$date)/60);
		
		if($difference > 60){
			$difference = floor($difference/60);
			
			if($difference > 24){
				$difference = floor($difference/24);
				
				return $difference.' hari lalu';		
			}
			else{
				return $difference.' jam lalu';
			}
		}
		else{
			return $difference.' menit lalu';
		}
	}



	public static function dateDiff($date)
	{
		$date = date(DATE_FORMAT, strtotime($date));
		$today = strtotime(date(DATE_FORMAT));
		
		$date_time = strtotime($date);
		
		$difference = floor(abs($today-$date_time)/60/60/24);
		
		if($difference == 0){
			return 'hari ini';
		}
		else{

			if($difference/30 < 1){
				$date_text = 'hari';
			}
			else{
				$difference = round($difference/30);

				if($difference/12 < 1){
					$date_text = 'bulan';
				}
				else{
					$difference = round($difference/12);

					$date_text = 'tahun';
				}
			}

			if($date_time > $today){
				$suffix = 'lagi';
			}
			else{
				$suffix = 'lalu';
			}

			return $difference.' '.$date_text.' '.$suffix;
		}
	}


	public static function numberRoman($num) 
	{
		// Make sure that we only use the integer portion of the value
		$n = intval($num);
		$result = '';
		
		// Declare a lookup array that we will use to traverse the number:
		$lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
		'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
		'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
		
		foreach ($lookup as $roman => $value){
			// Determine the number of matches
			$matches = intval($n / $value);
			
			// Store that many characters
			$result .= str_repeat($roman, $matches);
			
			// Substract that from the number
			$n = $n % $value;
		}
		
		// The Roman numeral should be built, return it
		return $result;
	}

	public static function cutString($str, $len, $suffix='&hellip;')
	{
		$str = trim($str);

		return (strlen($str) > $len) ? substr($str, 0, $len) . $suffix : $str;
	}

	public static function interpolateQuery($query, $params){
	    $keys = array();
	    $vals = array();

	    // build a regular expression for each parameter
	    foreach ($params as $key => $value) {
	        if (is_string($key)) {
	            $keys[] = '/:'.$key.'/';
	        } else {
	            $keys[] = '/[?]/';
	        }

	        if(is_string($value)) {
	        	$vals[] = "'".htmlspecialchars($value)."'";
	        }
	        else{
	        	$vals[] = $value;
	        }
	    }

	    $query = preg_replace($keys, $vals, $query, 1, $count);

	    // trigger_error('replaced '.$count.' keys');

	    return $query;
	}

	public static function arrayTotal($array=array()){
		$total = 0;

		foreach($array as $row){
			$total += (int) $row;
		}

		return $total;
	}

	public static function paginationText($result){
		$current_page = $result->current_page;
		$last_page = $result->last_page;
		$per_page = $result->per_page;
		$total = App_Util::formatPrice($result->total);

		$from = App_Util::formatPrice(($per_page * ($current_page - 1)) + 1);
		$to = App_Util::formatPrice($per_page * ($current_page));

		$output ="Menampilkan $from - $to dari total $total data";

		return $output;
	}

	public static function paginationLinks($result, $params=false, $base_url=false){
		$current_page = $result->current_page;
		$last_page = $result->last_page;
		$per_page = $result->per_page;
		$total = $result->total;

		$base_url = ($base_url) ? $base_url : Request::url();
		$params = ($params) ? $params : Input::all();
		unset($params['page']);
		$params = http_build_query($params);

		$output = '<ul class="pagination">';

		// goto prev link
		if($current_page>1){
			$param_page = 'page='.($current_page-1);
			$query = trim($param_page.'&'.$params, '&');
			$link = ($query) ? $base_url.'?'.$query : $base_url;
		}
		else{
			$link = false;
		}
		if($link){
			$output .= '<li><a href="'.$link.'">&laquo;</a></li>';
		}
		else{
			$output .= '<li class="disabled"><span>&laquo;</span></li>';
		}

		// goto page link
		$first_page = 1;
		$segment = 7;
		$segment_avg = floor($segment/2);

		if($last_page<=$segment){
			$segment_1 = $last_page;
			$segment_2 = 0;
			$segment_3 = 0;
		}
		else{

			$segment_1_0 = $first_page-1+$current_page-1;
			$segment_3_0 = $last_page+1-$current_page-1;

			if($segment_1_0<$segment_avg){
				$segment_1 = $segment_avg + $segment_1_0;
				$segment_2 = 0;
				$segment_3 = $segment_avg - $segment_1_0;
			}
			elseif($segment_3_0<$segment_avg){
				$segment_1 = $segment_avg - $segment_3_0;
				$segment_2 = 0;
				$segment_3 = $segment_avg + $segment_3_0;
			}
			else{
				$segment_1 = 1;
				$segment_2 = $segment_avg;
				$segment_3 = 1;
			}

		}

		if($segment_1){
			for($i=$first_page; $i<$first_page+$segment_1; $i++){
				$param_page = ($i>1) ? 'page='.$i : '';
				$query = trim($param_page.'&'.$params, '&');
				$link = ($query) ? $base_url.'?'.$query : $base_url;
				$li_class = ($i==$current_page) ? ' class="active"' : '';
				$output .= '<li'.$li_class.'><a href="'.$link.'">'.$i.'</a></li>';
				$segment -= 1;
			}
			if($segment_3){
				$output .= '<li><span>&hellip;</span></li>';
			}
		}

		if($segment_2){
			for($i=$current_page-1; $i<$current_page+$segment_2-1; $i++){
				$param_page = 'page='.$i;
				$query = trim($param_page.'&'.$params, '&');
				$link = ($query) ? $base_url.'?'.$query : $base_url;
				$li_class = ($i==$current_page) ? ' class="active"' : '';
				$output .= '<li'.$li_class.'><a href="'.$link.'">'.$i.'</a></li>';
				$segment -= 1;
			}
			if($segment_3){
				$output .= '<li><span>&hellip;</span></li>';
			}
		}

		if($segment_3){
			for($i=$last_page-$segment_3+1; $i<=$last_page; $i++){
				$param_page = 'page='.$i;
				$query = trim($param_page.'&'.$params, '&');
				$link = ($query) ? $base_url.'?'.$query : $base_url;
				$li_class = ($i==$current_page) ? ' class="active"' : '';
				$output .= '<li'.$li_class.'><a href="'.$link.'">'.$i.'</a></li>';
				$segment -= 1;
			}
		}


		// goto next link
		if($current_page<$last_page){
			$param_page = 'page='.($current_page+1);
			$query = trim($param_page.'&'.$params, '&');
			$link = ($query) ? $base_url.'?'.$query : $base_url;
		}
		else{
			$link = false;
		}

		if($link){
			$output .= '<li><a href="'.$link.'">&raquo;</a></li>';
		}
		else{
			$output .= '<li class="disabled"><span>&raquo;</span></li>';
		}	

		$output .= '</ul>';

		return $output;
	}
}