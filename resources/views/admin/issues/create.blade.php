<div class="modal-dialog">
    <div class="modal-content model-height">
        <div class="modal-header">
            <h5 class="modal-title text-dark" id="exampleModalLabel">اضافة سجل جديدة </h5>

        </div>
        <form action="{{ route('issues.store') }}" method="POST" enctype="multipart/form-data" id="add_issue_form">
            @csrf
            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="caseId">الاى دى</label>
                <input id="caseId"
                       class="form-control"
                       name="caseId"
                       placeholder="الاى دى"
                       type="text"
                       value="{{ old('caseId') }}" required>
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="name">الاسم</label>
                <input id="name"
                       class="form-control"
                       name="name"
                       placeholder="الاسم"
                       type="text"
                       value="{{ old('name') }}" required>
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="status">الحالة</label>
                <input id="status"
                       class="form-control"
                       name="status"
                       placeholder="مثال: محتجز - متهم ,,,"
                       type="text"
                       value="{{ old('status') }}" required>
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="evidences">الدلائل</label>
                <input id="evidences"
                       class="form-control"
                       name="evidences[]"
                       placeholder="الاى دى"
                       type="file"
                       multiple required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">حفظ  </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
        </form>
    </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#add_issue_form').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        console.log(formData)

        $.ajax({
            type:'POST',
            url: "{{ route('issues.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.status === true) {
                    sweetAlert('success', response.msg);

                    let images = JSON.parse(response.data.evidences)
                    let new_issue = `<tr>
                                    <th scope="row">مضافة الان!</th>
                                    <td>${response.data.caseId}</td>
                                    <td>${response.data.name}</td>
                                    <td>${response.data.status}</td>
                                    <td>{{\Auth::user()->username}}</td>
                                    <td>
                                    ${images.map((image, index) => `
                                     <a href="${window.location.origin + '/' + image}" target="_blank">
                                                <img src="${window.location.origin + '/' + image}"
                                                     alt="الدليل رقم : ${index +1}"
                                                     height="100" width="100">
                                            </a>`).join("")}
                                    </td>
                                    <td>
                                     @if(\Auth::user()->role == 'admin')
                                        <a href="#" data-toggle="modal" data-target="#modal" data-id="${response.data.id}" class="btn btn-info btn-sm edit_issue">تعديل</a>
                                        <a href="#" class="btn btn-danger btn-sm delete" data-id="${response.data.id}">حذف</a>
                                        @elseif(\Auth::user()->role == 'manager')
                                        <a href="#" data-toggle="modal" data-target="#modal" data-id="${response.data.id}" class="btn btn-info btn-sm edit_issue">تعديل</a>
                                    @endif
                                    </td>
                                </tr>`
                    let all_issues = $('#all_issues')
                    all_issues.prepend(new_issue)
                    $('.edit_issue').click(function (event) {
                        event.preventDefault()
                        let id = $(this).data('id')
                        $.get(`issues/${id}/edit`, function(data){
                            $('#modal').addClass('fade').html(data);
                        });
                    });

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
