@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')
@can('edit settings')
<settings-component></settings-component>
@endcan
@endsection
