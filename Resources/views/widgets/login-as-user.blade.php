@php
    $url = url("/api/root-access/loginAsUser/{$user_id}") . '?name=' . $name;
    if (!empty($params)) {
        $url .= '&params=' . urlencode(json_encode($params));
    }
@endphp

<a href="{{ $url }}" 
   onclick="window.open(this.href, 'userLoginWindow'); return false;"
   class="badge bg-light text-dark px-2 py-1"
   style="cursor:pointer;">
   Log ind &rsaquo;
</a>
