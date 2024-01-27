@extends('front.layouts.app')

@section('content')
    <section class="container">
        <div class="row justify-content-center align-items-start">
            <div class="col-md-12 text-center py-5">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <h1>Cảm ơn bạn đã đặt hàng nhé!</h1>
                <p>Mã đơn hàng: {{ $id }}</p>
            </div>
        </div>
    </section>
@endsection
