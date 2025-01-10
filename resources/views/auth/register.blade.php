@extends('frontEnd.layout.site-master')

@section('content')

<section id="logon">
    <div class="contain">
        <div class="log_blk">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="text">
                    <h3>Create an account</h3>
                    <p>Enter your details below</p>
                </div>
                <div class="row form_row">
                    <div class="col-sm-12">
                        <div class="form_blk">
                            <input id="name" type="text" class="form-control input @error('name') is-invalid @enderror" placeholder="Full Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form_blk">
                            <input id="email" type="email"  placeholder="Email Address" class="form-control input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form_blk">
                            <input type="text" name="number" id="" value="{{ old('number') }}" class="input @error('number') is-invalid @enderror" placeholder="Phone Number">

                            @error('number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form_blk">
                          
                                <input id="password" type="password" class="form-control input @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                              

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form_blk">
                 
                                <input id="password-confirm" placeholder="Confirm-Password" type="password" class="form-control input" name="password_confirmation" required autocomplete="new-password">

                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form_blk">
                            <div class="lbl_btn">
                                <input type="checkbox" name="confirm" id="confirm">
                                <label for="confirm">By creating an account you confirm that you agree to our website terms of use and our privacy notice.</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn_blk mt-5">
                    <button type="submit" class="site_btn w-100">Create an Account</button>
                </div>
                <div class="have_account">Already have an account? <a href="{{route('login')}}">Sign in</a></div>
            </form>
        </div>
    </div>
</section>
@endsection
