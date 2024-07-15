@extends('app')

@section('title', "CNUUY STORE | Register")

@section('content')

{{-- @if ($errors->any())

    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
    </ul>

@endif --}}

<div class="container d-flex">
    <div class="border p-3 bg-white shadow box-area d-flex justify-content-center align-items-center" style="margin-top: 62px;"">
        <div class="gtw d-flex justify-content-center align-items-center">
            <div class="d-flex left-area">
                <div class="elysia">
                    {{-- susu --}}
                    <img src="{{asset('image/Frame 24.png')}}">
                </div>
            </div>

            <div class="p-3 right-box">
                {{-- <div style="width: 500px"> --}}
                    <div class="header-text">
                        <h4>HEY, KAMU 🫵</h4>
                        <p style="font-size: 12px">Masukan informasi yang dibutuhkan untuk masuk</p>
                    </div>
                    <form action="{{ route('user.register') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label" style="margin-bottom: 1px">First Name</label>
                            <input type="name" class="form-control" id="exampleInputEmail1" name="Firstname" value="{{ old('Firstname') }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="margin-bottom: 1px">Last Name</label>
                            <input type="name" class="form-control" id="exampleInputEmail1" name="Lastname" value="{{ old('Lastname') }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="margin-bottom: 1px">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="margin-bottom: 1px">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="{{ old('password') }}">
                        </div>
                        <div class="mb-2 d-flex justify-content-between form-ballz">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="confirm">
                                <label class="form-check-label" for="exampleCheck1">I Agree with the term & condition</label>
                            </div>
                            {{-- <label class="forget-password">Already have account?</label> --}}
                        </div>
                        <button type="submit" class="primaryBtn" style="width: 100%">REGISTER</button>
                    </form>
                {{-- </div> --}}

                @if($errors->any())
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                                showCloseButton: true,
                                showCancelButton: false,
                                focusConfirm: false,
                                customClass: {
                                    confirmButton: 'primaryBtn',
                                }
                            });
                        </script>
                    @elseif(session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: '{{ session('success') }}'
                            });
                        </script>
                    @endif
            </div>
        </div>
    </div>
</div>

@endsection
