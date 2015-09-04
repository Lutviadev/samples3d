jQuery(document).ready(function($)
{
	console.log('jq live!');

	/*
	 * Flash messages
	 */
	$('[role="flash.success"]').delay( 300 ).animate({'top': '0px'}, 200).delay( 3000 ).animate({'top': '-54px'}, 500);	

	/*
	 * Navbar
	 */
	$('.navbar-locker').css('right', ($('.navbar-userdata').width() + 20) );

	/*
	 * Side Bar
	 */
	menuCollapser = new Sidebar();

	/*
	 * User menu Smooth
	 */
	$('.dropdown-user').on('click', function() {
		$('.dropdown-user-menu').slideToggle(200);
		menuCollapser.close();
	});

	/*
	 * css.class para cerrar dropdown abiertos sin boostrap
	 */
	$('.close-hover-dropdown-no-boots').on('mouseover', function()
	{
		if($('.dropdown-no-boots').css('display') == 'block')
		{
			$('.dropdown-no-boots').slideToggle(200).clearQueue();
		}
	});

	$('.close-click-dropdown-no-boots').on('click', function()
	{
		if($('.dropdown-no-boots').css('display') == 'block')
		{
			$('.dropdown-no-boots').slideToggle(200).clearQueue();
		}
	});

	/*
	 * Multiselects
	 */
	$('.resource_multiselect').multiSelect(
	{
		afterSelect:function(value)
		{
			values = $('.multi-empty').val();

			if(values != undefined)
			{
				values = values+','+value;
				$('.multi-empty').val(values);
			}
		},
		afterDeselect:function(value)
		{
			values = $('.multi-empty').val();

			if(values != undefined)
			{
				values = values.replace(','+value, '');
				$('.multi-empty').val(values);
			}
		}
	});
});

/*
 * Selects categories
 */
function ajaxcategories(main, cat, route, txt)
{
	if(txt == undefined)
	{
		txt = 'Please Select ...';
	}

	$.ajax({
		url: route,
		type: 'POST',
		data: {
			"idmain": main,
			"idcat": cat
		}
	}).done(function(response)
	{
		var options = jQuery.parseJSON(response);
		var select = $('.categoryselect');
		var input = '';
		var selected = '';

		select.find('option').remove();

		if($('.subcategoryselect').length != 0)
		{
			$('.subcategoryselect').find('option').remove();
			$('.subcategoryselect').append('<option value="">'+txt+'</option>');
		}

		select.append('<option value="">'+txt+'</option>');

		for (var i = 0; i <= options.length-1; i++)
		{
			if(options[i]['id'] == cat)
			{
				selected = 'selected="selected"';
			}
			else
			{
				selected = '';
			}

			input = '<option value="'+options[i]['id']+'" '+selected+'>'+options[i]['name']+'</option>';
			select.append(input);
		};

		if(cat == null)
		{
			select.focus();
		}
	});
}

/*
 * Selects subcategories
 */
function ajaxsubcategories(main, cat, sub, route, txt)
{
	if(txt == undefined)
	{
		txt = 'Please Select ...';
	}

	$.ajax({
		url: route,
		type: 'POST',
		data: {
			"idmain": main,
			"idcat": cat,
			"idsubcat": sub,
		}
	}).done(function(response)
	{
		var options = jQuery.parseJSON(response);
		var select = $('.subcategoryselect');
		var input = '';
		var selected = '';

		select.find('option').remove();

		select.append('<option value="">'+txt+'</option>');

		for (var i = 0; i <= options.length-1; i++)
		{
			if(options[i]['id'] == sub)
			{
				selected = 'selected="selected"';
			}
			else
			{
				selected = '';
			}

			input = '<option value="'+options[i]['id']+'" '+selected+'>'+options[i]['name']+'</option>';
			select.append(input);
		};

		if(sub == null)
		{
			select.focus();
		}
	});
}


//Vimeo modal src

function vimeo(id)
{
	$('#vimeoModal').on('hide.bs.modal', function ()
	{
		$('#vimeoplayer').attr('src','');
	})

	$('#vimeoModal').on('show.bs.modal', function ()
	{
		$('#vimeoplayer').attr('src', 'https://player.vimeo.com/video/'+id+'?autoplay=1&color=0bbfa7&byline=0');
	})
}