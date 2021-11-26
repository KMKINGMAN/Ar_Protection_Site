@extends('admin.layouts.app')
@section('title', 'AR Server | المشرفين')

@section('content')
    <section class="main-part text-center">
        <div class="container">
            <h1>لوحه التحكم الرئيسيه</h1>
            <img src="https://cdn.discordapp.com/attachments/857020671280152676/857093299986890752/AR_Line.png" class="mt-5 w-100">
            <div class="row">
                <div class="col-md-12 mt-5 mb-5 mx-auto">
                    <h2 class="mb-4">
                        <i class="fa fa-user fa-spin ml-1"></i>
                        جميع المشرفين
                    </h2>
                    <button type="button"
                            class="btn btn-primary ml-2 mb-3 float-left mt-2"
                            data-toggle="modal"
                            data-target="#modal"
                            id="add_new_manager">
                        اضافه مشرف جديد
                    </button>

                    <button type="button"
                            class="btn btn-primary ml-2 mb-3 float-left mt-2"
                            data-toggle="modal"
                            data-target="#modal"
                            data-id="{{ \Auth::id() }}"
                            id="edit_admin_profile_data">
                        تعديل البيانات الشخصية للادمن
                    </button>

                    <!-- Modal -->
                    <div class="modal" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">

                    </div>
                    <div class="cont">
                        <!-- Button trigger modal -->
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">الاسم الاول</th>
                                <th scope="col">الاسم الاخير</th>
                                <th scope="col">اسم المستخدم</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody id="all_user">
                            @forelse($managers as $index => $user)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#modal" data-id="{{ $user->id }}" class="btn btn-info btn-sm edit_manager">تعديل</a>
                                        <a href="#" class="btn btn-danger btn-sm delete" data-id="{{ $user->id }}">حذف</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3">لا يوجد مطلوبين حتى الان....</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $managers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $('#add_new_manager').click(function () {
            $.get('{{ route('managers.create') }}', function(data){
                $('#modal').addClass('fade').html(data);
            });
        });

        $('.edit_manager').click(function (event) {
            event.preventDefault()
            let id = $(this).data('id')
            $.get(`managers/${id}/edit`, function(data){
                $('#modal').addClass('fade').html(data);
            });
        });

         $('#edit_admin_profile_data').click(function (event) {
            event.preventDefault()
            let id = $(this).data('id')
            $.get(`managers/${id}/edit-admin`, function(data){
                $('#modal').addClass('fade').html(data);
            });
        });



        $('.delete').click(function (event) {
            event.preventDefault();
            let id = $(this).data('id')
            swal({
                    title: "هل أنت متأكدة من حذف القضية؟",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "نعم!",
                    showCancelButton: true,
                    cancelButtonText: "لا",
                }).
            then(function (e) {
                if (e.value === true) {
                    $.ajax({
                        type: "POST",
                        url: `managers/${id}/delete`,
                        data: {
                            _token: "{{ @csrf_token() }}"
                        },
                        success: function (response) {
                            if (response.status === true) {
                                sweetAlert('success', response.msg);
                                setTimeout(function () {
                                    window.location.reload();
                                }, 1500)
                            } else {
                                sweetAlert('error', response.msg)
                            }
                        }
                    });
                }  else {
                    e.dismiss;
                }
            },  function (dismiss) {
                return false;
            });
        });

        $(document).mouseup(function(e)
        {
            let model = $("#modal");
            let form_model = $("#modal .modal-content");
            if (model.hasClass('fade')) {
                // if the target of the click isn't the container nor a descendant of the container
                if (!form_model.is(e.target) && form_model.has(e.target).length === 0)
                {
                    model.removeClass('fade');
                    model.html('');
                }
            }
        });

    </script>
@endsection
