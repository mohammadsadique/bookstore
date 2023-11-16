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
                            <h3 class="card-title">@if(!empty($ban)) Update @else Add @endif Book</h3>
                        </div>

                        <form action="{{ route('manage-book.store') }}" role="form" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="@if(!empty($ban)){{ $ban['id'] }}@endif">
                            <div class="card-body">
                                <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Publisher Name</label>
                                                <input type="text" name="publisher" value="{{ old('publisher',  isset($ban) ? $ban['publisher'] : '') }}" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control" value="{{ old('title', isset($ban) ? $ban['title'] : '') }}" placeholder="Enter ...">
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Author</label>
                                                <input type="text" name="author" value="{{ old('author', isset($ban) ? $ban['author'] : '') }}" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Genre</label>
                                                <input type="text" name="genre" value="{{ old('genre', isset($ban) ? $ban['genre'] : '') }}" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" id="description" cols="30" rows="5" class="form-control">@if(isset($ban)){{ $ban['description'] }}  @endif</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>ISBN</label>
                                                <input type="tel" name="isbn" class="form-control" value="{{ old('isbn', isset($ban) ? $ban['isbn'] : '') }}" placeholder="Enter ...">
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input type="file" name="image" class="form-control" placeholder="Enter ...">
                                                @if(isset($ban))
                                                    <br>
                                                    <img src="{{ $ban['image']  }}" alt="image" style="width:50px;height:50px;">
                                                @endif 
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Published</label>
                                                <input type="date" name="published" class="form-control" value="{{ old('published', isset($ban) ? $ban['published'] : '') }}" placeholder="Enter ...">
                                            </div>
                                        </div>
                                       
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@if(!empty($ban['id'])) Update @else Add  @endif Book</button>
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
                            <h3 class="card-title">Book List</h3>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Genre</th>
                                        <th>Publisher</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookData as $val)
                                        <tr>
                                            <td style="text-align: ;">{{ $val->title }}</td>
                                            <td style="text-align: ;">
                                                @if(!empty( $val->image ))
                                                    <img src="{{ $val->image  }}" alt="image" style="width:50px;height:50px;">
                                                @else 
                                                    <img src="{{ url('custom/dummy-logo.png') }}" alt="image" style="width:50px;height:50px;">
                                                @endif
                                            </td>
                                            <td style="text-align: ;">{{ $val->genre  }}</td>
                                            <td style="text-align: ;">{{ $val->publisher  }}</td>
                                            <td style="text-align: ;">
                                                <div class="btn-group">
                                                    <form method="POST" action="{{ route('manage-book.destroy', $val->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                    <a class="btn btn-small btn-warning" href="{{ URL::to('admin/manage-book/' . $val->id) }}"><i class="fas fa-edit"></i></a>

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
