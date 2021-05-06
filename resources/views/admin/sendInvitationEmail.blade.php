@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Send invitation email</div>
                <div class="card-body">
                    @csrf
                    <form action="/admin/api/invitationEmail/store" method="post">
                        @csrf <!-- {{ csrf_field() }} -->
                        <input type="email" name="email" id="email" required>
                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
