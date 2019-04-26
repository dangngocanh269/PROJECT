@extends('master')
@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sinh Viên
                    <small>List</small>
                </h1>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <form action="{{asset('sinhvien/import')}}" method="post" enctype="multipart/form-data">
                        <h3>Import Sinh Viên</h3>
                        <input type="file" name="select_file" >
                        <button type="submit">Upload</button>
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
                    <th>GVCN</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sinhvien as $sv)
                <tr class="odd gradeX" align="center">
                    <td>{{$sv->msv}}</td>
                    <td>{{$sv->hoten}}</td>
                    <td>{{$sv->ngaysinh}}</td>
                    <td>{{$sv->khoahoc}}</td>
                    <td>{{$sv->chuyennganh}}</td>
                    <td>{{$sv->lophoc}}</td>
                    <td>{{$sv->gvcn}}</td>
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
    @stop