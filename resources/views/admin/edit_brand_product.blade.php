
@extends('admin_layout')
@section('admin_content')
    

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật thương hiệu sản phẩm
                </header>
                <?php
                $message = Session::get('message');
                if($message){
                    echo $message;
                    Session::put('message',null);
                }
                ?>
                <div class="panel-body">
                  @foreach ($edit_brand_product as $edit_value)
                      
                 
                    <div class="position-center">
                    <form role="form" method="POST" action="{{ url('/update-brand-product',[$edit_value->brand_id]) }}">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Thương hiệu</label>
                            <input type="text" value="{{ $edit_value->brand_name }}" class="form-control" name="brand_product_name" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Thương hiệu</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="brand_product_desc" >
                                {{ $edit_value->brand_desc }}
                            </textarea>
                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info">Cập nhật Thương hiệu</button>
                    </form>
                    </div>
                    @endforeach
                </div>
            </section>

    </div>
   
</div>
<div class="row">
@endsection