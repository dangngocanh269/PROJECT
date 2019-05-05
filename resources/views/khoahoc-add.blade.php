@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Khóa học
                    <small>Thêm mới</small>
                </h1>
            </div>
            <div class="col-lg-7" style="padding-bottom:120px">
                <form id="khoahocadd" method="POST">
                    <div class="form-group">
                        <label>Tên Khóa</label>
                        <input class="form-control" name="tenkhoa"  placeholder="Nhập " />
                        <small id="errortenkhoa" style="color: red;"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Chuyên ngành</label>
                        <select name="cn_id[]" id="" class="form-control" multiple>
                            @foreach($chuyennganh as $cn)
                                <option value="{{$cn->id}}">{{$cn->tencn}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Thêm mới</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <a href="{{asset('/khoahoc')}} " class="btn btn-default">Quay lại</a>
                    {{csrf_field()}}
                    <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('submit','#khoahocadd',function (e) {
                e.preventDefault();
                $.ajax({
                    url:'{{asset("api/khoahoc/add")}}',
                    type:'POST',

                    data:new FormData(this),
                    cache:false,
                    contentType:false,
                    processData:false,
                    success:function (data) {
                        alert(data.success);
                        window.location.href='{{asset("/khoahoc")}}';
                    },
                    statusCode: {
                        422: function(data) {
                            $.each(data.responseJSON.errors.tenkhoa,function (index,value) {
                                $('#errortenkhoa').text(value);
                            });

                        }
                    }

                })
            })

        });
    </script>
@endsection

