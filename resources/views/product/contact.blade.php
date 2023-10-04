@extends('layout.master')
@section('css')
@endsection
@section('content')

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d958.5276668348188!2d108.24265926956818!3d16.059745999038665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTbCsDAzJzM1LjEiTiAxMDjCsDE0JzM1LjkiRQ!5e0!3m2!1svi!2sus!4v1686393109245!5m2!1svi!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        @if(session('success'))
            <br>
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <br>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Form liên hệ</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="acc-edit">
                            <form action="{{route('postContact')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Họ và tên:</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại:</label>
                                    <input type="number" class="form-control" name="phone_number">
                                </div>
                                <div class="form-group">
                                    <label>Nội dung:</label>
                                    <textarea class="form-control" rows="4" name="content"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Thông tin liên hệ</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="acc-edit">

                            <h6 class="contact-title">Address</h6>
                            <p>
                                Suite 127 / 267 – 277 Brussel St,<br>
                                62 Croydon, NYC <br>
                                Newyork
                            </p>
                            <div class="space20">&nbsp;</div>
                            <h6 class="contact-title">Business Enquiries</h6>
                            <p>
                                Doloremque laudantium, totam rem aperiam, <br>
                                inventore veritatio beatae. <br>
                                <a href="mailto:biz@betadesign.com">biz@betadesign.com</a>
                            </p>
                            <div class="space20">&nbsp;</div>
                            <h6 class="contact-title">Employment</h6>
                            <p>
                                We’re always looking for talented persons to <br>
                                join our team. <br>
                                <a href="hr@betadesign.com">hr@betadesign.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('js')
@endsection