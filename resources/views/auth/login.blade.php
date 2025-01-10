@extends('frontEnd.layout.site-master')

@section('content')

<section id="logon">
    <div class="contain">
        <div class="log_blk">
            <form action="{{ route('login')}}" method="post">
                @csrf
                <div class="text">
                    <h3>Sign in to your account</h3>
                    <p>Enter your login details below</p>
                </div>
                <div class="row form_row">
                    <div class="col-sm-12">
                        <div class="form_blk">
                            {{-- <input type="text" name="" id="" class="input" placeholder="Email Address"> --}}
                            <input id="email" type="email" class="form-control input @error('email') is-invalid @enderror" placeholder="Email Address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form_blk">
                            {{-- <input type="password" name="" id="" class="input" placeholder="Password"> --}}
                            <input id="password" type="password" class="form-control input @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form_blk d-flex justify-content-between flex-wrap">
                            <div class="lbl_btn">
                                {{-- <input type="checkbox" name="remember" id="remember"> --}}
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">Remember me</label>
                            </div>
                            <a href="{{ route('password.request') }}" class="forgot">Forgot your password ?</a>
                        </div>
                    </div>
                </div>
                <div class="btn_blk mt-5">
                    <button type="submit" class="site_btn w-100">Sign in</button>
                </div>
                <div class="have_account">Don't have an account? <a href="{{ route('register') }}">Sign up</a></div>
            </form>
        </div>
    </div>
</section>
@endsection
