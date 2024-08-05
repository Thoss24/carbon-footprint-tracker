@props(['name', 'profile_photo_path', 'id'])

<div>
  <div class="flex row gap-2">
    <img src="{{$profile_photo_path}}" alt="profile img">
    <h2>{{$name}}</h2>
  </div>
</div>
