@extends('dashboard')


@section('mainPanel')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Invoice We Have</h4>

            <div class="table-responsive">
                <table class="table table-striped" id="myTable">
                    <thead>
                    <tr>
                        <th>SL NO</th>
                        <th>Invoice no.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Product Amount</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Tax %</th>
                        <th>Tax Amount</th>
                        <th>Sub Total</th>
                        <th>ACTION</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($get))

                        @php $i=1;

                        @endphp
                        @foreach($get as $item)
                            <tr>
                                <td class="py-1" width="65">
                                    <b>{{$i++}} </b>
                                </td>
                                <td class="py-1" width="150" >{{$item->invoice_no }}</td>
                                <td class="py-1" width="150" >{{$item->cust_name}}</td>
                                <td class="py-1" width="150" >{{$item->cust_email}}</td>
                                <td class="py-1" width="150" >{{$item->amount}}</td>
                                <td class="py-1" width="150" >{{$item->quantity}}</td>
                                <td class="py-1" width="150" >{{$sum = $item->amount * $item->quantity}}</td>
                                <td class="py-1" width="150" >{{$item->tax_percentage}}</td>
                                <td class="py-1" width="150" >{{$item->tax_amount}}</td>
                                <td class="py-1" width="150" >{{$item->net_amount}}</td>

                                <td class="py-1">
                                    <abbr style="text-decoration: none;"  title="Delete Career"><a href="{{url('/singleInvoice/'.$item->bId )}}" class="btn btn-primary">View</a></abbr>

                                </td>
                            </tr>
@endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    @endsection