@extends('admin_layout')
@section('admin_content')
            <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title-5 m-b-35">data table</h3>
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="rs-select2--light rs-select2--md">
                                    <?php 
                                        $url = url()->full();
                                    ?>
                                        <form>
                                        {{csrf_field()}}
                                        <select id="sort" name="sort" class="js-select2" name="property">
                                            @if (substr($url,60) == 'none' || substr($url,44) == ' ')
                                                <option id="none" value="{{Request::url()}}?sort-by-cate=none" selected>All Properties</option>
                                                @foreach ($categories as $category )
                                                    <option id="{{$category->category_id}}" value="{{Request::url().'?sort-by-cate='.$category->category_id}}">{{$category->category_name}}</option>
                                                @endforeach
                                            @else
                                            <option id="none" value="{{Request::url()}}?sort-by-cate=none">All Properties</option>
                                                    @foreach ($categories as $category )
                                                        @if($products[0]->category_id == $category->category_id)
                                                        <option id="{{$category->category_id}}" value="{{Request::url().'?sort-by-cate='.$category->category_id}}" selected>{{$category->category_name}}</option>
                                                        @else
                                                        <option id="{{$category->category_id}}" value="{{Request::url().'?sort-by-cate='.$category->category_id}}">{{$category->category_name}}</option>
                                                        @endif
                                                    @endforeach
                                            @endif
        
                                        </select>
                                        {{-- <select id="sort" name="sort" class="js-select2" name="property">
                                        @if($products[0]->category_id == $categories->category_id)
                                            <option id="none" value="{{Request::url()}}?sort-by-cate=none">All Properties</option>
                                            @foreach ($categories as $category )
                                            <option id="{{$category->category_id}}" value="{{Request::url().'?sort-by-cate='.$category->category_id}}">{{$category->category_name}}</option>
                                            @endforeach

                                        @endif
                                        </select> --}}
                                        <div class="dropDownSelect2"></div>
                                        </form>
                                    </div>
                                    {{-- <div class="rs-select2--light rs-select2--sm">
                                        <select class="js-select2" name="time">
                                            <option selected="selected">Today</option>
                                            <option value="">3 Days</option>
                                            <option value="">1 Week</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    <button class="au-btn-filter">
                                        <i class="zmdi zmdi-filter-list"></i>filters</button> --}}
                                </div>
                                <div class="table-data__tool-right">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <a href="{{URL::to('/admin/add-product')}}"><i class="zmdi zmdi-plus"></i>add item</a></button>
                                </div>
                            </div>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label class="au-checkbox">
                                                    <input type="checkbox">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </th>
                                            <th>name</th>
                                            <th>description</th>
                                            <th>status</th>
                                            <th>feature</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $key => $product)
                                        <tr class="tr-shadow">
                                            <td>
                                                <label class="au-checkbox">
                                                    <input type="checkbox">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </td>
                                            <td>{{$product->product_name}}</td>
                                            <td class="desc">{{$product->product_desc}}</td>

                                            @if($product->product_status == 1)
                                            <td>
                                                <a href="{{URL::to('/admin/update-product-status/'.$product->product_id)}}"><span class="status--process">Processed</span></a>
                                            </td>
                                            
                                            @else
                                            <td>
                                                <a href="{{URL::to('/admin/update-product-status/'.$product->product_id)}}"><span class="status--denied">Denied</span></a>
                                            </td>
                                            
                                            @endif

                                            @if($product->product_feature == 1)
                                            <td>
                                                <a href="{{URL::to('/admin/update-product-feature/'.$product->product_id)}}"><span class="feature--process">Unavailable</span></a>
                                            </td>
                                            
                                            @else
                                            <td>
                                                <a href="{{URL::to('/admin/update-product-feature/'.$product->product_id)}}"><span class="feature--denied">Available</span></a>
                                            </td>
                                            
                                            @endif
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{URL::to('/admin/edit-product/'.$product->product_id)}}" class="item"><button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button></a>
                                                    <a href="{{URL::to('/admin/delete-product/'.$product->product_id)}}" class="item"><button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button></a>
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
@endsection
