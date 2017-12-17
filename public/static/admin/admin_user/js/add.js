$(function(){
// 获取id
var id = $("#id").val();
console.log(id);
$('#adminUserForm').bootstrapValidator({
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        username: {
            validators: {
                notEmpty: {
                    message: '用户名不能为空！'
                },
                stringLength: {
                    min: 2,
                    max: 20,
                    message: '用户名必须大于2，小于20个字符！'
                },
                remote: {
                    url: '/admin/adminUser/checkUsername?id='+id,
                    message: '用户名已经存在！',
                    delay :  2000,
                    type: 'POST'
                }
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: '密码不能为空！'
                },
                stringLength: {
                    min: 6,
                    max: 30,
                    message: '密码必须大于6，小于30个字符！'
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
            setTimeout("window.location = '/admin/AdminUser/index'",2000);
        }
        else
        {
            swal("提示", result.msg, "error");
        }
    }, 'json');
});

})