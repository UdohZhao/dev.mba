$(function(){

});

// 展示&隐藏
function show(id,status,ctl)
{

    console.log(id,status,ctl);
    swal({
      title: "确认此操作吗？",
      text: "",
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
          url: "/admin/"+ctl+"/show",
          data: {
              id: id,
              status: status
          },
          dataType: "JSON",
          success: function (result)
          {
            console.log(result);
            if (result.status == 0)
            {
              swal("提示", result.msg, "success");
              setTimeout("window.location.reload();",2000);
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
    });

}

// 编辑
function edit(id,ctl,type)
{
  console.log(id,ctl,type);
  window.location.href = "/admin/"+ctl+"/add?id="+id+"&type="+type;
}

// 删除图片
function del(id,ctl)
{

  console.log(id,ctl);
    swal({
      title: "确认此操作吗？",
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
          url: "/admin/"+ctl+"/del?id="+id,
          dataType: "JSON",
          success: function (result)
          {
            console.log(result);
            if (result.status == 0)
            {
              swal("提示", result.msg, "success");
              setTimeout("window.location.reload();",2000);
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
    });

}