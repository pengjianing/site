/**
 * Created by Ning on 2016/12/23.
 */
$(function(){
   var screenHeight=window.screen.height;
    var contentHeight=$('.navbar ').siblings('.container').height();
    if(contentHeight<screenHeight){
        $('footer').css({"bottom":"0",
        "position": "absolute",
        "width": "100%",
        "margin-top": "40px"
        });
    }else{
    }
});