@extends('master')
@section('content')
    <div class="container-fluid">
        <style>
            th.dt-center, td.dt-center { text-align: center; }
        </style>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sinh Viên
                    <small>List</small>
                </h1>
            </div>
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{$error}}
                        @endforeach
                </div>
                @endif
            <div class="row " style="margin-bottom: 10px;">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form action="{{asset('sinhvien/import')}}" method="POST" id="importsv" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="file" name="file" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">Import</button>
                            </div>


                        </div>

                    {{csrf_field()}}
                    </form>
                </div>

            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr align="center">
                    <th>MaSV</th>
                    <th>Họ Tên</th>
                    <th>Ngày Sinh</th>
                    <th>Khóa Học</th>
                    <th>Chuyên Ngành</th>
                    <th>Lớp Học</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sinhvien as $sv)
                    <tr class="odd gradeX" align="center">
                        <td>{{$sv->masv}}</td>
                        <td>{{$sv->hoten}}</td>
                        <td>{{date('d-m-Y',strtotime($sv->ngaysinh))}}</td>
                        <td>{{$sv->khoahoc->tenkhoa}}</td>
                        <td>{{$sv->chuyennganh->tencn}}</td>
                        <td>{{$sv->lophoc}}</td>
                        <td><button class="btn btn-danger delete" data-id="{{$sv->id}}"><i class="fa fa-trash"></i></button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.delete').click(function () {
                if (confirm('Bạn muốn xóa?')){
                    $.ajax({
                        url:  '{{asset("api/sinhvien/delete")}}' +'/' +$(this).attr('data-id'),
                        type: 'post',
                        dataType: 'json',
                        headers: {"X-HTTP-Method-Override": "DELETE"},
                        success:function (data) {
                            alert(data.success);
                            window.location.reload();
                        },
                        // headers: {
                        //
                        //     "Content-Type": "application/json"
                        // },





                    })
                }
            })
        })
    </script>
@stop