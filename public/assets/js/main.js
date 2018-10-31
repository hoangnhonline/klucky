(function($){
    "use strict";
    $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Change viewport
    function ChangeWiewport() {
        if (screen.width < 750) {
            $("#viewport").attr("content", "width=750");
        }else{
            $("#viewport").attr("content", "width=750, maximum-scale=1.0, user-scalable=0");
        }
    }
    ChangeWiewport();
    $(window).resize(function() {
        ChangeWiewport();
    });

    // Zoom Web on in all browser
    function Zoom() {
        var winHeight = $(window).height();
        var zoom = 1;
        var bodyMaxHeight = 1331;
        zoom = winHeight/bodyMaxHeight;
        /* Firefox */
        var winWidth = $(window).width();
        var widthFirefox = winWidth/zoom;
        if(navigator.userAgent.indexOf("Firefox") != -1) {
            $('#Zoom').css({
                '-moz-transform': 'scale('+zoom+')',  /* Firefox */
                'transform-origin': '0 0',
                'width': widthFirefox,
            });
        } else {
            $('#Zoom').css({
                'zoom': zoom,
            });
        }
    }
    Zoom();
    $(window).on('load resize', function() {
        Zoom();
    });

    // Slider Rewards
    $('.kl_autoplay').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
    });
    function getContent(id){
        $.ajax({
              url: $('#route_get_content').val(),
              type: "GET",
              async: false,
              data: {          
                  id : id
              },
              dataType :'json',
              success: function(data){

                $('.title-page').html(data.title);
                $('#content-page').html(data.content);                  
              }
          });
    }
    $('a.load-content').click(function(){
        getContent($(this).data('id'));
        $('li.kl_content_item').removeClass('kl_content_item_active');
        $(this).parent('li.kl_content_item').addClass('kl_content_item_active');
    });
     $("input.number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
     function quayso(){
        var numberArr = Array(0,1,2,3,4,5,6,7,8,9);
         $('.number-list .number').each(function(){
            $(this).html(numberArr[Math.floor(Math.random()*numberArr.length)]);
         });   
     }     
     
     $('#btnQuayNgay').click(function(){

        var myQuaySo = setInterval(quayso, 30);   
        setTimeout(function(){
            clearInterval(myQuaySo);
        }, 3000);
        setTimeout(function(){
            checkNo();
        }, 2000);       
     });
     $('#code').keypress(function (e) {
        if (e.which == 13) {
          $('#btnQuayNgay').click();
        }
      });
     function checkNo(){
        var code = $('#code').val();
         $.ajax({
              url: $('#route_check_no').val(),
              type: "GET",
              async: false,
              data: {          
                  code : code
              },
              dataType :'json',
              success: function(data){
                if(data.success == 0){
                    $('#wrongModal').modal('show');
                }else if(data.success == 1){                    
                    $('#success_image').attr('src', data.popup_image_url);
                    $('#success_image').attr('alt', data.name);
                    $('#success_code').html(data.code);
                    $('#successModal').modal('show');
                }else if(data.success == 2){
                    $('#loseModal').modal('show');
                }          
              }
        });
     }
     $('button.close').click(function(){
        $('#code').val('');
        $('.number-list span.number').html(0);
     });
     $('#btnNhanSo').click(function(){
        $('#infoModal').modal('show');
     });
     $('#btnSend').click(function(){
        var error = 0;
        $('#contactForm input.required, #contactForm select.required').each(function(){
          if($.trim($(this).val()) == ""){
            error++;
          }

        });        
        if(error > 0){
          return false;
        }else{     
          $('#btnSend').attr('disabled','disabled');     
          $.ajax({
            url : $('#contactForm').attr('action'),
            type : 'POST',
            data : $('#contactForm').serialize(),
            dataType : 'json',
            async: false,
            success : function(data){
              if(data.success == 1){
                $('#contactForm input, #contactForm select').val('');
                $('#infoModal').modal('hide');
                $('#sendSuccessModal').modal('show');  
              }
              
            }
          });
        }
     });
     $('#btnNewNumber').click(function(){
      $('.modal').modal('hide');
      $('#infoModal').modal('show');
     });
})(jQuery); // End of use strict