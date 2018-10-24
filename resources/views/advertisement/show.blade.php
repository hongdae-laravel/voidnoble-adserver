@extends("layouts.app")

@section("header")
    <title>Advertisement Detail</title>
@endsection

@section("content")
    <div class="page-header mb-2">
        <h1>배너 {{ $data->id }}</h1>
    </div>

    <h2>{{ $data->title }}</h2>

    <div class="form-group">
        <label for="html">배너 embed 코드</label>
        <textarea name="embed" id="embed" cols="50" rows="10" class="form-control" placeholder="배너 embed 코드"><ins id="adver-voidnoble-{{ $data->id }}" class="adver-voidnoble"></ins><script src="{{ $data->host }}/js/render_adver.js"></script></textarea>
    </div>

    <ins id="adver-voidnoble-{{ $data->id }}" class="adver-voidnoble"></ins></textarea>
    <script src="{{ $data->host }}/js/render_adver.js"></script>

    <div class="form-group">
        <button type="button" class="btn btn-default btn-list">목록</button>
    </div>
@endsection

@section("script")
    <script>
    $('.btn-list').on('click', function (evt) {
        self.location.href = "/advertisements";
    });
    </script>
@endsection