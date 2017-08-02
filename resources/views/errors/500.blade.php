@extends('layouts.layout')
@section('body')
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-red"> 500</h2>
            <div class="error-content">
                <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>
                <p>
                    We will work on fixing that right away.
                </p>
                <p>
                    Meanwhile, you may <a href="/main">return to dashboard</a> or try again later.
                </p>
            </div>
        </div>
        <!-- /.error-page -->
    </section>
@endsection