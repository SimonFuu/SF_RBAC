@extends('layouts.layout')
@section('body')
    <div class="notify-body">
        &nbsp;
        <script>
            $('.login-time-out-mark').on('click', function() {
                window.top.location.href = $(this).data('url');
            });
        </script>
    </div>
@endsection