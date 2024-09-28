<div class="flex flex-row items-center bg-white rounded-lg shadow-sm mb-2">
    @if ($auth_user_id == $user_id)
        <h2 class="text-lg font-semibold text-black">{{ $friend_name }}</h2>
    @else
        <h2 class="text-lg">
            <a class="no-underline font-medium text-gray-800 hover:text-emerald-500 transition duration-200"
               href="{{ route('friend-profile', ['friend_id' => $user_id]) }}">
                {{ $user_name }}
            </a>
        </h2>
    @endif
</div>