@extends('app')

@section('title', "CNUUY STORE | Create")

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.8/holder.js" integrity="sha512-uhp2Ee4MNexF4HNrWF5Vo82DIq6bvfdEcDJEqOAVy7q2h2I4HsZTFgfEoHt7+j/Ez2cEeJ0yyrZZxcGeY9aT+A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const imageInput = document.getElementById('imageInput');
        const preview = document.getElementById('preview');

        imageInput.addEventListener('change', (event) => {
            const file = event.target.files[0];

            if(file){
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection

@section('content')
<div class="container d-flex">
    <div class="border p-3 bg-white shadow box-area d-flex justify-content-center align-items-center" style="height: 580px; margin-top: 60px">
        <form action="{{ route('toy.store') }}" method="POST" enctype="multipart/form-data" class="d-flex" style="flex-direction: row">
            @csrf
            <div class="image_holder" style="display: flex; border: 2px solid #1E87C8">
                <div class="d-flex justify-content-center align-items-center" style="flex-direction: column; align-items:center;">
                    <label for="Image" style="color: gray;">Upload the thumbnail here</label>
                    <img src="holder.js/240x240?text=Upload Here" class="align-middle" id="preview">
                    <input type="file" class="form-control" id="imageInput" style="font-size: 14px; width:240px" name="image">
                </div>
            </div>
            <div class="ms-2" style="padding: 5px; background: #1E87C8">
                <div>
                    <h3 class="mb-5" style="color: white">Insert New Toy</h3>
                    <div class="mb-2">
                        name:
                        <input type="text" class="form-control" placeholder="name" name="name" style="width: 500px; color:#1E87C8;" value="{{ old('name') }}">
                        {{-- <label for="floatingInput">Name</label> --}}
                    </div>
                    category:
                    <select class="form-select form-select-sm mb-2" style="color:#1E87C8" aria-label="Small select example" name="category_id">
                        <option disabled selected style="color:#1E87C8">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="mb-2">
                        description:
                        <textarea class="form-control" placeholder="description" style="height: 100px; color:#1E87C8;" name="description" value="{{ old('description') }}"></textarea>
                        {{-- <label for="floatingTextarea2">Comments</label> --}}
                    </div>
                    <div class="mb-2">
                        price:
                        <input type="text" class="form-control" placeholder="price" style="color:#1E87C8" name="price" value="{{ old('price') }}">
                        {{-- <label for="floatingInput">Price</label> --}}
                    </div>
                    <div class="mb-2">
                        stock:
                        <input type="text" class="form-control" placeholder="stock" style="color:#1E87C8" name="stock" value="{{ old('stock') }}">
                        {{-- <label for="floatingInput">Price</label> --}}
                    </div>
                    <div class="my-2">
                        <button class="secondaryBtn" style="width: 100%">Submit</button>
                    </div>

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
                                title: '{{ session('success') }}',
                                customClass: {
                                    confirmButton: 'primaryBtn'
                                }
                            });
                        </script>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
