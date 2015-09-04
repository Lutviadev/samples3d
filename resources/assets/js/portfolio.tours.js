function portTour(search)
{	
	//Tour	
	
	$('.resource_multiselect_tourmodal').change(function(event) 
	{
		ImageManager.reset();
		$('#searchtourmodal').submit();					
	});

	$('.addtourmodal').click(function(event) 
	{
		put2 = true;		
		$('#searchtourmodal').submit();
	});

	$('#searchtourmodal').submit(function(event) 
	{		
		event.preventDefault();

		that = this;

		if(put2)
		{
			put2 = false;

			ImageManager5.reset();

			for (var i = 0; i < selected_2.length; i++) 
			{				
				ImageManager5.addImage(['','',selected_2[i],'','']);				
			};
			
			ImageManager3.setMatrix(selected_2);

			ImageManager3.reset();

			$('.remove').click(function(event) 
			{			
				id = $(this).data('id')+'';

				$('#thumbox-'+id).remove();

				find = selected_2.indexOf(id);

				if (find > -1) 
				{
				    selected_2.splice(find, 1);
				}				

				ImageManager3.setMatrix(selected_2);

				put2 = false;

				ImageManager3.reset();

				$('#searchtourmodal').submit();

			}).bind();

			$('#tourmodal').modal('toggle');
		}
		else
		{
			var formData = {
	            'tags': $('.resource_multiselect_tourmodal').val()
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
					ImageManager3.isEmpty();
				}
				else
				{
					if(data.images.length <= 0 )
					{
						ImageManager3.notFound();
					}
					else
					{
						for (var i = 0; i < data.images.length; i++) 
						{
							ImageManager3.addImage([data.images[i].title,'',data.images[i].id,'','']);
						};

						$('.check').click(function(event) 
						{									
							manageIM_ids_2(event, selected_2);			

						}).bind();	
					}
				}			
			})	
		}	

	});

	function manageIM_ids_2(event, iM_ids_2)
	{
		id = $(event.target)[0].value;

		find = iM_ids_2.indexOf(id);

		if($(event.target)[0].checked)
		{
			added = false;

			for (var i = 0; i <= iM_ids_2.length; i++)
			{
				if(iM_ids_2[i] == undefined && !added)
				{
					iM_ids_2[i] = id;
					added = true;
				}
			};

			if(!added)
			{
				iM_ids_2[iM_ids_index_2] = id;
				iM_ids_index_2++;
			}
		}
		else
		{
			if (find > -1)
			{
			    iM_ids_2.splice(find, 1);
			}
		}

		if(iM_ids_2.length != 0)
		{
			$('.addtourmodal').css('display', 'inline');
		}
		else
		{
			$('.addtourmodal').css('display', 'none');
		}
	}

};