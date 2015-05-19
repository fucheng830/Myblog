<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>myblog</title>

    <!-- Bootstrap core CSS -->
    <link href="__ROOT__/Public/bootstrap-3.3.4-dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="__ROOT__/Public/bootstrap-3.3.4-dist/myblog.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
   

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
<body>
    <nav class="navbar navbar-fixed-top border-bottom background">
      <div class="container container-fix">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="__ROOT__">Myblog</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a  class="active" href="<?php echo url('Index','writeblog');?>">写文章</a></li>
          </ul>
          <ul class="nav navbar-nav pull-right login-btn">
            <li class="my-layout">
                <a href="#" id="user_name"><?php echo ($user_nice_name); ?></a>
            </li>
            <div class="layout my-layout off-display" id="login-div">
            <div class="layout-inline">
                <a href="<?php echo url('User','layout') ;?>"><p class=""><span class="glyphicon glyphicon-log-out"></span> 退出帐号</p></a>
            </div>
            </div>
          </ul>
        </div><!--/.nav-collapse -->
          
      </div>
   

    </nav>
<div class="container">
        <!--提示框-->
        <div class="ui-alertbar info ng-hide" ng-show="alert.message" data-alert="globalAlert" data-align="bottom" data-target="#header-holder" ui-     alertbar="" ui-sticky="">
        <div class="receptacle ng-binding">
            <i class="icon icon-alertbar-info"></i>
        </div>
            
        </div> 
<div class="row">
            <div class="col-lg-9">
                <div class="col-lg-12">
                <h1 class="entry-title">
                    <?php echo ($blog[0][b_title]); ?>
                </h1>
                    
                <div class="entry-meta">
                    <a target="_blank" href="http://www.zhihu.com/people/chenbailing" class="author name ng-binding">陈柏龄</a>
                        <span class="bull" ng-click="test()">·</span>
                    <time title="2015年4月22日星期三晚上9点28分" ui-time="" datetime="2015-04-22T21:28:02+08:00" class="published ng-binding "></time>
                    <a href="/cbling/20010164#comments" class="comment ng-binding" ng-show="post.commentsCount"><i class="icon icon-comment"></i><?php echo ($num); ?><span class="hide-on-mobile"> 条评论</span></a>
               </div>
                    
                <section class="entry-content" ng-bind-html="postContentTrustedHtml"> <?php echo ($blog[0][b_content]); ?></section>
                </div>
                
                   <div class="col-lg-12 top-hr">
					 <p>
						 <span class="counter">
						  <span class="glyphicon glyphicon-comment comment-ico"></span><span class="ng-binding"><?php echo ($num); ?> 条评论</span>
						</span>
					  </p>
					   <?php if(is_array($comment)): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="comment-item border-top">
						<img class="avatar" src="<?php echo ($vo["author_img"]); ?>">
						<div class="comment-body">
							<div class="comment-hd">
								<a><?php echo ($vo["author"]); ?></a>
							</div>
							<div class="comment-content">
								<?php echo ($vo["comment"]); ?>
							</div>
							<div class="comment-ft">
								<time title="2015年5月16日星期六上午9点24分" ui-time="" datetime="2015-05-16T09:24:22+08:00" class="date ng-binding ng-isolate-scope"><?php echo ($vo["c_time"]); ?></time>
							</div>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
					
					<form class="comment-form" action="__ROOT__/index.php/Blog/comment" method="post">
					   <img src="<?php echo ($user[user_img]); ?>" class="avatar">
					   <input type="text" class="editable"  placeholder="写下你的评论…" name="comment">
					   <input type="hidden" name="b_id" value="<?php echo ($blog_id); ?>">
					   <input type="submit" class="btn btn-default btn-fix"> 
					</form>
                </div>
            </div>
<!--右边作者模块-->
<div class="col-lg-3">
                <div class="block column-about">
                <div class="avatar-link">
                    <img class="avatar-big" ng-src="" src="__ROOT__/Public/img/user_image.jpg">
                 </div>
                <div href="cbling" class="title">@南七度</div>
                  <!-- ngIf: column.creator.slug == me.slug -->
                <div class="followers" ng-switch="" on="!!column.followersCount">
                    <!-- ngSwitchWhen: true --><a ng-switch-when="true" href="/cbling/followers" class="ng-binding">8863 人关注</a>
                    <!-- ngSwitchWhen: false -->
                </div>
      <div class="description" ng-bind-html="column.description | linky">非专业程序员</div>
    </div>
            </div>

	</div>   <!--row结束标签-->
</div><!--container结束标签-->
  <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 
	
     <script>
    $(document).ready(function(){
		
		$('#1').removeClass('top-hr');
			
		  //登陆按钮
        $('#login-btn').click(function(){
            var is = $('#login-div').hasClass('off-display');
            if (is){
                $('#login-div').removeClass('off-display');
            }else{
                $('#login-div').addClass('off-display');
            }
    });
		
        //退出按钮
        $('.my-layout').mouseover(function(){
            //var is = $('#login-div').hasClass('off-display');
            $('#login-div').removeClass('off-display');
			$('.my-layout').mouseleave(function(){
				$('#login-div').addClass('off-display');
			});
           
               
            
		 
    });
        
    
    });
        
       
    </script>
        
     

</body>
</html>