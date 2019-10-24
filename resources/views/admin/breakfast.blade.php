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
							<i class="fa fa-anchor fa-2x"></i>
							Breakfasts
						</div>
						<h4 class="card-title">
							<a href="{{ route('breakfast.add') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Breakfast</a>
							<input type="hidden" name="_token" value="{{ csrf_token() }} ">
						</h4>
					</div>
					<div class="card-body ">
						<div class="row">
							<div class="col-md-12">
								<div class="cf nestable-lists">
									<div class="dd" id="nestable">
										<ol class="dd-list" id="sortable">
											@foreach($breakfast as $breakfast)

											<li class="dd-item" id="{{$breakfast->id}} ">
												<div class="dropdown pull-right item_actions hidden-pc">
													<button class="btn btn-sm btn-success view dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions <i class="fa fa-chevron-down" aria-hidden="true"></i></button>

													<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
														<a href="./photo-gallery/{{ $breakfast->slug }}" class="btn btn-sm btn-primary center-block"> Gallery </a><br>

														<a href="#viewContent"
														data-toggle="modal"
														data-id="{{ $breakfast->id }}"
														data-slug="{{ $breakfast->slug }}"
														data-category="{{ $cat }}"
														data-display="{{ $breakfast->display }}"
														data-featured="{{ $breakfast->featured }}"
														data-price="{{ $breakfast->originalPrice }}"
														data-wholesellerPrice="{{ $breakfast->wholesellerPrice }}"
														data-stockQty="{{ $breakfast->stockQty }}"
														data-description='{{ $breakfast->description }}'
														data-content='{{ $breakfast->long_content }}'
														id="view{{ $breakfast->id }}"
														class="btn btn-sm btn-warning center-block"
														onclick="view_content('{{ $breakfast->id }}','{{ $breakfast->title }}','{{ $breakfast->image }}')"><i class="fa fa-eye"></i> View</a>	

														<a href="./breakfast/edit/{{ base64_encode($breakfast->id) }}" class="btn btn-sm btn-primary center-block"> Edit </a><br>

														<a href="#delete"
														data-toggle="modal"
														data-id="{{ $breakfast->id }} "
														id="delete{{ $breakfast->id }} "
														class="btn btn-sm btn-danger center-block"
														onclick="delete_breakfast('{{ base64_encode($breakfast->id) }}' )"> Delete</a>
													</div>
												</div>

												<div class="pull-right item_actions hidden-mobile">
													<a href="./photo-gallery/{{ $breakfast->slug }}"
														class="btn btn-sm btn-primary edit"> <i class="fa fa-image"></i>
													</a>

													<a href="#viewContent"
													data-toggle="modal"
													data-id="{{ $breakfast->id }}"
													data-slug="{{ $breakfast->slug }}"
													data-category="{{ $cat }}"
													data-display="{{ $breakfast->display }}"
													data-featured="{{ $breakfast->featured }}"
													data-price="{{ $breakfast->originalPrice }}"
													data-wholesellerPrice="{{ $breakfast->wholesellerPrice }}"
													data-stockQty="{{ $breakfast->stockQty }}"
													data-description='{{ $breakfast->description }}'
													data-content='{{ $breakfast->long_content }}'
													id="view{{ $breakfast->id }}"
													class="btn btn-sm btn-warning view"
													onclick="view_content('{{ $breakfast->id }}','{{ $breakfast->title }}','{{ $breakfast->image }}')"><i class="fa fa-eye"></i></a>	&nbsp;

													<a href="./breakfast/edit/{{ base64_encode($breakfast->id) }}"
														class="btn btn-sm btn-primary edit"> <i class="fa fa-edit"></i>
													</a>

													<a href="#delete"
													data-toggle="modal"
													data-id="{{ $breakfast->id }}"
													id="delete{{ $breakfast->id }} "
													class="btn btn-sm btn-danger delete"
													onclick="delete_breakfast('{{ base64_encode($breakfast->id) }}' )"><i class="fa fa-trash"></i></a>

												</div>
												<span class="dd-handle">
													<span class="search-title">{{ $breakfast->title }}</span> &nbsp;&nbsp;&nbsp;
													<small>
														<i>
														</i>
													</small>
												</span>
											</li>
											@endforeach

										</ol>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons fa fa-anchor fa-lg"></i> {{count($breakfast)}} Breakfasts Listed
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function view_content(id, title, image) {
		var slug = $('#view' + id).attr('data-slug');
		var category = $('#view' + id).attr('data-category');
		var display = $('#view' + id).attr('data-display');
		var featured = $('#view' + id).attr('data-featured');
		var price = $('#view' + id).attr('data-price');
		var wholesellerPrice = $('#view' + id).attr('data-wholesellerPrice');
		var stockQty = $('#view' + id).attr('data-stockQty');
		var description = $('#view' + id).attr('data-description');
		var content = $('#view' + id).attr('data-content');
		var category = $('#view' + id).attr('data-category');
		
			$('#viewCategories').html(category);
		

		if (featured == 1) {
			$('#viewFeatured').html("<i style='color:green'>Featured</i>");
		}else{
			$('#viewFeatured').html("<i style='color:red'>Featured</i>");
		}

		if (display == 1) {
			$('#viewDisplay').html("<i style='color:green'>Displayed</i>");
		}else{
			$('#viewDisplay').html("<i style='color:red'>Not Displayed</i>");
		}

		$('#viewId').val(id);
		$('#viewTitle').html(title);
		$("#viewImage").attr('src', "{{ asset('storage/admin/breakfast/')}}/"+slug+"/thumbs/cover_"+ image);
		$('#viewDescription').html(description);
		$('#viewContents').html(content);
	}

	function delete_breakfast(id) {
		var conn = 'breakfast/delete/' + id;
		$('#delete a').attr("href", conn);
	}
</script>

<!-- Sorting Starts -->
<script type="text/javascript">
	$(function () {
		$('#sortable').sortable({
			axis: 'y',
			opacity: 0.7,
			handle: 'span',
			update: function (event, ui) {
				var list_sortable = $(this).sortable('toArray').toString();
                // change order in the database using Ajax
                $.ajax({
                	url: "{{ URL::route('order_breakfast') }}",
                	type: 'POST',
                	data: {'_token': $('input[name=_token]').val(), list_order: list_sortable},
                	beforeSend: function () {

                	},
                	success: function (response) {
                		console.log("success");
                		console.log("response " + response);
                		var obj = jQuery.parseJSON(response);
                		if (obj.status == 'success') {
                			swal({
				                title: 'Success!',
				                buttonsStyling: false,
				                confirmButtonClass: "btn btn-success",
				                html: '<b>Breakfasts</b> Sorted Successfully',
				                timer: 1000,
				                type: "success"
				            }).catch(swal.noop);
                			// swal('Success!', 'Content Sorting Successfully', 'success')
                		}
                		;

                	}
                });
            }
        }); // fin sortable
	});
</script>
<!-- Sorting Ends -->

<!-- notice modal -->
<div class="modal fade" id="viewContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-notice modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background: #EB8C00">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">View Content</h4>
			</div>
			<div class="modal-body">
				<div class="instruction">
					<div class="row">

						<div class="col-md-12">
							<img id="viewImage" src="" class="img-responsive center-block" alt="no image" style="max-height: 300px;"> 
						</div>

						<div class="col-md-12">
							<h4 for="viewTitle"> Title: <span id="viewTitle"></span></h4>
							<span id="viewCategories"></span>
							<span id="viewFeatured"></span>, <span id="viewDisplay"></span>
						</div>
					</div>
				</div>
				<div class="instruction">
					<div class="row">
						<div class="col-md-12">
							<h4 for="excerptSection"> &nbsp;&nbsp;&nbsp;Description: </h4>
							<p id="viewDescription" style="text-align: justify;"></p>
						</div>
						<div class="col-md-12">
							<h4 for="description"> &nbsp;&nbsp;&nbsp;Content: </h4>
							<p id="viewContents" style="text-align: justify;"></p>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer" style="background: #EB8C00">
				<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- end notice modal -->


<!-- DELETE MODAL STARTS -->
<div class="modal fade modal-danger" id="delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Delete Breakfast</h4>
			</div>
			<div class="modal-body">
				<p>Do you want to delete Breakfast?</p>
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
@endsection