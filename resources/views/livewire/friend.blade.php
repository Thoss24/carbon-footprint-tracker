    {{-- Friends: Illuminate\Database\Eloquent\Collection Object ( [items:protected] => Array ( [0] => App\Models\Friendship Object ( [connection:protected] => mysql [table:protected] => friendships [primaryKey:protected] => id [keyType:protected] => int [incrementing] => 1 [with:protected] => Array ( ) [withCount:protected] => Array ( ) [preventsLazyLoading] => [perPage:protected] => 15 [exists] => 1 [wasRecentlyCreated] => [escapeWhenCastingToString:protected] => [attributes:protected] => Array ( [id] => 1 [user_id] => 4 [friend_id] => 3 [created_at] => 2024-08-22 09:33:14 [updated_at] => 2024-08-22 09:33:14 [user_name] => Thomas doe [friend_name] => John doe ) [original:protected] => Array ( [id] => 1 [user_id] => 4 [friend_id] => 3 [created_at] => 2024-08-22 09:33:14 [updated_at] => 2024-08-22 09:33:14 [user_name] => Thomas doe [friend_name] => John doe ) [changes:protected] => Array ( ) [casts:protected] => Array ( ) [classCastCache:protected] => Array ( ) [attributeCastCache:protected] => Array ( ) [dateFormat:protected] => [appends:protected] => Array ( ) [dispatchesEvents:protected] => Array ( ) [observables:protected] => Array ( ) [relations:protected] => Array ( ) [touches:protected] => Array ( ) [timestamps] => 1 [usesUniqueIds] => [hidden:protected] => Array ( ) [visible:protected] => Array ( ) [fillable:protected] => Array ( [0] => user_id [1] => friend_id ) [guarded:protected] => Array ( [0] => * ) ) ) [escapeWhenCastingToString:protected] => ) --}}

    <div class="flex flex-row">
        @if ($auth_user_id == $user_id)
            <h2>{{ $friend_name }}</h2>
        @else
            <h2>
                <a class="no-underline font-medium text-gray-800 hover:text-emerald-500"
                    href="{{ route('friend-profile', ['friend_id' => $user_id]) }}">
                    {{ $user_name }}
                </a>
            </h2>
        @endif
    </div>
