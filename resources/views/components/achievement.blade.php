
<div class="relative flex flex-col">
  <img class="w-20 h-20 {{!$met ? 'opacity-20' : 'opacity-100'}}" src="http://carbon-footprint-tracking-app.test/storage/images/{{$icon}}" alt="">
  @if ($achieveType == 'goals')
    <p>Meet {{$count}} {{$type}} goal</p>
  @elseif ($achieveType == 'submit_data')
    <p>Submit {{$type}} data {{$count}} times</p>
  @endif
</div>