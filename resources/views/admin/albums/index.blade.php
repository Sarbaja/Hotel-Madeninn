@extends ('admin.layouts.headerfooter')

@section ('title', 'Gallery')

@section ('content')
    
<div class="fluid-container">
        <div class="col-md-12">
            <div class="content card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">message</i>
                    </div>
                    <h4 class="card-title"><b>Manage your gallery here.</b>
                        <span class="btn btn-primary btn-round btn-file" data-target="#albumModal" data-toggle="modal">
                            <span class="fileinput-new">Add new album</span>
                        </span>
                    </h4>
                </div>
                <hr>
                <div class="container">
                    <div class="row">
                        @if(!is_null($albums))
                            @foreach($albums as $row)
                                    <div class="col-md-3 col-sm-3 albumContainer">
                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                <a href="{{url('admin/gallery/'.$row->id)}}" style="display:block;">
                                                    <img src="{{asset('uploads/albums/thumbs/thumb_').$row->album_image}}" class="img-fluid" alt="">
                                                </a>
                                                <!-- <span data-target="#deleteModal" data-toggle="modal" onClick="deleteAlbum('{{$row->id}}')" ><i class="fa fa-trash deleteIcon"></i></span> -->
                                                <span data-target="#editModal" data-toggle="modal" onClick="editAlbum('{{$row->id}}', '{{$row->album_name}}', '{{$row->album_image}}')" ><i class="fa fa-pencil editIcon"></i></span>
                                                <a href="#" class="albumName">{{$row->album_name}}</a>
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
        function deleteAlbum(id){
            url='albums/'+id;
            $("#deleteModal form").attr('action', url);
        }

        function editAlbum(id, albumName, albumImage){
            url='albums/' + id;
            $("#editModal form").attr('action', url);
            $("#albumName").val(albumName);
        }
    </script>

    <!-- Add Album Modal -->
    <div class="modal fade" id="albumModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Album</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="material-icons">clear</i>
                </button>
            </div>
            <form action="{{url('admin/albums')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Album Name</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                            <input type="text" name="album_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Thumbnail Image</label>
                        <div class="col-sm-8">
                            <span class="btn btn-rose btn-round btn-file">
                                <span class="fileinput-new">Select image</span>
                                <input class="btn btn-rose btn-flat btn-sm" type="file" name="album_image">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link btn-primary">Save Album</button>
                    <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!--  End of Add Album Modal -->

    <!-- Edit Album Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Album</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="material-icons">clear</i>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-body">
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Album Name</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                            <input type="text" name="album_name" class="form-control" id="albumName">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-center">Thumbnail Image</label>
                        <div class="col-sm-8">
                            <span class="btn btn-rose btn-round btn-file">
                                <span class="fileinput-new">Select image</span>
                                <input class="btn btn-rose btn-flat btn-sm" type="file" name="album_image">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link btn-primary">Save Edit</button>
                    <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!--  End of Edit Album Modal -->

    <!-- Delete Album Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content del-content">
            <div class="modal-header">
                <h4 class="modal-title danger">Delete Album</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="material-icons">clear</i>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p>Are you sure want to delete this Album. Images associated with it will also be deleted!!</p>
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
    <!--  End of Delete Album Modal -->
@endsection
