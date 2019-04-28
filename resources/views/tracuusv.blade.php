@extends('master')
@section('content')
    <style>
        table tr th{
            text-align:center;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tra cứu
                    <small>Sinh viên</small>
                </h1>
            </div>
            <div class="col-lg-12" style="padding-bottom:20px">
                <form id="tracuusv">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="col-lg-3">
                                <select name="column" class="form-control" id="column">
                                    <option value="masv">Mã Sinh Viên</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" required class="form-control" value="" name="tukhoa" id="tukhoa">
                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                            </div>

                        </div>
                        <div class="col-lg-2"></div>

                    </div>
                </form>
            </div>
            <div id="info"></div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#tracuusv').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url:'{{asset('tracuusv/search')}}',
                    type:'GET',
                    data:{tukhoa:$('#tukhoa').val(),column:$('#column').val()},
                    success:function (data) {
                        $('#info').html(data);
                    }
                })
            })
        });
    </script>
    @stop