var loaderSymbols = ['0', '1', '2', '3', '4', '5', '6', '7'], loaderRate = 100, loaderIndex = 0;
function loader () {
    t = setTimeout(function () {
        document.getElementById('loader').innerHTML = loaderSymbols[loaderIndex];
        loaderIndex = loaderIndex < loaderSymbols.length - 1 ? loaderIndex + 1 : 0;
        loader()
    }, loaderRate)
}
$(function() {
	// Left Menu Tip

	var isHovered = false;
	var isNonTransparent = false;
	$(".icon-menu > .element").hover(function(e) {
		e.stopPropagation();
		var title = $(this).data("title");
		if(!isHovered) {
			$(".icon-menu > .tip").stop();
			$(".icon-menu > .tip").css({"top" : $(this).offset().top + 13, 'display' : 'block', 'opacity' : 0});
			$(".icon-menu > .tip").animate({"left" : 60, 'opacity' : 1}, 150);
			$(".icon-menu > .tip").text(title);
		} else {
			if(isNonTransparent) $(".icon-menu > .tip").stop();
			$(".icon-menu > .tip").animate({"top" : $(this).offset().top + 13}, 100, function() {	
				$(".icon-menu > .tip").text(title);
			});		
			$(".icon-menu > .tip").fadeIn(150);
		}
		
		isHovered = true;
	}, function() {
		if(!isHovered) {
			$(".icon-menu > .tip").fadeOut(150);
		}
	});
	
	$(".icon-menu").hover( function() {
		$(".icon-menu > .tip").animate({"left" : 70, 'opacity' : 0}, 150, function() {
			$(this).css({'display' : 'none'});
		});
		isHovered = false;
		isNonTransparent = false;
	}, function() {
		$(".icon-menu > .tip").animate({"left" : 70, 'opacity' : 0}, 150, function() {
			$(this).css({'display' : 'none'});
		});
		isHovered = false;
		isNonTransparent = false;
	});

	// input clear x 

	$('.input-clear').click(function() {
		$('#'+$(this).attr('id')+'.input').val('');
		$('#'+$(this).attr('id')+'.input').change();
		$(this).animate({'opacity' : '0'}, 200, function() {
			$(this).css({'display': 'none'});
		});
	});

	// delete-confirmation (update to )

	$('.confirm-delete').click(function() {
		var isConfirmed = confirm('Вы уверены?');
		if (isConfirmed) {
			return true;
		} else
			return false;
	});

	$('.ajax-load').click(function(e) {
		e.stopPropagation();
		$.ajax($(this).data('page')).done(function(data) {
			popup(data);
		});
		return false;
	});

	$('.manti-clearer').on('keyup', function() {
		clearer($(this));
	});

	$('.shower').click(function() {
        if($(this).hasClass('active')){
            $(this).toggleClass('active');
        } else{
        var active=$(document).find(".shower.active");
        active.removeClass('active');
		$(this).toggleClass('active');
        }
	});
	$('.stop').click(function(e) {
		e.stopPropagation();
	})

	$('.shower .icon').click(function(e) {
		e.stopPropagation();
	});

	// Switch togglers

	var switchID = 0;
	$('.switch').each(function() {
		$(this).attr('data-id', switchID);
		temp = "";
		leftSpace = "";
		if ($(this).val() == 1) {
			temp = " true";
			leftSpace = "style='left: 1em;'"
		};
		$(this).after("<div class='switcher"+temp+"' data-id='"+switchID+"' data-state='1'><div class='toggle' "+leftSpace+"></div></div>");
		$(this).hide();
		
		switchID++;
	});
	$('.switcher').click(function() {
		$(this).toggleClass('true');
		

		if($(this).hasClass('true')) {
			$('.toggle', $(this)).animate({'left' : '1em'}, 200);
			$('.switch[data-id="'+$(this).data('id')+'"]').val(1);
		} else {
			$('.toggle', $(this)).animate({'left': '0em'}, 200);
			$('.switch[data-id="'+$(this).data('id')+'"]').val(0);
		}
	});

	
});

function popup(text) {
	$('.container > .content').append('<div class="popup-outer"><div class="popup">'+text+'</div></div>');
	$('.popup-outer').fadeIn(200);
	$('.popup-outer > .popup').animate({'opacity' : 1, 'margin-top' : 100});
	$('.popup-outer > .popup').click(function(e) { e.stopPropagation(); });
	$('.popup-outer').click(function() {
		$('.popup-outer > .popup').animate({'opacity' : 0, 'margin-top' : 0});
		$(this).fadeOut(200, function() {
			$(this).remove();
			
		});
	});
}

function clearer(id) {
	if(id.val().length > 0) {
		if ($('.input-clear#'+id.attr('id')).css('display') == 'none') {
			$('.input-clear#'+id.attr('id')).css({'display': 'inline', 'opacity': 0});
			$('.input-clear#'+id.attr('id')).animate({'opacity' : '1'}, 200);	
		};
	} else {
			$('.input-clear#'+id.attr('id')).animate({'opacity' : '0'}, 200, function() {
			$('.input-clear#'+id.attr('id')).css({'display': 'none'});
		});
	}
}

String.prototype.translit = (function(){
    var L = {
'А':'A','а':'a','Б':'B','б':'b','В':'V','в':'v','Г':'G','г':'g',
'Д':'D','д':'d','Е':'E','е':'e','Ё':'Yo','ё':'yo','Ж':'Zh','ж':'zh',
'З':'Z','з':'z','И':'I','и':'i','Й':'Y','й':'y','К':'K','к':'k',
'Л':'L','л':'l','М':'M','м':'m','Н':'N','н':'n','О':'O','о':'o',
'П':'P','п':'p','Р':'R','р':'r','С':'S','с':'s','Т':'T','т':'t',
'У':'U','у':'u','Ф':'F','ф':'f','Х':'Kh','х':'kh','Ц':'Ts','ц':'ts',
'Ч':'Ch','ч':'ch','Ш':'Sh','ш':'sh','Щ':'Sch','щ':'sch','Ъ':'j','ъ':'j',
'Ы':'Y','ы':'y','Ь':"j",'ь':"j",'Э':'E','э':'e','Ю':'Yu','ю':'yu',
'Я':'Ya','я':'ya', ' ':'_'
        },
        r = '',
        k;
    for (k in L) r += k;
    r = new RegExp('[' + r + ']', 'g');
    k = function(a){
        return a in L ? L[a] : '';
    };
    return function(){
        return this.replace(r, k);
    };
})();