@extends('layouts.app')

@section('content')
    <section class="gallery">
        <div class="container clearfix">
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <p><a href="{{ url()->previous() }}">Back</a> / Favourites</p>
                        <h1>Your Favourites</h1>

                        <hr>

                        @if (session()->has('success_message'))
                            <div class="alert alert-success">
                                {{ session()->get('success_message') }}
                            </div>
                        @endif

                        @if (session()->has('error_message'))
                            <div class="alert alert-danger">
                                {{ session()->get('error_message') }}
                            </div>
                        @endif

                        @if (sizeof(Cart::instance('wishlist')->content()) > 0)
                            <div class="col-lg-12">
                                <table class="table table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="table-image"></th>
                                        <th>Product</th>

                                        <th>Price</th>
                                        <th class="column-spacer"></th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach (Cart::instance('wishlist')->content() as $item)
                                        <tr>
                                            <td class="table-image col-sm-4"><a href="{{URL::Asset('/').App\Models\Photo::find($item->id)
                        ['original'].'/'.App\Models\Photo::find($item->id)['name']}}"><img
                                                            src="{{ URL::Asset('/').App\Models\Photo::find($item->id)['original'].'/'.App\Models\Photo::find($item->id)['name']}}"
                                                            alt="product" class="img-responsive cart-image"></a></td>
                                            <td><a href="#">{{ $item->name }}</a></td>
                                            <td>${{ $item->subtotal }}</td>
                                            <td class=""></td>
                                            <td>
                                                <form action="{{ url('wishlist', [$item->rowId]) }}" method="POST"
                                                      class="side-by-side">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger" style="margin-bottom: 2%;
                                        margin-right: 1%"><i class="glyphicon
                                        glyphicon-trash"></i>Delete
                                                    </button>
                                                </form>

                                                <form action="{{ url('switchToCart', [$item->rowId]) }}" method="POST"
                                                      class="side-by-side">
                                                    {!! csrf_field() !!}
                                                    <button class="btn btn-success pull-left" style="margin-bottom: 2%;
                                        margin-right: 1%"><i class="glyphicon glyphicon-shopping-cart"></i>Add
                                                        to cart
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6 pull-right">
                                <a href="{{URL::Asset('/albums')}}" class="btn btn-info">Continue Shopping</a>
                                <div class="pull-right">
                                    <form action="{{ url('/emptyWishlist') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" class="btn btn-danger" value="Empty Wishlist">
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-12">
                                <h3>You have no items in your Wishlist</h3>
                                <a href="{{URL::Asset('/albums')}}" class="btn btn-info">Continue Shopping</a>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    </div><!-- end container -->
@endsection