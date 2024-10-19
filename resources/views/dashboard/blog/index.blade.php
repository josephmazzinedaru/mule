@extends('layouts.dashboardmaster')

@section('title')
   Blog
@endsection

@section('content')

<x-breadcum slogan="Blog Show Page"></x-breadcum>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Blog's table</h4>

            <div class="table-responsive">
                <table class="table table-dark mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category Title</th>
                            <th>Status</th>
                            <th>Feature</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                   @foreach ($blogs as $blog)
                         <tr>
                             <th scope="row">
                                {{ $blogs->firstItem() + $loop->index  }}
                             </th>
                             <td>
                               <img src="{{ asset('uploads/blog') }}/{{ $blog->thumbnail }}" style="width: 80px; height:80px;">
                             </td>
                             <td>
                                {{ $blog->title }}
                             </td>
                             <td>
                                {{ $blog->onecategory->title }}
                             </td>
                             <td>
                                <form id="mules{{ $blog->id }}" action="{{ route('category.status',$blog->id) }}" method="POST">
                                    @csrf
                                <div class="form-check form-switch">
                                    <input onchange="document.querySelector('#mules{{$blog->id}}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $blog->status == 'active' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="flexSwitchCheckChecked">{{ $blog->status }}</label>
                                  </div>
                                </form>
                             </td>
                             <td>
                                <form id="mule{{ $blog->id }}" action="{{ route('blog.feature',$blog->id) }}" method="POST">
                                    @csrf
                                <div class="form-check form-switch">
                                    <input onchange="document.querySelector('#mule{{$blog->id}}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $blog->feature == true ? 'checked' : '' }} >
                                  </div>
                                </form>
                             </td>
                             <td>
                               <div class="d-flex justify-content-around">
                                <a href="{{ route('blog.edit',$blog->id) }}" type="button" class="btn btn-soft-info waves-effect waves-light">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form action="{{ route('blog.destroy',$blog->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-soft-danger waves-effect waves-light">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                               </div>
                             </td>
                         </tr>
                   @endforeach
                    </tbody>

                    {{  $blogs->links() }}
                </table>
            </div>
        </div>
    </div> <!-- end card -->
</div>


@endsection
