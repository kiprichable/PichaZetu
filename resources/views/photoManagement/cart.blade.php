@extends('layouts.app')

@section('content')
    <section class="gallery">
        <div class="container clearfix">
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <p><a href="{{url()->previous()}}">Back</a> / Cart</p>
                        <h1>Your Cart</h1>

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

                        @if (sizeof(Cart::content()) > 0)


                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th class="table-image"></th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th class="column-spacer"></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach (Cart::content() as $item)
                                    <tr>
                                        <td class="table-image"><a href="{{URL::Asset('/').App\Models\Photo::find($item->id)['original'].'/'.App\Models\Photo::find($item->id)['name']}}"><img src="{{ URL::Asset('/').App\Models\Photo::find($item->id)['original'].'/'.App\Models\Photo::find($item->id)['name']}}" alt="product" class="img-responsive cart-image"></a></td>
                                        <td><a href="#">{{ $item->name }}</a></td>
                                        <td>
                                            <select class="quantity" data-id="{{ $item->rowId }}">
                                                <option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                                                <option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                                                <option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                                                <option {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                                                <option {{ $item->qty == 5 ? 'selected' : '' }}>5</option>
                                            </select>
                                        </td>
                                        <td>${{ $item->subtotal }}</td>
                                        <td class=""></td>
                                        <td>
                                            <form action="{{ url('cart', [$item->rowId]) }}" method="POST" class="side-by-side">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger" style="margin-bottom: 2%;
                                        margin-right: 1%"><i class="glyphicon
                                        glyphicon-trash"></i>Delete
                                                </button>
                                            </form>

                                            <form action="{{ url('switchToWishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
                                                {!! csrf_field() !!}
                                                <button class="btn btn-success pull-left" style="margin-bottom: 2%;
                                        margin-right: 1%"><i
                                                            class="glyphicon glyphicon-heart"></i>Add to favourites
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="table-image"></td>
                                    <td></td>
                                    <td class="small-caps table-bg" style="text-align: right">Subtotal</td>
                                    <td>${{ Cart::instance('default')->subtotal() }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="table-image"></td>
                                    <td></td>
                                    <td class="small-caps table-bg" style="text-align: right">Tax</td>
                                    <td>${{ Cart::instance('default')->tax() }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="border-bottom">
                                    <td class="table-image"></td>
                                    <td style="padding: 40px;"></td>
                                    <td class="small-caps table-bg" style="text-align: right">Your Total</td>
                                    <td class="table-bg">${{ Cart::total() }}</td>
                                    <td class="column-spacer"></td>
                                    <td></td>
                                </tr>

                                </tbody>
                            </table>

                            <div class="col-lg-6 pull-right">
                                <a href="{{URL::Asset('/albums')}}" class="btn btn-info">Continue Shopping</a>

                                <div class="pull-right">
                                    <form action="{{ url('/emptyCart') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" class="btn btn-danger" value="Empty Cart">
                                    </form>
                                </div>
                                {!! Form::open(['url' => 'billing' ,'method' => 'POST']) !!}

                                <input name="stripeToken" id="stripeToken" type="hidden">
                                <input name="stripeEmail" id="stripeEmail" type="hidden">

                                <button class="btn btn-success" id="checkout">Checkout</button>

                                {!! Form::close() !!}
                            </div>
                        @else
                            <div class="col-lg-12">
                                <h3>You have no items in your cart</h3>
                                <a href="{{URL::Asset('/albums')}}" class="btn btn-info">Continue Shopping</a>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end container -->

<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
    let stripe = StripeCheckout.configure({
        key: "{{config('services.stripe.key')}}",
        image: "https://stripe.com/img/documentation/checkout/marketplace.png",
        locale: "auto",
        token: function (token) {
            document.querySelector('#stripeEmail').value = token.email;
            document.querySelector('#stripeToken').value = token.id;
            document.querySelector('#checkout-form');
        }
    });

    document.querySelector('#checkout').addEventListener('click', function(e) {
        stripe.open({
            name: "Buy Pictures in Cart",
            description: "Online photo",
            zipCode: true,
            billingAddress: true,
            amount: "{{Cart::total() *100}}",

        });

       // e.preventDefault();
    });
</script>
@endsection
@section('extra-js')
    <script>
        (function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.quantity').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                    type: "PATCH",
                    url: '{{ url("/cart") }}' + '/' + id,
                    data: {
                        'quantity': this.value,
                    },
                    success: function(data) {
                        window.location.href = '{{ url('/cart') }}';
                    }
                });
            });
        })();
    </script>


@endsection