@if (! empty($avatarUrl))
    <img src="{{ $avatarUrl }}" alt="{{ $name }}" width="40" height="40"
         class="rounded-circle object-fit-cover">
@else
    <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-secondary text-white"
          style="width: 40px; height: 40px;">
        {{ mb_strtoupper(mb_substr($name, 0, 1)) }}
    </span>
@endif
