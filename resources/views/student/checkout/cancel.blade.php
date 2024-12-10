@includes(layouts.Layout)
@section('title','Academa | payments')
@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Payment Canceled</h1>
    <p>Your payment was canceled. Please try again later.</p>
</div>
<div class="text-center">
    <a href="{{ route('welcome') }}" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600">Return to Home</a>
</div>

</div>
@endsection
