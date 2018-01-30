//首页头部加入收藏
$(document).ready(function(){
       $("#favorites").click(function(){
           var ctrl=(navigator.userAgent.toLowerCase()).indexOf('mac')!=-1?'Command/Cmd': 'CTRL';
           if(document.all){
               window.external.addFavorite('dev.mba.vag/', '重庆MBA招生考试服务平台');
               }
               else if(window.sidebar){
                   window.sidebar.addPanel('重庆MBA招生考试服务平台', 'dev.mba.vag/', "");
                   }
                   else{ alert('您可以通过快捷键' + ctrl + ' + D 加入到收藏夹');}
           })

})


//发起ajax

$("#searchBtn").click(function(){

  //获取用户输入搜索信息并验证
  var keywords =  $('input[name="search"]').val();
  console.log(keywords);
    // 验证
  if (keywords == null || keywords == '') {
          alert('搜索关键字不能为空');
          return false
        }else if(keywords == '站内搜索'){
          alert('搜索关键字不能为"站内搜索"');
          return false
        }else if (keywords.length < 2) {
            alert('请至少输入2个文字');
            return false
        } else if (keywords.length > 40) {
            alert('最多可输入40个文字');
            return false
        }

})


