<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/auth.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <section style="background-color: rgb(26 188 156)" class="vh-100 ">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">
                                <form id="signupForm" method="POST">
                                    <h2 class="fw-bold mb-2 text-uppercase">Signup</h2>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="typeEmailX">Name</label>
                                        <input type="text" name="name"
                                            class="form-control form-control-lg" />
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="typeEmailX">Email</label>
                                        <input type="email" id="typeEmailX" name="email"
                                            class="form-control form-control-lg" />
                                        <div class="text-danger" id="emailError"></div>
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="typePasswordX">Password</label>
                                        <input type="password" name="password" id="typePasswordX"
                                            class="form-control form-control-lg" />
                                        <div class="text-danger" id="passwordError"></div>
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="confirm-typePasswordX">Confirm password</label>
                                        <input type="password" name="password_confirmation" id="confirm-typePasswordX"
                                            class="form-control form-control-lg" />
                                        <div class="text-danger" id="passwordConfirmationError"></div>
                                    </div>

                                    <button data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-outline-light btn-lg px-5" type="submit">Signup</button>
                                </form>

                            </div>

                            <div>
                                <p class="mb-0">Don't have an account? <a href="#!"
                                        class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
