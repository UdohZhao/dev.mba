$(function(){


})

// 编辑
function edit(id)
{
  console.log(id);
  window.location.href = "/admin/AdminUser/add?id="+id;
}

// 删除
function del(id)
{
console.log(id);
swal({
  title: "确认删除吗？",
  text: "你将无法恢复此数据！",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: '确定',
  cancelButtonText: '取消',
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: true
}).then(function() {
    // Ajax
    $.ajax({
      type: "GET",
      url: "/admin/AdminUser/del?id="+id,
      dataType: "JSON",
      success: function (result)
      {
        console.log(result);
        if (result.status == 0)
        {
          swal("提示", result.msg, "success");
          setTimeout("window.location = '/admin/AdminUser/index'",2000);
        }
        else
        {
          swal("提示", result.msg, "error");
        }
      },
      error: function (e)
      {
        console.log(e);
      }
    });
}, function(dismiss) {
  // dismiss的值可以是'cancel', 'overlay',
  // 'close', 'timer'
  if (dismiss === 'cancel') {
      swal("取消了！", "不受影响的操作", "error");
  }
})

}

// 配置权限
function permissions(id)
{
    console.log(id);
    window.location.href = "/admin/Permissions/add?auid="+id;
}