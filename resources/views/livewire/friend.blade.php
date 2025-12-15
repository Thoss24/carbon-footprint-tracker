<div class="flex flex-row items-center bg-white rounded-lg shadow-sm mb-2">
    @if ($auth_user_id == $user_id)
        <h2 class="text-lg">
            <a class="no-underline font-medium text-gray-800 hover:text-emerald-500 transition duration-200"
                href="{{ route('friend-profile', ['friend_id' => $friend_id]) }}">
                {{ $friend_name }}
            </a>
        </h2>
    @else
        <h2 class="text-lg">
            <a class="no-underline font-medium text-gray-800 hover:text-emerald-500 transition duration-200 flex row gap-2 content-center items-center"
                href="{{ route('friend-profile', ['friend_id' => $user_id]) }}">
                <div class="flex rounded-3xl bg-slate-200 p-1">
                    {{ $profile_initials }}
                </div>
                {{ $user_name }}
            </a>
        </h2>
    @endif
</div>
