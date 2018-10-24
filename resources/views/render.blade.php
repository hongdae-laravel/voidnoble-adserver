<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Advertisement</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex,nofollow">
</head>
<body>
    <a href="{{ (Request::server('SERVER_PORT') == 443)? "https" : "http" }}://{{ Request::server('HTTP_HOST') }}/collects/click/{{ $data->id }}" title="{{ $data->link_title }}" target="{{ ($data->link_new_window == "1")? "_blank" : "_self" }}">
    @if ($data->type == "file")
        <img src="{{ asset("storage/" . $data->file) }}" width="{{ $data->width }}" height="{{ $data->height }}">
    @elseif ($data->type == "html")
        {{ $data->html }}
    @elseif ($data->type == "url")
        <img src="{{ $data->url }}" width="{{ $data->width }}" height="{{ $data->height }}"></a>
    @endif
    </a>
    <img src="{{ (Request::server('SERVER_PORT') == 443)? "https" : "http" }}://{{ Request::server('HTTP_HOST') }}/collects/view/{{ $data->id }}" width="0" height="0">
</body>
</html>