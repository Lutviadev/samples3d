function portRender(categories, subcategories, search)
{
	//Renders

	var matrix = selected;

	$('.maincategoryselect').change(function(event)
	{
		ajaxcategories($(this).val(), null, categories, 'All ...');
		$('.categoryselect').val('');
		$('.subcategoryselect').val('');
		ImageManager.reset();
		$('#searchrendermodal').submit();
	});

	$('.categoryselect').change(function(event)
	{
		ajaxsubcategories($('.maincategoryselect').val(), $(this).val(), null, subcategories, 'All ...');
		$('.subcategoryselect').val('');
		ImageManager.reset();
		$('#searchrendermodal').submit();
	});

	$('.subcategoryselect').change(function(event)
	{
		ImageManager.reset();
		$('#searchrendermodal').submit();
	});

	// Render

	$('.resource_multiselect_rendermodal').change(function(event)
	{
		ImageManager.reset();
		$('#searchrendermodal').submit();
	});

	$('.addrendermodal').click(function(event)
	{
		put = true;
		$('#searchrendermodal').submit();
	});

	$('#searchrendermodal').submit(function(event)
	{
		event.preventDefault();

		that = this;

		if(put)
		{
			put = false;

			ImageManager2.reset();

			for (var i = 0; i < matrix.length; i++)
			{
				ImageManager2.addImage(['','',matrix[i],'','']);
			};

			ImageManager.setMatrix(matrix);

			ImageManager.reset();

			$('.remove').click(function(event)
			{
				id = $(this).data('id')+'';

				$('#thumbox-'+id).remove();

				find = matrix.indexOf(id);

				if (find > -1)
				{
				    matrix.splice(find, 1);
				}

				ImageManager.setMatrix(matrix);

				put = false;

				ImageManager.reset();

				$('#searchrendermodal').submit();

			}).bind();

			$('#rendermodal').modal('toggle');
		}
		else
		{
			var formData = {
	            'maincategory'   : $('.maincategoryselect').val(),
	            'category'       : $('.categoryselect').val(),
	            'subcategory'    : $('.subcategoryselect').val(),
	            'tags'    		 : $('.resource_multiselect_rendermodal').val()
	        };

			$.ajax({
				url: search,
				type: 'POST',
				data: formData
			}).done(function(response)
			{
				data = jQuery.parseJSON(response);

				if(!data.images)
				{
					ImageManager.isEmpty();
				}
				else
				{
					if(data.images.length <= 0 )
					{
						ImageManager.notFound();
					}
					else
					{
						for (var i = 0; i < data.images.length; i++)
						{
							ImageManager.addImage([data.images[i].title,'',data.images[i].id,'','']);
						};

						$('.check').click(function(event)
						{
							manageIM_ids(event, matrix);

						}).bind();
					}
				}
			})
		}

	});

	function manageIM_ids(event, iM_ids)
	{
		id = $(event.target)[0].value;

		find = iM_ids.indexOf(id);

		if($(event.target)[0].checked)
		{
			added = false;

			for (var i = 0; i <= iM_ids.length; i++)
			{
				if(iM_ids[i] == undefined && !added)
				{
					iM_ids[i] = id;
					added = true;
				}
			};

			if(!added)
			{
				iM_ids[iM_ids_index] = id;
				iM_ids_index++;
			}
		}
		else
		{
			if (find > -1)
			{
			    iM_ids.splice(find, 1);
			}
		}

		if(iM_ids.length != 0)
		{
			$('.addrendermodal').css('display', 'inline');
		}
		else
		{
			$('.addrendermodal').css('display', 'none');
		}
	}
};