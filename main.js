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

window.res = '';

function confirm_delete() {

    //resume_remove.php?id=
    //  alert(id);
    var id = window.res;
    if(id>1)
    {
        console.log(id);
        $.post('resume_remove.php?id='+id,null,function (data) {
           if(data == 'done')
           {
               $("#rlist-"+id).remove();
           }
        });

    }

   //var res = $('#exampleModal').modal();
   // console.log(window.res);
}
$('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    var recipient1 = button.data('whatever1') // Extract info from data-* attributes


    console.log(recipient1);
    window.res = recipient;

    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    //modal.find('.modal-title').text(' ' + recipient)
     modal.find('.modal-body').text('您确定要删除标题为“'+recipient1+'”的这条简历么？');
})
