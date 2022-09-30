@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Add Categories</strong> Elements
            </div>
            <div class="card-body card-block">
            @if($edit_category->category_id)
                <form action="{{URL::to('/admin/update-category/'.$edit_category->category_id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field()}}
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Title</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="category_title" placeholder="Text" value="{{$edit_category->category_name}}" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Description</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="category_desc" id="textarea-input" rows="9" placeholder="Content..." class="form-control">{{$edit_category->category_desc}}</textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">Status</label>
                        </div>
                        <div class="col col-md-9">
                        @if ($edit_category->category_status == 0)
                            <div class="form-check">
                                <div class="radio">
                                    <label for="radio1" class="form-check-label ">
                                        <input type="radio" id="radio1" name="category_status" value="0" class="form-check-input" checked="checked">Hide
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radio2" class="form-check-label ">
                                        <input type="radio" id="radio2" name="category_status" value="1" class="form-check-input">Show
                                    </label>
                                </div>
                            </div>
                        
                        @else
                            <div class="form-check">
                                <div class="radio">
                                    <label for="radio1" class="form-check-label ">
                                        <input type="radio" id="radio1" name="category_status" value="0" class="form-check-input">Hide
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radio2" class="form-check-label ">
                                        <input type="radio" id="radio2" name="category_status" value="1" class="form-check-input" checked="checked">Show
                                    </label>
                                </div>
                            </div>
                        
                        @endif

                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label">Image</label>
                        </div>
                        <div class="col-12 col-md-9">
                        <img src="{{asset('public/uploads/admin/'.$edit_category->category_ava)}}" width=100px>
                            <input type="file" id="file-input" name="category_ava" class="form-control-file">
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
            @else
                <form action="{{URL::to('/admin/save-category')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field()}}
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Title</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="category_title" placeholder="Text" value="{{$edit_category->category_name}}" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Description</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="category_desc" id="textarea-input" rows="9" placeholder="Content..." class="form-control">{{$edit_category->category_desc}}</textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">Status</label>
                        </div>
                        <div class="col col-md-9">
                        @if ($edit_category->category_status == 0)
                            <div class="form-check">
                                <div class="radio">
                                    <label for="radio1" class="form-check-label ">
                                        <input type="radio" id="radio1" name="category_status" value="0" class="form-check-input" checked="checked">Hide
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radio2" class="form-check-label ">
                                        <input type="radio" id="radio2" name="category_status" value="1" class="form-check-input">Show
                                    </label>
                                </div>
                            </div>
                        
                        @else
                            <div class="form-check">
                                <div class="radio">
                                    <label for="radio1" class="form-check-label ">
                                        <input type="radio" id="radio1" name="category_status" value="0" class="form-check-input">Hide
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radio2" class="form-check-label ">
                                        <input type="radio" id="radio2" name="category_status" value="1" class="form-check-input" checked="checked">Show
                                    </label>
                                </div>
                            </div>
                        
                        @endif

                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label">Image</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="file-input" name="category_ava" class="form-control-file">
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
            @endif
            </div>
        </div>
    </div>
@endsection