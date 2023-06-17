@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Project Chart Code</b> (copy code to your website or download it as html)
                    </div>
                    <div class="panel-body">

                        <input type="hidden" id="htmlcode" value="{{ $html }}">

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">

                            <textarea onclick="this.select()" id="treecode">{{ $tree }}</textarea>

                        </form>
                        <a class="btn btn-primary btn-rounded" id="download">Download as HTML</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/export.js') }}"></script>
@endsection
