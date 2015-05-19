<?php

//url 生成函数相对路径
function url($value1,$value2){
	$url=__ROOT__.'/index.php/'.$value1.'/'.$value2;
	return  $url;
}

//url 生成函数绝对路径
function  url_full($value1,$value2){
	$url="http://".$_SERVER ['HTTP_HOST'].url($value1,$value2);
	return  $url;
	 
}

//url 字符串截取函数
function substr_cut($str_cut,$length)
{
	if (strlen($str_cut) > $length)
	{
		for($i=0; $i < $length; $i++)
		if (ord($str_cut[$i]) > 128)    $i++;
		$str_cut = substr($str_cut,0,$i)."..";
	}
	return $str_cut;
}


/**
 * 距离现在多少时间转换函数
 * @var $list :数据列表 二维数组
 * @var $item :时间日期字段名称
 */
function time_transform($list,$item){
	
	foreach ($list as $key => $value) {
		$nowtime=time();
		$ab_time=$nowtime - $value[$item];
		 
		if ($ab_time<=(3600*24)){
			if($ab_time<60){
				$ab_time=floor($ab_time);
				$list[$key][$item]=$ab_time."秒前";
			}elseif ($ab_time>=60 && $ab_time<=3600){
				$ab_time=floor($ab_time/60);
				$list[$key][$item]=$ab_time."分钟前";
			}elseif ($ab_time>3600 && $ab_time<=3600*24){
				$ab_time=floor($ab_time/3600);
				$list[$key][$item]=$ab_time."小时前";
			}
			
			}elseif ($ab_time>3600*24 && $ab_time<=3600*24*30) {
				$ab_time=floor($ab_time/(3600*24));
				//$list[$key][$item]=$ab_time;
				$list[$key][$item]=$ab_time."天前";
			}else{
				$list[$key][$item]=date('Y-m-d H:i:s',$value[$item]);
			}
	
		}
	return ($list);
}


function page_list($p,$last=5,$g=1){
	$last=$g*5;
	if($p>$last){
		$g++;
		$last=$g*5;
		page_list($p,$last,$g);
		return page_list($p,$last,$g);
	}else{
		$group=array();
		$group[0]=$p;
		$group[1]=$last;
		$group[2]=$g;
		return $group ;
	}

}










	


?>