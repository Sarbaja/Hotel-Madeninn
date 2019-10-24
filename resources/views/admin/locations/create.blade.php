@extends ('admin.layouts.headerfooter')

@section ('title', 'Create Amneties')

@section ('content')

    <div class="content">
        <div class="fluid-container">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-rose card-header-text">
                        <div class="card-text">
                            <h4 class="card-title">Amneties</h4>
                        </div>
                        <a style="float: right; margin-top: 20px;" href="{{url('admin/locations')}}" class="btn btn-sm btn-primary"> <i class="fa fa-arrow-left"></i> Go Back</a>
                    </div>
                    <div class="card-body ">
            
                        <form method="post" action="{{url('admin/locations')}}" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Amneties Title</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <input type="text" name="title" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-6 col-sm-6">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ asset('admin/assets/img/image_placeholder.jpg') }}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="image" />
                          </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                
                            <div class="row">
                                <label class="col-sm-2 col-form-label label-checkbox">Display</label>
                                <div class="col-sm-4 col-sm-offset-1 checkbox-radios">
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="display" value="1" checked> Show/hide
                                        <span class="form-check-sign">
                                        <span class="check"></span>
                                        </span>
                                    </label>
                                    </div>
                                </div>
                            </div>
                
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                    <textarea name="description" id="editor1" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div>
                            <button type="submit" name="submit" class="btn btn-fill btn-rose pull-right">Submit<div class="ripple-container"></div></button>
                            </div>
                
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">                
    $(function () {
        CKEDITOR.replace('editor1');
    });
    </script>

@endsection