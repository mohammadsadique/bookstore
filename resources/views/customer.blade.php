@extends('master.master')
@section('main-section')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row  mt-2">
                <div class="col-md-12">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="fas fa-skull-crossbones"></i> Alert!</h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="col-md-4">
                    @if(session()->has('customersuccess'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Alert!</h5>
                            {{ session()->get('customersuccess') }}
                        </div>
                    @endif
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">@if(!empty($ban)) Update @else Add @endif Customer</h3>
                        </div>

                        <form action="{{ route('customers.store') }}" role="form" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="@if(!empty($ban)){{ $ban['id'] }}@endif">
                            <div class="card-body">
                                <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="first_name" value="{{ old('first_name',  isset($ban) ? $ban['first_name'] : '') }}" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', isset($ban) ? $ban['last_name'] : '') }}" placeholder="Enter ...">
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" value="{{ old('email', isset($ban) ? $ban['email'] : '') }}" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="tel" name="phone" class="form-control" value="{{ old('phone', isset($ban) ? $ban['phone'] : '') }}" placeholder="Enter ...">
                                            </div>
                                        </div>
                                       
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@if(!empty($ban['id'])) Update @else Add  @endif Customer</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    @if(session()->has('deletesuccess'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Alert!</h5>
                            {{ session()->get('deletesuccess') }}
                        </div>
                    @endif
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Customer List</h3>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($custData as $val)
                                        <tr>
                                            <td style="text-align: ;">{{ $val->first_name }}</td>
                                            <td style="text-align: ;">{{ $val->last_name  }}</td>
                                            <td style="text-align: ;">{{ $val->email  }}</td>
                                            <td style="text-align: ;">{{ $val->phone  }}</td>
                                            <td style="text-align: ;">
                                                <div class="btn-group">
                                                    <form method="POST" action="{{ route('customers.destroy', $val->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                    <a class="btn btn-small btn-warning" href="{{ URL::to('customers/' . $val->id) }}"><i class="fas fa-edit"></i></a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

@endsection
