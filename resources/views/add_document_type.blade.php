@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Create Document Type') }}

                        <div class="btn-toolbar float-right">
                            <a class="btn btn-primary mr-1" href="{{ url('document_type_list') }}" title="Document Types">
                                <i class="fa fa-list"></i> Document Types
                            </a>
                        </div>
                    </div>

                    <form action="{{ url('/save_document_type') }}" method="post">
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
                                        <label for="task_name" class="form-label">Name <span style="color: red">*</span></label>
                                        <input class="form-control" type="text" id="document_type_name" name="document_type_name" required="required" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="task_description" class="form-label">Description </label>
                                        <input class="form-control" type="text" id="document_type_description" name="document_type_description" />
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
