<div class="modal-dialog">
    <div class="modal-content model-height">
        <div class="modal-header">
            <h5 class="modal-title text-dark" id="exampleModalLabel">اضافة مشرف جديدة </h5>

        </div>
        <form action="{{ route('managers.store') }}" method="POST" enctype="multipart/form-data" id="add_manager_form">
            @csrf
            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="first_name">الاسم الاول</label>
                <input id="first_name"
                       class="form-control"
                       name="first_name"
                       placeholder="الاسم الاول"
                       type="text"
                       value="{{ old('first_name') }}" required>
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="last_name">الاسم الاخير</label>
                <input id="last_name"
                       class="form-control"
                       name="last_name"
                       placeholder="الاسم الاخير"
                       type="text"
                       value="{{ old('last_name') }}" required>
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="username">اسم المستخدم</label>
                <input id="username"
                       class="form-control"
                       name="username"
                       placeholder="اسم المستخدم"
                       type="text"
                       value="{{ old('username') }}" required>
            </div>


            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="email">الايميل</label>
                <input id="email"
                       class="form-control"
                       name="email"
                       placeholder="الايميل"
                       type="email"
                       value="{{ old('email') }}" required>
            </div>


            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="password">كلمة المرور</label>
                <input id="password"
                       class="form-control"
                       name="password"
                       placeholder="كلمة المرور"
                       type="password"
                       value="{{ old('password') }}" required>
            </div>


            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="password_confirmation">تأكيد كلمة المرور</label>
                <input id="password_confirmation"
                       class="form-control"
                       name="password_confirmation"
                       placeholder="كلمة المرور"
                       type="password"
                       value="{{ old('password_confirmation') }}" required>
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="image">الصورة الشخصية</label>
                <input id="image"
                       class="form-control"
                       name="image"
                       type="file">
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="facebook_link">رابط بروفايل الفيسبوك</label>
                <input id="facebook_link"
                       class="form-control"
                       name="facebook_link"
                       placeholder="رابط بروفايل الفيسبوك"
                       type="text"
                       value="{{ old('facebook_link') }}">
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="twitter_link">رابط بروفايل تويتر</label>
                <input id="twitter_link"
                       class="form-control"
                       name="twitter_link"
                       placeholder="رابط بروفايل تويتر"
                       type="text"
                       value="{{ old('twitter_link') }}">
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="instagram_link">رابط بروفايل الانستجرام</label>
                <input id="instagram_link"
                       class="form-control"
                       name="instagram_link"
                       placeholder="رابط بروفايل الانستجرام"
                       type="text"
                       value="{{ old('instagram_link') }}">
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
    $('#add_manager_form').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "{{ route('managers.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.status === true) {
                    console.log(response.data, response)
                    sweetAlert('success', response.msg);

                    let new_issue = `<tr>
                                    <th scope="row">مضاف الان!</th>
                                    <td>${response.data.first_name}</td>
                                    <td>${response.data.last_name}</td>
                                    <td>${response.data.username}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#modal" data-id="${response.data.id}" class="btn btn-info btn-sm edit_manager">تعديل</a>
                                        <a href="#" class="btn btn-danger btn-sm delete" data-id="${response.data.id}">حذف</a>
                                    </td>
                                </tr>`
                    let all_user = $('#all_user')
                    all_user.prepend(new_issue)
                    $('.edit_manager').click(function (event) {
                        event.preventDefault()
                        let id = $(this).data('id')
                        $.get(`managers/${id}/edit`, function(data){
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
