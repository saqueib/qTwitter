@extends('layouts.app')

@section('content')
<section class="hero is-light is-fullheight">
    <div class="hero-body">
        <div class="container">
            <div class="columns align-item-center">
                <div class="column is-7">
                    <h1 class="title">
                        Reset Password
                    </h1>
                    <h2 class="subtitle">
                        Create a new password.
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

                            <form method="POST" action="{{ route('password.request') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="token" value="{{ $token }}">

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

                                <div class="field">
                                    <label class="label" for="password">Password</label>
                                    <div class="control has-icons-left">
                                        <input class="input {{ $errors->has('password') ? ' is-danger' : '' }}"
                                               name="password"
                                               id="password"
                                               type="password"
                                               placeholder="Password"
                                               value="{{ old('password') }}">

                                        <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('password'))
                                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>

                                <div class="field">
                                    <label class="label" for="password_confirmation">Confirm Password </label>
                                    <div class="control has-icons-left">
                                        <input class="input {{ $errors->has('password_confirmation') ? ' is-danger' : '' }}"
                                               name="password_confirmation"
                                               id="password_confirmation"
                                               type="password"
                                               placeholder="Password Confirmation"
                                               value="{{ old('password_confirmation') }}">

                                        <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                                    @endif
                                </div>

                                <div class="field is-grouped">
                                    <div class="control">
                                        <button type="submit" class="button is-primary">
                                            Reset Password
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
