@extends('admin/emails/layouts/default')

@section('content')
<p>Hello {!! $user->name !!} ,</p>

<p>You have New Order List ! It is quick delivery so please reply immediately! Thank you !</p>

<p>Best Regards,</p>

@stop
