<!-- Modal -->
<div class="modal fade" id="{{ $search }}" tabindex="-1" role="dialog" aria-labelledby="{{ $search }}lLabel">
    <div class="modal-dialog fullwidht" role="document">
        <div class="{{ $search }} modal-content">
            {!! Form::open(['method' => 'POST', 'route' => 'render_search', 'id'=> 'search'.$search , 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="{{ $search }}Label"><i class="material-icons">wallpaper</i> {{ $name }}</h4>
            </div>
            <div class="modal-body">
                
                <table width="100%">
                    <tr>
                        <td valign="top" width="420">
                            <div class="tagslong form-group">    
                                {!! Form::label('tags', 'Tags') !!}

                                <br> <span class="multi-sublabel">Selected</span>
                                <div class="input-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-indent-left"></i></span>                           
                                        {!! Form::select('tags[]',$tags, null, ['class' => 'resource_multiselect resource_multiselect_'.$search.' bigmulti form-control', 'multiple']) !!}                     
                                </div>  
                                {!! $errors->first('tags' ,'<small class="text-danger">:message</small>') !!}
                            </div>
                        </td>
                        <td>
                           
                            @if ($search == 'rendermodal')                       
                            
                                <div class="form-group">
                                {!! Form::label('maincategory_id', 'Main Category') !!}
                                <div class="input-group {{ $errors->has('maincategory_id') ? 'has-error' : '' }}">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-menu-hamburger"></i></span>
                                                
                                    {!! Form::select('maincategory_id', $maincategories, null, ['class' => 'maincategoryselect form-control']) !!}

                                </div>
                                    {!! $errors->first('maincategory_id' ,'<small class="text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('category_id', 'Category') !!}
                                    <div class="input-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-menu-hamburger"></i></span>
                                        
                                        {!! Form::select('category_id', $categories, null, ['class' => 'categoryselect form-control']) !!}

                                    </div>
                                    {!! $errors->first('category_id' ,'<small class="text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('subcategory_id', 'Subcategory') !!}
                                    <div class="input-group {{ $errors->has('subcategory_id') ? 'has-error' : '' }}">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-menu-hamburger"></i></span>
                                        
                                        {!! Form::select('subcategory_id', $subcategories, null, ['class' => 'subcategoryselect form-control']) !!}

                                    </div>
                                    {!! $errors->first('subcategory_id' ,'<small class="text-danger">:message</small>') !!}
                                </div>
                       
                            @endif
                            
                            <div class="gallery" id="{{ $search }}-gallery"></div> 
                       
                        </td>   
                    </tr>
                </table>    
                                  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                {!! Form::submit("Add to Portfolio", ['class' => 'addportfolio add'. $search .' btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>