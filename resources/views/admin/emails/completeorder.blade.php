@extends('admin/emails/layouts/default')

@section('content')
<p>Hello {!! $user->name !!} ,</p>

<p></p>

<p>Best Regards,</p>

@stop
