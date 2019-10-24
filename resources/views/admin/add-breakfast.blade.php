@extends('admin.layouts.headerfooter')

@section('content')
<div class="content">
	<div class="container-fluid">
		<form id="TypeValidation" class="form-horizontal" action="{{ route('breakfast.save') }} " enctype="multipart/form-data" method="post">
			{{csrf_field()}}		<!-- to generate a token -->
			<div class="card ">
				<div class="card-header card-header-rose card-header-text">
					<div class="card-text">
						<h4 class="card-title">Add New Breakfast</h4>
					</div>
				</div>
				<div class="card-body ">
					<div class="row">
						<div class="col-md-12 ml-auto mr-auto">
							<div class="row">
								<label class="col-sm-2 col-form-label"><i class="fa fa-bullhorn"></i>Breakfast Title <code>*</code></label>
								<div class="col-sm-4">
									<div class="form-group">
										<input type="text" name="title" class="form-control" placeholder="eg:  Vintage TIBET Trinket" required value="">
									</div>
								</div>
							</div><br>
							<div class="row">
								<!-- <label class="col-sm-2 col-form-label">Required Text <code>*</code></label> -->
								<div class="col-sm-3">
									<div class="togglebutton">
										<label>
											<input name="featured" value="1" type="checkbox">
											<span class="toggle"></span>
											Featured
										</label>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="togglebutton">
										<label>
											<input name="display" value="1" type="checkbox" checked>
											<span class="toggle"></span>
											Display
										</label>
									</div>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-6 col-sm-6 ml-auto mr-auto">
									<h4>Featured Image</h4>
									<div class="fileinput fileinput-new text-center" data-provides="fileinput">
										<div class="fileinput-new thumbnail">
											<img src="{{ asset('admin/assets/img/image_placeholder.jpg')}}" alt="no-image" style="max-width: 200px;">
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail"></div>
										<div>
											<span class="btn btn-rose btn-round btn-file">
												<span class="fileinput-new">Select image</span>
												<span class="fileinput-exists">Change</span>
												<input type="file" name="image" required/>
											</span>
											<a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
										</div>
										<small>Recommended size: 900px X 1200px for best fit.</small>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 ml-auto mr-auto">
									<h4>Other Images</h4>
									<div class="fileinput fileinput-new text-center" data-provides="fileinput">
										<div class="fileinput-new thumbnail">
											<img src="{{ asset('admin/assets/img/image_placeholder.jpg')}}" alt="no-image" style="max-width: 200px;">
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail"></div>
										<div>
											<span class="btn btn-rose btn-round btn-file">
												<span class="fileinput-new">Select image</span>
												<span class="fileinput-exists">Change</span>
												<input type="file" name="other_images[]" multiple="" />
											</span>
											<a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
										</div>
										<small>Recommended size: 900px X 1200px for best fit.</small>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Description</label>
						<div class="col-sm-12">
							<textarea class="form-control" name="description" id="editor1" style="width:100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Details About Breakfast"></textarea>
						</div>
					</div>
				</div>
				<div class="card-footer">

					<a class="btn btn-danger col-md-2" href="{{ route('breakfast') }}" >
						<span class="glyphicon glyphicon-remove-sign"></span><b> Cancel</b>
					</a>
					<button type="submit" class="btn btn-success col-md-3 pull-right">
						<span class="glyphicon glyphicon-floppy-disk" ></span><b> Save</b>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(function () {
            $(".select2").select2({
                allowClear: true,
                placeholder: 'Select Category'
            });
	    CKEDITOR.replace('editor1');
	    CKEDITOR.replace('editor2');
	});
</script>
<script>
	function setFormValidation(id) {
		$(id).validate({
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
				$(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
			},
			success: function(element) {
				$(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
				$(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
			},
			errorPlacement: function(error, element) {
				$(element).closest('.form-group').append(error);
			},
		});
	}

	$(document).ready(function() {
		setFormValidation('#TypeValidation');
	});
</script>
@endsection