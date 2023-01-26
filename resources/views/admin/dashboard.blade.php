@extends('admin.layout.master')
@section('content')
<h1>Admin Dashboard</h1>
{{auth()->guard('admin')->user()}}
<h4>Welcome Admin</h4>
@endsection
