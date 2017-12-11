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
  var keywords =  $('input[name="keywords"]').val();
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
        }else{
          $.ajax({
            type:"POST",
             url:'http://dev.mba.vag/Index/search',
             data:{
               keywords:keywords,
            },
            dataType:"json",     
            success:function(data){
              console.log(data);
                if(data.status == 0){
                   console.log(data.data.items)
                   // 把获取到数据赋值给items对象
                   var items = data.data.items;
                   var html = '';
                   html +=`
                      <div class="article_bd">
                        <h1>${items.title}</h1>
                        <div class="title-box">
                          <span class="newTime">${items.time}</span>
                          <span class="newfrom">来源：${items.from}</span>
                        </div>
                        <div class="content">
                           <p>${items.content}</p>
                        </div>
                      </div>
                   `;
                $("#returnMsg").html(html);
                }
            },
            error:function(jqXHR){
                 //$("#test").html("发生错误:"+jqXHR.status);
                 alert('请求失败：'+err.Msg)
                 console.log(jqXHR.status)
            }
        });
        }

})


