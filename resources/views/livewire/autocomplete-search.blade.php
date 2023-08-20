<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <input wire:model='search' autocomplete="off"
        style="border-radius: 10px; padding:5px; width: 200px; margin-right: 100px;" type="text" name="name"
        id="search-username" placeholder="Search by name">

    {{-- Our autocomplete results : --}}
    <ul id="autocomplete-results"
        style="border-radius:1px;position: absolute; top: 120%; left: 0; width: 200px; background-color: #fff; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2); list-style: none; z-index:4;">
        @foreach ($users as $user)
            <a href="/profile/{{ $user->profile->username }}">
                <li class='my-2 py-1'>{{ $user->name }}</li>
            </a>
        @endforeach
    </ul>
</div>
