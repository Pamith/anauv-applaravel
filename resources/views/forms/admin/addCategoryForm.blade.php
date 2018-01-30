@if(isset($categories))
{{ print_r($categories) }}
@endif
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Category Management</div>
            <div class="panel-body">
        <div class="col-md-6 ">
            <div class="panel panel-default">
                <div class="panel-heading">Parent Category</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('processCategory') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('parentcategory') ? ' has-error' : '' }}">
                            <label for="parentcategory" class="col-md-4 control-label">Parent Category</label>

                            <div class="col-md-6">
                                <input id="parentcategory" type="text" class="form-control" name="parentcategory" value="{{ old('parentcategory') }}" required autofocus>

                                @if ($errors->has('parentcategory'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('parentcategory') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <span id="addChild">Add Children</span>
                            <div id="childrens">
                            
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    ADD 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="panel panel-default">
                <div class="panel-heading">Child Category</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('processCategory') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('parentcategory') ? ' has-error' : '' }}">
                            <label for="parentcategory" class="col-md-4 control-label">Child Category</label>

                            <div class="col-md-6">
                                <input id="parentcategory" type="text" class="form-control" name="parentcategory" value="{{ old('parentcategory') }}" required autofocus>

                                @if ($errors->has('parentcategory'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('parentcategory') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    ADD 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

