
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


    <style>
        body{margin-top:20px;
            background-color:#eee;
        }

        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: 1rem;
        }
    </style>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    @if(isset($get))
        @php $i=1;

        @endphp
    <div class="container">
        @if (session('success'))
            <h6 class="alert alert-success" id="alert">{{ session('success') }}</h6>
        @endif
        @if (session('error'))
            <h6 class="alert alert-danger" id="alert">{{ session('error') }}</h6>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <h5 class="font-size-16 mb-3">Billed To:</h5>
                                    <h5 class="font-size-15 mb-2">{{$get->cust_name}}</h5>
                                    <p class="mb-1">{{$get->cust_email}}</p>
                                    <img src="{{asset('image/'.$get->image)}}" width="60" height="60">
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="text-muted text-sm-end">
                                    <div>
                                        <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                        <p>{{$get->invoice_no }}</p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                        <p>{{date('Y-m-d',strtotime($get->date))}}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="py-2">
                            <h5 class="font-size-15">Order Summary</h5>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead>
                                    <tr>
                                        <th style="width: 70px;">No.</th>
                                        <th></th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end" style="width: 120px;">Total</th>
                                    </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>

                                        </td>
                                        <td>{{$get->amount}}</td>
                                        <td>{{$get->quantity}}</td>
                                        <td class="text-end">{{$sum = $get->amount * $get->quantity}}</td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">
                                            Tax :</th>
                                        <td class="border-0 text-end">{{$get->tax_amount}}</td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">Total :</th>
                                        <td class="border-0 text-end"><h4 class="m-0 fw-semibold">{{$get->net_amount}}</h4></td>
                                    </tr>
                                    <!-- end tr -->
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    {{--<a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>--}}
                                    <a href="{{url('/sendMail/'.$get->bId.'/mail')}}" class="btn btn-primary w-md">Mail</a>
                                    <br><br>
                                    <a href="{{url('/invoiceList')}}" class="btn btn-primary w-md">Back</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
    </div>




