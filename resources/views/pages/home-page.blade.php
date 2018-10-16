@extends('layouts.app')
@section('content')
  <div class="container mt-5 mb-5">
    <div class="row justify-content-between">
        <div  class="col-md-6 rounded">
          <div id="carouselExampleIndicators" class="carousel slide rounded" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2">yo</li>
              <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner rounded">
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('img/homepage/retro-slider-1.png') }}" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('img/homepage/retro-slider-2.png') }}" alt="Second slide">
              </div>
              <div class="carousel-item">
                  <img class="d-block w-100" src="{{ asset('img/homepage/retro-slider-1.png') }}" alt="Third slide">
                </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('img/homepage/retro-slider-3.png') }}" alt="Fourth slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      <div class="col-md-6 pl-lg-5">
          <div class="bg-dark card custom-card rounded">
              <div class="card-header">
                  <span class="card-header-icon"><i class="nav-icon fa fa-book-open text-cyan"></i></span>
                  <h3 class="display-title"> Latest News Updates:</h3>
              </div>
              <div class="card-body p-0">
                  <ul class="list-group bg-light-green">
                      @foreach ($articles as $article)
                      <li class="list-group-item list-group-item-secondary" ><i class="nav-icon fa fa-adjust text-secondary mr-2"></i><a href="#">{{ $article->title }}</a></li>
                      @endforeach
                   </ul>
              </div>
          </div>
      </div>
    </div>
  </div>
  <div class="full-divider">
      <h2 class="divider-title text-center">Reviews</h2>
  </div>


        <img class="big-mofo-img" src="/img/retroshrine-compressed.jpg" alt="" style="max-width: 100%;">
@endsection
