@extends('admin.layouts.app')

@section('title')
Create Account
@endsection


@section('content')



<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title">Create Account</h3>
                        @can('view account')

                        <a href="{{ route('admin.accounts.index') }}" class="btn btn-success float-right"><i class="fa fa-angle-left"> Back</i></a>

                        @endcan
                    </div>
                    <!-- /.card-header -->
                  <form id="quickForm" method="POST" action="{{route('admin.accounts.store') }}" enctype="multipart/form-data">

                        @csrf
                        @method('POST')

                        <div class="card-body row">
                            <div class="form-group col-lg-6">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        


                            <div class="form-group col-lg-6">
                                <label>Phone Number<span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="01XXXXXXXXX" required>
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Password<span class="text-danger">*</span></label>
                                <input type="text" name="password" class="form-control" placeholder="Enter password" required>
                            </div>


                            <div class="form-group col-lg-6">
                                <label>Account Number <span class="text-danger">*</span></label>
                                <input type="text" name="account_no" class="form-control @error('account_no') is-invalid @enderror"
                                    placeholder="Enter Account Number " required>
                                @error('account_no')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-lg-6">
                                <label>Account Balance </label>
                                <input type="number" name="balance" class="form-control @error('balance') is-invalid @enderror"
                                    placeholder="Enter balance ">
                                @error('balance')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                           

                            <div class="form-group col-lg-6">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>


                             <div class="form-group col-lg-6">
                                <label>Image</label>
                                <input type="file" name="image" id="image" class=" p-1 form-control ">
                                <img id="preview-image" src="#" alt="Preview Image" style="max-width: 80px; margin-top:10px; display:none;">
                            </div>

                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </form>

                    <!-- /.card-body -->
                </div>


            </div>



        </div>

    </div>
</section>

@section('script')
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const preview = document.getElementById('preview-image');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endsection


@endsection