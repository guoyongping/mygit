<?php if (!defined('THINK_PATH')) exit();?>﻿<!Doctype html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="/Public/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/Public/Font-Awesome/css/font-awesome.css">
</head>
<body>
<!---->
<section class="container">
    <div class="pull-right">
        <a href="/index.php/Admin/user/index" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"> <i class="icon-reply"></i>
        </a>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">添加会员</h3>
        </div>
        <div class="panel-body ">
            <!--表单数据-->
            <form class="form-horizontal" action="/index.php/Admin/user/addUser.html" method="post">
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="username" name="username" placeholder="请输入用户名">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label" >密码</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" id="inputPassword" placeholder="请输入密码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">手机号</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="phone" name="mobile" placeholder="添加一个手机号">
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">所在地</label>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-3">
                                <select class="form-control"  name="province" id="provence" onchange="setProvence(this)">
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control"  name="city" id="city" onchange="setCity(this)">
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control"  name="district" id="district">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" >
                    <label class="col-sm-2 control-label">性别</label>
                    <div class="col-sm-8">
                        <label class="checkbox-inline">
                            <input type="radio" name="sex" id="male" value="1" > 男
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" name="sex" id="female" value="2"> 女
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" name="sex" id="secret"checked  value="0"> 保密
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">会员等级</label>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-3">
                                <select class="form-control"  name="level" id="level">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
            <!--表单数据-->
        </div>
    </div>
</section>

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="/Public/bootstrap/jquery-3.1.0.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
</body>
<script>
    $(function() {
        $.ajax({
            url: "/index.php/Admin/address/getRegion",
            type: "get",
            dataType: "json",
            success: function (msg) {
                $.each(msg['region'], function (k, v) {
                    if (k == 0)
                        $("#provence").append("<option selected value=" + v.id + " data-id="+ v.id+">" + v.name + "</option>");
                    else
                        $("#provence").append("<option value=" + v.id + " data-id="+ v.id+">" + v.name + "</option>");
                });
            },
            error: function (msg) {
                alert("出错了");
            }
        });
        $.ajax({
            url: "/index.php/Admin/address/RegionTree",
            type: "get",
            dataType: "json",
            success: function (msg) {
                $.each(msg['region'], function (k, v) {
                    if (k == 0)
                        $("#city").append("<option selected value=" + v.id + " data-id="+ v.id+">" + v.name + "</option>");
                    else
                        $("#city").append("<option value=" + v.id + " data-id="+ v.id+">" + v.name + "</option>");
                });

                $.each(msg['region'][0].child, function (k, v) {
                    if (k == 0)
                        $("#district").append("<option selected value=" + v.id + " data-id="+ v.id+">" + v.name + "</option>");
                    else
                        $("#district").append("<option value=" + v.id + " data-id="+ v.id+">" + v.name + "</option>");
                });
            },
            error: function (msg) {
                alert("出错了");
            }
        });

        //获取所有等级信息
        $.ajax({
            url:"/index.php/admin/user/getLevel",
            type:'post',
            dataType:'json',
            success:function(msg){
                $.each(msg.level_list,function(k,v){
                    if(k == 0)
                        $('#level').append("<option selected value="+v.level_id+">"+v.level_name+"</option>");
                    else
                        $('#level').append("<option value="+v.level_id+">"+v.level_name+"</option>");
                });
            }
        });
    });

    function setProvence(obj){
        var parent_id = $("#provence option:selected").data('id');
        console.log(parent_id);
        $.ajax({
            url: "/index.php/Admin/address/RegionTree/parent_id/"+parent_id,
            type: "get",
            dataType: "json",
            success: function (msg) {
                $("#city").html("");
                $.each(msg['region'], function (k, v) {
                    if (k == 0)
                        $("#city").append("<option selected value=" + v.id + " data-id="+ v.id+">" + v.name + "</option>");
                    else
                        $("#city").append("<option value=" + v.id + " data-id="+ v.id+">" + v.name + "</option>");
                });
                $("#district").html("");
                $.each(msg['region'][0].child, function (k, v) {
                    if (k == 0)
                        $("#district").append("<option selected value=" + v.id + " data-id="+ v.id+">" + v.name + "</option>");
                    else
                        $("#district").append("<option value=" + v.id + " data-id="+ v.id+">" + v.name + "</option>");
                });
            },
            error: function (msg) {
                alert("出错了");
            }
        });
    }

    function setCity(obj){
        var parent_id = $("#city option:selected").data('id');
        $.ajax({
            url: "/index.php/Admin/address/RegionTree/parent_id/"+parent_id,
            type: "get",
            dataType: "json",
            success: function (msg) {
                $("#district").html("");
                $.each(msg['region'], function (k, v) {
                    if (k == 0)
                        $("#district").append("<option selected value=" + v.id + " data-id="+ v.id+">" + v.name + "</option>");
                    else
                        $("#district").append("<option value=" + v.id + " data-id="+ v.id+">" + v.name + "</option>");
                });
            },
            error: function (msg) {
                alert("出错了");
            }
        });
    }
</script>
</html>