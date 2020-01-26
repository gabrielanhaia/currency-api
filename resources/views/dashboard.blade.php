@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to Currency Fair (Dashboard).</p>
    <h2>List of processed transactions:</h2>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">User Name</th>
            <th scope="col">$ From</th>
            <th scope="col">$ To</th>
            <th scope="col">Amount Sell</th>
            <th scope="col">Amount Buy</th>
            <th scope="col">Rate</th>
            <th scope="col">Country</th>
            <th scope="col">Transaction At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactions as $trancation)
            <tr>
                <th scope="row">#</th>
                <td>FAKE_NAME</td>
                <td>{{$trancation->currencyFrom->name}}</td>
                <td>{{$trancation->currencyTo->name}}</td>
                <td>{{$trancation->amount_sell}}</td>
                <td>{{$trancation->amount_buy}}</td>
                <td>{{$trancation->rate}}</td>
                <td>{{$trancation->countryOrigin->name}}</td>
                <td>{{$trancation->datetime_transaction->format('Y-m-d H:i:s')}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('.transactions').DataTable();
        });
    </script>
@stop
