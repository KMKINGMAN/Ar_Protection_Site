<div class="modal-dialog">
    <div class="modal-content model-height">
        @if($found)
        <div class="modal-header">
            <h5 class="modal-title text-dark" id="exampleModalLabel">تعديل المشرف: {{ $manager->username }}</h5>
        </div>
        <form action="{{ route('managers.store') }}" method="POST" enctype="multipart/form-data" id="edit_manager_form">
            @csrf
            @method('PUT')
            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="first_name">الاسم الاول</label>
                <input id="first_name"
                       class="form-control"
                       name="first_name"
                       placeholder="الاسم الاول"
                       type="text"
                       value="{{ $manager->first_name }}" required>
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="last_name">الاسم الاخير</label>
                <input id="last_name"
                       class="form-control"
                       name="last_name"
                       placeholder="الاسم الاخير"
                       type="text"
                       value="{{ $manager->last_name }}" required>
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="username">اسم المستخدم</label>
                <input id="username"
                       class="form-control"
                       name="username"
                       placeholder="اسم المستخدم"
                       type="text"
                       value="{{ $manager->username }}" required>
            </div>


            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="email">الايميل</label>
                <input id="email"
                       class="form-control"
                       name="email"
                       placeholder="الايميل"
                       type="email"
                       value="{{ $manager->email }}" required>
            </div>


            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="password">كلمة المرور</label>
                <input id="password"
                       class="form-control"
                       name="password"
                       placeholder="كلمة المرور"
                       type="password">
            </div>


            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="password_confirmation">تأكيد كلمة المرور</label>
                <input id="password_confirmation"
                       class="form-control"
                       name="password_confirmation"
                       placeholder="كلمة المرور"
                       type="password">
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="image">الصورة الشخصية</label>
                <input id="image"
                       class="form-control"
                       name="image"
                       type="file">
                <img src="{{ renderImage($manager->image) }}" alt="{{ $manager->username }}" width="100" height="100">
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="facebook_link">رابط بروفايل الفيسبوك</label>
                <input id="facebook_link"
                       class="form-control"
                       name="facebook_link"
                       placeholder="رابط بروفايل الفيسبوك"
                       type="text"
                       value="{{ $manager->facebook_link }}">
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="twitter_link">رابط بروفايل تويتر</label>
                <input id="twitter_link"
                       class="form-control"
                       name="twitter_link"
                       placeholder="رابط بروفايل تويتر"
                       type="text"
                       value="{{ $manager->twitter_link }}">
            </div>

            <div class="form-group w-100 pr-2 pl-2 m-0">
                <label class="text-dark" for="instagram_link">رابط بروفايل الانستجرام</label>
                <input id="instagram_link"
                       class="form-control"
                       name="instagram_link"
                       placeholder="رابط بروفايل الانستجرام"
                       type="text"
                       value="{{ $manager->instagram_link }}">
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">حفظ  </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
        </form>
        @else
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">لم يتم العثور على المشرف!</h5>
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
    $('#edit_manager_form').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "{{ route('managers.update', $manager->id) }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.status === true) {
                    sweetAlert('success', response.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, 1500)

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
