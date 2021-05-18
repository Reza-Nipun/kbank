@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Create Category') }}

                        <div class="btn-toolbar float-right">
                            <a class="btn btn-primary mr-1" href="{{ url('category_list') }}" title="Category List">
                                <i class="fa fa-list"></i> Category List
                            </a>
                        </div>
                    </div>

                    <form action="{{ url('/save_category') }}" method="post">
                        {{ csrf_field() }}

                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
                        @endif

                        @if(count($errors))
                            <div class="form-group">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="category_name" class="form-label">Category Name <span style="color: red">*</span></label>
                                        <input class="form-control" type="text" id="category_name" name="category_name" required="required" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="category_description" class="form-label">Description </label>
                                        <input class="form-control" type="text" id="category_description" name="category_description" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="task_assign_to" class="form-label">Status <span style="color: red">*</span></label>
                                        <select class="form-control" name="status" id="status" required="required">
                                            <option value="">Select Status</option>
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success mt-4">SAVE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('select').select2();
    </script>

@endsection
