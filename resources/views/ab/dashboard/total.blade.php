<div class="row">
  
    <div class="col-lg-3 col-6">
      <div class="small-box text-bg-primary">
        <div class="inner">
          <h3>{{ @$data['restaurantsCount'] }}</h3>
          <p>Total Restaurants</p>
        </div>
        <a href="{{ route('ab.restaurants') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
          More info <i class="bi bi-link-45deg"></i>
        </a>
      </div>
    </div>


    <div class="col-lg-3 col-6">
      <div class="small-box text-bg-danger">
        <div class="inner">
          <h3>{{ @$data['usersCount'] }}</h3>
          <p>Total Users</p>
        </div>
        <a href="{{ route('ab.users') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
          More info <i class="bi bi-link-45deg"></i>
        </a>
      </div>
    </div>



  </div>