@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sinh Viên
                    <small>Thêm mới</small>
                </h1>
            </div>
            <div class="col-lg-7" style="padding-bottom:120px">
                <div class=" errors alert alert-danger" style="display: none" ></div>

                <form id="sinhvienadd" method="POST">
                    <div class="form-group">
                        <label>Mã Sinh Viên</label>
                        <input class="form-control" name="masv"  placeholder="Nhập Mã" />

                    </div>
                    <div class="form-group">
                        <label>Tên Sinh Viên</label>
                        <input class="form-control" name="hoten"  placeholder="Nhập tên SV" />

                    </div>
                    <div class="form-group">
                        <label>Ngày Sinh</label>
                        <input type="date" class="form-control" name="ngaysinh"   />

                    </div>
                    <div class="form-group">
                        <label>Chọn khoa</label>
                        <select name="khoa_id" onchange="ChangeKhoa(this.value)"  class="form-control">
                            @foreach($khoa as $k)
                                <option value="{{$k->id}}">{{$k->tenkhoa}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Chuyên ngành</label>
                        <select name="cn_id"  class="form-control" onchange="ChangeCN()"  id="cn_id">
                            @foreach($chuyennganh->chuyennganh as $cn)
                                <option value="{{$cn->id}}">{{$cn->tencn}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Lớp học</label>
                        <input class="form-control" name="lophoc"  placeholder="Nhập" />

                    </div>
                    <div class="form-group">
                        <label>Khóa học</label>
                        <input class="form-control" name="khoahoc"  placeholder="Nhập" />

                    </div>
                    <div class="form-group">
                        <label>Ép cứng môn học theo chuyen nganh:</label>
                        <select name="mh_id[]"  class="form-control" multiple style="height: 500px" id="mh_id">
                            @foreach($chuyennganh->chuyennganh->first()->monhoc->all() as $mh)
                                <option value="{{$mh->id}}">{{$mh->tenmon}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="check" > Tích nếu muốn điểm phẩy TK các môn chọn trên 5
                    </div>

                    <button type="submit" class="btn btn-success">Thêm mới</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <a href="{{asset('/sinhvien')}} " class="btn btn-default">Quay lại</a>
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
        function ChangeKhoa(id) {
            $.ajax({
                url:'{{asset('ajax/changekhoa')}}/'+id,
                type:'GET',
                success:function (data) {
                    var html='';
                    $.each(data,function (index,value) {
                        html+=' <option value="'+value.id+'">'+value.tencn+'</option>'
                    });
                    $('#cn_id').html(html);
                    ChangeCN();

                }
            })

        }
        function ChangeCN() {

            $.ajax({
                url:'{{asset('ajax/changecn')}}/'+$('#cn_id').val(),
                type:'GET',
                success:function (data) {
                    var html='';
                    $.each(data,function (index,value) {
                        html+=' <option value="'+value.id+'">'+value.tenmon+'</option>'
                    });
                    $('#mh_id').html(html);

                }
            })

        }
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('submit','#sinhvienadd',function (e) {
                e.preventDefault();
                $.ajax({
                    url:'{{asset("api/sinhvien/add")}}',
                    type:'POST',
                    data:new FormData(this),
                    cache:false,
                    contentType:false,
                    processData:false,
                    success:function (data) {
                        alert(data.success);
                        window.location.href='{{asset("/sinhvien")}}';
                    },
                    statusCode: {
                        422: function(data) {
                            alert('Kiểm tra lại thông tin');
                            var errors=[]
                            $.each(data.responseJSON.errors.masv,function (index,value) {
                                errors.push(value);

                            })
                            $.each(data.responseJSON.errors.hoten,function (index,value) {
                                errors.push(value);

                            })
                            $.each(data.responseJSON.errors.khoahoc,function (index,value) {
                                errors.push(value);

                            })
                            $.each(data.responseJSON.errors.lophoc,function (index,value) {
                                errors.push(value);

                            })
                            $.each(data.responseJSON.errors.ngaysinh,function (index,value) {
                                errors.push(value);

                            })
                            if (errors.length >0){
                                $('.errors').addClass('show')
                                var html='';
                                $.each(errors,function (index,value) {
                                    html+='<li>'+value;
                                    html+='</li>';
                                });
                                $('.errors').html(html);
                            }else{
                                $('.errors').addClass('hide')
                            }
                        }
                    }

                })
            })

        });
    </script>
@endsection

