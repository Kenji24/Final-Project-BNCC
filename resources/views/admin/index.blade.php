@extends('app')

@section('title', "CNUUY Store | Admin Menu")

@section('content')

{{$num = 1;}}
<div class="container background_tabel d-flex justify-content-center" style="margin-top: 38px; flex-direction:column">
    <div class="btn-group">
        <a href="{{ route('admin.home') }}" class="btn btn-primary">All Categories</a>
        @foreach ($categories as $category)
            <a href="{{ route('admin.filter', $category) }}" class="btn btn-primary">{{ $category->name }}</a>
        @endforeach
        {{-- <a href="{{ route('your_route', ['category_id' => $category->id]) }}" class="btn btn-primary {{ $category->id == $selectedCategory ? 'active' : '' }}" aria-current="page">{{ $category->name }}</a> --}}
    </div>
    <div class="table_container">
        <div class="tabel_head">
            Items List
            <div class="icon">
                <a href="{{ route('admin.create') }}"><i class="bi bi-plus-square-fill" style="color: black"></i></a>
                <i class="bi bi-trash3-fill"></i>
            </div>
        </div>
        <div class="tabel">
            <table class="table table-hover table-striped text-center">
                <thead class="sticky-header">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col" style="width: 500px">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($toys as $toy)
                    <tr>
                        <th scope="row" class="align-middle">{{$num++}}</th>
                        <td class="align-middle" style="width:140px">
                            <div class="image-container">
                                <img style="display:block; width: 100px; height:100px;" src="{{ asset("image/product images/" . $toy->image )}}">
                            </div>
                        </td>
                        <td class="align-middle" style="width: 500px">
                            <a href="{{ route('product.detail', $toy) }}" style="text-decoration: none;">
                                {{$toy->name}}
                            </a>
                        </td>
                        <td class="align-middle">{{$toy->category->name}}</td>
                        <td class="align-middle">{{$toy->stock}}</td>
                        <td class="align-middle">{{$toy->price}}</td>
                        <td class="align-middle">
                            <div class="action_icon gap-2">
                                <a href="{{ route("toy.edit", $toy) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route("toy.delete", $toy) }}" method="POST" class="mb-0">
                                    @csrf
                                    @method('DELETE')
                                    <button class="trash-can confirm-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if(session('success'))
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


@endsection
