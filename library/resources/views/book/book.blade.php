@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12 m6 l3">
        <book-component></book-component>

    </div>
    <div class="col s7">
        <addbook-component></addbook-component>
    </div>
</div>
@endsection
