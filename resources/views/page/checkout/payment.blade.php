@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ url('/', []) }}">Trang chủ</a></li>
              <li class="active">Thanh Toán giỏ hàng</li>
            </ol>
        </div>
        
        
      
        
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            <?php
            $content =Cart::content();
        
            ?>


            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Mô tả</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $v_content)
                   
                    <tr>
                        <td class="cart_product">
                            <a href=""> <img src="{{ url('public/upload/product/'.$v_content->options->image)  }}" width="50" alt="" />
                            </a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $v_content->name }}</a></h4>
                            <p>Mã ID:{{ $v_content->id }}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($v_content->price)." VNĐ" }}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                            <form action="{{ url('/update-cart') }}" method="POST">
                                {{ csrf_field() }}
                                <input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}" >
                                <input type="hidden" name="rowId_cart" value="{{$v_content->rowId}}" class="form-control">
                                <input type="submit" name="update_qty" value="Cập nhật" class="btn btn-default btn-sm">
                            </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                    $subtotal= $v_content->price*$v_content->qty;
                                    echo number_format($subtotal)." vnđ";
                                    ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{ url('/delete-to-cart/'.$v_content->rowId) }}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="payment-options">
                <span>
                    <label><input name="payment_options" value="1" type="checkbox"> Trả bằng thẻ ATM</label>
                </span>
                <span>
                    <label><input name="payment_options" value="2" type="checkbox"> Nhận tiền mặt</label>
                </span>
                <span>
                    <label><input name="payment_options" value="3" type="checkbox"> Thanh toán thẻ ghi nợ</label>
                </span>
         
            </div>
    </div>
</section> <!--/#cart_items-->


@endsection