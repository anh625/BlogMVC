@extends('user.layouts.app')
@section('content')
    <div class="hero overlay inner-page bg-primary py-5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center pt-5">
                <div class="col-lg-6">
                    <h1 class="heading text-white mb-3" data-aos="fade-up">Contact Us</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-3">
                                <input required name="contact_name" type="text" class="form-control"
                                       placeholder="Your Name">
                            </div>
                            <div class="col-6 mb-3">
                                <input required name="contact_phone" type="number" class="form-control"
                                       placeholder="Your Phone">
                            </div>
                            <div class="col-12 mb-3">
                                <input required name="subject" type="text" class="form-control" placeholder="Subject">
                            </div>
                            <div class="col-12 mb-3">
                                <textarea required name="message" id="" cols="30" rows="7" class="form-control"
                                          placeholder="Message"></textarea>
                            </div>

                            <div class="col-12">
                                <input required type="submit" value="Send Message" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                    @if ($errors->any())
                        <div style="color: red">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div> <!-- /.untree_co-section -->
@endsection
