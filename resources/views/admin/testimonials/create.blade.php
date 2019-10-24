@extends ('admin.layouts.headerfooter')
@section ('title', 'Testimonials')
@section ('content')

<div class="content">
  <div class="fluid-container">
    <div class="col-md-12">
      <div class="card ">
          <div class="card-header card-header-rose card-header-icon">
              <div class="card-icon">
                  <i class="material-icons">message</i>
              </div>
              <h4 class="card-title"><b>Create New Testimonials Here.</b><span><a class="btn btn-rose"
                                                                                   href="{{url('admin/testimonials')}}"><i
                              class="fa fa-arrow-left"></i> Go Back</a></span></h4>
          </div>
          <hr>
        <div class="card-body ">
  
          <form method="post" action="{{url('admin/testimonials')}}" class="form-horizontal">
            @csrf
  
            <div class="row">
              <label class="col-sm-2 col-form-label">User Name</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" name="user_name" class="form-control">
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 col-form-label">Post</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" name="post" class="form-control">
                </div>
              </div>
            </div>
  
            <div class="row">
              <label class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" name="title" class="form-control">
                </div>
              </div>
            </div>
  
            <div class="row">
              <label class="col-sm-2 col-form-label label-checkbox">Display</label>
              <div class="col-sm-4 col-sm-offset-1 checkbox-radios">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="display" value="" checked> Show/hide
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
              <!-- <a href="{{url('testimonials')}}" type="submit" name="submit" class="btn btn-fill btn-rose pull-right">Submit</a> -->
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