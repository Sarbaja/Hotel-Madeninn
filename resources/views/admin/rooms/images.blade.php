@extends ('admin.layouts.headerfooter')

@section ('title', 'Rooms Images')

@section ('content')

<div class="fluid-container">
        <div class="row">
            <div class="col-md-12">
                <div class="content card">

                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">message</i>
                        </div>
                        <h4 class="card-title"><b>Rooms Images</b> <a href="{{url('admin/rooms')}}" class="btn btn-rose btn-sm">Go Back</a>
                            <span><a class="btn btn-rose" href="#addImgModal" data-toggle="modal"><i
                                        class="fa fa-plus"></i> Add Images</a>
                            </span>
                        </h4>
                    </div>

                    <br>

                    <div class="container">
                        <div class="row">
                            @foreach($rooms as $row)
                                <div class="col-md-3 col-sm-3 imageContainer">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{asset('uploads/roomimages/'.$row->image_name)}}" alt="">
                                            <div class="row">
                                                <div class="col-3 text-right">
                                                    <span data-target="#deleteModal" data-toggle="modal" onClick="deleteImage('{{$row->id}}')" ><i class="fa fa-trash delIcon"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('status'))
		<div data-notify="container" class="col-11 col-md-4 alert alert-success alert-with-icon animated fadeInDown" role="alert" data-notify-position="bottom-right" style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; bottom: 20px; right: 20px;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<i class="material-icons">close</i>
			</button>
			<i data-notify="icon" class="material-icons">add_alert</i><span data-notify="title"></span>
			<span data-notify="message">
				Success!! <br> {{ session('status') }}
			</span>
			<a href="#" target="_blank" data-notify="url"></a>
		</div>
    @endif
    
    <script>
        function deleteImage(id){
            // alert(id);
            var url='../images/deleteImage/' + id;
            $('#deleteModal form').attr("action", url);
        }
    </script>

    <!-- Add Images Modal -->
    <div class="modal fade" id="addImgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Images</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="material-icons">clear</i>
                </button>
            </div>
            <form action="{{url('admin/rooms/add-images')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="room_id" value="{{$roomId}}">
                <div class="modal-body">
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Room Images</label>
                        <div class="col-sm-8">
                            <span class="btn btn-rose btn-round btn-file">
                                <span class="fileinput-new">Select Images</span>
                                <input type="file" name="other_images[]" class="btn btn-rose btn-flat btn-sm" multiple>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link btn-primary">Save Images</button>
                    <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!--  End of Add Images Modal -->

    <!-- Delete Images Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content del-content">
            <div class="modal-header">
                <h4 class="modal-title danger">Delete Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="material-icons">clear</i>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="room_id" value="{{$roomId}}">
                <div class="modal-body">
                    <p>Are you sure want to delete this Image</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link btn-primary">Delete</button>
                    <!-- <a href="" class="btn btn-link btn-primary" id="deleteBtn">Delete</a> -->
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!--  End of Delete Images Modal -->

@endsection