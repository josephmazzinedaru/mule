@extends('layouts.master')

@section('content')
  <!--page404-->
  <div class="page404 ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="page404-content">
                   <img src="{{ asset('frontend') }}/assets/img/other/error404.png" alt="">
                    <h3>Oops... Page Not Found!</h3>
                    <p>The page which you are looking for does not exist galley of type and scrambled it to make a type specimen book. Please return to the homepage.
                    </p>
                    <a href="index.html" class="btn-custom">Back to homepage</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
