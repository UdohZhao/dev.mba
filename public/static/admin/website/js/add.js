$(function(){

// bootstrapValidator
$('#WebsiteForm').bootstrapValidator({
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        service_qq: {
            validators: {
                notEmpty: {
                    message: '客服QQ不能为空！'
                }
            }
        },
        service_tel: {
            validators: {
                notEmpty: {
                    message: '客服电话不能为空！'
                }
            }
        },
        title: {
            validators: {
                notEmpty: {
                    message: '网站标题不能为空！'
                }
            }
        },
        describe: {
            validators: {
                notEmpty: {
                    message: '网站描述不能为空！'
                }
            }
        },
        search_keywords: {
            validators: {
                notEmpty: {
                    message: '网站搜索关键词不能为空！'
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

})