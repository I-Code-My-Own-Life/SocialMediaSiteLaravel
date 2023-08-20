@extends('layouts.app')

@section('content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        @if (auth()->user()->id === $profile->user->id)
            Your profile
        @else
            {{ $profile->username }} profile
        @endif
    </h2>

    <div style="margin-top:30px;padding:140px; display:flex; align-items:baseline; justify-content:center"
        class="p-6 border-b border-gray-200">

        {{-- Username :  --}}
        <div style="display: block;position: absolute; top:430px">
            <h1 style="font-size:30px">{{ $profile->user->name }}</h1>
        </div>

        {{-- Avatar :  --}}
        <img style="position: absolute;top: 202px;height:125px; background:rgb(245, 250, 245); border-radius:50%"
            src="/storage/{{ $profile->avatar }}" alt="image">

        {{-- Bio :  --}}
        <p style="postion:absolute;margin-top:80px;">{{ $profile->bio }}</p>

    </div>
    <div style="text-align:center;">
        @if (!(auth()->user()->id == $profile->user->id))
            @if (auth()->user()->friends->contains('id', $profile->user->id))
                <x-button class="btn-success">Friends</x-button>
            @else
                @if (auth()->user()->receivedFriendRequests->contains('user_id', $profile->user->id))
                    {{-- Display "Accept request" button --}}
                    <div style="display:flex; justify-content:center;">
                        <form class="mx-4" method="post" action="{{ route('friend-requests.accept', ['user' => $profile->user->id]) }}">
                            @csrf
                            <x-button class="btn-primary">Accept request</x-button>
                        </form>
                        <form class="mx-4 bg-red" method="post" action="{{ route('friend-requests.reject', ['user' => $profile->user->id]) }}">
                            @csrf
                            <x-button class="btn-danger">Reject request</x-button>
                        </form>
                    </div>
                @else
                    <form method="post" action="{{ route('friend-requests.send', ['user' => $profile->user->id]) }}">
                        @csrf
                        <x-button class="btn-dark">Add friend</x-button>
                    </form>
                @endif
            @endif
        @endif
    </div>
@endsection
