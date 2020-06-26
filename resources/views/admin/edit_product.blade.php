
@extends('admin_layout')
@section('admin_content')
    

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật  Sản Phẩm
                </header>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    if($message){
                        echo $message;
                        Session::put('message',null);
                    }
                    ?>
                    <div class="position-center">
                        @foreach ($edit_product as $key => $pro)
                            
                        
                        <form role="form"     enctype="multipart/form-data" method="POST" action="{{ url('/update-product/'.$pro->product_id) }}">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Sản phẩm</label>
                            <input type="text" value="{{ $pro->product_name }}" class="form-control" name="product_name" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá Sản phẩm</label>
                            <input type="text" value="{{ $pro->product_price }}" class="form-control" name="product_price" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh Sản phẩm</label>
                            <input type="file" class="form-control" name="product_image" placeholder="">
                            <img src="{{ url('public/upload/product/'.$pro->product_image) }}" height="100" width="100" alt="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Sản phẩm</label>
                            <textarea style="resize: none" value="" rows="5" class="form-control" name="product_desc" placeholder="">
                                {{ $pro->product_desc }}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung Sản phẩm</label>
                            <textarea style="resize: none" value="" rows="5" class="form-control" name="product_content" placeholder="">
                                {{ $pro->product_content }}
                            </textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="product_cate" class="form-control input-lg m-bot15">

                                @foreach ($cate_product as $key => $cate)
                                @if ($cate->category_id== $pro->category_id)
                                <option selected value="{{ $cate->category_id }}">{{ $cate->category_id }}</option>
                                @else
                                <option value="{{ $cate->category_id }}">{{ $cate->category_id }}</option>
                                @endif
                                @endforeach
                            </select>
                         </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                            <select name="product_brand" class="form-control input-lg m-bot15">
                                @foreach ($brand_product as $key => $brand)
                                @if ($cate->category_id== $pro->category_id)
                                <option selected value="{{ $brand->brand_id }}">{{ $brand->brand_id }}</option>
                                @else
                                <option value="{{ $cate->category_id }}">{{ $cate->category_id }}</option>
                                @endif
                                @endforeach
                            </select>
                         </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control input-lg m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                         </div>
                        <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                    </form>
                    @endforeach
                    </div>

                </div>
            </section>

    </div>
   
</div>
<div class="row">
@endsection