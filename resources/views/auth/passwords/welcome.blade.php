
@extends('home')

@section('content-app')
<div class="card card-custom d-none">
    <div class="form-row">
        <div class="form-group col-md-12">
            <button type="submit" id="update-password" class="btn-confirm-login d-none">Entrar</button>
        </div>
    </div>
</div>

@include('user.modal.update-password')

<script>
    $(document).ready(function () {
       $('#update-password').click(); 
    });
</script>
@endsection
