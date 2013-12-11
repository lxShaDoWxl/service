// *** Easy window *************************************************************

	function prevent(e) {
		if (e.stopPropagation) e.stopPropagation();
		else e.cancelBubble = true;
		
		return false;
	}
		/**
		 * Запрет / разрешение выделения
		 *
		 */
		$.fn.disableSelection = function( b ) {

			function preventDefault () {return false;}

			if ( !b ) {
				this.func = preventDefault;
				this.oldSl = this.onselectstart||null;
				this.unSl = $(this).attr('unselectable');

				$(this).attr('unselectable', 'on')
					.css('-moz-user-select', 'none')
					.css('-khtml-user-select', 'none')
					.css('-o-user-select', 'none')
					.css('-msie-user-select', 'none')
					.css('-webkit-user-select', 'none')
					.css('user-select', 'none')
					.bind('mousedown', this.func)
					.each(function() {
						this.onselectstart = preventDefault;
					});
			} else {

			$(this).attr('unselectable', this.unSl);
			$(this).css('-moz-user-select', '')
				.css('-khtml-user-select', '')
				.css('-o-user-select', '')
				.css('-msie-user-select', '')
				.css('-webkit-user-select', '')
				.css('user-select', '')
				.unbind('mousedown', this.func).each(function() {
					try{this.onselectstart = this.oldSl;}catch(e){}
				});

			this.func = null;
			this.oldSl = null;
			this.unSl = null;
			}
		};

/**
 *	TODO: не доделано как следует...
 */
var $window = new (function($){

		/**
		 * ID открытых окон
		 */
	var win =  {};
	var autoincrement = 1;

	var vars = ({

		focused: null,
		
		timeFadeIn: 200,
		timeFadeOut: 50,

		marginSide: 10,
		marginTop: 20,

		baseIndex: 1980

		});

	this.getID = function(){ return autoincrement++; };
	
	/**
	 * Проверить присутствие в массиве открытых окон элемента с данным id
	 */
	this.seek = function ( id ) {
		for(var k in win) {
			if ( win[k].id == id ) {
				return k;
			}
		}
	return null;
	}
	this.kill = function( id ){ delete win[id]; };

	var calculateSize = function ( wnd, params, px ){

		px = px||'';
		var scr = ({
			width	: $(window).width(),
			height	: $(window).height()
		});
		var scrolltop = $('html,body');
			scrolltop = scrolltop.scrollTop();	// тукущий параметр прокрутки

		var ie = $.browser.msie;// '\v'=='v';

		var obj = {};

		obj.width = scr.width - (vars.marginSide*2) - ( parseInt(wnd.css('marginLeft')) + parseInt(wnd.css('marginRight')) + parseInt(wnd.css('paddingLeft')) + parseInt(wnd.css('paddingRight')) + parseInt(wnd.css('borderLeftWidth')) + parseInt(wnd.css('borderRightWidth')) );
		obj.height = scr.height - vars.marginTop - (vars.marginSide*2) - ( parseInt(wnd.css('marginTop')) + parseInt(wnd.css('marginBottom')) + parseInt(wnd.css('paddingTop')) + parseInt(wnd.css('paddingBottom')) + parseInt(wnd.css('borderTopWidth')) + parseInt(wnd.css('borderBottomWidth')) );

		obj.left = vars.marginSide + px;
		obj.top = vars.marginSide + vars.marginTop + ( ie? scrolltop:0 ) +px;

			if ( typeof(params.maxHeight) != 'undefined' && params.maxHeight && obj.height>params.maxHeight ) {

					obj.top = Math.round((scr.height - params.maxHeight) /2) + px;
					obj.height = params.maxHeight;
				}
			if ( typeof(params.maxWidth) != 'undefined' && params.maxWidth && obj.width>params.maxWidth ) {

					obj.left = Math.round((scr.width - params.maxWidth) /2) + px;
					obj.width = params.maxWidth;
				}
		obj.width = (!obj.width? (scr.width-30):obj.width) + px;
		obj.height = !obj.height? (scr.height-30):obj.height + px;

		return obj;
	}
	/**
	 * Создаёт новое окно с уникальным DOM id (если отсутствует)
	 *
	 * @param Object params
	 *				Входные параметры окна
	 *				{
	 *				id: (строка, DOM идентификатор окна ),
	 *				[header]: (строка, заголовок окна),
	 *
	 *					// далее вызов функций, с параметром DOM id окна.
	 *				[resize]: (функция, срабатывает когда окно браузера изменяет свои размеры),
	 *				[load]: (функция, вызывается после полного формирования окна в элементах DOM),
	 *				[close]: (функция, вызывается при закрытии окна),
	 *
	 *				[html]: (строка, html содержание окна),
	 *
	 *				[...more other parameters...] : ( if just not used now - each will be saved )
	 *				}
	 */
	this.open = function ( params ){

		if ( !params || typeof params != 'object' ) return null;
		if ( !params.id ) return null;

		var _sk = this.seek( params.id );
		if ( _sk !== null ) {			
			if ( !!win[_sk].focus ) this.focus( $('#' + _sk), _sk );
			return null;
		}

		var winIDNum = this.getID();
		var winID = 'window' + winIDNum;
		var modal = '', movement = '';

		if ( !!params.modal && !$('div.window-modal').length ) modal = '<div class="window-modal"></div>';

		if ( !!params.movement ) movement = '<div class="window-mover"></div>';

		var windws = $( modal + '<div id="' + winID + '" class="window-wrapper"><div class="window-close" title="Закрыть" unselectable="on">&times;</div><div class="window-header">' + (params.header||'') +
					'</div>'+movement+'<div id="' + params.id + '" class="window-content"></div></div>').appendTo('body');
//<div class="window-map-content-gag"></div>

		var wnd = $('#' + winID);
		var close = wnd.find('div.window-close').eq(0);
		var header = wnd.find('div.window-header').eq(0);
		var content = wnd.find('div.window-content').eq(0);

			var sz = calculateSize( wnd, params );

		var ie = (document.all && !document.querySelector); //$.browser.msie;// '\v'=='v';

					var posit = ( ie? 'absolute':'fixed');

			if (!!params.modal) {

				winIDNum = 9999;

				var mdl = $('div.window-modal').eq(0);
				mdl.css({position: posit});
				$('body, div.wrapper').css({overflow: 'hidden' }); // body, // не очень корректно // , height: $(window).height()+'px'
				$('body').css('paddingRight', '18px');

				$(document).disableSelection( false );
			}

		wnd.css({
			position : posit,
			width : sz.width+'px',
			height : sz.height+'px',
			left : sz.left + 'px',
			top : sz.top + 'px',
			zIndex : vars.baseIndex + winIDNum
		}).fadeIn(vars.timeFadeIn, function(){
				if ( typeof(params.load) == 'function' ) {
					params.load( params.id, winID, wnd );
				}
			})


		var heightB = !sz.height? ($(window).height()-30):sz.height;

		content.height( heightB - vars.marginSide - header.height() +5 );//.css('marginTop', vars.marginSide + 'px');
		//wnd.find('div.window-map-content-gag').height( content.height() );
				// вешаем обработчик на закрытие окна

			
			var closer = function(){
				wnd.fadeOut( vars.timeFadeOut, function(){

					if ( typeof(params.close) == 'function' ) params.close( params.id );
					
					if ( !!params.modal && $('div.window-modal').length ) {

						$(document).disableSelection( true );

						var mdl = $('div.window-modal').eq(0);
							purge( mdl[0] );
							mdl.remove();
						$('body, div.wrapper').css({overflow: 'auto', height: 'auto'}); // body, // не очень корректно
						$('body').css('paddingRight', '0');
					}
					$window.kill( winID );

					if ( !!params.escClose ) $('body').unbind('keydown', escCloser);
					
						purge(this);
					$(this).remove();
				});
			};
			var escCloser = function(e){
				
				if ( (e||window.event).keyCode == 27 && vars.focused == winID ) closer();
			};

			close.click(closer);
			if ( !!params.escClose ) $('body').bind('keydown', escCloser);


				//if ( !!params.blur ) wnd.bind('blur', params.blur);
				
				if ( !!params.movement ) wnd.find('div.window-mover').bind('mousedown', $window.move);


			// сохраняем
			params.closeWindow = closer;
		win[winID] = params;

		wnd.find('div.window-content').html( params.html||'' );

		if ( !!params.focus ) {
			wnd.children().bind('mousedown', function(){ $window.focus(wnd, winID); });
			$window.focus(wnd, winID);
		}

		return [wnd, winID];
	};

	var bindingScroller = function ( disSel, func1, func2 ) {

			if ( !disSel ) {
				$($.browser.msie? document:window).bind('mouseup', func2).bind('mousemove', func1);
			} else {
				$($.browser.msie? document:window).unbind('mousemove', func1).unbind('mouseup', func2);
			}

			$(document).disableSelection( disSel );
		}

	this.focus = function(wnd, winID){
		
		wnd.css({ zIndex: vars.baseIndex + $window.getID() });
		vars.focused = winID;
		
		if ( typeof win[winID].focus == 'function' ) win[winID].focus( winID );
		
		for(var k in win) {
			if ( k != winID && !!win[k].blur ) win[k].blur( k );
		}
		//win[winID] = params;
	};
	this.move = function(e) { // onmousedown

			e = e||window.event;

		var t = this.parentNode;

		var id = $(t).attr('id');
		//win[ id ];

		var scrlMvStart = true;
		var p_=({
					x : e.clientX,
					y : e.clientY,
					left: parseInt(t.style.left),
					top: parseInt(t.style.top)
			});

		// можем добавить какой-нибудь класс
		$(t).addClass('moving');

		var scrlMoveEnd = function(){

				scrlMvStart = false;

				$(t).removeClass('moving');


				bindingScroller( !win[id].modal,  scrlMoveMove, scrlMoveEnd);
			};


			var scrlMoveMove = function(e){
				e = e||window.event;

				if ( scrlMvStart ) {

					// меняем только position
					t.style.left = (p_.left + e.clientX - p_.x) + 'px';
					t.style.top = (p_.top + e.clientY - p_.y) + 'px';

				}
			};

		bindingScroller( false,  scrlMoveMove, scrlMoveEnd);

	};

	this.close = function ( id ){

		if ( !!win[id] && win[id].closeWindow ) {
			win[id].closeWindow();
		}

	};


	this.resize = function (){

		var scr = ({
			width	: $(window).width(),
			height	: $(window).height()
		});

		var wnd, obj = {};

		for (var k in win) {


			wnd = $('#' + k);

			obj = calculateSize( wnd, win[k], 'px' );

			wnd.css(obj);

			wnd.find('div.window-content').eq(0).height( parseInt(obj.height) - vars.marginSide - wnd.find('div.window-header').eq(0).height() +5 );

			if ( typeof(win[k].resize) == 'function' ) win[k].resize( win[k].id );
			
			if ( !!win[k].modal ) $('div.wrapper').height(scr.height);
			
		}
	};

})(jQuery);
$(window).resize($window.resize);

			function purge(d) {
				var a = d.attributes, i, l, n;
				if (a) {
					for (i = a.length - 1; i >= 0; i -= 1) {
						n = a[i].name;
						if (typeof d[n] === 'function') d[n] = null;
					}
				}
				a = d.childNodes;
				if (a) {
					l = a.length;
					for (i = 0; i < l; i += 1) purge(d.childNodes[i]);
				}
			}


//*** Переопределяем alert'ы всякие там... *************************************

var _alert = window.alert, _confirm = window.confirm, _prompt = window.prompt;

window.alert = function( str, header, nospec, small ) {

	str = (str||'').toString();

	if ( !nospec ) {
		str = str.replace(/\n/g, '<br/>');
		str = str.replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;');
	}
	
	var buttons = '<div class="window-buttons"><input type="button" name="OK" value="OK" /></div>';

	if ( !header ) header = document.URL.substring( document.URL.indexOf('/')+2, document.URL.indexOf('/', document.URL.indexOf('/')+2 ) );

	//*** The button ***********************************************************

	str += buttons;

	var wnd = $window.open({id: (new Date).getTime(),header: header, maxHeight: 170, maxWidth: 380, html: '<div'+(!small?'':' class="small-font"')+'>'+str+'</div>',movement: true, modal: true});

	var keyOK = null;
	
	var keyHandler = function(e){
		
		e = e||window.event;
		var _k = e.keyCode;
		
			switch(e.type){
				case 'keypress':
					break;
				case 'keydown':
						switch ( _k ) {
							case 13:
							case 27:
									$window.close( wnd[1] );
								break;
						};
					break;
				case 'keyup':
					break;
			}
		return prevent(e);
	};

	wnd[0].find('input[name="OK"]').click( function(){ $window.close( wnd[1] ) }).focus().keydown(keyHandler).keypress(keyHandler).keyup(keyHandler);
}

window.confirm = function( str, func, header, nospec ) {

	str = (str||'').toString();

	if ( !nospec ) {
		str = str.replace(/\n/g, '<br/>');
		str = str.replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;');
	}

	var buttons = '<div class="window-buttons"><input type="button" name="OK" value="OK" /><input type="button" name="CANCEL" value="Отмена" /></div>';

	if ( !header ) header = document.URL.substring( document.URL.indexOf('/')+2, document.URL.indexOf('/', document.URL.indexOf('/')+2 ) );

	//*** The button ***********************************************************
	func = (func||(function(){}));

	str += buttons;

	var wnd = $window.open({id: (new Date).getTime(),header: header, maxHeight: 170, maxWidth: 300, html: '<div>'+str+'</div>',movement: true, modal: true });
	
	var keyOK = null, keyCANCEL = null;
	
	var keyHandler = function(e){
		
		e = e||window.event;
		var _k = e.keyCode;
		
			switch(e.type){
				case 'keypress':
					break;
				case 'keydown':
						switch ( _k ) {
							case 9:		// tab
									if ( this.name == 'OK' ) keyCANCEL.focus();
									else keyOK.focus();
								break;
							case 13:
									if ( this.name == 'OK' ) func();
							case 27:
									$window.close( wnd[1] );
								break;
						};
					break;
				case 'keyup':
					break;
			}
		return prevent(e);
	};

	keyCANCEL = wnd[0].find('input[name="CANCEL"]').click( function(){ $window.close( wnd[1] ) }).focus().keydown(keyHandler).keypress(keyHandler).keyup(keyHandler);
	keyOK = wnd[0].find('input[name="OK"]').click( function(){ $window.close( wnd[1] ); func(); }).keydown(keyHandler).keypress(keyHandler).keyup(keyHandler);
}

window.prompt = function( str, func, header, nospec ) {

	str = (str||'').toString();

	if ( !nospec ) {
		str = str.replace(/\n/g, '<br/>');
		str = str.replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;');
	}

	var buttons = '<div class="window-buttons"><input type="button" name="OK" value="OK" /><input type="button" name="CANCEL" value="Отмена" /></div>';

	if ( !header ) header = document.URL.substring( document.URL.indexOf('/')+2, document.URL.indexOf('/', document.URL.indexOf('/')+2 ) );

	//*** The button ***********************************************************
	func = (func||(function(){}));

	str += '<div class="window-prompt"><input type="text" name="PROMPT" value="" /></div>';

	str += buttons;

	var wnd = $window.open({id: (new Date).getTime(),header: header, maxHeight: 170, maxWidth: 300, html: '<div>'+str+'</div>',movement: true, modal: true });

	var keyOK = null, keyCANCEL = null, keyTEXT = null;
	
	var keyHandler = function(e){
		
		e = e||window.event;
		var _trigger = false, _k = e.keyCode;
		
			switch(e.type){
				case 'keypress':
						if ( this.name == 'PROMPT' ) _trigger = true;
					break;
				case 'keydown':
						switch ( _k ) {
							case 9:		// tab
									if ( this.name == 'OK' ) keyCANCEL.focus();
									else if ( this.name == 'CANCEL' ) keyTEXT.focus();
									else if ( this.name == 'PROMPT' ) keyOK.focus();
								break;
							case 13:
									if ( this.name == 'OK' || this.name == 'PROMPT' ) func( keyTEXT.val() );
							case 27:
									$window.close( wnd[1] );
								break;
							case 9: // tab
							case 112: case 113: case 114: case 115: case 116: case 117: case 118:
							case 119: case 120: case 121: case 122: case 123:
								break;
							default:
								_trigger = true;
						};
					break;
				case 'keyup':
					break;
			}
		prevent(e);
		return _trigger;
	};

	keyCANCEL = wnd[0].find('input[name="CANCEL"]').click( function(){ $window.close( wnd[1] ) }).keydown(keyHandler).keypress(keyHandler).keyup(keyHandler);
	keyOK = wnd[0].find('input[name="OK"]').click( function(){ $window.close( wnd[1] ); func( keyTEXT.val() ); }).keydown(keyHandler).keypress(keyHandler).keyup(keyHandler);

	keyTEXT = wnd[0].find('input[name="PROMPT"]').focus().keydown(keyHandler).keypress(keyHandler).keyup(keyHandler);
}


		// получить объект, в котором возникло событие
		function getEventTarget(e) {

			e = e||window.event;
			var target = e.target || e.srcElement;

			if ( typeof target == "undefined" ) return e; // передали this, а не event
			if ( target.nodeType == 3 ) target = target.parentNode;// боремся с Safari

			return target;
		}


		$(function(){
		
			var helper = function(){

				alert( $('#'+this.name).html(), '', true );
				return!1;
			}
			$('a.icon-help').click(helper);
		})