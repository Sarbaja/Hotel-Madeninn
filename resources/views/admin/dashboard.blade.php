@extends('admin.layouts.headerfooter')

@section('content')
	
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="card card-stats">
							<div class="card-header card-header-warning card-header-icon">
								<div class="card-icon">
									<i class="fa fa-anchor"></i>
								</div>
								<br>
								<a href="{{ route('programs') }}" class="card-category">Go to Page >></a>
								<!-- <h3 class="card-title">184</h3> -->
							</div>
							<div class="card-footer">
								<div class="stats">
									<h3 class="card-title">Programs</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="card card-stats">
							<div class="card-header card-header-rose card-header-icon">
								<div class="card-icon">
									<i class="material-icons">equalizer</i>
								</div>
								<p class="card-category">Website Visits</p>
								<h3 class="card-title">75.521</h3>
							</div>
							<div class="card-footer">
								<div class="stats">
									<i class="material-icons">local_offer</i> Tracked from Google Analytics
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="card card-stats">
							<div class="card-header card-header-success card-header-icon">
								<div class="card-icon">
									<i class="material-icons">store</i>
								</div>
								<p class="card-category">Revenue</p>
								<h3 class="card-title">$34,245</h3>
							</div>
							<div class="card-footer">
								<div class="stats">
									<i class="material-icons">date_range</i> Last 24 Hours
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="card card-stats">
							<div class="card-header card-header-info card-header-icon">
								<div class="card-icon">
									<i class="fa fa-twitter"></i>
								</div>
								<p class="card-category">Followers</p>
								<h3 class="card-title">+245</h3>
							</div>
							<div class="card-footer">
								<div class="stats">
									<i class="material-icons">update</i> Just Updated
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection
