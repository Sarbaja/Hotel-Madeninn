@extends ('admin.layouts.headerfooter')

@section ('title', 'Create Rooms')

@section ('content')

    <div class="content">
        <div class="fluid-container">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-rose card-header-text">
                        <div class="card-text">
                            <h4 class="card-title">Rooms</h4>
                        </div>
                        <a style="float: right; margin-top: 20px;" href="{{url('admin/rooms')}}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> Go Back</a>
                    </div>
                    <div class="card-body ">

                        <form method="post" action="{{url('admin/rooms')}}" enctype="multipart/form-data"
                              class="form-horizontal">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleTitle" class="bmd-label-floating"> Room Title *</label>
                                        <input type="text" name="title" class="form-control" id="exampleEmail" required="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleSingleRoomPrice" class="bmd-label-floating">Single Room Price </label>
                                        <input type="number" min="1" name="priceSingle" class="form-control" id="exampleSingleRoomPrice">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleSDoubleRoomPrice" class="bmd-label-floating"> Double Room Price</label>
                                        <input type="number" min="1" name="priceDouble" class="form-control" id="exampleSDoubleRoomPrice" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label label-checkbox">Display</label>
                                <div class="col-sm-4 col-sm-offset-1 checkbox-radios">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="display" value="1"
                                                   checked> Show/hide
                                            <span class="form-check-sign">
                                        <span class="check"></span>
                                        </span>
                                        </label>
                                    </div>
                                </div>

                                <label class="col-sm-2 col-form-label label-checkbox">Featured</label>
                                <div class="col-sm-4 col-sm-offset-1 checkbox-radios">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="featured" value="1"
                                                   checked> Show/hide
                                            <span class="form-check-sign">
                                        <span class="check"></span>
                                        </span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <h4 class="title">Main Image</h4>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ asset('admin/assets/img/image_placeholder.jpg') }}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="image"/>
                          </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                               data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <h4 class="title">Other Images</h4>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ asset('admin/assets/img/image_placeholder.jpg') }}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="other_images[]" multiple/>
                          </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                               data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <textarea name="description" id="editor1" cols="30" rows="10"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Room Facilities</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <textarea name="RoomFacilities" id="editor2" cols="30" rows="10"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" name="submit" class="btn btn-fill btn-rose pull-right">Submit
                                    <div class="ripple-container"></div>
                                </button>
                            <!-- <a href="{{url('rooms')}}" type="submit" name="submit" class="btn btn-fill btn-rose pull-right">Submit</a> -->
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
            CKEDITOR.replace('editor2');
        });
    </script>

@endsection
