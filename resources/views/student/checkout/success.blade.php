@extends('layouts.Layout')
@section('title','Academa | payments')
@section('content')
<div class="container mx-auto p-6">


    <h1 class="text-2xl font-bold mb-6">Payment Successful!</h1>
    <p>Your order has been processed successfully.</p>


    <div class="text-center">

        <a href="{{route('my-learning')}}" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600"> Check Your
            Learning</a>

    </div>

</div>
@endsection