@extends ('admin.layouts.headerfooter')

@section ('title', 'Album Gallery')

@section ('content')
<div class="fluid-container">
    <div class="col-md-12">
        <div class="content card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">message</i>
                </div>
                <h4 class="card-title"><b>Upload Images here.</b>
                    <span class="btn btn-primary btn-round btn-file btn-sm">
                        <a href="{{url('admin/albums')}}">Go to Album List</a>
                    </span>
                </h4>
            </div>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                            <img src="{{asset('images/image_placeholder.jpg')}}" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                            <span class="btn btn-primary btn-round btn-file" data-target="#galleryModal" data-toggle="modal">
                            <span class="fileinput-new">Add Images</span>
                            <span class="fileinput-exists">Change</span>
                            </span>
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                        </div>
                    </div>
                    @if(!is_null($allImages))
                        @foreach($allImages as $row)
                            <div class="col-md-3 col-sm-3 imageContainer">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="{{asset('uploads/gallery/thumbs/thumb_').$row->image_name}}" alt="">
                                        <div class="row" style="padding:5px 10px;">
                                            <div class="col-9 text-left">
                                                <span class="text-left">
                                                    @if(!is_null($row->caption))
                                                        {{$row->caption}}
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="col-3 text-right">
                                                <span data-target="#captionModal" data-toggle="modal" onClick="editCaption('{{$row->id}}', '{{$row->caption}}')" ><i class="fa fa-pencil capEditIcon"></i></span>
                                                <span data-target="#deleteModal" data-toggle="modal" onClick="deleteImage('{{$row->id}}')" ><i class="fa fa-trash delIcon"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        function deleteImage(id){
            var url='../gallery/' + id;
            $('#deleteModal form').attr("action", url);
        }

        function editCaption(id, caption){
            var url='../gallery/' + id;
            $('#captionModal form').attr('action', url);
            $('#caption').val(caption);
        }
    </script>

    <!-- Add Images Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Images</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="material-icons">clear</i>
                </button>
            </div>
            <form action="{{url('admin/gallery')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="album_id" value="{{$albumId}}">
                <div class="modal-body">
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Gallery Images</label>
                        <div class="col-sm-8">
                            <span class="btn btn-rose btn-round btn-file">
                                <span class="fileinput-new">Select Images</span>
                                <input type="file" name="image_name[]" class="btn btn-rose btn-flat btn-sm" multiple>
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

    <!-- Add Caption for Images Modal -->
    <div class="modal fade" id="captionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Caption</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="material-icons">clear</i>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <input type="hidden" name="album_id" value="{{$albumId}}">
                <div class="modal-body">
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Image Caption</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                            <input type="text" name="caption" id="caption" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link btn-primary">Save Caption</button>
                    <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!--  End of Add Caption for Images Modal -->

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
                <input type="hidden" name="album_id" value="{{$albumId}}">
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