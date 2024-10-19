@extends('layouts.dashboardmaster')

@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Role Assign</h4>

                <form role="form" action="{{ route('role.assign') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="user_id">
                                <option value="" disabled>Select users</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="role">
                                <option value="" disabled>Select Role</option>
                                <option value="manager">Manager</option>
                                <option value="blogger">Blogger</option>

                            </select>
                            @error('role')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">All Blogger Table</h4>
                <div class="table-responsive">
                    <table class="table table-dark mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                @if (auth()->user()->role == 'admin')
                                <th>Status</th>
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($role_assign_blogger as $blogger)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->index + 1 }}
                                    </th>
                                    <td>
                                        {{ $blogger->name }}
                                    </td>
                                    <td>
                                        {{ $blogger->role }}
                                    </td>
                                    @if (auth()->user()->role == 'admin')
                                    <td>
                                        <form id="roleundoblogger{{ $blogger->id }}" action="{{ route('management.user.role.undo.blogger',$blogger->id) }}" method="POST">
                                            @csrf
                                            <div class="form-check form-switch">
                                            <input onchange="document.querySelector('#roleundoblogger{{ $blogger->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $blogger->role == $blogger->role ? 'checked' : '' }}>
                                        </div>
                                    </form>
                                    </td>


                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a href="{{ route('category.edit',$blogger->id) }}" type="button" class="btn btn-outline-info waves-effect waves-light">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <form action="{{ route('category.destroy',$blogger->id) }}" method="POST">
                                               @csrf
                                                <button type="submit" class="btn btn-outline-danger waves-effect waves-light">
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

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">All Users Table</h4>
                <div class="table-responsive">
                    <table class="table table-dark mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                @if (auth()->user()->role == 'admin')
                                <th>Status</th>
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($role_assign_user as $user)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->index + 1 }}
                                    </th>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->role }}
                                    </td>
                                    @if (auth()->user()->role == 'admin')
                                    <td>
                                        <form id="roleundouser{{ $user->id }}" action="{{ route('management.user.role.undo.user',$user->id) }}" method="POST">
                                            @csrf
                                            <div class="form-check form-switch">
                                            <input onchange="document.querySelector('#roleundouser{{ $user->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $user->role == $user->role ? 'checked' : '' }}>
                                        </div>
                                    </form>
                                    </td>


                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a href="{{ route('category.edit',$user->id) }}" type="button" class="btn btn-outline-info waves-effect waves-light">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <form action="{{ route('category.destroy',$user->id) }}" method="POST">
                                               @csrf
                                                <button type="submit" class="btn btn-outline-danger waves-effect waves-light">
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

@if (session('success_role'))
<script>
Toastify({
  text: "{{ session('success_role') }}",
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

<script>

    function myFun(){
        Swal.fire({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "success"
        });
    }

</script>

@endsection
