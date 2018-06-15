@extends('layouts.app')

@push('style')
@endpush

@section('title','회원관리')

@section('content')
<form method="post" action="{{URL::to('/user')}}{{ isset($user->id) ? '/'.$user->id : '' }}" class="form-horizontal">
    {{ csrf_field() }}
    @if (isset($user)) {{ method_field('PUT') }} @endif
</form>
@endsection

@push('script')
<script>
$('body').on('click', '.btnCreate', function() {
    var button = $(this);
    var buttonText = button.text();
    var id = button.data("id");
    if (id < 1) return false;
    $.ajax({
        url: urlprefix + "/remakeReport/" + id, type: 'GET', async: true,
        /*data: {_method: 'PUT', data: data},*/
        beforeSend: function (xhr) {
            button.text('실행중...').prop("disabled", true);
        }
    })
    .done(function(data) {
        if (data.RESULT) {
            alert("요청이 완료되었습니다.");
        } else {
            alert(data.MESSAGE);
        }
    })
    .fail(function(data) {
        alert(data.MESSAGE);
    })
    .always(function(data) {
        button.text(buttonText).prop("disabled", false);
    });
});
</script>
@endpush
