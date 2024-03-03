/**
 *
 * --------------------------------------------------------------------
 *
 * Template : Custom Js Template
 * Author : reacthemes
 * Author URI : http://www.reactheme.com/
 *
 * --------------------------------------------------------------------
 *
 **/
(function ($) {
    "use strict";

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

   

    $.fn.skillBars = function (options) {
        var settings = $.extend({
            from: 0, // number start
            to: false, // number end
            speed: 1000, // how long it should take to count between the target numbers
            interval: 100, // how often the element should be updated
            decimals: 0, // the number of decimal places to show
            onUpdate: null, 
            onComplete: null,
            /*onComplete: function(from) {
                console.debug(this);
            }*/
            classes: {
                skillBarBar: '.skillbar-bar',
                skillBarPercent: '.skill-bar-percent',
            }
        }, options);

        return this.each(function () {

            var obj = $(this),
                to = (settings.to != false) ? settings.to : parseInt(obj.attr('data-percent'));
            if (to > 100) {
                to = 100;
            };
            var from = settings.from,
                loops = Math.ceil(settings.speed / settings.interval),
                increment = (to - from) / loops,
                loopCount = 0,
                interval = setInterval(updateValue, settings.interval);

            obj.find(settings.classes.skillBarBar).animate({
                width: parseInt(obj.attr('data-percent')) + '%'
            }, settings.speed);

            function updateValue() {
                from += increment;
                loopCount++;
                $(obj).find(settings.classes.skillBarPercent).text(from.toFixed(settings.decimals) + '%');

                if (typeof (settings.onUpdate) == 'function') {
                    settings.onUpdate.call(obj, from);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    from = to;

                    if (typeof (settings.onComplete) == 'function') {
                        settings.onComplete.call(obj, from);
                    }
                }
            }

        });
    };

  
    $(window).on('elementor/frontend/init', function () { 
        elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {
            AOS.init({
                duration: 500,
                easing: 'ease-out-quart',
                once: true
            });
            if($('.react-parallax-image').length) {
                gsap.to(".react-parallax-image", {
                    scrollTrigger:{
                    // trigger: ".images",
                    start: "top bottom", 
                    end: "bottom top", 
                    scrub: 1,
                    // markers: true
                    },
                    x: -250,
                });
            }

            if($('.react-parallax-image2').length) {
              gsap.to(".react-parallax-image2", {
                scrollTrigger:{
                  // trigger: ".images",
                  start: "top bottom", 
                  end: "bottom top", 
                  scrub: 1,
                  // markers: true
                },
                y: -250,
              });
            }  
            
             // Counter Up  
            $('.rs-counter').counterUp({
                delay: 20,
                time: 1500
            });

        });
    });

    //Sound Cloud
    $(document).ready(function(){
        var clicked_id;
        var audio_var = new Audio();

        $('.ppbutton').on("click",function(){
            var datasrc = $(this).attr('data-src');
            clicked_id= $(this).attr('id');
            console.log(clicked_id);
            audio_var.pause();
            
            $('.ppbutton').not(this).each(function(){
                $(this).removeClass('fa-pauses');
                $(this).addClass('fa-plays');
            });
            
            if($(this).hasClass('fa-plays')){
            console.log('play_click');
            audio_var.src=datasrc;
            $(this).removeClass('fa-plays');
            $(this).addClass('fa-pauses');
            console.log(audio_var);
            audio_var.play();
            } else {
            console.log('pause_click');
            $(this).removeClass('fa-pauses');
            $(this).addClass('fa-plays');
            console.log(audio_var);
            audio_var.pause();
            //audio_var.src='';
            //audio_var.load();
            console.log(audio_var);
            }
        });

        audio_var.onended = function() {
            $("#"+clicked_id).removeClass('fa-pauses');
            $("#"+clicked_id).addClass('fa-plays');
        };
    });
    

 

})(jQuery);




