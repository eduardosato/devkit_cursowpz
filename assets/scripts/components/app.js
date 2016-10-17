// $(window).load(function(){
//     $("#loader").fadeOut("slow");
// });
$(document).ready(function() {
    attachFixed();
    $('.menu-switch').click(function(){

        
        if($(this).hasClass('ativo')){
            $(this).removeClass('ativo');
            $('#menuresponsivo').animate({right: "-255px" }, 600 );
            $('.menu-overlay').hide();
            $('#site').animate({left: "0px" }, 20 );
            $('.menu-switch i').removeClass('fa-times-circle-o');
            $('.menu-switch i').addClass('fa-bars');
            
        } else {
            $(this).addClass('ativo');
            $('.menu-overlay').show();
            $('#menuresponsivo').animate({right: "0px" }, 600 );
            $('#site').animate({left: "-250px" }, 20 );
            $('.menu-switch i').removeClass('fa-bars');
            $('.menu-switch i').addClass('fa-times-circle-o');
        }
        
    });

    $('.menu-overlay').click(function(){
      $('#menuresponsivo').animate({right: "-255px" }, 600 );
      $('.menu-overlay').hide();
      $('#site').animate({left: "0px" }, 20 );
    });

    $('#menu ul li a').click(function(){
        var divID = $(this).attr('href');
        $('html,body').animate({
            scrollTop: $(divID).offset().top - 0 // or 10
        },'slow');
        return false;
    });

    $('#menuresponsivo ul li a').click(function(){
        var divID = $(this).attr('href');
        $('html,body').animate({
            scrollTop: $(divID).offset().top - 0 // or 10
        },'slow');
        $('#menuresponsivo').animate({right: "-255px" }, 600 );
        $('.menu-overlay').hide();
        $('#site').animate({left: "0px" }, 20 );
        $('.menu-switch i').removeClass('fa-times-circle-o');
        $('.menu-switch i').addClass('fa-bars');
        return false;
    });

    $(".colorbox").colorbox({rel:'colorbox'});
    
    $( window ).resize(function() {
        recize();
    });
    recize();

    $('.bxslider').bxSlider({
      auto: true,
      autoControls: false,
      mode: 'fade'
    });
    
});

function recize(){
    var w = $(document).width();
    if(w>960){
        $(".popupColorbox").colorbox({inline:true, width:"60%"});
        $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
        $(".vimeo").colorbox({iframe:true, innerWidth:960, innerHeight:540});
    } else {
        $(".popupColorbox").colorbox({inline:true, width:"86%"}); 
        $(".youtube").colorbox({iframe:true, innerWidth:300, innerHeight:183});
        $(".vimeo").colorbox({iframe:true, innerWidth:300, innerHeight:183});        
    }
}

function attachFixed() {
  var w = $(document).width();
  if(w>960){
    $(window).on('scroll', function () {
        var topo = $('header');
        var scrollTop = $(window).scrollTop();
        if(scrollTop >= 50) {
          topo.addClass('menutop');
        }else{
          topo.removeClass('menutop');
        }
    });
  }else{
  }
}