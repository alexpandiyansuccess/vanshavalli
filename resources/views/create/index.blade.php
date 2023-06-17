@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection

@section('content')
   
    <div class="container mt-5">
        <div id="panel1" class="row justify-content-center">
            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-header custom-header">{{ __('Create Chart') }}</div>

                    <div class="card-body custom-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row mt-4">
                                <label for="node_name"
                                    class="col-md-4 col-form-label text-md-right">Root Node : </label>

                                <div class="col-md-6">
                                    <input id="node_name" type="text"
                                        class="form-control @error('node_name') is-invalid @enderror custom-form" name="node_name"
                                        value="{{ old('node_name') }}" required autofocus>

                                    @error('node_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div id="createButton" class="col-md-8 offset-md-4">



                                </div>
                              
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="panel2">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Tree Chart</div>
                    <div class="panel-body">
                        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

                        <div class="tree">

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Node</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="campaign_image" value="">

                    <div class="form-group">

                        <div class="row">
                            <div class="col-sm-10">



                                <div class="img-container">
                                    <img id="image123" src="{{ asset('images/def.jpeg') }}">
                                </div>
                                <p></p>



                                <div class="row">
                                    <div class="col-md-9 docs-buttons">

                                        <div class="btn-group">

                                            <label class="btn btn-primary btn-upload" for="inputImage"
                                                title="Upload image file">
                                                <input type="file" class="sr-only" id="inputImage" name="file"
                                                    accept="image/*">
                                                <span class="docs-tooltip" data-toggle="tooltip"
                                                    title="Import image with Blob URLs">
                                                    <span class="fa fa-upload"></span>
                                                    Upload
                                                </span>
                                            </label>

                                        </div>

                                        <div class="btn-group btn-group-crop">

                                            <button type="button" class="btn btn-primary" data-method="getCroppedCanvas">
                                                <span class="docs-tooltip" data-toggle="tooltip"
                                                    title="$().cropper(&quot;getCroppedCanvas&quot;)">
                                                    <span class="fa fa-picture-o"></span>

                                                    Save Image
                                                </span>
                                            </button>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <input id="nodeid" type="hidden" value="0">
                    <span id="errormodal"></span>
                    <form>
                        <div class="form-group">
                            <label for="rootname">Node Name</label>
                            <input type="text" class="form-control" id="nodename">
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-ligh" data-dismiss="modal">Close</button>
                    <button id="savenodename" type="button" class="btn btn-primary">Save</button>
                    <button id="addparent" type="button" class="btn btn-primary">Add Parent</button>
                    <button id="addchild" type="button" class="btn btn-primary">Add Child</button>
                    <button id="deletenode" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
@endsection


