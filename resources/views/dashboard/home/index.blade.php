@extends('layouts.dashboardmaster')




@section('content')

<h1>{{ auth()->user()->name }}-{{ auth()->user()->email }}</h1>

@if (auth()->user()->role == 'user')
<div class="row">
    @if(!$request)
<div class="col-xl-6">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-3">Do you sent request?</h4>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <i class="mdi mdi-help-circle me-1 text-primary"></i> Do you want to be a blogger..!
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                        <div class="accordion-body">

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <form role="form" action="{{ route('request.send',Auth::user()->id) }}" method="POST">
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Feedback</label>
                                                <div class="col-sm-9">
                                                    <textarea type="text" class="form-control" id="inputEmail3" name="feedback" rows="5"></textarea>
                                                </div>
                                            </div>
                                            <div class="justify-content-end row">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Send request</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end accordion -->
        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
</div>
@endif
</div>
@endif



@endsection
