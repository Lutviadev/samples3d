(function($){
    $.fn.Collector = function(settings){
        
    	var that = this;    	

        var config = {
            'name': 		'myCollector',
            'label': 		'Assigned to this group',
            'labelselected':'<i class="glyphicon glyphicon-briefcase"></i> Permissions',
            'emptyMessage':	'No briefcase assigned to this group',
            'select': 		'#selectCollection',
            'button': 		'#addToCollection',
            'ajaxurl':  	'home',
            'token': 		'',
            'options':      []
        };

        config.options = [
			['total.animation','Animation::All'], 
			['create.animation','Animation::Create'],
			['update.animation','Animation::Update'],
			['index.animation','Animation::View'],
			['delete.animation','Animation::Delete'],
			['total.render','Render::All'],
			['create.render','Render::Create'],
			['update.render','Render::Update'],
			['index.render','Render::View'],
			['delete.render','Render::Delete'],
			['total.tour','Tour::All'],
			['create.tour','Tour::Create'],
			['update.tour','Tour::Update'],
			['index.tour','Tour::View'],
			['delete.tour','Tour::Delete'],
			['total.portfolio','Portfolio::All'],
			['create.portfolio','Portfolio::Create'],
			['update.portfolio','Portfolio::Update'],
			['index.portfolio','Portfolio::View'],
			['delete.portfolio','Portfolio::Delete']
		];

        if (settings){$.extend(config, settings);}
        
        /**
		 * Check if collection if empty
		 *
		 * @param int id
		 */ 
        that.isEmpty = function(id)
        {
	        if($('#recipientOfCollections_'+id+' div').length > 0)
			{
				$('#emptyCollection_'+id).css('display','none');
				$('#recipientOfCollections_'+id+'').css('display','block');
			}
			else
			{
				$('#emptyCollection_'+id).css('display','block');
				$('#recipientOfCollections_'+id).css('display','none');
			}
        };

        /**
		 * Get complete collection
		 *
		 * @param int id
		 * @param string ajaxone
		 * @param string ajaxtwo
		 */         
        that.getCollection = function(id , ajaxone, ajaxtwo)
        {        	
        	var dataone = {
		    	"_token": config.token,
	  			"id": id
			};
			
        	$.ajax({
				type: "POST",
				url: (ajaxone).replace('%7Bgroup%7D', id),
				data: dataone,
				success: function(responseone)
				{
					var responsedataone = jQuery.parseJSON(responseone);						

					for (var i = 0; i < responsedataone.length; i++) 
					{											
						var datatwo = {
							"_token": config.token,
							"id": id,
							"idbriefcase": responsedataone[i]
						};

						$.ajax({
							type: "POST",
							url: (ajaxtwo).replace('%7Bgroup%7D', id),
							data: datatwo,
							success: function(responsetwo)
							{
								var permissionsarray = [];
								var responsedatatwo = jQuery.parseJSON(responsetwo);																							

								for (var t = 0; t < responsedatatwo.length; t++) 
								{
									permissionsarray[t]=responsedatatwo[t];
								};	

								var getid = this.data.split('=');

								that.addToCollection(getid[3], permissionsarray);						
							}
						});						
					};
				}
			})
        }

        /**
		 * Add to collection
		 *
		 * @param int id
		 * @param array permissionsarray
		 */        
        that.addToCollection = function(id , permissionsarray)
		{
			if(jQuery.inArray(id, config.idCollection) < 0 && id > 0)
			{
			    var data = {
			    	"_token": config.token,
		  			"id": id
				};						

				$.ajax({
					type: "POST",
					url: (config.ajaxurl).replace('%7Bid%7D', id),
					data: data,
					success: function(response)
					{
						var responsedata = jQuery.parseJSON(response);

						var elementCollected  = '<div class="alert alert-info elementCollected" id="'+config.name+'_'+id+'">';
							elementCollected += '<span class="titleCollected">'+responsedata.name+'</span>';
							elementCollected += '<i class="glyphicon glyphicon-trash removeFromCollection" id="removeFromCollection_'+config.idCollector+'" data-id="'+id+'"></i>';
							elementCollected += '<br><span class="ptitleCollected">'+config.labelselected+'</span>';
							elementCollected += '<select multiple="multiple" name="permissions['+id+'][]" id="'+config.name+'_ms_'+id+'">';

							for (var i = 0; i < config.options.length; i++) 
							{
								var selected = '';
								if(jQuery.inArray(config.options[i][0], permissionsarray) >= 0)
								{
									selected = 'selected';	
								}
								elementCollected += '<option value="'+config.options[i][0]+'" '+selected+'>'+config.options[i][1]+'</option>';								
							};				

							elementCollected += '</select>';
							elementCollected += '<input type="hidden" name="'+config.name+'[]" value="'+id+'">';
							elementCollected += '</div>';
							elementCollected = $(elementCollected);

						config.idCollection[id] = id.toString();
						
						$('#recipientOfCollections_'+config.idCollector).append(elementCollected);

						$('#'+config.name+'_ms_'+id).multiSelect()
						$('.removeFromCollection').unbind().click(function(event){ that.removeFromCollection($(this).data('id')) }).clearQueue();
						
						that.isEmpty(config.idCollector);
					
					}
				});
			}
		}

		/**
		 * Remove Collection
		 *
		 * @param int id
		 */
		that.removeFromCollection = function(id)
		{
			$('#'+config.name+'_'+id).remove();
			config.idCollection[id] = null;
			that.isEmpty(config.idCollector);
		}        
	 
        return this.each(function()
        {			
    		config.idCollector = 1;
    		var htmlCollector = '<label>'+config.label+'</label>';	
        		htmlCollector += '<div class="alert alert-danger" style="margin-bottom: 0px;" role="alert" id="emptyCollection_'+config.idCollector+'"><i class="glyphicon glyphicon-info-sign"></i> '+config.emptyMessage+'</div>';	
        		htmlCollector += '<div class="recipientOfCollections" id="recipientOfCollections_'+config.idCollector+'"></div>';
            
        	config.idCollection = [];		

            var element = $(this);
            	element.append(htmlCollector);        

            $(config.button).click(function(event){ that.addToCollection($(config.select).val()) });     
        });
    };
})(jQuery);