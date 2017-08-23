@extends('layouts.app')

@section('content')
    <section class="hero is-light is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="columns align-item-center">
                    <div class="column is-7">
                        <h1 class="title">
                            Sign-In
                        </h1>
                        <h2 class="subtitle">
                            Login into your {{ config('app.name') }} account.
                        </h2>
                    </div>
                    <div class="column is-5">
                        <div class="card">
                            <div class="card-content">
                                <form method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}

                                    <div class="field">
                                        <label class="label" for="email">Email</label>
                                        <div class="control has-icons-left">
                                            <input class="input {{ $errors->has('email') ? ' is-danger' : '' }}"
                                                   name="email"
                                                   id="email"
                                                   type="text"
                                                   placeholder="hello@email.com"
                                                   value="{{ old('email') }}" required v-focus>

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
                                                   value="" required>

                                            <span class="icon is-small is-left">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                        </div>
                                        @if ($errors->has('password'))
                                            <p class="help is-danger">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <label class="checkbox">
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                            </label>
                                        </div>
                                    </div>

                                    <div class="field is-grouped">
                                        <div class="control">
                                            <button type="submit" class="button is-primary">
                                                Login
                                            </button>

                                            <a class="button is-link" href="{{ route('password.request') }}">
                                                Forgot Your Password?
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{--end card--}}
                        <div class="column">
                            <p class="has-text-centered">
                                or <a href="{{ route('register') }}" class="has-text-primary">Create an Account</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
