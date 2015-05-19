<?php if (!defined('THINK_PATH')) exit();?> <div class="row">
            <div class="col-lg-9">
               
				<!--模版赋值-->
     			<?php if(is_array($blog)): $i = 0; $__LIST__ = $blog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-lg-12 top-hr" id="<?php echo ($i); ?>">
                    
                <h1 class="entry-title">
                    <a href="__ROOT__/index.php/Index/blog?b_id=<?php echo ($vo["blog_id"]); ?>" class=""><?php echo ($vo["b_title"]); ?></a>
                </h1>
                    
                <div class="entry-meta">
                    <a target="_blank" href="#" class="author name ng-binding"><?php echo ($vo["sort_name"]); ?></a>
                        <span class="bull" ng-click="test()">·</span>
                    <time title="2015年4月22日星期三晚上9点28分" ui-time="" datetime="2015-04-22T21:28:02+08:00" class="published ng-binding "><?php echo ($vo["last_updata"]); ?></time>
                    <a href="/cbling/20010164#comments" class="comment ng-binding" ng-show="post.commentsCount"><i class="icon icon-comment"></i><?php echo ($vo["comment_num"]); ?><span class="hide-on-mobile"> 条评论</span></a>
               </div>
                    
                <section class="entry-summary ng-scope" ng-if="!titleImageShow">
                   
              
					<?php echo ($vo["b_descript"]); ?>
                    <a href="__ROOT__/index.php/Index/blog?b_id=<?php echo ($vo["blog_id"]); ?>"><span class="read-all">继续阅读<i class="icon icon-read-all"></i></span></a>
                   
                    
               </section>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        
            </div>