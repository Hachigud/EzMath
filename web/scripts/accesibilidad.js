$('#checkContrast').click(function() {
    if ($(this).prop("checked") == true) { 
        $("#main-logo").css("display","none")
        $("#invert-logo").css("display","inline-block")
        $("body").css("background-color", "#000e1f")
        $("main .main-navbar").removeClass("bg-white")
        $("nav").removeClass("bg-white")
        $("main .main-navbar").css("background-color", "#062D5B")
        $(".dropdown-item").css("background-color", "#062D5B")
        $("label").css("color","#fff")
        $(".nav-link.active").css("background-color", "rgb(4, 26, 51)")
        $(".main-sidebar").css("background-color", "#062D5B")
        $(".main-navbar").css("background-color","#062D5B !important")
        $("footer").removeClass("bg-white")
        $("footer").css("background-color","#062D5B")
        $(".card").css("background-color","#062D5B")
        $(".card-header").css("background-color","#062D5B")
        $("footer").removeClass("border-top");
        $("h3, h6, h4").css("color", "#fff")
        $("span").css("color", "#fff")
    } else {
        if ($(this).prop("checked") == false) {
            $("#main-logo").css("display","inline-block")
            $("#invert-logo").css("display","none")
            $("body").css("background-color", "#f5f6f8")
            $("main .main-navbar").addClass("bg-white")
            $("nav").addClass("bg-white")
            $("main .main-navbar").css("background-color", "#fff")
            $(".dropdown-item").css("background-color", "#fff")
            $("label").css("color","#212529")
            $(".nav-link.active").css("background-color", "#fbfbfb")
            $(".main-sidebar").css("background-color", "#fff")
            $(".main-navbar").css("background-color","#fff !important")
            $("footer").removeClass("bg-white")
            $("footer").css("background-color","#fff")
            $(".card").css("background-color","#fff")
            $(".card-header").css("background-color","#fff")
            $("footer").removeClass("border-top");
            $("h3, h6, h4").css("color", "#3d5170")
            $("span").css("color", "#3d5170")
        }
    }
}); 