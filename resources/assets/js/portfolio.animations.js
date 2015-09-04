function portAnim(search)
{
	$('.resource_multiselect_animationmodal').change(function(event)
	{
		ImageManager4.reset();
		$('#searchanimationmodal').submit();
	});

	$('.addanimationmodal').click(function(event)
	{
		put3 = true;
		$('#searchanimationmodal').submit();
	});

	$('#searchanimationmodal').submit(function(event)
	{
		event.preventDefault();

		that = this;

		if(put3)
		{
			put3 = false;

			ImageManager6.reset();

			for (var i = 0; i < selected_3.length; i++)
			{
				ImageManager6.addImage(['','',selected_3[i],'','']);
			};

			ImageManager4.setMatrix(selected_3);

			ImageManager4.reset();

			$('.remove').click(function(event)
			{
				id = $(this).data('id')+'';

				$('#thumbox-'+id).remove();

				find = selected_3.indexOf(id);

				if (find > -1)
				{
				    selected_3.splice(find, 1);
				}

				ImageManager4.setMatrix(selected_3);

				put3 = false;

				ImageManager4.reset();

				$('#searchanimationmodal').submit();

			}).bind();

			$('#animationmodal').modal('toggle');
		}
		else
		{
			var formData = {
	            'tags': $('.resource_multiselect_animationmodal').val()
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
					ImageManager4.isEmpty();
				}
				else
				{
					if(data.images.length <= 0 )
					{
						ImageManager4.notFound();
					}
					else
					{
						for (var i = 0; i < data.images.length; i++)
						{
							ImageManager4.addImage([data.images[i].title,'',data.images[i].id,'','']);
						};

						$('.check').click(function(event)
						{
							manageIM_ids(event, selected_3);

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
				iM_ids[iM_ids_index_2] = id;
				iM_ids_index_2++;
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
			$('.addanimationmodal').css('display', 'inline');
		}
		else
		{
			$('.addanimationmodal').css('display', 'none');
		}
	}
};