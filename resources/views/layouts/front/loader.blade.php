@extends('layouts.app')

<style>
    .loaderBg {
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        background-color: rgb(58 94 158);
        color: #fff;
    }
</style>

@section('content')
    <section class="loaderBg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto py-5">
                    <div class="text-center my-5 py-5">
                        <div class="my-5 py-5">
                            <div>
                                <h2>Waiting For Your Response...</h2>
                            </div>
                            <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
