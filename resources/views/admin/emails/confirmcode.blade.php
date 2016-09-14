@extends('admin/emails/layouts/default')

@section('content')
<p>Hello {!! $user->name !!} ,</p>

<p>Your 528express Verification code is {!! $user->code !!}</p>

<p>Best Regards,</p>

@stop
