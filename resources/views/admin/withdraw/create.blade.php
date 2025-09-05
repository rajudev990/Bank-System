@extends('admin.layouts.app')

@section('title')
Create Withdraw
@endsection


@section('content')

<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title">Create Withdraw</h3>
                        @can('view withdraw')

                        <a href="{{ route('admin.withdraw.index') }}" class="btn btn-success float-right"><i class="fa fa-angle-left"> Back</i></a>

                        @endcan
                    </div>
                    <!-- /.card-header -->
                    <form id="quickForm" method="POST" action="{{route('admin.withdraw.store') }}">

                        @csrf
                        @method('POST')

                        <div class="card-body row">
                            <div class="form-group col-lg-6">
                                <label>User <span class="text-danger">*</span></label>
                                <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                    @foreach($user as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="form-group col-lg-6">
                                <label>Select Account<span class="text-danger">*</span></label>
                                <select name="account_name" id="account_name" class="form-control @error('account_name') is-invalid @enderror">
                                    <option value="1">Bank</option>
                                    <option value="2">Bkash</option>
                                    <option value="3">Nagad</option>
                                    <option value="4">PayPal</option>
                                    <option value="5">Rocket</option>
                                    <option value="6">Upay</option>
                                    <option value="7">SureCash</option>
                                </select>
                                @error('account_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-lg-6">
                                <label>Withdraw Date</label>
                                <input type="date" name="withdraw_date" id="withdraw_date" class="form-control @error('withdraw_date') is-invalid @enderror">
                            </div>


                            <div class="form-group col-lg-6">
                                <label> Amount</label>
                                <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror">
                            </div>

                            <div class="form-group col-lg-12">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
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


@endsection