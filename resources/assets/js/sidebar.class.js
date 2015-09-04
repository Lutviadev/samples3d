var Sidebar = function () 
{	
	/*
	 *	Objetos
	 */
	this.obArrow = '.arrow-sidebar';
	this.obBotn = '.botn';
	this.obBotnlink = '.botn-link';
	this.obConten = '#content';
	this.obControls = '.sidebar-controller';
	this.obColapser = '.colapser-btn';
	this.obHeader = '#head';
	this.obListener = '.mobile-listener';
	this.obTarget = '#sidebar';
	this.obSubmenu = '.sub';
	this.obSlimScrollDiv = '.slimScrollDiv';
	this.obSlim = '.slim';
	this.obSlimScrollBar = '.slimScrollBar';
	this.obSeparador = '.separador';
	this.obBotnLinkToggler = '.botn-link-toggler';
	this.obDropDownNoBoots = '.dropdown-no-boots';

	/*
	 *	Variables
	 */
	this.target_width = $(this.obTarget).width();

	/*
	 *	Funciones privadas
	 */
	this._setController = _setController;	this._setController();
	this._setHeight = _setHeight;	this._setHeight();
	this._resize = _resize; this._resize();
	this._openSlide = _openSlide;
	this._closeSlide = _closeSlide;
	this.setActives = setActives(window.location.pathname);
	this.checkCookies = _checkCookies;

	/*
	 *	Funciones publicas
	 */
	this.close = close;

	this.checkCookies();

	}

	function _closeSlide(action)
	{
		var that = this;
		var newTargetWidth = that.target_width;

		switch(action)
		{
			case 'toggle':
				newPostion1 = -newTargetWidth;
				newPostion2 = newTargetWidth;
				newPostionC = '0px';					
			break;

			case 'minimize':
				newPostion1 = -(newTargetWidth-50);
				newPostion2 = newTargetWidth;
				newPostionC = '50px';
			break;
		}

		$(that.obControls).removeClass('max');
		$(that.obControls).addClass('min');
		$(that.obTarget).css('margin-left', newPostion1);					
		$(that.obConten).css('margin-left', newPostionC);
		$(that.obColapser).removeClass('glyphicon-circle-arrow-left');
		$(that.obColapser).addClass('glyphicon-circle-arrow-right');
		$(that.obBotn).removeClass('max');
		$(that.obBotn).addClass('min');
		$(that.obBotnlink).removeClass('botn-link-toggler');	
		$(that.obBotnlink).removeClass('open');
		$(that.obSubmenu).attr('style','');		
		$(that.obArrow).removeClass('glyphicon-triangle-bottom');
		$(that.obArrow).addClass('glyphicon-triangle-right');	
		$(that.obSlimScrollDiv).css('overflow','');
		$(that.obSlim).css('overflow','');					
		$(that.obSlimScrollBar).css('right','9999px');	
		$(that.obSeparador).css('display','none');

		Cookies.set('sidebar', 'closed');
	}

	function _openSlide(action)
	{
		var that = this;
		var newTargetWidth = that.target_width;

		switch(action)
		{
			case 'toggle':
				newPostion1 = -newTargetWidth;
				newPostion2 = newTargetWidth;
				newPostionC = '0px';					
			break;

			case 'minimize':
				newPostion1 = -(newTargetWidth-50);
				newPostion2 = newTargetWidth;
				newPostionC = '50px';
			break;
		}

		$(that.obControls).removeClass('min');
		$(that.obControls).addClass('max');
		$(that.obTarget).css('margin-left', '0px');							
		$(that.obConten).css('margin-left', newPostion2);
		$(that.obColapser).removeClass('glyphicon-circle-arrow-right');
		$(that.obColapser).addClass('glyphicon-circle-arrow-left');
		$(that.obBotn).removeClass('min');
		$(that.obBotn).addClass('max');
		$(that.obBotnlink).addClass('botn-link-toggler');
		$(that.obBotnlink).removeClass('open');
		$(that.obArrow).removeClass('glyphicon-triangle-right');
		$(that.obArrow).addClass('glyphicon-triangle-bottom');
		$(that.obSlimScrollDiv).css('overflow','hidden');
		$(that.obSlim).css('overflow','hidden');
		$(that.obSlimScrollBar).css('right','1px');
		$(that.obSeparador).css('display','block');	

		Cookies.set('sidebar', 'opened');
	}

	function _setController()
	{	
		var that = this;

		/*
		 *	Sidebar toggle/minimize
		 */
		$(that.obControls).click(function()
		{		
			if($(that.obTarget).css('margin-left') == '0px')
			{
				that._closeSlide($(this).data('action'));	
			}
			else
			{
				that._openSlide($(this).data('action'));
			}
		})	

		/*
		 *	Submenus
		 */
		$(that.obBotn).on('click', that.obBotnLinkToggler, function() 
		{			
			$(that.obBotnLinkToggler).removeClass('open');

			if($(this).parent().hasClass('max'))
			{
				subs = $(that.obSubmenu);

				for(i=0;i<=subs.length;i++)
				{
					if($(subs[i]).css('display') == 'block' && $(this).parent().children(that.obSubmenu).css('display') != 'block')
					{
						$(subs[i]).slideToggle(200)	
					}
				}

				$(this).parent().children(that.obSubmenu).slideToggle(200);
			}
			
			if($(this).parent().children(that.obSubmenu).css('height') == '1px')
			{			
				if(!$(this).hasClass('active'))
				{
					$(this).addClass('open');
				}
			}
		});	

		/*
		 *	Swipe mobil
		 */
		if(isMobile.any())
		{
			$(window).on("swiperight", function()
			{
				if($(that.obTarget).css('margin-left') != '0px')
				{
					$(that.obTarget).css('margin-left', '0px');
					$(that.obConten).css('margin-left', that.target_width);
				}		
				if($(that._dropdownNoBoot).css('display') == 'block')
				{
					$(that._dropdownNoBoot).slideToggle(200);
				}
			});

			$(window).on("swipeleft", function()
			{
				if($(that.obTarget).css('margin-left') == '0px')
				{
					$(that.obTarget).css('margin-left', -that.target_width);
					$(that.obConten).css('margin-left', '0px');
				}		
			});

			$(window).on("orientationchange", function()
			{  
				that._setHeight();
			})
		}
	}

	function _resize()
	{	
		var that = this;

		$(window).resize(function(event) 
		{
			that._setHeight()
		});
	}

	function _setHeight()
	{		
		var that = this;

		if(isMobile.any())
		{
			windowHeight = screen.height;
		}
		else
		{
			windowHeight = $(window).height();
		}

		headerHeight = $(that.obHeader).height();	
		sidebarHeight = windowHeight - headerHeight;

		$(that.obSlimScrollDiv).css('height',sidebarHeight);
		$(that.obTarget).css('height',sidebarHeight);

		$(that.obSlim).slimscroll({
	        height: sidebarHeight,
	        size: '4px'
	    });
	}

	function close()
	{
		var that = this;

		var mq = window.matchMedia( "(min-width: 992px)" );
		if(mq.matches)
		{
			action = 'minimize';
		}
		else
		{
			action = 'toggle';	
		}	

		that._closeSlide(action);
	}

	function setActives(uri)
	{
        uriParts = uri.split('/');

        boton = '#menu_'+uriParts[1]+' .botn-link';
        submenu = '#menu_'+uriParts[1]+' .sub';

        if(uriParts[2])
        {
            submenuboton = submenu+' .'+uriParts[2];
        }
        else
        {
            submenuboton = submenu+' .list';
        }            

        $(boton).addClass('active');
        $(submenu).addClass('active');
        $(submenuboton).addClass('active');
	}

	function _checkCookies()
	{
		if(Cookies.get('sidebar') == 'closed')
		{
			this._closeSlide('minimize');
		}
	}