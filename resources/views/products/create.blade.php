@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('index-products')}}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> 
            <ul>
                @foreach ($errors->all() as $error)
                    <li></li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('store-product')}}" method="POST" >
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="number" name="price" class="form-control" placeholder="Put the price">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" style="height:50px" name="description"
                        placeholder="description"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Qty:</strong>
                    <input type="number" name="qty" class="form-control" placeholder="Put the qty">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image-URL:</strong>
                    <input type="text" name="image-url" class="form-control" placeholder="Put the image url">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection

@section('script')
 <script>
  $('body').on('click', '#save-form', function () {
            $.easyAjax({
                url: '{{route('create-product')}}',
                container: '#createForm',
                type: "POST",
                redirect: true,
                file:true,
                data: $('#createForm').serialize(),
                success: function (response) {
                    if (myDropzone.getQueuedFiles().length > 0) {
                        serviceID = response.serviceID;
                        defaultImage = response.defaultImage;
                        $('#serviceID').val(response.serviceID);
                        myDropzone.processQueue();
                    }
                    else{
                        var msgs = "@lang('messages.createdSuccessfully')";
                        var msg = "@lang('messages.maxServiceLimit')";
                        if (response.serviceID == '0') {

                            $.showToastr(msg, 'error');
                            setTimeout(function()
                            {
                                window.location.href = '{{ route('index-products') }}'
                                return false;
                            }, 1000);
                        }else{

                            $.showToastr(msgs, 'success');
                            setTimeout(function()
                            {
                                window.location.href = '{{ route('index-products') }}'
                                return false;
                            }, 1000);
                        }
                    }
                }
            })
        });
 </script>
 @endsection