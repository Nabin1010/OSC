@extends('layouts.adminlayouts')

@section('content')

<div class="col-sm-11">

    @component('admin.includes.title')
        Edit product
    @endcomponent
    @if (!empty ($product))
    <form method="POST" action="/admin/products/{{ $product->id}}" style="text-align:right">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-secondary">Delete product</button>

    </form>
   

<form method="POST" action="/admin/products/{{ $product->id}}" enctype="multipart/form-data">

        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-sm-3">

                <div class="form-group">
                    <label for="file">product pic</label>
                    <div>
                        {{-- <img src="{{ url(' z_temp\posters\blank.jpg') }}" id="profile-img-tag" width="295px"/> --}}
                        <img src="{{ url('images/products/'.$product->photo) }}" id="profile-img-tag" width="200px"/>
                    </div>
                    <input type="file" name="file" id="profile-img">
                </div>


            </div>
            <div class="col-sm-9">
                <div class="form-group">

                    <div class="form-group">
                        <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter a post title" value="{{ $product->name}}">
                    </div>

                    <div class="form-group">
                        <label for="price">price</label>
                        <input type="number" class="form-control" name="price" placeholder="Enter a price" value="{{ $product->price}}">
                    </div>
                    <div class="form-group">
                        <label for="unit_in_stock">stock</label>
                        <input type="number" class="form-control" name="unit_in_stock" placeholder="Enter a price" value="{{ $product->unit_in_stock}}">
                    </div>


                    {{-- <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" name="category_id">
                            <option disabled selected>select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id}}">{{ $category->name}}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <label for="description">description</label>
                        <textarea id="article-ckeditor" class="form-control" rows="5" name="description"> {{ $product->description}}</textarea>
                    </div>

        
                    <button type="submit" class="btn btn-primary">Edit product</button>

                </div>
                @component('admin.includes.formErrors')
                @endcomponent

            </div>
        </div>
        
    
        
    </form>
    @else
        <div><strong><h6>sorry no product found</h6></strong></div>
    @endif
</div>

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    };

    CKEDITOR.replace( 'article-ckeditor', options );

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
                
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#profile-img").change(function(){
        readURL(this);
    });
</script>


@endsection