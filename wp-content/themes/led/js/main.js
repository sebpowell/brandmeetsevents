jQuery(document).ready(function(){
    
    jQuery('.dropmenu ul li:has(> ul) > a').append('<span class="arrow-icon" />');    
    
    jQuery('.dropmenu li ul').each(function(){ 
        jQuery(this).addClass('off');
    });

    if(jQuery('li.current-page-parent').length > 0) { 
        jQuery('li.current-page-parent ul').removeClass('off');
        jQuery('li.current-page-parent ul').addClass('on');
    }

    if(jQuery('li.current-menu-item ul').length > 0) { 
        jQuery('li.current-menu-item ul').removeClass('off');
        jQuery('li.current-menu-item ul').addClass('on');
    }
    
    jQuery(".dropmenu>ul>li>a").hoverIntent({
        over: function(){
            jQuery("nav.main-nav").filter(':not(:animated)').animate({ 
                'padding-bottom': '40px'
            }, "slow").addClass("two-layer");        
            hideAllNav();
            showChildNav(this);
        },
        out: function() {
            
        }
    });

    jQuery(".dropmenu").bind("mouseleave",function(){   
      jQuery(".dropmenu li.current-page-parent ul").addClass("on");
       if(jQuery(".dropmenu li.current-page-parent ul").hasClass("on")) {
           
       } else {
            jQuery("nav.main-nav").animate({ 
                 'padding-bottom': '0px'
             }, "slow").removeClass("two-layer");      
        }
        hideAllNav();
        showCurrentNav();  
    });


    if(jQuery(".dropmenu li ul").hasClass("on")) {
        jQuery("nav.main-nav").filter(':not(:animated)').animate({ 
            'padding-bottom': '40px'
        }, "slow").addClass("two-layer");
    }

    jQuery('.flexslider').flexslider();
    
    // Easing 
    jQuery.extend( jQuery.easing, {    
        easeInOutQuad: function (x, t, b, c, d) {
            if ((t/=d/2) < 1) return c/2*t*t + b;
            return -c/2 * ((--t)*(t-2) - 1) + b;
        }        
    });
    jQuery('#carousel').jcarousel({
        auto: 2,
        wrap: 'last',
        scroll: 1,
        easing: 'easeInOutQuad',
        animation: 1000,
        initCallback: mycarousel_initCallback
    });

    jQuery("label").inFieldLabels(); 
    jQuery("input").attr("autocomplete","off");
    
    jQuery('div.mc_merge_var').each(function() {
      var wrap = jQuery('<p>');
      jQuery(this).before(wrap);
      var next = jQuery(this).next();
      wrap.append(this).append(next);
    });

    // Drop Menu
    if(!jQuery.support.cssProperty("transition")){
    jQuery("#nav").removeClass("use-trans");
        jQuery("#nav li").each(function(){
            var obj = jQuery(this);
            var submenu = obj.children(".submenu");
            if(submenu.length > 0) obj
            .mouseenter(function(){	
                jQuery(this).children(".submenu").fadeIn(200);	
            }).mouseleave(function(){	
                jQuery(this).children(".submenu").fadeOut(200);	
            });
        submenu.hide();
        });
    }


    // Drop Filter
    jQuery('ul#filter a').click(function() {
            var filterVal = jQuery(this).text().toLowerCase().replace(/\s+/g, '-');
             jQuery('.case-studies .item').each(function() {
                if(!jQuery(this).hasClass(filterVal)) {
                jQuery(this).fadeOut('normal').addClass('hidden');
                } else {
                    jQuery(this).fadeIn('slow').removeClass('hidden');
                }
            });
            return false;
        });    


    jQuery('#mc_signup_submit').wrap('<p />');
    jQuery('.col').first().css('margin-left', '0px');
   
});
					
function hideAllNav(menu){
    jQuery(".dropmenu ul ul").removeClass("on fix");
    jQuery(".dropmenu ul ul").addClass("off");
}
			
function showChildNav(actOnMe){
    jQuery(".dropmenu li").removeClass("MenuVisible");
    jQuery(actOnMe).parent("li").find("ul").removeClass("off");
    jQuery(actOnMe).parent("li").find("ul").addClass("on fix");
    jQuery(actOnMe).parent("li").not($("li.here")).find("ul").bind("mouseenter",function(){
        jQuery(this).parent("li").addClass("MenuVisible");
    }).bind("mouseleave",function(){
        jQuery(this).parent("li").removeClass("MenuVisible");
    });
}
			
function showCurrentNav(){
    //only do this if it is currently hidden
    if(jQuery(".dropmenu li.current-menu-item ul").hasClass("off")){
        jQuery(".dropmenu li.current-menu-item ul").removeClass("off");
        jQuery(".dropmenu li.current-menu-item ul").addClass("on fix");
    }
}

function mycarousel_initCallback(carousel)
{
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};

// CSS Property Support
jQuery.support.cssProperty = (function() {
    function cssProperty(p, rp) {
        var b = document.body || document.documentElement,
        s = b.style;
        if(typeof s == 'undefined') { return false; }
        if(typeof s[p] == 'string') { return rp ? p : true; }
        v = ['Moz', 'Webkit', 'Khtml', 'O', 'Ms'],
        p = p.charAt(0).toUpperCase() + p.substr(1);
        for(var i=0; i<v.length; i++) {
            if(typeof s[v[i] + p] == 'string') { return rp ? (v[i] + p) : true; }
        }
    }
    return cssProperty;
})();



