@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Add Categories</strong> Elements
                	<?php 
						$message = Session::get('message');
						if($message){
							echo '<span class="text-alert" style="color:red;font-size:30px;text-align:center;width:100%">' . $message . '</span>';
							Session::put('message',null);
						}
					?>
            </div>
            <div class="card-body card-block">
                <form action="{{URL::to('/admin/save-product')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field()}}
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Title</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="product_title" placeholder="Text" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Price</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="product_price" placeholder="Price" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Weight</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="product_weight" placeholder="Weight" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Description</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="product_desc" id="textarea-input" rows="9" placeholder="Content..." class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">Status</label>
                        </div>
                        <div class="col col-md-9">
                            <div class="form-check">
                                <div class="radio">
                                    <label for="radio1" class="form-check-label ">
                                        <input type="radio" id="radio1" name="product_status" value="0" class="form-check-input" checked="checked">Hide
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radio2" class="form-check-label ">
                                        <input type="radio" id="radio2" name="product_status" value="1" class="form-check-input">Show
                                    </label>
                                </div>
                            </div>
                        

                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">Categories</label>
                        </div>
                        <div class="col col-md-9">
                            <select class="select" name="category_id">
                            @foreach ($category as $key => $cate)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label">Image</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="file-input" name="product_imgs[]" class="form-control-file" multiple>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection