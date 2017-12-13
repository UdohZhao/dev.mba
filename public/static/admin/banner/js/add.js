$(function(){

    var List = new Array();//定义一个全局变量去接受文件名和id
    // 初始化bootstrap-fileinput
    $("#kv-explorer").fileinput({
        theme: 'fa',
        language: 'zh',
        uploadUrl: '/admin/Base/fileUpload',
        //uploadExtraData:{"id": paid},
        allowedFileExtensions: ['jpg', 'jpeg' , 'gif', 'png'],
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
        // if
        if (data.response.status == 0)
        {
          var data = data.response.data;  //文件上传成功返回的文件名，可返回自定义文件名
          List.push({ FileName: data, KeyID: previewId });
          // jQuery动态赋值
          $("#img_path").val(data);
        }
        else
        {
          alert(data.response.msg);
        }
    }).on('filesuccessremove', function(event, id) {
        if(!confirm("确认此操作吗？")) return false;
        console.log(List);
        console.log(id);
        for (var i = 0; i < List.length; i++) {
          if (List[i].KeyID == id) {
            // Ajax 删除图片
            $.ajax({
                type: "post",
                url: "/admin/Base/fileDel",
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

    // bootstrapValidator
    $('#bannerForm').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            img_link: {
                validators: {
                    notEmpty: {
                        message: '链接地址不能为空，默认为 #'
                    }
                }
            }
        }
    }).on('success.form.bv', function(e) {
        // Prevent form submission
        e.preventDefault();

        // Get the form instance
        var $form = $(e.target);

        // Get the BootstrapValidator instance
        var bv = $form.data('bootstrapValidator');

        // Use Ajax to submit form data
        $.post($form.attr('action'), $form.serialize(), function(result) {
            console.log(result);
            // if
            if (result.status == 0)
            {
                swal("提示", result.msg, "success");
                setTimeout("window.location.reload();",2000);
            }
            else
            {
                swal("提示", result.msg, "error");
            }
        }, 'json');
    });

});

// 删除图片
function delImg(id,img_path,ctl)
{

  console.log(id,img_path,ctl);
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
          type: "POST",
          url: "/admin/"+ctl+"/delImg?id="+id,
          data: {
              img_path: img_path
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

