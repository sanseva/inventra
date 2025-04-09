<?php  if ( ! defined('BASEPATH')) exit('$currency direct script access allowed');


if ( ! function_exists('makeSafe'))
{
function makeSafe($string){
		$string=str_replace("'","",$string);
		$string=str_replace("\\","",$string);
		$string=str_replace("//","",$string);
		//$string=str_replace("-","",$string);
		$string=str_replace(")","",$string);
		$string=str_replace("(","",$string);
		$string=str_replace("0x27","",$string);
		$string=str_replace("0x7e","",$string);
		$string=str_replace("information_schema","",$string);
		
		
		$string=(get_magic_quotes_gpc() ? stripslashes($string) : $string);
		
			
			return ($string);
		
	}
}
function RenameUploadFile($data) {
		$search = array("'"," ","(",")","&","-","\"","\\","?",":","/");
		$replace = array("","_","","","","","","","","","","");
		$new_data=str_replace($search, $replace, $data);
		$new_data=str_replace($search, $replace, $data);
		return strtolower(date("YmdHis")."_".$new_data);
	}
function temp_id()
{
	$day = date('d', time());
	$month = date('m', time());
	$year = date('y', time());
	$hour = date('H', time());
	$min = date('i', time());
	$sec = date('s', time());
	return $year.$month.$day.$hour.$min.$sec;
	
	
}
/* function date_mysql_format($date)
{
	$list=explode('/',$date);
	return $list[2]."-".$list[1].'-'.$list[0];
} */
/**
 * Mysql to user format
 * @param date $date
 */

/*function date_mysql_user($date)
{
	$list=explode('-',$date);
	return $list[2]."/".$list[1].'/'.$list[0];
}*/

/**
 * 
 * Converts exp date to mysql date format from mm/yyyy format
 * @param date $exp_date
 */
function exp_dat($exp_date)
{
	$list=explode('/',$exp_date);
	return $list[1]."-".$list[0].'-01';
}

//this will convert mysql date to expiry date
function mysql_to_exp_dat($exp_date)
{
	$list=explode('-',$exp_date);
	return $list[1]."/".$list[0];
}
function jtable_message($message)
{
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $message;
	print json_encode ($jTableResult);
	
}

function convert_number_to_words($number) {

    $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
          
  return $result. " Only";// . "Rupees  " . $points . " Paise";
  
}
	function permission($module_name,$permission_for){
	if($permission_for=='view' && substr($module_name,0,1)==1) return ' checked=true ';
	if($permission_for=='add' && substr($module_name,1,1)==1) return ' checked=true ';
	if($permission_for=='edit' && substr($module_name,2,1)==1) return ' checked=true ';
	if($permission_for=='delete' && substr($module_name,3,1)==1) return ' checked=true ';
	if($permission_for=='publish' && substr($module_name,4,1)==1) return ' checked=true ';
	
	}
	function state_id_name($state_id)
	{
		
		$states=array(
		'1'=>'01-Jammu and Kashmir',
		'2'=>'02-Himachal Pradesh',
		'3'=>'03-Punjab',
		'4'=>'04-Chandigarh',
		'5'=>'05-Uttarakhand',
		'6'=>'06-Haryana',
		'7'=>'07-Delhi',
		'8'=>'08-Rajasthan',
		'9'=>'09-Uttar Pradesh',
		'10'=>'10-Bihar',
		'11'=>'11-Sikkim',
		'12'=>'12-Arunachal Pradesh',
		'13'=>'13-Nagaland',
		'14'=>'14-Manipur',
		'15'=>'15-Mizoram',
		'16'=>'16-Tripura',
		'17'=>'17-Meghalaya',
		'18'=>'18-Assam',
		'19'=>'19-West Bengal',
		'20'=>'20-Jharkhand',
		'21'=>'21-Odisha',
		'22'=>'22-Chattisgarh',
		'23'=>'23-Madhya Pradesh',
		'24'=>'24-Gujarat',
		'25'=>'25-Daman and Diu',
		'26'=>'26-Dadra and Nagar Haveli',
		'27'=>'27-Maharashtra',
		'28'=>'28-Andhra Pradesh',
		'29'=>'29-Karnataka',
		'30'=>'30-Goa',
		'31'=>'31-Lakshadweep Islands',
		'32'=>'32-Kerala',
		'33'=>'33-Tamil Nadu',
		'34'=>'34-Pondicherry',
		'35'=>'35-Andaman and Nicobar Islands', 
		'36'=>'36-Telangana', 
		'37'=>'37-Andhra Pradesh (New)'
	);

return $states[$state_id];

}
	
?>