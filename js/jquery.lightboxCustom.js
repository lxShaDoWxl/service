$(document).ready(function(){
	$('a.btn-zoom,a.btn-request,input.btn-request').simplebox();
});

(function($) {
	$.fn.simplebox = function(options) { 
		return new Simplebox(this, options); 
	};
	
	function Simplebox(context, options) { this.init(context, options); };
	
	Simplebox.prototype = {
		options:{},
		init: function (context, options){
			this.options = $.extend({
				duration: 300,
				linkClose: 'a.close, a.btn-close',
				divFader: 'fader',
				faderColor: 'black',
				opacity: 0.7,
				wrapper: '#wrapper',
				linkPopup: '.link-popup'
			}, options || {});
			this.btn = $(context);
			this.select = $(this.options.wrapper).find('select');
			this.initFader();
			this.btnEvent(this, this.btn);
		},
		btnEvent: function($this, el){
			el.click(function(){
				if ($(this).attr('href')) $this.toPrepare($(this).attr('href'));
				else $this.toPrepare($(this).attr('title'));
				return false;
			});
		},
		calcWinWidth: function(){
			this.winWidth = $('body').width();
			if ($(this.options.wrapper).width() > this.winWidth) this.winWidth = $(this.options.wrapper).width();
		},
		toPrepare: function(obj){
			this.popup = $(obj);
			this.btnClose = this.popup.find(this.options.linkClose);
			this.submitBtn = this.popup.find(this.options.linkPopup);
			
			if ($.browser.msie) this.select.css({visibility: 'hidden'});
			this.calcWinWidth();
			this.winHeight = $(window).height();
			this.winScroll = $(window).scrollTop();
			
			this.popupTop = this.winScroll + (this.winHeight/2) - this.popup.outerHeight(true)/2;
			if (this.popupTop < 0) this.popupTop = 0;
			this.faderHeight = $(this.options.wrapper).outerHeight();
			if ($(window).height() > this.faderHeight) this.faderHeight = $(window).height();
			
			this.popup.css({
				top: this.popupTop,
				left: this.winWidth/2 - this.popup.outerWidth(true)/2
			}).hide();
			this.fader.css({
				width: this.winWidth,
				height: this.faderHeight
			});
			this.initAnimate(this);
			this.initCloseEvent(this, this.btnClose, true);
			this.initCloseEvent(this, this.submitBtn, false);
			this.initCloseEvent(this, this.fader, true);
		},
		initCloseEvent: function($this, el, flag){
			el.click(function(){
				$('body > div.outtaHere').removeClass('optionsDivVisible').addClass('optionsDivInvisible')
				$this.popup.fadeOut($this.options.duration, function(){
					$this.popup.css({left: '-9999px'}).show();
					if ($.browser.msie) $this.select.css({visibility: 'visible'});
					$this.submitBtn.unbind('click');
					$this.fader.unbind('click');
					$this.btnClose.unbind('click');
					$(window).unbind('resize');
					if (flag) $this.fader.fadeOut($this.options.duration);
					else {
						if ($this.submitBtn.attr('href')) $this.toPrepare($this.submitBtn.attr('href'));
						else $this.toPrepare($this.submitBtn.attr('title'));
					}
				});
				return false;
			});
		},
		initAnimate:function ($this){
			$this.fader.fadeIn($this.options.duration, function(){
				$this.popup.fadeIn($this.options.duration);
			});
			$(window).resize(function(){
				$this.calcWinWidth();
				$this.popup.animate({
					left: $this.winWidth/2 - $this.popup.outerWidth(true)/2
				}, {queue:false, duration: $this.options.duration});
				$this.fader.css({width: $this.winWidth});
			});
		},
		initFader: function(){
			if ($(this.options.divFader).length > 0) this.fader = $(this.options.divFader);
			else{
				this.fader = $('<div class="'+this.options.divFader+'"></div>');
				$('body').append(this.fader);
				this.fader.css({
					position: 'absolute',
					zIndex: 999,
					left:0,
					top:0,
					background: this.options.faderColor,
					opacity: this.options.opacity
				}).hide();
			}
		}
	}
}(jQuery));