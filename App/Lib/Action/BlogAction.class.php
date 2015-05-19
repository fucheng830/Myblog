<?php


class BlogAction extends Action {
	
	function index(){
		
		$this->display();
		
		
	}
	
	
	function write_blog(){
		if($_POST!=null){
			$date=time();
			//print $date;
			//$uid=cookie('uid');
			//$User=M('User');
			//$Userinfo=$User->where("uid='$uid'")->select();
			$sort = split('，',$_POST[b_sort]);
			
			$short_str=substr_cut(strip_tags($_POST['b_content']),170);
			
			
			$Blog=M('Blog');
			$Blog->create();
			$Blog->b_title=$_POST['b_title'];
			$Blog->b_descript=$short_str.'...';
			$Blog->b_content=$_POST['b_content'];
			$Blog->creat=$date;
			$Blog->b_sort=$sort[0];
			$Blog->sort_name=$sort[1];
			$Blog->author=session('user_nice_name');
			$Blog->author_id=session('uid');
			$Blog->last_updata=$date;
			$back=$Blog->add();
			if($back!=null){
				header('Location:'.url_full('Index','index'));
			}else{
				$this->error('新增失败！');
					}
				}
			}
			
	function comment(){
		if($_POST!=null){
			$blog_id=$_POST['b_id'];
			$uid=session('uid');
			$Comment=M('Comment');
			
			$User=M('User');
			$back=$User->where("uid='$uid'")->select();
			
			$Comment->create();
			$Comment->author=session('user_nice_name');
			$Comment->author_img=$back[0]['user_img'];
			$Comment->author_id=session('uid');
			
			$Comment->comment=$_POST['comment'];
			$Comment->b_id=$blog_id;
			$Comment->c_time=time();
			$back=$Comment->add();
			if($back!=null){
				$Blog=M('Blog');
				$list=$Blog->where("blog_id='$blog_id'")->select();
				$data['comment_num']=++$list[0]['comment_num'];
				$Blog->where("blog_id='$blog_id'")->save($data);
				header('Location:'.url_full('Index','blog').'?b_id='.$_POST['b_id']);
			}else{
				$this->error('新增失败！');
			}
			
			
		}
	}
}
?>