<div class="notification">
    <a>
        <div class="notBtn">
            {{-- Notification icon :  --}}
            <svg id="not-icon" style="cursor:pointer;margin-top:7px;margin-right:-80px;" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg" fill="currentFill">
                <path
                    d="M3.494 6.818a6.506 6.506 0 0 1 13.012 0v2.006c0 .504.2.988.557 1.345l1.492 1.492a3.869 3.869 0 0 1 1.133 2.735 2.11 2.11 0 0 1-2.11 2.11H2.422a2.11 2.11 0 0 1-2.11-2.11c0-1.026.408-2.01 1.134-2.735l1.491-1.492c.357-.357.557-.84.557-1.345V6.818Zm-1.307 7.578c0 .13.106.235.235.235h15.156c.13 0 .235-.105.235-.235 0-.529-.21-1.036-.584-1.41l-1.492-1.491a3.778 3.778 0 0 1-1.106-2.671V6.818a4.63 4.63 0 1 0-9.262 0v2.006a3.778 3.778 0 0 1-1.106 2.671L2.77 12.987c-.373.373-.583.88-.583 1.41Zm4.49 4.354c0-.517.419-.937.937-.937h4.772a.938.938 0 0 1 0 1.875H7.614a.937.937 0 0 1-.938-.938Z">
                </path>
            </svg>
            @auth
                @if (auth()->user()->unreadNotifications->count() != 0)
                    <span style="margin-left:-25px;margin-top:4px;"
                        class="position-absolute top-0 translate-middle badge rounded-pill bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                @endif
            @endauth
            <div style="margin-top:40px;" class="box">
                <div class="display">
                    <div class="cont">
                        @auth
                            @foreach (auth()->user()->notifications as $notification)
                                <div class="sec">
                                    <a href="/profile/{{ $notification->data['profile']['username'] }}">
                                        <div class="profCont">
                                            <img class="profile" src="/storage/{{ $notification->data['profile']['avatar'] }}">
                                        </div>
                                        <div class="txt">{{ $notification->data['message'] }}</div>
                                        <div class="txt sub">{{ $notification->data['sent_at'] }}</div>
                                        <livewire:mark-notification-read :notificationId="$notification->id" :key="$notification->id" />
                                    </a>
                                </div>
                            @endforeach
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
