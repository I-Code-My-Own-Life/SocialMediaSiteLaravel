@extends('layouts.app')

@section('content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        Complete your profile
    </h2>

    <div style="background-color:white;padding-bottom:50px;">
        <div style="width: 600px;margin-left: 300px;">
            <form style="text-align:center;padding:10px;" action="/profile" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Username :  --}}
                <div class="mb-4">
                    <x-label for="username" :value="__('Username')" />
                    <x-input value="username" type="text" :oldvalue="old('username')" required />
                    <x-show-error value="username" />
                </div>

                {{-- Bio :  --}}
                <div class="mb-4">
                    <x-label for="bio" :value="__('Bio')" />
                    <x-textarea value="bio" :placeholder="null" required />
                    <x-show-error value="bio" />
                </div>

                {{-- Avatar :  --}}
                <div class="mb-4">
                    <x-label for="avatar" :value="__('Profile picture')" />
                    <x-input value="avatar" type="file" :oldvalue="old('avatar')" required/>
                    <x-show-error value="avatar" />
                </div>

                {{-- Button :  --}}
                <div class="flex items-center justify-center mt-6">
                    <x-button class="btn-dark">Create profile</x-button>
                </div>
            </form>
        </div>
    </div>
@endsection
