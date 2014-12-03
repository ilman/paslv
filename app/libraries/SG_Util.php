<?php 

class SG_Util{

	static function val($var, $field_name=null, $default=null){
		if($field_name===null){ return $var; }
		
		$value = '';
		
		if(is_array($var)){			
			if(isset($var[$field_name])){ $value = $var[$field_name]; }
			else{ return $default; }
		}
		elseif(is_object($var)){
			if(isset($var->$field_name)){ $value = $var->$field_name; }
			else{ return $default; }
		}
		else{
			$value = $var;
		}
		
		return ($value!==null) ? $value : $default;
	}

	static function esc($var, $field_name=null, $default=null){
		$value = self::val($var, $field_name, $default);

		return htmlspecialchars($value);
	}

	static function un_set($var, $field_name=''){
		if(is_array($var)){
			unset($var[$field_name]);
		}
		elseif(is_object($var)){
			unset($var->$field_name);
		}
		return $var;
	}

	static function slug($str, $sep='-'){
		$str = strtolower(trim($str));
		$str = preg_replace('/[^a-z0-9'.$sep.']/', $sep, $str);
		$str = preg_replace('/'.$sep.'+/', $sep, $str);
		$str = trim($str, $sep);
		
		return $str;
	}

	static function inline_attr($attr=array()){
		$inline_attr = '';
		$allowed_attr = array('class','type','value','name','placeholder','readonly','disabled','rel','id','style','selected','checked','rows','tabindex');

		if(!is_array($attr) && !is_object($attr)){ return false; }
					
		foreach($attr as $key => $val){
			if(in_array($key, $allowed_attr) || strpos($key,'data-')===0){
				$inline_attr .= $key.'="'.htmlspecialchars($val).'" ';
			}
		}
		
		return $inline_attr;	
	}

	static function event_attr($attr=array()){
		$inline_attr = '';
		$allowed_attr = array('onchange','onclick','onkeyup','onload');
		
		if(is_array($attr)){		
			foreach($attr as $key => $val){					
				if(in_array($key, $allowed_attr)){
					$inline_attr .= $key.'="'.htmlspecialchars($val).'" ';
				}
			}
		}
					
		return $inline_attr;	
	}

	static function content($path){
		ob_start();
		include($path);
		return ob_get_clean();
	}

	static function array_linear($params,$child_key='fields'){			
		if(!is_array($params)){
			return false;	
		}

		$array_linear = array();
		
		foreach($params as $param){
			$param_child = sg_util::val($param, $child_key);				

			if($param_child){
				$param[$child_key] = array();
				$array_linear[] = $param;
				$array_linear = array_merge($array_linear,self::array_linear($param_child, $child_key));
			}
			else{
				$array_linear[] = $param;
			}
		}
		
		return $array_linear;
	}


	static function arrayMapOption($array,$label_key='label',$value_key='value', $selected=null){			
		if(!is_array($array) && !is_object($array)){
			return false;
		}

		$new_array = array();
		
		$i=0; 
		foreach($array as $row){
			$temp_label = '';

			if(is_array($label_key)){
				foreach($label_key as $label){
					$temp_label .= SG_Util::val($row,$label).' ';
				}
			}
			else{
				$temp_label = SG_Util::val($row,$label_key);
			}

			$new_array[$i] = array(
				'label' => $temp_label,
				'value' => SG_Util::val($row,$value_key)
			);

			if($selected){
				foreach($selected as $key=>$val){
					if(SG_Util::val($row,$key)===$val){
						$new_array[$i]['selected'] = true;
					}
				}
			}
			$i++;
		}
		
		return $new_array;
	}
}