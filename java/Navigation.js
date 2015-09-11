var NavigationSlideLock=true;

function NavigationSlide(a){
    if(NavigationSlideLock){
        var time=0;
        NavigationSlideLock=false;
        $(a).find("ul").stop();
        $(a).find("ul").slideUp(0);
        $(a).find("ul").find("li").each(function(){
            time=time+200;
        });
        $(a).find("ul").slideDown(time,function(){
            NavigationSlideLock=true;
        });
    }
}

function NavigationOut(a){
    $(a).find("ul").stop();
    $(a).find("ul").slideUp(200);
    NavigationSlideLock=true;
}