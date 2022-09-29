<x-adminheader />
<x-adminnav />

<div class="app-content">
    <div class="section">
        <!--page-header open-->
        <div class="page-header">
            <h4 class="page-title">{{$title}} List</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-light-color">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}} List</li>
            </ol>
        </div>
        <!--page-header closed-->
        <!--row open-->
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{$title}} List
                            <!-- <a href="{{ url('author/product/add') }}" 
                                class="btn btn-primary m-b-5 m-t-5 pull-right"><i class="fa fa-plus"
                                    aria-hidden="true"></i></a> -->
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- @foreach($errors -> all() as $errvalue)
                        <span style="color:red">{{ $errvalue }}</span>
                        @endforeach -->

                        <div style="color:green; padding-left:50px ">{{ Session::get('successmsg') }}</div>
                        <div style="color:red; padding-left:50px ">{{ Session::get('errmsg') }}</div>
                        <table id="customers2" class="table datatable">
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="15%">Invoice Number</th> 
                                    <th width="15%">Product Name</th> 
                                    <th width="15%">Price</th>  
                                    <th width="15%">Email Id</th>  
                                    <th width="15%">Customer Name</th>
                                    <th width="15%">Discount Amount</th> 
                                    <th width="15%">Country</th> 
                                    <th width="15%">Pincode</th>  
                                    <th width="15%">Product Image</th>                              
                                    <th width="15%">Status</th>
                                    <!-- <th width="5%">Action</th> -->
                                </tr>
                                <tbody>
                                @foreach($order as $item)
                                <tr>
                                    <td style="color: black;">{{ $loop -> index + 1 }}</td>
                                    <td style="color: black;">{{ $item -> invoice ->invoice_no }}</span></td>
                                    <td style="color: black;">{{ $item -> blog ->name }}</span></td>
                                    <td style="color: black;">{{ $item -> final_price }}</span></td>
                                    <td style="color: black;">{{ $item -> email_id }}</span></td>
                                    <td style="color: black;">{{ $item -> fname }} {{ $item ->lname}}</span></td>
                                    <td style="color: black;">{{ $item -> discount_amt }}</span></td>
                                    <td style="color: black;">{{ $item -> country }}</span></td>
                                    <td style="color: black;">{{ $item -> pincode }}</span></td>
                                     <td style="color: black;"><div class="img">
                                        <img src="{{ asset($item -> blog-> image) }}" alt="" height="60px" weidth="40px">
                                    </div></span></td>
                                    <!--
                                    <td style="color: black;"><div class="img">
                                    @if($item ->image4 == '')
																	    {{ "-" }}
																    @else
                                                                        <video autoplay="" loop="true" controlslist="nodownload" muted="muted" disableremoteplayback="" playsinline="" poster="{{ asset($item -> image4) }}">
                                                                            <source data-src="{{ asset($item -> image4) }}" type="video/mp4" src="{{ asset($item -> image4) }}">
                                                                        </video>
																	@endif
                                    
                                    </div></span></td> -->
                                    <td> <span
                                            class="badge {{ $item -> invoice ->status == 0?'badge-danger':'badge-success' }} m-b-5">{{ $item -> invoice -> status?'Active':'Inactive' }}</span>
                                    </td>

                                    <!-- <td style="color: black;"><a
                                            href="{{ URL('/author/product/upate/'.$item -> id) }}"><i
                                                class="fa fa-pencil-square" aria-hidden="true"></i></a> | <a
                                            href="{{ URL('/author/product/delete/'.$item -> id) }}"
                                            onclick="return confirm('Do you really want to delete this data?')"><i
                                                class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--row closed-->
    </div>
</div>


<x-adminfooter />