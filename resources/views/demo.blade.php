@extends('layouts.demo')
@section('content')
     
@if(Session::has('messenge'))
<div class="alert alert-success">
    {{Session::get('messenge')}}
</div>
@endif
<div style="margin: 50px auto; width: 550px;">
<form action="{{ url('emailsend') }}" method="POST">
    @csrf
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        	<table>
        		<tr>
        			<td>To: </td>
        			<td><input type="text" name="to" value="{{ old('to') }}"> - 
        				From: <input type="text" name="from" value="{{ old('from') }}">
        			</td>
        		</tr>
        		<tr>
        			<td>Subject:</td>
        			<td><input type="text" name="Subject" value="{{ old('Subject') }}"></td>
        		</tr>
        		<tr>
        			<td>content:</td>
        			<td><textarea name="content" style="min-width:500px; min-height: 200px ">{{ old('content') }}</textarea></td>
        		</tr>
        		<tr>
        			<td></td>
        			<td>
        				<input type="submit" value="Submit">
        			</td>
        		</tr>
        	</table>
		</div>
	</div>
</form>
</div>
@endsection