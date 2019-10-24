@extends ('admin.layouts.headerfooter')

@section ('title', 'Create Policy')

@section ('content')

    <div class="content">
        <div class="fluid-container">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-rose card-header-text">
                        <div class="card-text">
                            <h4 class="card-title"><i class="fa fa-file-o"></i></h4>
                        </div>
                        <a style="float: right; margin-top: 10px;" href="{{url('admin/policy')}}" class="btn btn-sm btn-rose"><i class="fa fa-angle-left"></i> Go Back</a>
                    </div>
                    <div class="card-body ">
            
                        <form method="post" action="{{url('admin/policy')}}" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                
                            <div class="row">
                                <label class="col-sm-2 col-form-label"> Title</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <input type="text" name="title" class="form-control">
                                    </div>
                                </div>

                                <label for="" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-4">
                                        <span class="btn btn-round btn-sm btn-file">
                                            <span class="fileinput-new">Select Image</span>
                                            <input type="file" name="image">
                                        </span>
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
                            <!-- <a href="{{url('policy')}}" type="submit" name="submit" class="btn btn-fill btn-rose pull-right">Submit</a> -->
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
