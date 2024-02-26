


@extends('dashboard')


@section('mainPanel')






<form action="{{url('/insert')}}" id="entry" method="POST" enctype="multipart/form-data">
@csrf
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="card shadow mb-4">
    @if (session('success'))
        <h6 class="alert alert-success" id="alert">{{ session('success') }}</h6>
    @endif
    @if (session('error'))
        <h6 class="alert alert-danger" id="alert"><{{ session('error') }}</h6>
    @endif
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <div class="form-group mb-3">
                        <label for="simpleinput"><b style="color: black;">Customer Name</b></label>
                        <input type="text" id="name" name="name" value="{{old('name')}}"  placeholder="Enter Name" class="form-control" required>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <span id="name-error" class="error text-danger"></span>

                    </div>
                    <label for="simpleinput"><b style="color: black;">Customer Email</b></label>
                    <input type="text" id="email" name="email" value="{{old('email')}}"  placeholder="Enter Email" class="form-control" required>
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <span id="email-error" class="error text-danger"></span>

                </div>
                <div class="form-group mb-3">
                    <label for="simpleinput"><b style="color: black;">Quantity</b></label>
                    <input type="text" id="quantity" name="quantity" value="{{old('quantity')}}"  placeholder="Enter Quantity" class="form-control" required>
                    @if ($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                    @endif
                    <span id="quantity-error" class="error text-danger"></span>

                </div>
                <div class="form-group mb-3">
                    <label for="simpleinput"><b style="color: black;">Amount</b></label>
                    <input type="text" id="amount" name="amount" value="{{old('amount')}}" placeholder="Enter Amount" onkeyup="" class="form-control" required>
                    @if ($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                    @endif
                    <span id="amount-error" class="error text-danger"></span>

                </div>
                <div>
                    <label for="simpleinput"><b style="color: black;">Tax Percentge</b></label>
                    <select class="form-control" name="tax_percentage" id="tax_percentage" required>
                        <option value="0" selected>0%</option>
                        <option value="5" >5%</option>
                        <option value="12" >12%</option>
                        <option value="18" >18%</option>
                        <option value="28" >28%</option>
                    </select>
                </div> <br>

                <div class="form-group">

                    <label for="Total"><b style="color: black;">Total :</b></label>
                    <p id="total"></p><br>
                    <label for="Tax"><b style="color: black;">Tax :</b></label>
                    <p id="tax"></p><br>
                    <label for="NetTotal"><b style="color: black;">Net Total :</b></label>
                    <p id="netTotal"></p>

                    <input type="hidden" id="total1" name="total">
                    <input type="hidden" id="tax1" name="tax">
                    <input type="hidden" id="netTotal1" name="netTotal">

                </div>
                <br>

                <div>
                    <label for="file"><b style="color: black;">File</b></label>
                    <input type="file" id="file" name="file" value="{{old('file')}}" onkeyup="" class="form-control" required>
                    @if ($errors->has('file'))
                    <span class="text-danger">{{ $errors->first('file') }}</span>
                    @endif
                    <span id="file-error" class="error text-danger"></span>
                </div>
                <br>
                <div class="form-group">
                    <div>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                </div>
                <br>
                <button type="submit" id="btn" onclick="" class="btn btn-primary">SAVE</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="{{url('/invoiceList')}}" class="btn btn-primary">Invoice List</a>
            </div> <!-- /.col -->

        </div>
    </div>
</div>
</form>


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Entry We Have</h4>

            <div class="table-responsive">
                <table class="table table-striped" id="myTable">
                    <thead>
                    <tr>
                        <th>SL NO</th>
                        <th>Image</th>
                        <th>Date</th>
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
                        @php $i=1 @endphp
                        @foreach ($get as $item)
                            <tr>
                                <td class="py-1" width="65">
                                    <b>{{$i++}} </b>
                                </td>
                                <td><img src="{{asset('image/'.$item->image)}}" width="60" height="60"></td>
                                <td class="py-1" width="150" >{{$item->date = date('d-m-Y') }}</td>
                                <td class="py-1" width="150" >{{$item->cust_name}}</td>
                                <td class="py-1" width="150" >{{$item->cust_email}}</td>
                                <td class="py-1" width="150" >{{$item->amount}}</td>
                                <td class="py-1" width="150" >{{$item->quantity}}</td>
                                <td class="py-1" width="150" >{{$sum = $item->amount * $item->quantity}}</td>
                                <td class="py-1" width="150" >{{$item->tax_percentage}}</td>
                                <td class="py-1" width="150" >{{$item->tax_amount}}</td>
                                <td class="py-1" width="150" >{{$item->net_amount}}</td>

                                <td class="py-1">
                                    <abbr style="text-decoration: none;"  title="Edit Career"><a href="{{url('/editEntry/'.$item->bId )}}" class="btn btn-primary">Edit</a></abbr>

                                    <abbr style="text-decoration: none;"  title="Delete Career"><a href="{{url('/disableEntry/'.$item->bId )}}" class="btn btn-danger">Delete</a></abbr>

                                    <abbr style="text-decoration: none;"  title="Delete Career"><a href="{{url('/invoiceGenerate/'.$item->bId )}}" class="btn btn-primary">Invoice</a></abbr>


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



<script>
    $(document).ready(function() {

        //validation for file format
        $.validator.addMethod("fileFormat", function(value, element) {
            // Supported file formats
            let allowedFormats = ["jpg", "png", "pdf"];

            // Get the file extension
            let extension = value.split('.').pop().toLowerCase();

            // Check if the file extension is in the allowed formats array
            return allowedFormats.indexOf(extension) !== -1;
        }, "Invalid file format. Allowed formats: JPG, PNG, PDF.");

    //validation for alphabets
    $.validator.addMethod( "lettersOnly", function( value, element ) {
        return this.optional( element ) || /^[a-z]+$/i.test( value );
    }, "Letters only please." );

    //validation for numbers
    $.validator.addMethod( "number", function( value, element ) {
        return this.optional( element ) || /^-?\d+$/.test( value );
    }, "A positive or negative non-decimal number please." );

    //validation for file size
    $.validator.addMethod("maxFileSize", function (value, element, param) {
        let maxSize = 3 * 1024 * 1024;
        if (element.files && element.files.length > 0) {
            return element.files[0].size <= maxSize;
        }
        return true; // No file selected, so it's valid
    }, "File size must be less than or equal to 3 MB");


    if ($("#entry").length > 0) {
        $("#entry").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 50,
                    lettersOnly: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                quantity: {
                    required: true,
                    number:true,
                },
                tax_percentage: {
                    required: true,
                },
                amount: {
                    required: true,
                    number: true,
                },
                date: {
                    required: true,
                },
                file: {
                    required: true,
                    maxFileSize: true,
                    fileFormat:true,
                },

            },
            messages: {
                name: {
                    required: "Please enter name",
                    lettersOnly:"Please enter alphabets only",
                    maxlength: "only 50 charecters"
                },
                email: {
                    required: "Please enter email",
                    email: "Please enter valid email"
                },
                quantity: {
                    required: "Please enter quantity",
                    number: "provide numbers only"
                },
                tax_percentage: {
                    required: "Please select tax_percentage",
                },
                amount: {
                    required: "Please enter amount",
                    number: "provide numbers only"
                },
                date: {
                    required: "Please select a date",
                },
                file: {
                    required: "Please select a file",



                },
            },
            errorPlacement: function (error, element) {
                // Custom error placement to display the error messages next to the fields
                error.appendTo($("#" + element.attr("id") + "-error"))
            },
        })
    }
    });
</script>

<script>
    $(document).ready(function() {
        // Bind keyup event on the tax rate input field


        $('#tax_percentage').on('change', calculateTax);

        function calculateTax() {
            // Get the values from the input fields
            let amount = parseFloat($('#amount').val());
            let qty = parseFloat($('#quantity').val());
            let taxRate = parseFloat($('#tax_percentage').val());

            console.log(amount);
            console.log(qty);
            console.log(taxRate);


            //calculate total amount
            let total = (amount * qty);


            // Calculate the tax amount
            let taxAmount = (total * taxRate) / 100;

            //calculate net amount
            let netAmount = (total + taxAmount);


            // Display the result
            $('#tax').text(taxAmount.toFixed(2));
            $('#total').text(total.toFixed(2));
            $('#netTotal').text(netAmount.toFixed(2));

            //to print in hidden input
            $('#tax1').val(taxAmount.toFixed(2));
            $('#total1').val(total.toFixed(2));
            $('#netTotal1').val(netAmount.toFixed(2));
        }
    });
</script>
    @endsection