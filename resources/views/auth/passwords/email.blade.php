@extends('layouts.app')

@section('content')
<section class="hero is-light is-fullheight">
    <div class="hero-body">
        <div class="container">
            <div class="columns align-item-center">
                <div class="column is-7">
                    <h1 class="title">
                        Forgot Password?
                    </h1>
                    <h2 class="subtitle">
                        Give your registered email id and we will <br>
                        send you password reset email.
                    </h2>
                </div>
                <div class="column is-5">
                    <div class="card">
                        <div class="card-content">

                            @if (session('status'))
                                <div class="alert bg-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}

                                <div class="field">
                                    <label class="label" for="email">Email</label>
                                    <div class="control has-icons-left">
                                        <input class="input {{ $errors->has('email') ? ' is-danger' : '' }}"
                                               name="email"
                                               id="email"
                                               type="text"
                                               placeholder="hello@email.com"
                                               value="{{ old('email') }}" required autofocus>

                                        <span class="icon is-small is-left">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('email'))
                                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>

                                <div class="field is-grouped">
                                    <div class="control">
                                        <button type="submit" class="button is-primary">
                                            Send Password Reset Link
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{--end card--}}
                    <div class="column">
                        <p class="has-text-centered">
                            back to <a href="{{ route('login') }}" class="has-text-primary">Sign-In</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
