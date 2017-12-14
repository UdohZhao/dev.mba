$(function(){

  //异步提交表单
  $("#PermissionsForm").ajaxForm({
      dataType:"json",
      success:function( result ){
        console.log(result);
        // result
        if (result.status == 0 )
        {
          swal("提交成功", result.msg, "success");
          setTimeout("window.location.href = '/admin/AdminUser/index'",2000);
        }
        else
        {
          swal("提交失败", result.msg, "error");
        }
      },
      error:function(e){
        console.log(e.responseText);
        swal("未知错误 :(", "请刷新页面后重试!", "error");
      }
  });

})

