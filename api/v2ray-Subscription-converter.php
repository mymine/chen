<?php
//代码很乱，能实现就行，大神勿喷
//有问题联系QQ55484816
*/
下载api.php上传到主机即可

调用格式http://你的域名/api.php??网址??混淆??显示端口(不填默认全部)

例如http://ml.mk39.cf/??https://sspool.herokuapp.com/vmess/sub??a.189.cn??80

主要作用:订阅链接批量筛选指定端口节点，批量修改host
/*
$url=$_SERVER['REQUEST_URI'];
$parameter=explode('&&',$url);
if(strstr($url,"http")==false) {
	//用户没有提交含http的订阅链接
	echo 'Please use the correct format!';
	return;
}
nodedata($parameter);
function analysisVmess($str,$host,$port) {
	$obj=json_decode($str, true);
	if(!is_array($obj)) {
		return;
	}
	foreach($obj as $key=>$value) {
		//修改host
		if($host!=null) {
			$obj['host']=$host;
		}
		//判断节点是否和提交参数相等
		if($obj['port']==$port) {
			$result=true ;
		}
	}
	//如果端口相同或没有填端口将默认全部节点添加
	if($result||$port==null) {
		return 'vmess://'.base64_encode(json_encode($obj));
	}
}
function nodedata($parameter) {
	$text='';
	$http=$parameter[1];
	$host=$parameter[2];
	$port=$parameter[3];
	$urldata=get($http);
	//判断订阅链接是否能正常访问
	if(is_null($urldata)) {
		echo "数据为空！";
		return false;
	}
	$httpdatadecode= base64_decode($urldata);
	$vmessdatas=explode('vmess://',$httpdatadecode);
	for ($i = 0; $i < count($vmessdatas); $i++) {
		//循环获取每个节点信息
		$vmessdata=base64_decode($vmessdatas[$i]);
		$text=$text.analysisVmess($vmessdata,$host,$port).PHP_EOL;
	}
	echo base64_encode($text);
}
//get请求获取函数
function get($url) {
	$ch = curl_init();
	if(substr($url,0,5)=='https') {
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
	}
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
?>
