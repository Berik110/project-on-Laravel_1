@extends('layout.app')
@section('content')
    <div class="row mt-4 justify-content-center" style="min-height: 400px">
        <div class="col-md-8 mx-auto">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Персональные данные</a>
                    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Изменить пароль</a>
{{--                    <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>--}}
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
            {{-- 1-Персональные данные --}}
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row mt-4 justify-content-center">
                        <div class="col-md-10">
                            <form method="post" action="{{ route('save_setting') }}">
                                @csrf
                                {{method_field('put')}}
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="form-group row">
                                    <label for="name" class="col-md-5 col-form-label text-md-right font-weight-bold">{{ __('Имя и Фамилия') }}</label>

                                    <div class="col-md-7">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-5 col-form-label text-md-right font-weight-bold">{{ __('Эл.адрес') }}</label>

                                    <div class="col-md-7">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone_number" class="col-md-5 col-form-label text-md-right font-weight-bold">{{ __('Номер телефона') }}</label>

                                    <div class="col-md-7">
                                        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $user->phone_number }}" required autocomplete="email">

                                        @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-7 text-right offset-md-5">
                                        <button type="submit" class="btn btn-success">
                                            {{ __('Сохранить') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            {{-- 2-Изменение пароля--}}
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="row mt-4 justify-content-center">
                        <div class="col-md-10">
{{--                            @if(\Illuminate\Support\Facades\Session::get('success'))--}}
{{--                                <div class="alert alert-success">--}}
{{--                                    {{ \Illuminate\Support\Facades\Session::get('success') }}--}}
{{--                                </div>--}}
{{--                            @endif--}}

                            <form method="post" action="{{ route('change_password') }}" id="changePasswordForm">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label text-md-right font-weight-bold">{{ __('Старый Пароль') }}</label>

                                    <div class="col-md-7">
                                        <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password"autocomplete="old_password" autofocus placeholder="Введите текущий пароль">
                                        <span class="text-danger error-text old_password_error" style="font-size: small"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label text-md-right font-weight-bold">{{ __('Новый Пароль') }}</label>

                                    <div class="col-md-7">
                                        <input type="password" class="form-control" name="new_password" autocomplete="new_password" placeholder="Введите новый пароль">
                                        <span class="text-danger error-text new_password_error" style="font-size: small"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label text-md-right font-weight-bold">{{ __('Подтвердите Новый Пароль') }}</label>

                                    <div class="col-md-7">
                                        <input type="password" class="form-control" name="cnew_password" id="cnew_password_error" autocomplete="cnew_password" placeholder="Повторно введите новый пароль">
                                        <span class="text-danger error-text cnew_password_error" style="font-size: small"></span>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-7 text-right offset-md-5">
                                        <button type="submit" class="btn btn-success">
                                            {{ __('Сохранить') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            {{-- 3-ничего нет--}}
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
            </div>

{{--            <h4 class="text-center">Настройка данных</h4>--}}
{{--            <div class="row mt-3 justify-content-center">--}}
{{--                <div class="col-md-9">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <form method="post" action="{{ route('save_setting') }}">--}}
{{--                                @csrf--}}
{{--                                {{method_field('put')}}--}}
{{--                                <input type="hidden" name="id" value="{{ $user->id }}">--}}
{{--                                <div class="form-group row">--}}
{{--                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя и Фамилия') }}</label>--}}

{{--                                    <div class="col-md-6">--}}
{{--                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>--}}

{{--                                        @error('name')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="form-group row">--}}
{{--                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Эл.адрес') }}</label>--}}

{{--                                    <div class="col-md-6">--}}
{{--                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email">--}}

{{--                                        @error('email')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="form-group row">--}}
{{--                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Номер телефона') }}</label>--}}

{{--                                    <div class="col-md-6">--}}
{{--                                        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $user->phone_number }}" required autocomplete="email">--}}

{{--                                        @error('phone_number')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>Please indicate your phone number</strong>--}}
{{--                                    </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                    начиная тут не надо--}}
{{--                                <div class="form-group row">--}}
{{--                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>--}}

{{--                                    <div class="col-md-6">--}}
{{--                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $user->password }}" required autocomplete="new-password">--}}

{{--                                        @error('password')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="form-group row">--}}
{{--                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Подтвердить Пароль') }}</label>--}}

{{--                                    <div class="col-md-6">--}}
{{--                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ $password }}" required autocomplete="new-password">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                заканчивается тут--}}
{{--                                --}}
{{--                                <div class="form-group row mb-0">--}}
{{--                                    <div class="col-md-6 text-right offset-md-4">--}}
{{--                                        <button type="submit" class="btn btn-success">--}}
{{--                                            {{ __('Сохранить') }}--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection

@section('custom.js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function (){
            $('#changePasswordForm').on('submit', function (event){
                event.preventDefault();

                $.ajax({
                    url:$(this).attr('action'),
                    method:$(this).attr('method'),
                    data:new FormData(this),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success:function (data){
                        if (data.status==0){
                            $.each(data.error, function (prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            $('#changePasswordForm')[0].reset();
                            alert(data.msg);
                        }
                    }
                });
            });
        });
    </script>
@endsection
