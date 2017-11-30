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



