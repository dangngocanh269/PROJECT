<div>
    <p>Mã SV: {{$sinhvien->masv}} </p>
    <p>Họ Và Tên: {{$sinhvien->hoten}}</p>
    <p>Khóa: {{$sinhvien->khoahoc}}</p>
    <p>Chuyên Ngành: {{$sinhvien->chuyennganh->tencn}}</p>
    <p>Lớp: {{$sinhvien->lophoc}}</p>
</div>
            <div class="col-lg-12" >
                <h4>Bảng điểm</h4>
                <div class="col-md-6">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th width="5%%">STT</th>
                            <th width="10%">Mã môn</th>
                            <th width="65%">Tên môn</th>
                            <th width="10%">Tín chỉ</th>
                            <th width="10%">Điểm TB</th>
                        </tr>
                        @foreach($b as $key=> $bangdiem1)
                        <tr style="{{$bangdiem1->pivot->diemtk <5 ? 'color:red;' : ''}}">
                            <td>{{$key+1}}</td>
                            <td style="text-align: center">{{$bangdiem1->mamon}}</td>
                            <td>{{$bangdiem1->tenmon}}</td>
                            <td style="text-align: center">{{$bangdiem1->sotinchi}}</td>
                            <td style="text-align: center">{{$bangdiem1->pivot->diemtk}}</td>
                        </tr>
                        @endforeach

                    </table>
                    @if(empty($b))
                        Không có dữ liệu
                    @endif
                </div>
                <div class="col-md-6">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th width="5%%">STT</th>
                            <th width="10%">Mã môn</th>
                            <th width="65%">Tên môn</th>
                            <th width="10%">Tín chỉ</th>
                            <th width="10%">Điểm TB</th>
                        </tr>

                        @foreach($c as $stt => $bangdiem2)
                            <tr style="{{$bangdiem2->pivot->diemtk <5 ? 'color:red;' : ''}}">
                                <td>{{$stt+1}}</td>
                                <td style="text-align: center">{{$bangdiem2->mamon}}</td>
                                <td >{{$bangdiem2->tenmon}}</td>
                                <td style="text-align: center">{{$bangdiem2->sotinchi}}</td>
                                <td style="text-align: center">
                                    {{$bangdiem2->pivot->diemtk}}</td>
                            </tr>
                        @endforeach

                    </table>
                    @if(empty($b))
                        <td>Không có dữ liệu</td>
                    @endif
                </div>

            </div>

@if(!empty($b))
<div style="margin-bottom: 20px;">
    <p>Tổng số tín chỉ: {{$tongtinchi}} </p>
    <p>Điểm trung bình môn: {{round($diemtb,2)}}</p>
    <small>(*Chú giải: Mã HP là mã học phần, Tên HP là tên học phần. Lưu ý: TBC không tính điểm của các học phần GDTC & GDQP) </small>
</div>
@endif