@extends('layouts.dashboardmaster')

@section('content')


<div class="row">
    @if (session('name_update'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {{session('name_update')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card-body">
        <h5 class="header-title">Username Update</h5>

        <form action="{{ route('profile.name.update') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingnameInput" placeholder="Enter Name" name="name">
                <label for="floatingnameInput">Name</label>
                @error('name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-md">Submit</button>
            </div>
        </form>
    </div>
</div>

{{-- email --}}

<div class="row">
    @if (session('email_update'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {{session('email_update')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card-body">
        <h5 class="header-title">Email Update</h5>

        <form action="{{ route('profile.email.update') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingnameInput" placeholder="Enter Name" name="email">
                <label for="floatingnameInput">Email</label>
                @error('email')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-md">Submit</button>
            </div>
        </form>
    </div>
</div>

{{-- email --}}

{{-- password --}}

<div class="row">
    @if (session('password_update'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {{session('password_update')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card-body">
        <h5 class="header-title">Password Update</h5>

        <form action="{{ route('profile.password.update') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingnameInput" placeholder="Enter Name" name="c_pass">
                <label for="floatingnameInput">Current password</label>
                @error('c_pass')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingnameInput" placeholder="Enter Name" name="password">
                <label for="floatingnameInput">New password</label>
                @error('password')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingnameInput" placeholder="Enter Name" name="password_confirmation">
                <label for="floatingnameInput">Confirm password</label>
                @error('password_confirmation')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-md">Submit</button>
            </div>
        </form>
    </div>
</div>

{{-- image up --}}

<div class="row">
    @if (session('image_update'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {{session('image_update')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card-body">
        <h5 class="header-title">Image Update</h5>

        <form action="{{ route('profile.image.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <input type="file" class="form-control" id="floatingnameInput" name="image">
                <label for="floatingnameInput">Image File</label>
                @error('email')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-md">Submit</button>
            </div>
        </form>
    </div>
</div>

{{-- image up --}}

{{-- password --}}
{{-- <script>
    const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: "success",
  title: "Signed in successfully"
});
</script> --}}

@endsection
