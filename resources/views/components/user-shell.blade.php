@props(['name', 'profile_photo_path', 'id'])

<div class="flex m-2 content-center items-center gap-4">
    <div class="flex row gap-2 content-center items-center">
        @if (strlen($profile_photo_path) != 0)
            <img src="{{ $profile_photo_path }}" alt="profile img">
        @else
            <div id='profile-icon' class="flex rounded-3xl bg-slate-200 p-1">
              @php
                $initials = explode(" ", $name);
                foreach ($initials as $value) {
                  echo $value[0];
                }
              @endphp
            </div>
        @endif
        <h2>{{ $name }}</h2>
      </div>
      <livewire:add-friend :user_id="$id"/>
</div>

