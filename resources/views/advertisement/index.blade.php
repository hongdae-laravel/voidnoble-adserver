@extends("layouts.app")

@section("header")
    <title>Advertisement list</title>
@endsection

@section("content")
    <div class="page-header mb-2">
        <h1>배너 목록</h1>
    </div>

    @if(count($advers) > 0)
        <ul class="list-group mb-4">
        @foreach($advers as $adver)
            <li class="list-group-item">
                <form class="badge" method="post" action="/advertisements/{{ $adver->id }}">
                    {{ method_field("DELETE") }}
                    {{ csrf_field() }}
                    <a href="/advertisements/{{ $adver->id }}/edit" class="btn btn-edit">수정</a>
                    <a href="javascript:void(0)" class="btn btn-del">삭제</a>
                </form>
                <a href="/advertisements/{{ $adver->id }}">{{ $adver->title }}</a>
            </li>
        @endforeach
        </ul>
    @endif

    <button type="button" id="btnWrite" class="btn btn-primary">입력</button>
@endsection

@section("script")
    <script>
        $('#btnWrite').on('click', function (evt) {
            self.location.href = "/advertisements/create";
        });

        $('.btn-del').on('click', function (evt) {
            $(this).parent().submit();
        });
    </script>
@endsection