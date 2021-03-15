@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Update Document Type') }}
                    </div>

                    <form action="{{ url('/update_document_type/'.$document_type_info->id) }}" method="post">
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
                                        <input class="form-control" type="text" id="document_type_name" name="document_type_name" required="required" value="{{ $document_type_info->document_type_name }}" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="task_description" class="form-label">Description </label>
                                        <input class="form-control" type="text" id="document_type_description" name="document_type_description" value="{{ $document_type_info->document_type_description }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="task_assign_to" class="form-label">Status <span style="color: red">*</span></label>
                                        <select class="form-control" name="status" id="status" required="required">
                                            <option value="">Select Status</option>
                                            <option value="0" @if($document_type_info->status == 0) selected="selected" @endif>Inactive</option>
                                            <option value="1" @if($document_type_info->status == 1) selected="selected" @endif>Active</option>
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
