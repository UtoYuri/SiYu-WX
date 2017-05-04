<?php

	/**
	* 登录逻辑模型
	*/
	class Login_Model extends WebBase {

		/** 
	     * 构造函数
	     */  
		function __construct(){
			//调用父类构造函数
			$result = parent::__construct();
			if (!$result){
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
				die();
			}
		}

		/** 
	     * 登录
	     *
	     */  
		function login(){
			$POST = json_decode(file_get_contents("php://input"), true);
			// $POST = $_POST;
			if (isset($POST['code']) 
				&& isset($POST['raw_data']) 
				&& isset($POST['signature'])){
				$code		 = $POST['code'];
				$raw_data	 = $POST['raw_data'];
				$signature	 = $POST['signature'];
				$result = $this->login_session($code, $raw_data, $signature);
			} else {
				$result['success'] = false;
				$result['msg'] = '参数错误';
			}
			echo json_encode($result, JSON_UNESCAPED_UNICODE);
		}

		/** 
	     * 检查登录状态过期
	     *
	     */  
		function check(){
			$POST = json_decode(file_get_contents("php://input"), true);
			if (isset($POST['session'])){
				$session 	= $POST['session'];
				$result = $this->check_session($session);
			} else {
				$result['success'] = false;
				$result['msg'] = '参数错误';
			}
			echo json_encode($result, JSON_UNESCAPED_UNICODE);
		}
		
		/** 
	     * 析构函数
	     *  
	     */  
		function __destruct(){

		}
		
	}
?>