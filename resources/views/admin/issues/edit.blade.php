<div class="modal-dialog">
    <div class="modal-content model-height">
        @if($found)
        <div class="modal-header">
            <h5 class="modal-title text-dark" id="exampleModalLabel">تعديل سجل: {{ $issue->name }} ذات الاى دى: {{ $issue->caseId }}</h5>

        </div>
        <form action="{{ route('issues.update', $issue->id) }}" method="POST" enctype="multipart/form-data" id="edit_issue_form">
            @csrf
            @method('PUT')
            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="caseId">الاى دى</label>
                <input id="caseId"
                       class="form-control"
                       placeholder="الاى دى"
                       type="text"
                       value="{{ $issue->caseId }}" disabled readonly>
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="name">الاسم</label>
                <input id="name"
                       class="form-control"
                       name="name"
                       placeholder="الاسم"
                       type="text"
                       value="{{ $issue->name }}" required>
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="status">الحالة</label>
                <input id="status"
                       class="form-control"
                       name="status"
                       placeholder="مثال: محتجز - متهم ,,,"
                       type="text"
                       value="{{ $issue->status }}" required>
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="evidences">الدلائل</label>
                <input id="evidences"
                       class="form-control"
                       name="evidences[]"
                       placeholder="الاى دى"
                       type="file"
                       multiple>
            </div>
            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="old-evidences" class="text-dark">  الدلائل الموجودة مسبقا:</label>
                @foreach((array)json_decode($issue->evidences) as $index => $image)
                    <img src="{{ renderImage($image) }}" alt="الدليل رقم: {{$index+1}}" class="img img-fluid" width="100" height="100">
                @endforeach
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">تحديث</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
        </form>
        @else
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">لم يتم العثور على السجل</h5>
            </div>
        @endif
    </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#edit_issue_form').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "{{ route('issues.update', $issue->id) }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.status === true) {
                    sweetAlert('success', response.msg);
                    window.location.reload();

                } else {
                    if(typeof(response.msg) == "object") {
                        sweetAlert('error', response.msg.toString())
                    } else {
                        sweetAlert('error', response.msg)
                    }
                }
            },
        })
    })
</script>
