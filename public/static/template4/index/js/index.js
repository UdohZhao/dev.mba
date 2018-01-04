$(function(){

	//点击搜索框 发起ajax请求
    function searchBtn() {
        var y = document.getElementById('keywords').val();
        if (y == null || y == '' || y == '站内搜索') {
            alert('搜索关键字不能为空');
            return false;
        } else if (y.length < 2) {
            alert('请至少输入2个文字');
            return false
        } else if (y.length > 40) {
            alert('最多可输入40个文字');
            return false
        }
    }


})




