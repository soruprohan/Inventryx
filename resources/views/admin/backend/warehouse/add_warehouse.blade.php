@extends('admin.admin_master')
@section('admin')

<!-- Include jQuery from Google CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content">

                    <!-- Start Content-->
                    <div class="container-xxl">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">Add WareHouse</h4>
                            </div>
            
                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <li class="breadcrumb-item active">Add WareHouse</li>
                                </ol>
                            </div>
                        </div>

                        <!-- Form Validation -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Add WareHouse</h5>
                                    </div><!-- end card header -->
        
                                    <div class="card-body">
                                        <form action="{{ route('store.warehouse') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                                            @csrf
                                            
                                            <div class="col-md-6">
                                                <label for="validationDefault01" class="form-label">Warehouse Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="validationDefault01" class="form-label">Warehouse Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="validationDefault01" class="form-label">Warehouse Phone</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone">
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="validationDefault01" class="form-label">Warehouse City</label>
                                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city">
                                                @error('city')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-12">
                                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                            </div>
                                        </form>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>

                    
                    </div> <!-- container-fluid -->

                </div>


@endsection