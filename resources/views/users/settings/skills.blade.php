@title('Password')

@extends('layouts.settings')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">My Skills</div>
        <div class="panel-body">
            {{ Form::open(['route' => 'settings.skills.update', 'method' => 'PUT', 'class' => 'form-horizontal-x']) }}

            <div class="row">
                <div class="col-md-12">
                    <h4>Languages</h4>
                </div>
                @foreach($skills['language'] as $item)
                    <div class="col-sm-4">
                        {!! Form::checkbox('skills[]', $item->id, in_array($item->id, $userSkills)) !!}
                        {{ $item->name }}
                    </div>
                @endforeach
            </div>


            <div class="row">
                <div class="col-md-12">
                    <h4>Databases</h4>
                </div>
                @foreach($skills['database'] as $item)
                    <div class="col-sm-4">
                        {!! Form::checkbox('skills[]', $item->id, in_array($item->id, $userSkills)) !!}
                        {{ $item->name }}
                    </div>
                @endforeach
            </div>


            <div class="row">
                <div class="col-md-12">
                    <h4>Frameworks</h4>
                </div>
                @foreach($skills['framework'] as $item)
                    <div class="col-sm-4">
                        {!! Form::checkbox('skills[]', $item->id, in_array($item->id, $userSkills)) !!}
                        {{ $item->name }}
                    </div>
                @endforeach
            </div>


            <div class="row">
                <div class="col-md-12">
                    <h4>IDE (Code Editors)</h4>
                </div>
                @foreach($skills['ide'] as $item)
                    <div class="col-sm-4">
                        {!! Form::checkbox('skills[]', $item->id, in_array($item->id, $userSkills)) !!}
                        {{ $item->name }}
                    </div>
                @endforeach
            </div>


            <div class="row">
                <div class="col-md-12">
                    <h4>Security</h4>
                </div>
                @foreach($skills['security'] as $item)
                    <div class="col-sm-4">
                        {!! Form::checkbox('skills[]', $item->id, in_array($item->id, $userSkills)) !!}
                        {{ $item->name }}
                    </div>
                @endforeach
            </div>


            <div class="row">
                <div class="col-md-12">
                    <h4>Operating Systems</h4>
                </div>
                @foreach($skills['os'] as $item)
                    <div class="col-sm-4">
                        {!! Form::checkbox('skills[]', $item->id, in_array($item->id, $userSkills)) !!}
                        {{ $item->name }}
                    </div>
                @endforeach
            </div>


            <div class="row">
                <div class="col-md-12">
                    <h4>Others</h4>
                </div>
                @foreach($skills['other'] as $item)
                    <div class="col-sm-4">
                        {!! Form::checkbox('skills[]', $item->id, in_array($item->id, $userSkills)) !!}
                        {{ $item->name }}
                    </div>
                @endforeach
            </div>





            <div class="row">
                <div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
            </div>



            {{ Form::close() }}
        </div>
    </div>
@endsection
