@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Category List') }}

                        <div class="btn-toolbar float-right">
                            <a class="btn btn-success mr-1" href="{{ url('/add_category') }}" title="Add Category">
                                <i class="fa fa-plus"></i> Category
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                    <th>DESCRIPTION</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($category_list as $k => $c)
                                    <tr>
                                        <td>{{ $k+1 }}</td>
                                        <td>{{ $c->category_name }}</td>
                                        <td>{{ $c->category_description }}</td>
                                        <td>{{ ($c->status == 0 ? 'INACTIVE' : 'ACTIVE') }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="{!! route('edit_category', $c->id) !!}" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
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
@endsection
