@extends('welcome') {{-- lay theo ten welcome.blade.php --}}
@section('content') {{--  content la ten tu dat --}}
<div class="login">
	<?php
										$message = Session::get('alert');
										//nếu tồn tại biến $message thỳ thực hiện lệnh
										if($message) {
											echo '<section class="alert alert-danger" style="text-align: center">'.$message.' </section';
											Session::put('alert', null);
										}
									?>
					<div class="container">
						<div class="row">
							<div class="col-sm-5 ">
								<div class="login-form"><!--login form-->
									<h2>Đăng nhập tài khoản</h2>
									<form action="{{URL::to('/login-customer')}}" method="post" id="login">
										{{csrf_field() }}
										{{-- <div class="error-message" style="color: red; list-style: none;">
        									<ul>
									            @foreach ($errors->all() as $error)
									            <li>{{ $error }}</li>
									            @endforeach
        									</ul>
									    </div> --}}
										<input type="text" name="email_account" placeholder="Tài khoản" />
										<input type="password" name="password_account" placeholder="Mật khẩu" />
										<span>
											<input type="checkbox" class="checkbox"> 
											<p>Ghi nhớ đăng nhập</p>
										</span>
										<button type="submit" class="btn btn-default login">Đăng nhập</button>
									</form>
								</div><!--/login form-->
							</div>
							<div class="col-sm-2">
								<h2 class="or">Hoặc</h2>
							</div>
							<div class="col-sm-5">
								<div class="signup-form"><!--sign up form-->
									<h2>Đăng kí tài khoản</h2>
									<form action="{{URL::to('/add-customer')}}" method="post" id="login-checkout">
										{{csrf_field() }}
										{{-- @if ($errors->any())
										    <div class="alert alert-danger">
										        <ul>
										            @foreach ($errors->all() as $error)
										                <li>{{ $error }}</li>
										            @endforeach
										        </ul>
										    </div>
										@endif --}}
										{{-- <input id="title" type="text" name="title" class="@error('title') is-invalid @enderror">

										@error('title')
										    <div class="alert alert-danger">{{ $message }}</div>
										@enderror --}}
										<input type="text" id="customer_name" name="customer_name" class="@error('customer_name') is-invalid @enderror" placeholder="Họ và tên" >
										@error('customer_name')
										    <div class="alert alert-danger">{{ $message }}</div>
										@enderror

										<input type="text" id="customer_email" name="customer_email"  placeholder="Địa chỉ email" class="@error('customer_email') is-invalid @enderror">
										@error('customer_email')
										    <div class="alert alert-danger">{{ $message }}</div>
										@enderror 

										<input type="password" id="customer_password" name="customer_password"  placeholder="Mật khẩu" class="@error('customer_password') is-invalid @enderror">
										@error('customer_password')
										    <div class="alert alert-danger">{{ $message }}</div>
										@enderror 

										<input type="password" id="confirm_password" name="confirm_password"  placeholder="Nhập lại Mật khẩu" class="@error('confirm_password') is-invalid @enderror">
										@error('confirm_password')
										    <div class="alert alert-danger">{{ $message }}</div>
										@enderror 

										<input type="text" id="customer_phone" name="customer_phone"  placeholder="Số điện thoại" class="@error('customer_phone') is-invalid @enderror">
										@error('customer_phone')
										    <div class="alert alert-danger">{{ $message }}</div>
										@enderror
										<div>
											<label>Đồng ý các điều khoản</label>
											<input name="dieukhoan" type="checkbox" style="width: 15px; 
											    float: left;
											    height: 15px;
											    margin-right: 5px;
											    margin-top: 3px"
											    class="@error('dieukhoan') is-invalid @enderror"
											    >
												@error('dieukhoan')
										    <div class="alert alert-danger">{{ $message }}</div>
										@enderror
										</div>
										<div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
										<br/>
										{{-- ktra lõi --}}
										{{-- @if($errors->has('g-recaptcha-response')) 

										<span class="invalid-feedback" style="display:block">
											<strong>{{$errors->first('g-recaptcha-response')}}</strong>
										</span>
										@endif --}}
										<button type="submit" class="btn btn-default login-checkout">Đăng kí</button>
									</form>
									
								</div><!--/sign up form-->
							</div>
						</div>
					</div>
				</div> <!-- hết login -->
@endsection