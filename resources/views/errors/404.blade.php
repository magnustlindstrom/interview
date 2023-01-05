@extends('errors.layout')

@php
  $error_number = 404;
@endphp

@section('title')
  Page not found.
@endsection

@section('description')
  @php
    $default_error_message = "Please <a href='javascript:history.back()''>go back</a> or return to <a href='".url('')."'>our homepage</a>.";
  @endphp
  {!! isset($exception)? ($exception->getMessage()?e($exception->getMessage()):$default_error_message): $default_error_message !!}
  <div class="w-1/3 m-auto flex flex-col items-center py-24">
      @svg('illustrations/under-construction', 'text-primary')
      <h1 class="text-2xl text-primary">Page is under construction</h1>
  </div>
@endsection
