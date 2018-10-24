@extends("layouts.app")

@section("header")
    <title>Advertisement form</title>
@endsection

@section("content")
    <div class="page-header mb-2">
        <h1>배너 입력</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form name="frm_input" method="post" action="/advertisements/{{ $id }}" enctype="multipart/form-data">
        @if ($form_method == "put")
            {{ method_field("PUT") }}
        @endif
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">제목</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">코드</label>
            <input type="text" name="code" id="code" class="form-control col-3" placeholder="유니크한 구분 코드 - 영숫자">
        </div>

        <div class="form-group">
            <label for="type">유형</label>
            <select name="type" id="type" class="form-control col-2" required>
                <option value="file">이미지</option>
                <option value="html">HTML</option>
                <option value="url">URL</option>
            </select>
        </div>
        <div class="form-group">
            <div class="type-item type-item-file">
                <label for="file">배너 파일</label>
                <label for="">배너</label>
                업로드 <input type="file" name="file" id="file" class="form-control-file">
                <img src="" alt="배너 파일 미리보기" class="file-preview-image">
            </div>
            <div class="type-item type-item-html">
                <label for="html">배너 HTML 코드</label>
                <textarea name="html" id="html" cols="50" rows="5" class="form-control" placeholder="배너 HTML 코드"></textarea>
            </div>
            <div class="type-item type-item-url">
                <label for="url">배너 URL</label>
                <input type="text" name="url" id="url" class="form-control" placeholder="배너 URL https://">
            </div>
        </div>

        <div class="form-group">
            <label for="">위치</label>
            <input type="text" name="position" id="position" class="form-control col-2" placeholder="위치를 나타내는 영숫자">
        </div>
        <div class="form-group">
            <label for="">순서</label>
            <input type="number" name="sequence" id="sequence" class="form-control col-1" placeholder="숫자">
        </div>
        <div class="form-group row mx-0 align-items-center">
            <label for="width">크기 (px)</label>
            <div class="w-100"></div>
            <input type="text" name="width" id="width" class="form-control col-1 mr-2" placeholder="넓이" required> x <input type="text" name="height" id="height" class="form-control col-1 ml-2" placeholder="높이" required>
        </div>
        <div class="form-group">
            <label for="link">링크</label>
            <input type="text" name="link" id="link" class="form-control" placeholder="https://">
        </div>
        <div class="form-group">
            <label for="link_title">링크 텍스트</label>
            <input type="text" name="link_title" id="link_title" class="form-control">
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="link_new_window" id="link_new_window" value="1">
            <label class="form-check-label" for="link_new_window">링크 클릭시 새창</label>
        </div>
        <div class="form-group row mx-0 align-items-center">
            <label for="start_date">표시기간</label>
            <div class="w-100"></div>
            <input type="text" name="start_date" id="start_date" class="form-control col-2 mr-2" size="20" required> ~ <input type="text" name="end_date" id="end_date" class="form-control col-2 ml-2" size="20" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">확인</button>
            <button type="button" class="btn btn-default btn-list">목록</button>
        </div>
    </form>
@endsection

@section("script")
    <script>
        @if (!empty($adver))
            // input values
            @foreach($adver as $key => $val)
                @if ($key == "link_new_window")
                    @if ($val == "1")
                        $('#{{ $key }}').attr('checked', true);
                    @endif
                @elseif ($key == "file")
                    $('.file-preview-image').attr('src', '{{ asset("storage/". $val) }}');
                @else
                    $('#{{ $key }}').val('{{ $val }}');
                @endif

                @if ($key == "type")
                    $('.type-item-{{ $val }}').show();
                @endif
            @endforeach
        @endif

        $('#type').on("change", function () {
            $('.type-item').hide();
            $('.type-item-'+ $(this).val()).show();
        });

        $('.btn-list').on("click", function () {
            self.location.href = "/advertisements";
        });
    </script>
@endsection