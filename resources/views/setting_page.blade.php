@extends('layout.app')
@section('content')
    <div class="row mt-4 justify-content-center" style="min-height: 400px">
        <div class="col-md-8 mx-auto">
            <h4 class="text-center">Настройка данных</h4>
            <div class="row mt-3 justify-content-center">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('save_setting') }}">
                                @csrf
                                {{method_field('put')}}
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя и Фамилия') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Эл.адрес') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Номер телефона') }}</label>

                                    <div class="col-md-6">
                                        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $user->phone_number }}" required autocomplete="email">

                                        @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>Please indicate your phone number</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

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

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 text-right offset-md-4">
                                        <button type="submit" class="btn btn-success">
                                            {{ __('Сохранить') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
