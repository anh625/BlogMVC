<!-- MDB CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />

<!-- MDB JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
<!-- Bootstrap CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS Bundle CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <form method="POST" action=" {{ route('login') }} " class="card-body p-5 text-center">
                        @csrf
                        <h3 class="mb-5">Sign in</h3>

                        <div class="mb-4">
                            <input value="{{ old('email') }}" name="email" placeholder="Email" type="email" id="typeEmailX-2" class="form-control form-control-lg" />
                        </div>

                        <div class="mb-4">
                            <input value="{{ old('password') }}" name="password" placeholder="Password" type="password" id="typePasswordX-2" class="form-control form-control-lg" />
                        </div>

                        @if ($errors->any())
                            <div style="color: red">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <div class="text-center">
                            <p>Not a member? <a href="{{route('sign-up')}}">Register</a></p>
                        </div>
                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
