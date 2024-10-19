@extends('layouts.dashboardmaster')

@section('content')


<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Register New User </h4>

                <form role="form" action="{{ route('management.user.register') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="name" name="name">
                        @error('name')
                        <p class="text-danger">{{$message}}</p>

                        @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="inputPassword3" placeholder="email" name="email">
                        @error('email')
                        <p class="text-danger">{{$message}}</p>

                        @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="password" name="password">
                        @error('password')
                        <p class="text-danger">{{$message}}</p>

                        @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                        <select class="form-select" name="role">
                            <option value=""disabled>Select Role</option>
                            <option value="manager">Manager</option>
                            <option value="blogger">Blogger</option>
                            <option value="user">User</option>

                        </select>
                        @error('role')
                        <p class="text-danger">{{$message}}</p>

                        @enderror
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
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Manager table</h4>

                <div class="table-responsive">
                    <table class="table table-dark mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                @if(auth()->user()->role == 'admin')
                                <th>Status</th>
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                       @foreach ($managers as $manager)
                             <tr>
                                 <th scope="row">
                                    {{$loop->index+1}}
                                 </th>
                                 <td>
                                    {{ $manager->name }}
                                 </td>
                                 <td>
                                    {{ $manager->role }}
                                 </td>
                                 @if(auth()->user()->role == 'admin')
                                 <td>
                                    <form id="roleundo{{ $manager->id }}" action="{{ route('management.user.role.undo',$manager->id) }}" method="POST">
                                        @csrf
                                    <div class="form-check form-switch">
                                        <input onchange="document.querySelector('#roleundo{{$manager->id}}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $manager->role == $manager->role  ? 'checked' : '' }} >
                                      </div>
                                    </form>
                                 </td>

                                 <td>
                                   <div class="d-flex justify-content-around">
                                    <a href="{{ route('category.edit',$manager->id) }}" type="button" class="btn btn-soft-info waves-effect waves-light">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{ route('category.destroy',$manager->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-soft-danger waves-effect waves-light">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                   </div>
                                 </td>
                                 @endif
                             </tr>
                       @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end card -->
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
