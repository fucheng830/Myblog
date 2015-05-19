<?php

class UserAction extends Action {
	
	function index(){
		
		$this->display();
		
		
		
		
	}
	
	function login(){
		
		if($_POST != null){
				
			$User=M('User');
			$condition['user_name']=$_POST[user_name];
			$condition['user_psw']=$_POST[user_psw];
			$callback = $User->where($condition)->select();
			//dump($callback);exit();
			if($callback!=null){
				$uid=$callback[0][uid];
				$user_name=$callback[0][user_name];
				$user_nice_name=$callback[0][user_nice_name];
				session(uid,$uid);
				session(user_name,$user_name);
				session(user_nice_name,$user_nice_name);
				//echo session(user_nice_name);
				//$this->success('登录成功', 'Index/index');
				$url=$_SERVER["HTTP_REFERER"];
				//echo $_SERVER["HTTP_HOST"];
				
				//if(){
				header('Location:'.$url.'/');
				//}
				
				
			  }else{
				
				echo "用户名或密码错误";
			}
			
		}
	}
	
	
	function layout(){
		
		session(null);
		if(session('uid')==null){
			$url=url_full('Index','index');
			header('Location:'.$url);
			
		}else{
			echo "faild";
		}
		
	}
	
	
}

?>