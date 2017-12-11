$(function(){

});



// 编辑
function edit(id,pid)
{
  console.log(id,pid);
  window.location.href = "/admin/ProgramaArticle/add?id="+id+"&pid="+pid;
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
      url: "/admin/ProgramaArticle/del?id="+id,
      dataType: "JSON",
      success: function (result)
      {
        console.log(result);
        if (result.status == 0)
        {
          swal("提示", result.msg, "success");
          setTimeout("location.reload();",2000);
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

// 置顶
function tops(id,atype)
{

console.log(id,atype);

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
      url: "/admin/ProgramaArticle/tops",
      data: {
        id: id,
        atype: atype
      },
      dataType: "JSON",
      success: function (result)
      {
        console.log(result);

        if (result.status == 0)
        {
          swal("提示", result.msg, "success");
          setTimeout("location.reload();",2000);
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

// 展示
function show(id,status)
{

console.log(id,status);

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
      url: "/admin/ProgramaArticle/show",
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
          setTimeout("location.reload();",2000);
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
var List = new Array();//定义一个全局变量去接受文件名和id
// 更新封面
function updateCover(id)
{
    console.log(id);
    $('#myModal').modal({
      show: true
    })
    $("#kv-explorer").fileinput({
        theme: 'fa',
        language: 'zh',
        uploadUrl: '/admin/ProgramaArticle/coverUpload?id='+id,
        //uploadExtraData:{"id": paid},
        allowedFileExtensions: ['jpg', 'gif', 'png'],
        showRemove: false,
        maxFileSize: 8192,
        minFileCount: 1,
        maxFileCount: 1
    }).on('fileclear', function(event) {
        if(!confirm("确认清空文件吗？")) return false;
    }).on('filepreremove', function(event, id, index) {
        if(!confirm("确认此操作吗？")) return false;
    }).on("fileuploaded", function (event, data, previewId, index){
        console.log(data.response,previewId);
        var data = data.response;  //文件上传成功返回的文件名，可返回自定义文件名
        List.push({ FileName: data, KeyID: previewId })
    }).on('filesuccessremove', function(event, id) {
        if(!confirm("确认此操作吗？")) return false;
        console.log(List);
        console.log(id);
        for (var i = 0; i < List.length; i++) {
          if (List[i].KeyID == id) {
            // Ajax 删除图片
            $.ajax({
                type: "post",
                url: "/admin/ProgramaArticle/coverDelete",
                data: {path: List[i].FileName},
                dataType: "JSON",
                success: function (result)
                {
                    console.log(result);
                },
                error: function (e)
                {
                    console.log(e);
                }
            });
            List.splice(i,1);
          }
        }
    }).on('fileerror', function(event, data, msg) {
        console.log(event, data, msg);
    });
}

// 完成
function accomplish()
{
  if (!confirm("确认此操作吗？")) return false;
  window.location.reload();
}
