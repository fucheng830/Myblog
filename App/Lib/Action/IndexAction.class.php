<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {

    public function index($p=1){
    		//取session值
    		$uid=session(uid);
    		$user_nice_name=session(user_nice_name);
    		$lay_out=url('User','layout');
    		$write_url=url('Index','writeblog');
    		//博客数据模块
    		$Blog= M('Blog');
			$listRows=20;//设置分页显示数量
			
			$count      = $Blog->count();// 查询满足要求的总记录数
			$count=(int)$count;
			
			if($count>$listRows){
			$totalPages = ceil($count/$listRows);
			$firstRow = $listRows*($p-1)+1;
			if($count<$listRows*$p){
			$listRows=$count-$firstRow;
			}
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $Blog->limit($firstRow,$listRows)->select();
			krsort($list);
		  
			$c=page_list($p);
			if($c[1]>$totalPages){
					$c[1]=$totalPages;
			}
			$end=$c[1];
			$start=$c[1]-4;
			if($start<=0){
				$start=1;
			}
			
    		$back=time_transform($list,$item='last_updata');
    		
    		
    		//dump($back);exit;
    		$this-> assign('blog',$back);
			$this-> assign('p',$p);
			$this-> assign('start',$start);
    		$this-> assign('end',$end);
			}else{
					
					$Blog= M('Blog');
					$list = $Blog->select();
					krsort($list);
					$back=time_transform($list,$item='last_updata');
					$this-> assign('display','off-display');
					$this-> assign('blog',$back);
					
			}
		     //取blog数据
		    if($uid!=null){
					    	$this-> assign('user_nice_name',$user_nice_name);
					    	$this-> assign('layout',$lay_out);
					    	$this-> assign('write_url',$write_url);
		    	
		     				$this-> display('index');
    					}else{
    						
    						$this-> display('index_guest');
							
    				}
    	}
    
    function writeblog(){
    	$uid=session(uid);
    	$user_nice_name=session(user_nice_name);
    	$lay_out=url('User','layout');
    	$write_url=url('Index','writeblog');
    	$Sort=M('Sort');
    	$sort=$Sort->select();
    	$this-> assign('sort',$sort);
    	$this-> assign('user_nice_name',$user_nice_name);
    	$this-> assign('layout',$lay_out);
    	$this-> assign('write_url',$write_url);
    	$this-> display();
    	
    }
    
    function blog($b_id){
    	$uid=session('uid');
    	$user_nice_name=session(user_nice_name);
    	if($b_id!=null){
    		$User=M('User');
    		$Blog=M('Blog');
			$echo=$Blog->where("blog_id='$b_id'")->select();
			$author_id=$echo[0][author_id];
			$author=$User->where("uid='$author_id'")->select();
			//博客和作者数据
			$this-> assign('blog',$echo);
			$this-> assign('author',$author[0]);
			//取评论数据
			$Comment=M('Comment');
			$co=$Comment->where("b_id='$b_id'")->select();
			$co_list=time_transform($co,$item='c_time');
			$num=count($co);
			$this-> assign('num',$num);
			$this-> assign('comment',$co_list);
			
			$lay_out=url('User','layout');
			$write_url=url('Index','writeblog');
			
			//判断是否登录
    		if($uid !=null && $user_nice_name!=null){
    			
    			
    			$back=$User->where("uid='$uid'")->select();	
    		
    			$this-> assign('user_nice_name',$user_nice_name);
    			$this-> assign('blog_id',$b_id);
    			$this-> assign('user',$back[0]);
    			$this-> display();
    			
    		}else{
				
				$this-> display('blog_guest');
    		}
    			
    	}else{
    	 echo "错误";
    	}
    }
    
    
    
	public function page($p=1){
		$Blog= M('Blog');
		$listRows=20;//设置分页显示数量
		$count      = $Blog->count();// 查询满足要求的总记录数
		$totalPages = ceil($count/$listRows);
		
		$firstRow = $count-$listRows*($nowPage);
		
		
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $Blog->limit($firstRow,$listRows)->select();
		krsort($list);
		
		
		$c=page_list($p);
		if($c[1]>$totalPages){
				$c[1]=$totalPages;
		}
		$end=$c[1];
		$start=$c[1]-4;
		
	}
	
	public function f(){
		import("@.Extend.MakePage");
		$Blog= M('Blog');
		$count      = $Blog->count();// 查询满足要求的总记录数
		 
		$Make_page       = new Makepage($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Make_page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $Blog->limit($Make_page->firstRow.','.$Make_page->listRows)->select();
		
		$this->assign('blog',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		//$this->assign('list',$list);
		$this->display('index');
	}
	
	public function s(){
		$name=s('name');
		if(!$name){
			s('name','success',10);
			$this->show('S缓存已过期，现在已经重新设置了值，请重新刷新浏览器');	
		}else{
			dump(s('name'));
			$this->show('缓存过期时间是10秒，请10秒后查看是否过期');
		}
	}
	public function upload(){
		    if (!empty($_FILES)) {
            import("@.ORG.UploadFile");
            $config=array(
                'allowExts'=>array('jpg','gif','png'),
                'savePath'=>'./Public/upload/',
                'saveRule'=>'time',
            );
            $upload = new UploadFile($config);
            $upload->thumb=true;
            $upload->thumbMaxHeight=100;
            $upload->thumbMaxWidth=100;
			$upload->water='./ThinkPHP/logo.png';//水印
            if (!$upload->upload()) {
                $this->error($upload->getErrorMsg());
            } else {
                $info = $upload->getUploadFileInfo();
				$this->assign('filename',$info[0]['savename']);
            }
		}
			$this->show('
<form action="" method="post" enctype="multipart/form-data"><input type="file" name="files[]"/><input name="" value="上传" type="submit" /></form>
<notempty name="filename">
	<img src="__PUBLIC__/upload/{$filename}" /> <a href="__URL__/delete/filename/{$filename}">删除图片</a>
</notempty>
');

	}
	public function delete($filename){
		if(file_delete('./Public/upload/'.$filename) && file_delete('./Public/upload/thumb_'.$filename)){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
	public function log(){
		Log::write('一条测试日志');
		$this->show('日志已记录，请查看日志是否生成');
	}
}
