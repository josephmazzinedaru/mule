@extends('layouts.dashboardmaster')

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Categories table</h4>

                <div class="table-responsive">
                    <table class="table table-dark mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Image</th>
                                <th>Category Title</th>
                                <th>Category Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                       @foreach ($categories as $category)
                             <tr>
                                 <th scope="row">
                                    {{$loop->index+1}}
                                 </th>
                                 <td>
                                   <img src="{{ asset('uploads/category') }}/{{ $category->image }}" style="width: 80px; height:80px;">
                                 </td>
                                 <td>
                                    {{ $category->title }}
                                 </td>
                                 <td>
                                    <form id="mules{{ $category->id }}" action="{{ route('category.status',$category->id) }}" method="POST">
                                        @csrf
                                    <div class="form-check form-switch">
                                        <input onchange="document.querySelector('#mules{{$category->id}}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $category->status == 'active' ? 'checked' : '' }} >
                                        <label class="form-check-label" for="flexSwitchCheckChecked">{{ $category->status }}</label>
                                      </div>
                                    </form>
                                 </td>
                                 <td>
                                   <div class="d-flex justify-content-around">
                                    <a href="{{ route('category.edit',$category->id) }}" type="button" class="btn btn-soft-info waves-effect waves-light">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-soft-danger waves-effect waves-light">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                   </div>
                                 </td>
                             </tr>
                       @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end card -->
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Category Insert </h4>

                <form role="form" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Title" name="title">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Category Slug</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputPassword3" placeholder="Slug" name="slug">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">Category Image</label>
                        <div class="col-sm-9">
                            <img id="cat_img" src="{{asset('uploads/default/default.jpg')}}" alt="" style="height: 300px; width:100%; object-fit:contain; margin:10px 0px;">
                            <input onchange="document.querySelector('#cat_img').src = window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="inputPassword5" name="image">
                        </div>
                    </div>
                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@if(session('success_insert'))
<script>
    Toastify({
  text: "{{ session('success_insert') }}",
  duration: 5000,
  destination: "https://github.com/apvarun/toastify-js",
  newWindow: true,
  close: true,
  gravity: "top", // `top` or `bottom`
  position: "right", // `left`, `center` or `right`
  stopOnFocus: true, // Prevents dismissing of toast on hover
  style: {
    background: "linear-gradient(to right, #00b09b, #96c93d)",
  },
  onClick: function(){} // Callback after click
}).showToast();
    </script>

@endif


@endsection
