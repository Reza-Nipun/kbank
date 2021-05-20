@extends('layouts.app')

@section('content')

        <div id="carouselExampleFade" class="carousel slide" data-ride="carousel" data-interval="2000" >
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleFade" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleFade" data-slide-to="1"></li>
                <li data-target="#carouselExampleFade" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">

                <div class="carousel-item active">
                    <a href="{{ url('/documents') }}">
                        <div class="d-flex justify-content-center w-100 h-100">
                            <img class="center-block" src="https://blog.ipleaders.in/wp-content/uploads/2019/04/policy.jpg" width="80%" height="440" alt="POLICY">
                        </div>
                    </a>
                </div>

                <div class="carousel-item">
                    <a href="{{ url('/documents') }}">
                        <div class="d-flex justify-content-center w-100 h-100">
                            <img class="center-block" src="https://www.yourretailcoach.in/wp-content/uploads/2018/04/SOP-Adv2-%E2%80%93-1@2x.png" width="80%" height="440" alt="SOP">
                        </div>
                    </a>
                </div>

                <div class="carousel-item">
                    <a href="{{ url('/documents') }}">
                        <div class="d-flex justify-content-center w-100 h-100">
                            <img class="center-block" src="https://info.vethanlaw.com/hs-fs/hubfs/Blog_Images/transitional-service-agreement.jpg?width=792&height=528&name=transitional-service-agreement.jpg" width="80%" height="440" alt="AGREEMENT">
                        </div>
                    </a>
                </div>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>


@endsection
