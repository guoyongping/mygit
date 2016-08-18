<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>tpshop管理后台</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="/Public/bootstrap/css/bootstrap.css">
    <link href="/Public/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/Public/Font-Awesome/css/font-awesome.css">
    <!-- Ionicons 2.0.0 --
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/Public/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
    	folder instead of downloading all of them to reduce the load. -->
    <link href="/Public/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/Public/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <script src="/Public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/js/myFormValidate.js"></script>    
    <script src="/Public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/Public/js/layer/layer-min.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
    <script src="/Public/js/myAjax.js"></script>
    <script type="text/javascript">
    function delfunc(obj){
    	layer.confirm('确认删除？', {
    		  btn: ['确定','取消'] //按钮
    		}, function(){
    		    // 确定
   				$.ajax({
   					type : 'post',
   					url : $(obj).attr('data-url'),
   					data : {act:'del',del_id:$(obj).attr('data-id')},
   					dataType : 'json',
   					success : function(data){
   						if(data==1){
   							layer.msg('操作成功', {icon: 1});
   							$(obj).parent().parent().remove();
   						}else{
   							layer.msg(data, {icon: 2,time: 2000});
   						}
   						layer.closeAll();
   					}
   				})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);
    }
    
    function selectAll(name,obj){
    	$('input[name*='+name+']').prop('checked', $(obj).checked);
    }    
    </script>        
  </head>
  <body style="background-color:white;">
 

<div class="wrapper">
  <!--<div class="breadcrumbs" id="breadcrumbs">-->
	<!--<ol class="breadcrumb">-->
	<!--<?php if(is_array($navigate_admin)): foreach($navigate_admin as $k=>$v): ?>-->
	    <!--<?php if($k == '后台首页'): ?>-->
	        <!--<li><a href="<?php echo ($v); ?>"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo ($k); ?></a></li>-->
	    <!--<?php else: ?>    -->
	        <!--<li><a href="<?php echo ($v); ?>"><?php echo ($k); ?></a></li>-->
	    <!--<?php endif; ?>                  -->
	<!--<?php endforeach; endif; ?>          -->
	<!--</ol>-->
<!--</div>-->

    <section class="content ">
        <!-- Main content -->
        <div class="container-fluid">
            <div class="pull-right">
                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> 添加会员等级</h3>
                </div>
                <div class="panel-body ">   
                    <!--表单数据-->
                    <form method="post" id="handleposition" action="<?php echo U('Admin/User/levelHandle');?>">                    
                        <!--通用信息-->
                    <div class="tab-content col-md-10">                 	  
                        <div class="tab-pane active" id="tab_tongyong">                           
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td class="col-sm-2">等级名称：</td>
                                    <td class="col-sm-4">
                                        <input type="text" class="form-control" name="level_name" value="<?php echo ($info["level_name"]); ?>" >
                                        <span id="err_attr_name" style="color:#F00; display:none;"></span>                                        
                                    </td>
                                    <td class="col-sm-4">设置会员等级名称
                                    </td>
                                </tr>  
                                <tr>
                                    <td>消费额度：</td>
                                    <td >
                         				<input type="text" class="form-control" name="amount" value="<?php echo ($info["amount"]); ?>">
                                    </td>
                                    <td class="col-sm-4">设置会员等级所需要的消费额度</td>
                                </tr>
                                <tr>
                                    <td>折扣率：</td>
                                    <td>
                               			<input type="text" class="form-control" name="discount" value="<?php echo ($info["discount"]); ?>">     
                                    </td>
                                    <td class="col-sm-4">折扣率单位为百分比，如输入90，表示该会员等级的用户可以以商品原价的90%购买</td>
                                </tr>  
                                <tr>
                                    <td>等级描述：</td>
                                    <td>
                             			<textarea rows="5" cols="30" name="describe"><?php echo ($info["describe"]); ?></textarea>
                                    </td>
                                    <td class="col-sm-4">会员等级描述信息</td>
                                </tr>                              
                                </tbody> 
                                <tfoot>
                                	<tr>
                                	<td><input type="hidden" name="act" value="<?php echo ($act); ?>">
                                		<input type="hidden" name="level_id" value="<?php echo ($info["level_id"]); ?>">
                                	</td>
                                	<td class="col-sm-4"></td>
                                	<td class="text-right"><input class="btn btn-primary" type="buuton" onclick="adsubmit()" value="保存"></td></tr>
                                </tfoot>                               
                                </table>
                        </div>                           
                    </div>              
			    	</form><!--表单数据-->
                </div>
            </div>
        </div>
    </section>
</div>
<script>
function adsubmit(){
	$('#handleposition').submit();
}
</script>
</body>
</html>