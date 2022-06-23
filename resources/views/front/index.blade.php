@extends('template.front.layout')
@section('content')
    <!-- Header -->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="dispay-4 fw-bolder">Silahkan Pilih Produk Yang Diinginkan</h1>
            </div>
        </div>
    </header>
    <!-- Section -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">

        @if (\Session::has('danger'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! \Session::get('danger') !!}</li>
            </ul>
        </div>
        @elseif (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
        @endif
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @if(count($products) > 0)
                @foreach($products as $product)
                <div class="col mb-5">
                    <div classs="card h-100">
                        <!-- Product Image -->
                        <img class="card-img-top" src="{{asset($product->product_photo)}}" alt="{{$product->product_name}}" />
                        <!-- Product Details -->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product Name -->
                                <a href="{{url('product/'.$product->id)}}" style="...">
                                    <h5 class="fw-bolder">{{$product->product_name}}</h5>
                                </a>

                                <!-- Product Price -->
                                {{idrFormat($product->product_price)}}
                            </div>
                        </div>
                        <!--Product action-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{url('cart/add?products_id='.$product->id)}}"> Add to cart</a></div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
