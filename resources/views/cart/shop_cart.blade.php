@extends('layout')
@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('public/frontend/img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping</h2>
                        <div class="breadcrumb__option">
                            <a href="{{URL::to('/')}}">Home</a>
                            <span>Shopping cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                        <?php
                            $content = Cart::content();
                        ?>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th></th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($content as $v_content)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="{{asset('public/uploads/admin/products/'.$v_content->options->image)}}" alt="" style="width:100px ">
                                            <h5>{{$v_content->name}}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            ${{$v_content->price}}
                                        </td>
                                        <form action="{{URL::to('/update-cart')}}" method="post">
                                            {{csrf_field()}}
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="{{$v_content->qty}}">
                                                    <input type="hidden" name="qty_cart" value="">
                                                </div>
                                                <input type="hidden" name="rowId_cart" value="{{$v_content->rowId}}">
                                            </div>
                                        </td>
                                        <td>
                                            <button>
                                                <a class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>Upadate Cart</a>
                                            </button>
                                        </td>
                                        </form>
                                        <td class="shoping__cart__total">
                                        $<?php 
                                            $subtotal = $v_content->price * $v_content->qty;
                                            echo $subtotal;
                                        ?>
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><span class="icon_close"></span></a>
                                        </td>
                                    </tr>   
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{URL::to('/shop-grid')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>${{Cart::subtotal()}}</span></li>
                            <li>VAT <span>${{Cart::tax()}}</span></li>                            
                            <li>Total <span>${{Cart::total()}}</span></li>
                        </ul>
                        <a href="{{URL::to('/checkout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection