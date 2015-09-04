(function($){
    $.fn.ImageManager = function(settings)
    {
        var that = this;

        var config = {
            'mode': 'multy',
            'input': $('.fileinput'),
            'responseinput': $('.responseinput'),
            'gallery': $('#gallery'),
            'index': 0,
            'numFiles': 0,
            'alltags': '',
            'thumbroute':'',
            'empty':'<div class="isempty">Use filters to search.</div>',
            'nofound':'<div class="isempty">No results found. Try another filter combination.</div>',
            'matrix': [],
            'tipo':'render',
            'inputname':'',
            'myme':''
        };

        if (settings){$.extend(config, settings);}

        /**
		 * Feedback about quantity of images in gallery
		 */
        that.feedback = function()
		{
			var images = config.gallery.find('.imagebox').length,
				log = images > 1 ? images + ' files selected' : images + ' file selected';
				log = images == 0 ? '' : log;

			if(config.mode == 'check')
			{
				$('.isempty').remove();
			}

			config.responseinput.val(log);
		}

		that.setMatrix = function(data)
		{
			config.matrix = data;
		}

		that.getMatrix = function()
		{
			return config.matrix;
		}

		that.addFunctions = function()
		{
			switch(config.mode)
			{
				case 'multy':
					$('.tagme').tagsinput(
					{
						trimValue: true,
						freeInput: true,
						typeahead:
						{
							source: config.alltags,
							displayText: function(item){ return item; }
						}
					});
					break;
			}

			if(config.mode != 'check')
			{
				$('.removeimage').click(function(event)
				{
					target = $(this).data('image');

					$('#'+target).remove();

					that.feedback();
				});

				$('.remove').click(function(event)
				{
					target = $(this).data('id');

					$('#thumbox-'+target).remove();

					that.feedback();
				});
			}

			if(config.tipo == 'anim')
			{
				$('.openvimeo').click(function(event)
				{
					$.ajax({
						url: config.vimeo,
						type: 'GET',
						data: {id: $(this).data('vimeo')}
					})
					.done(function(response)
					{
						if(response.search('DOCTYPE') == -1)
						{
							$('#vimeoplayer').attr('src', 'https://player.vimeo.com/video/'+response+'?autoplay=1&color=0bbfa7&byline=0');

							$('#vimeoModal').on('hide.bs.modal', function ()
							{
								$('#vimeoplayer').attr('src','');
							})

							$('#vimeoModal').on('show.bs.modal', function ()
							{
								$('#vimeoplayer').attr('src', 'https://player.vimeo.com/video/'+response+'?autoplay=1&color=0bbfa7&byline=0');
							})
						}
					});
				});
			}

			that.feedback()
		}

		that.reset = function()
		{
			if(config.mode == 'check' || config.mode == 'image' || config.mode == 'single')
			{
				config.gallery.find('.thumb-box').remove();
			}
			else
			{
				config.gallery.find('.imagebox').remove();
			}
		}

		that.isEmpty = function()
		{
			config.gallery.find('.isempty').remove();
			that.reset();
			config.gallery.append(config.empty);
		}

		that.notFound = function()
		{
			config.gallery.find('.isempty').remove();
			that.reset();
			config.gallery.append(config.nofound);
		}

		that.getHtml = function(name, img, title, description, tags, path)
		{
			imagebox = '';

			switch(config.mode)
			{
				case 'single':
					imagebox += '<div class="thumb-box '+config.myme+'" id="imagebox-'+config.index+'">';

					if(img * 0 == 0)
					{
						big = config.thumbroute+'/'+img+'/1000';
						path = config.thumbroute+'/'+img+'/200/200';

						imagebox += '<input type="text" name="images[]" value="'+img+'" style="display:none;">';
						imagebox += '<a href="'+big+'" target="_blank" class="thumb" style="background-image:url('+path+');"></a>';
					}
					else
					{
						path = img;

						imagebox += '<div class="thumb" style="background-image:url('+path+')">';
						imagebox += '<input type="hidden" name="images['+name+'][name]" value="'+name+'"></input>';
						imagebox += '</div>';
					}

					imagebox += '<a class="removeimage" data-image="imagebox-'+config.index+'"><i class="material-icons">delete</i></a>'; 
					imagebox += '</div>';
					break;

				case 'check':

					selecteds = that.getMatrix();

					find = selecteds.indexOf(img);

					if (find > -1)
					{
						imagebox += '<div class="thumb-box" style="display:none">';
						imagebox += '<div class="thumb" style="background-image:url()">';
						imagebox += '<input class="check" type="checkbox" name="images[]" value="'+img+'" checked>';
						imagebox += '</div>';
						imagebox += '</div>';
					}
					else
					{
						path = config.thumbroute+'/'+img+'/113/113';
						big = config.thumbroute+'/'+img+'/1000';

						imagebox += '<div class="thumb-box">';
						imagebox += '<div class="thumb" style="background-image:url('+path+')">';
						imagebox += '<label class="btn btn-primary">';
						imagebox += '<input class="check" type="checkbox" name="images[]" value="'+img+'">';
  						imagebox += '</label>';
  						imagebox += '</div>';
  			  			imagebox += '<a href="'+big+'" target="_blank"><i class="material-icons">photo_library</i></a>';
						imagebox += '</div>';
					}
					break;

				case 'image':
					big = config.thumbroute+'/'+img+'/1000';
					path = config.thumbroute+'/'+img+'/113/113';

					imagebox += '<div class="thumb-box '+config.myme+'" id="thumbox-'+img+'">';

					switch(config.tipo)
					{
						case 'anim':
							imagebox += '<a href="javascript:void(0)" class="thumb openvimeo" style="background-image:url('+path+');" data-vimeo="'+img+'" data-toggle="modal" data-target="#vimeoModal"></a>';
							break;

						default:
							imagebox += '<a href="'+big+'" target="_blank" class="thumb" style="background-image:url('+path+')">';
							break;
					}

					switch(config.inputname)
					{
						case 'renders':
							imagebox += '<input class="check" type="hidden" name="renders[]" value="'+img+'">';
							break;

						case 'tours':
							imagebox += '<input class="check" type="hidden" name="tours[]" value="'+img+'">';
							break;

						case 'animations':
							imagebox += '<input class="check" type="hidden" name="animations[]" value="'+img+'">';
							break;

						default:
							imagebox += '<input class="check" type="hidden" name="images[]" value="'+img+'">';
							break;
					}

					imagebox += '</a>';
					imagebox += '<a class="remove" data-id="'+img+'"><i class="material-icons">delete</i></a>';
					imagebox += '</div>';
					break;

				default:

					pathern = img.split(':');
					big = '';

					if(pathern[0] != 'data')
					{
						big = config.thumbroute+'/'+img+'/1000';
						img = config.thumbroute+'/'+img+'/113/113';
					}

					imagebox += '<div id="imagebox-'+config.index+'" class="imagebox">';
					imagebox += '<div class="col-xs-24">';
					imagebox += '<div class="imagecase">';
					imagebox += '<div class="thumb-box">';

					if(big != '')
					{
						imagebox += '<a href="'+big+'" target="_blank" class="thumb" style="background-image:url('+img+');"></a>';
					}
					else
					{
						imagebox += '<div class="thumb" style="background-image:url('+img+')"></div>';
					}
					imagebox += '</div>';
					imagebox += '<i class="removeimage material-icons" data-image="imagebox-'+config.index+'">delete</i>';
					imagebox += '</div>';
					imagebox += '<div class="imagedata">';
					imagebox += '<div class="input-group">';
					imagebox += '<span class="input-group-addon">Title</span>';
					imagebox += '<input type="text" class="form-control" name="images['+name+'][title]" value="'+title+'"></input>';
					imagebox += '</div>';
					imagebox += '<div class="input-group">';
					imagebox += '<span class="input-group-addon">Description</span>';
					imagebox += '<input type="text" class="form-control" name="images['+name+'][description]" value="'+description+'"></input>';
					imagebox += '<input type="hidden" name="images['+name+'][name]" value="'+name+'"></input>';
					imagebox += '<input type="hidden" name="images['+name+'][path]" value="'+path+'"></input>';
					imagebox += '</div>';
					imagebox += '<div class="input-group">';
					imagebox += '<span class="input-group-addon">Tags</span>';
					imagebox += '<input type="text" class="tagme form-control" name="images['+name+'][tags]" value="'+tags+'"></input>';
					imagebox += '</div>';
					imagebox += '<span class="note"><i class="glyphicon glyphicon-info-sign"></i> Press [ENTER] after each tag</span>';
					imagebox += '</div>';
					imagebox += '</div>';
					imagebox += '</div>';
					imagebox += '</div>';
					break;
			}

		 	return imagebox;
		}

		that.addFile = function(file)
		{
			if (/^image/.test( file.type))
			{
				if(config.mode == 'single')
				{
					that.reset();
				}

				var reader = new FileReader();

				reader.readAsDataURL(file);

				reader.onload = function()
				{
					imagebox = that.getHtml(file.name, this.result, '', '', '', '', '');

				 	config.gallery.append(imagebox);

				 	that.addFunctions();

					config.index ++;
		        }
	    	}
		}

		that.addImage = function(image)
		{
			var title = image[0];
			var description = image[1];
			var img = image[2];
			var name = image[4].split('/'); name = name[2];
			var tags = image[3];
			var path = image[4];

			if(config.mode == 'single')
			{
				if(config.tipo != 'render')
				{
					that.reset();
				}
			}

		 	config.gallery.append(that.getHtml(name, img, title, description, tags, path));

		 	that.addFunctions();

			config.index ++;
		}

        return this.each(function()
        {
            config.input.change(function()
			{
				var files = config.input.get(0).files;

			 	totalFiles = config.numFiles + files.length;

				if (!window.FileReader) return;

				for (var i = 0; i < totalFiles; i++)
				{
					if(files[i] != undefined)
					{
						that.addFile(files[i]);
					}
				}
			});

            if(config.mode == 'check')
            {
            	config.gallery.append(config.empty);
            }

        });
    };
})(jQuery);