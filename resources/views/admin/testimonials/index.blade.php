@extends ('admin.layouts.headerfooter')
@section ('title', 'Testimonials')
@section ('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
<div class="content card">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">message</i>
        </div>
        <h4 class="card-title"><b>Manage your testimonials here.</b><span><a class="btn btn-rose"
                                                         href="{{url('admin/testimonials/create')}}"><i
                        class="fa fa-plus"></i> Add Testimonials</a></span></h4>
    </div>

    <div class="container">
        <div class="nestable-lists">
            <div class="dd">
                <ul class="dd-list" id="sortable" style="padding-bottom: 30px;">
                    @foreach($testimonials as $t)
                        <li class="dd-item" id="{{$t->id}}">
                            <div class="pull-right item_actions action-section">
                                <a href="{{url('admin/testimonials/'.$t->id.'/edit')}}" rel="tooltip"
                                   title=""
                                   class="btn btn-primary btn-link btn-sm"
                                   data-original-title="Edit Testimonials">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="#deleteModal"
                                   data-toggle="modal"
                                   data-id="{{ $t->id }}"
                                   id="delete{{$t->id}}"
                                   onClick="deleteTestimonial('{{$t->id}}')"
                                   rel="tooltip" title=""
                                   class="btn btn-danger btn-link btn-sm"
                                   data-original-title="Delete Testimonials">
                                    <i class="material-icons">close</i>

                                </a>
                            </div>
                            <span class="dd-handle">{{$t->user_name}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
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

    @if (session('errStatus'))
		<div data-notify="container" class="col-11 col-md-4 alert alert-success alert-with-icon animated fadeInDown" role="alert" data-notify-position="bottom-right" style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; bottom: 20px; right: 20px;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<i class="material-icons">close</i>
			</button>
			<i data-notify="icon" class="material-icons">add_alert</i><span data-notify="title"></span>
			<span data-notify="message">
				Error!! <br> {{ session('status') }}
			</span>
			<a href="#" target="_blank" data-notify="url"></a>
		</div>
    @endif

<script>
    function deleteTestimonial(id){
        url='testimonials/' + id;
        $('#deleteModal form').attr('action', url);
    }
</script>

<script type="text/javascript">
    $(function (){
        $('#sortable').sortable({
            axis: 'y',
            opacity: 0.7,
            handle: 'span',
            update: function (event, ui) {
                var list_sortable = $(this).sortable('toArray').toString();
                
                $.ajax({
                    type:'POST',
                    url:'orderTestimonials',
                    data: {
                            list_order: list_sortable, 
                            _token: '<?php echo csrf_token() ?>'
                        },
                        beforeSend: function () {

                        },
                        success: function (response) {
                            console.log("success");
                            console.log("response " + response);

                            var obj = jQuery.parseJSON(response);

                            if(obj.status == 'success'){
                                swal({
				                title: 'Success!',
				                buttonsStyling: false,
				                confirmButtonClass: "btn btn-success",
				                html: '<b>Testimonials</b> Sorted Successfully',
				                timer: 1000,
				                type: "success"
				                }).catch(swal.noop);
                            }

                        }
                });    

            }
        })
    });
</script>

<!-- Delete Testimonial Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content del-content">
            <div class="modal-header">
                <h4 class="modal-title danger">Delete Testimonial</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p>Are you sure want to delete this Testimonial. Contents associated with it will also be deleted!!</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link btn-primary">Delete</button>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--  End of Delete Testimonial Modal -->
@endsection
