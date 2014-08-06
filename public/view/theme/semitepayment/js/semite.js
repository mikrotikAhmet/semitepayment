/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {

    $('#details').bind('click',function(){
        $('.details-control').toggle('fast');
    });
    
    // Usage
    $('.pay').click(function(e) {
       openOverlay('#overlay-inAbox');
       e.preventDefault();
    });

});

function openOverlay(olEl) {
    
    var data = $('#paymentform').serialize();
    var pk = $('input[name=\'M_PK\']').val();
    
    $.ajax({
        url: 'index.php?route=module/vpos/pay&key='+pk,
        type : 'post',
        dataType: 'json',
        data : data,
        beforeSend : function(){
            $oLay = $(olEl);
            
            html = '<img src="public/view/theme/semitepayment/img/semite_logo.png"/>';
                    html +='<p>Please wait while we are processing your payment.</p>';
                    html +='<p><img src="public/view/theme/semitepayment/img/loading.gif"></p>';
            
            $('.toolbar').hide();
            
            $('.wrapper').html(html);
        
            if ($('#overlay-shade').length == 0)
                $('body').prepend('<div id="overlay-shade"></div>');

            $('#overlay-shade').fadeTo(300, 0.6, function() {
                var props = {
                    oLayWidth       : $oLay.width(),
                    scrTop          : $(window).scrollTop(),
                    viewPortWidth   : $(window).width()
                };

                $oLay
                    .css({
                        display : 'block',
                        opacity : 0,
                        top : '-=300',
                        left : '72.5px'
                    })
                    .animate({
                        top : props.scrTop + 40,
                        opacity : 1
                    }, 600);
                });
        },
        complete : function(){
            
            
            
        },
        success : function(json){
            var timer = setInterval(function() {
                
                if (json.status == 'OK'){
                    closeOverlay();
                    if ($(this).attr('href') == '#') e.preventDefault();
                    clearInterval(timer);
                } else {
                    html = '<img src="public/view/theme/semitepayment/img/semite_logo.png"/>';
                    html +='<p>We could not be able to process your payment.</p>';
                    html +='<p>Please contact <a href="mailto:ahmet.gudenoglu@semitepayment.com">Technical Support Team</a> for more information.</p>';
                    
                    $('.toolbar').show();
                    
                    $('.wrapper').html(html);
                    clearInterval(timer);
                }
            }, 5000);
            
        },
        error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
        
    });
    
    
        
    }

    function closeOverlay() {
        $('.wrapper').html();
        $('.overlay').animate({
            top : '-=300',
            opacity : 0
        }, 400, function() {
            $('#overlay-shade').fadeOut(300);
            $(this).css('display','none');
        });
    }
    
    $('#overlay-shade, .overlay a').bind('click', function(e) {
        closeOverlay();
        if ($(this).attr('href') == '#') e.preventDefault();
    });
    