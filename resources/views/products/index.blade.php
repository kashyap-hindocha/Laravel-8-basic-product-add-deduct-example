@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Product management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{route('create-product')}}" title="Create a product"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>description</th>
            <th>Qty</th>
            <th>Date Created</th>
            <th>Actions</th>
        </tr>
        @foreach ($products as $product)
         <form id="order_form">
        <tr>
            <td id='product_id'>{{$product->id}}</td>
            <td id='image-url'></td>
            <td id="name">{{$product->name}}</td>
                <td id="price">{{$product->price}}</td>
                <td id="description">{{$product->description}}</td>
                <td>
                    <select class="select quantity" id='selected-qty' detail-id="{{ $product->id }}" product-id="{{ $product->id }}" product-type="{{ $product->name }}">
                        @for($i = 0; $i <= $product->qty; $i++)
                        <option value="{{ $i }}" {{ $i == $product->quantity ? 'selected' : '' }}> {{ $i }} </option>
                        @endfor
                    </select>
                </td>
                <td>{{$product->created_at}}</td>
                <td>
                   
                        <button type="submit" id='{{$product->id}}' title="order" style="border: none; background-color:transparent;">
                            <i class="fas fa-shopping-cart fa-lg text-danger"></i>
                        </button>
                    
                </td>
            </tr>
            </form>
        @endforeach
    </table>

    {!! $products->links() !!}

@endsection

@section('script')
<script>
$('#order_form').on('submit',function(e){
        let qty = $('#selected-qty').val();
        let productId = $("#product_id").text();
        let price = $("#price").text();
        let name = $("#name").text();
        let description = $("#descriptoin").text();
        $.ajax({
          url:'/products/order',
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            'qty' : qty,
            'product_id' : productId,
            'price' :  price,
            'name' : name,
            'description' : description
          },
          success:function(response){
            console.log(response);
            if (response) {
              alert('order-placed');
            }
          },
         });
        });
</script>
@endsection()