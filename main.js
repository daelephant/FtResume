function send_form(form_id) {
    //alert(form_id);
    //jQuery.post( url, [data], [callback], [type] ) ：使用POST方式来进行异步请求
    //data (Map) : (可选) 要发送给服务器的数据，以 Key/value 的键值对形式表示。
    //callback (Function) : (可选) 载入成功时回调函数(只有当Response的返回状态是success才是调用该方法)。
    //serialize()序列表表格内容为字符串。
    $.post($("#"+form_id).attr("action"),$("#"+form_id).serialize(),function (data) {
        if ($("#"+form_id+"_notice"))
            $("#"+form_id+"_notice").html(data);
    });
}

function confirm_delete(id) {
    //resume_remove.php?id=
    // alert(id);
    if(confirm("确定要删除这份简历么？"))
    {
        $.post('resume_remove.php?id='+id,null,function (data) {
           //
        });
    }
}