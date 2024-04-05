<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Users') }}</h2>

            <div class="min-w-max">
                <a href="{{route('user.index')}}" class="px-4 py-2 hover:text-white text-white rounded-md text-base bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{route('user.update', $user->id)}}" method="post" class="p-6 bg-white border-b border-gray-200" enctype="multipart/form-data"> @csrf @method('put')
                    <div class="mb-6">
                        <label class="civanoglu-label" for="name">Name <span class="required-text">*</span></label>
                        <input class="civanoglu-input" type="text" id="name" name="name" value="{{$user->name}}" required>

                        @error('name')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="civanoglu-label" for="email">Email <span class="required-text">*</span></label>
                        <input class="civanoglu-input cursor-not-allowed" type="text" id="email" name="email" value="{{$user->email}}" readonly>
                    </div>

                    <div class="flex -mx-4 mb-6">
                        <div class="flex-1 px-4">
                            <label class="civanoglu-label" for="password">Password <span class="required-text">*</span></label>
                            <input class="civanoglu-input" type="password" id="password" name="password" value="{{old('password')}}" required>

                            @error('password')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="flex-1 px-4">
                            <label class="civanoglu-label" for="password_confirmation">Password Confirmation <span class="required-text">*</span></label>
                            <input class="civanoglu-input" type="password" id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}" required>

                            @error('password_confirmation')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <button class="btn" type="submit">Update</button>
                </form>
            </div>


            <div class="flex-1 px-4">
                <label class="civanoglu-label" for="two-factor-authentication">Two factor authentication</label>

                @if (!session('status') == "two-factor-authentication-disabled")
                    <div class="alert alert-danger" role="alert">
                        Two factor authentication has been disabled
                    </div>
                    <div>
                        <form action="/user/two-factor-authentication" method="post" >
                            @csrf
                            <button class="btn btn-success">
                                Enable
                            </button>
                        </form>
                    </div>
                @else
                    <div class="alert alert-success" role="alert">
                        Two factor authentication has been enabled
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg mb-4">Scan this QR code into your authenticator app.</h3>
                        {!! request()->user()->twoFactorQrCodeSvg() !!}
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg mb-4">Record these recovery codes.</h3>
                        @foreach(request()->user()->recoveryCodes() as $code)
                            {{$code}}<br>
                        @endforeach
                    </div>
                 <div class="flex-1 px-4">
                    <label class="civanoglu-label" for="two-factor-authentication-confirmation">Confirm two factor authentication </label>
                    <form action="/user/confirmed-two-factor-authentication" method="post">
                        @csrf
                        <input class="civanoglu-input" type="text" id="code" name="code">
                        <button class="btn" type="submit">Confirm</button>
                    </form>
                    @if (session('status') == 'two-factor-authentication-confirmed')
                        <div class="alert alert-success" role="alert">
                            Two factor authentication confirmed and enabled successfully.
                        </div>
                    @endif
                 </div>
                    <div class="flex-1 px-4">
                        <form action="/user/two-factor-authentication" method="post" >
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-success">
                                Disable
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
