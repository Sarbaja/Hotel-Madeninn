@extends('admin.layouts.headerfooter')

@section('content')
<!-- Sorting Starts -->
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

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card ">
					<div class="card-header card-header-success card-header-icon">
						<div class="card-icon">
							<i class="fa fa-image fa-2x"></i>
							{{ $productTitle[0]->title}}
						</div>
						<h4 class="card-title">
							<!-- <a href="#addModal" data-toggle="modal" class="fa fa-trash" title="Delete Image"></a> -->
							<a href="{{route('products')}}" class="btn btn-default btn-round">
								<i class="fa fa-arrow-circle-left"></i> Go Back
							</a>
							<a href="#addModal" data-toggle="modal" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add new Images</a>
							<input type="hidden" name="_token" value="{{ csrf_token() }} ">
						</h4>
					</div>
					<hr>
					<div class="card-body ">
						<div class="row">
								<?php
									$albumName = (request()->route()->parameters)['albumName'];
									// $albumName = $parameter['albumName'];
									// echo $albumName;
									$images = Storage::files('public/admin/products/'.$albumName.'/');
									// var_dump($images);
									// exit();
								?>
								@for ($i = 0; $i < count($images); $i++)
									<div class="col-md-2">
                                        <div class="polaroid">
                                            <a data-lightbox="image-1" data-title="<?='abc'; ?>" href="{{ asset('storage/admin/products/'.$albumName.'/thumbs/cover_'.basename($images[$i]))}}">
                                                <img src="{{ asset('storage/admin/products/'.$albumName.'/thumbs/thumb_'.basename($images[$i]))}}" class="img-responsive"/>
                                            </a>
                                            <div class="polaroid-view">
                                                <ul class="nav nav-pills">
                                                    <li>
                                                        <a data-lightbox="image-2" data-title="<?='abc'; ?>" href="{{ asset('storage/admin/products/'.$albumName.'/thumbs/cover_'.basename($images[$i]))}}" class="fa fa-eye" title="View Image"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#delete" data-toggle="modal"
                                                           data-photo=""
                                                           onclick="delete_image('<?= basename($images[$i]); ?>')"
                                                           id="" class="fa fa-trash" title="Delete Image"></i>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
									
								@endfor
								<!-- <img src="{{ public_path('storage/admin/products/'.$albumName.'/1549275063.jpg') }}" alt="no image"> -->
							
						</div>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons fa fa-anchor fa-lg"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Add Images Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Images</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <form action="{{ route('photo_gallery.add_images') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }} ">
            <input type="hidden" name="albumName" value="{{$albumName }}">
            <div class="modal-body">
                <div class="row">
                    <label class="col-sm-4 col-form-label">Gallery Images</label>
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


<!-- DELETE MODAL STARTS -->
<div class="modal fade modal-danger" id="delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Delete Gallery Image</h4>
			</div>
			<div class="modal-body">
				<p>Do you want to delete Image?</p>
			</div>
			<div class="modal-footer">
				<div class="modal-footer">
					<a class="btn btn-primary" href="">Delete</a>
					<a data-dismiss="modal" class="btn btn-primary pull-left" href="#">Cancel</a>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- DELETE MODAL ENDS -->

<script>
	function delete_image(image) {
        // alert(image);
        var conn = '<?=urlencode($albumName);?>/' + image;
        $('#delete a').attr("href", conn);
    }

</script>
@endsection