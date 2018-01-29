@extends('layouts.base')

@section('body')
    <div class="container">
        <div class="row" style="margin-top:30px;">
            <div class="col-md-4 offset-md-4">
                @include('layouts._alerts')

                <div class="card">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <div>
                            @yield('small-content')
                        </div>
                    </div>
                </div>

                @yield('small-content-after')
            </div>
        </div>
    </div>
@endsection
