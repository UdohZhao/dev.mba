$(function(){

// 初始化UEditor
var title = UE.getEditor('title');
var content = UE.getEditor('content');

})


// 验证表单
$('#AboutUsForm').bootstrapValidator({
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {

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
            $(".btn-primary").removeAttr("disabled");
        }
    }, 'json');
});