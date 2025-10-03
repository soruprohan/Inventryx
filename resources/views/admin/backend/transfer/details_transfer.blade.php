@extends('admin.admin_master')
@section('admin')

<div class="content d-flex flex-column flex-column-fluid">
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid my-4">
            <div class="d-md-flex align-items-center justify-content-between">
                <h3 class="mb-0"> Transfer Details Page </h3>
                <div class="text-end my-2 mt-md-0"><a class="btn btn-outline-primary" href="{{ route('all.transfer') }}">Back</a></div>
            </div>


            <div class="card">
                <div class="card-body">
                    <div class="row">

                       <!--Transfer info -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-0 h-100" style="border-radius: 10px; transition: 0.2s">
                                <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #17a2b8, #0d6efd); border-radius:10px 10px 0 0;">
                                    <h5 class="mb-0 fw-bold">Transfer Information</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <strong class="me-2 text-muted">Transfer Id:</strong>
                                        <span>{{ $transfer->id }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <strong class="me-2 text-muted">Date:</strong>
                                        <span>{{ $transfer->date }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <strong class="me-2 text-muted">Status:</strong>
                                        <span>{{ $transfer->status }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <strong class="me-2 text-muted">Note:</strong>
                                        <span>{{ $transfer->note }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- End Transfer info -->


                        <!-- Company From warehouse info -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-0 h-100" style="border-radius: 10px; transition: 0.2s">
                                <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #17a2b8, #0d6efd); border-radius:10px 10px 0 0;">
                                    <h5 class="mb-0 fw-bold">From Warehouse </h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <strong class="me-2 text-muted">Warehouse Name:</strong>
                                        <span>{{ $transfer->fromWarehouse->name }}</span>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- End Company From warehouse info -->


                        <!-- To Warehouse info-->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-0 h-100" style="border-radius: 10px; transition: 0.2s">
                                <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #17a2b8, #0d6efd); border-radius:10px 10px 0 0;">
                                    <h5 class="mb-0 fw-bold">To Warehouse </h5>
                                </div>

                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <strong class="me-2 text-muted">Warehouse Name:</strong>
                                        <span>{{ $transfer->toWarehouse->name }}</span>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- End To Warehouse info -->

                        <!-- Order Summary  -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card shadow-sm border-0 h-100" style="border-radius: 10px; transition: 0.2s">
                                        <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #17a2b8, #0d6efd); border-radius:10px 10px 0 0;">
                                            <h5 class="mb-0 fw-bold">Order Summary</h5>
                                        </div>


                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product Name</th>
                                                        <th>Quantity</th>
                                                        <th>Net Unit Cost</th>
                                                        <th>Discount</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($transfer->transferItems as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ number_format($item->net_unit_cost,2)  }}</td>
                                                        <td>{{ number_format($item->discount,2)  }}</td>
                                                        <td>{{ number_format($item->subtotal,2)  }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection