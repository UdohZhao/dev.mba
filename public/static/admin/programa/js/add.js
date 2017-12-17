$(function(){
// 获取id
var id = $("#id").val();
var pid = $("#pid").val();
console.log(id);
console.log(pid);
$('#programaForm').bootstrapValidator({
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        cname: {
            validators: {
                notEmpty: {
                    message: '栏目名称不能为空！'
                },
                remote: {
                    url: '/admin/Programa/checkCname?id='+id+'&pid='+pid,
                    message: '栏目名称已经存在！',
                    delay :  2000,
                    type: 'POST'
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
            setTimeout("window.location = '/admin/Programa/index'",2000);
        }
        else
        {
            swal("提示", result.msg, "error");
        }
    }, 'json');
});

})