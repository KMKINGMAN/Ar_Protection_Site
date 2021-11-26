	
$(document).ready(function() {
    if ($(window).scrollTop() >= 5) {
        $(".navbar ").css("background-image", "linear-gradient(to top, #F14158 20%, #8e575e 80%)");
    } else {
        $(".navbar ").css("background-image", "");
    }
})
$(window).scroll(function() {
    if ($(window).scrollTop() >= 5) {
        $(".navbar ").css("background-image", "linear-gradient(to top, #F14158 20%, #8e575e 80%)");
    } else {
        $(".navbar ").css("background-image", "");
    }
});
$(window).on({
    load:function(){
        $(".annon").delay(2500).animate({
            right:"0px",
        },500).delay(7500).animate({
            right:"-760px"
        },500)
    }
})