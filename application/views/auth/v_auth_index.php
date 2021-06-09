<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url("assets/backend/"); ?>assets/images/favicon.png">
    <title>Matrix Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="<?= base_url("assets/backend/"); ?>dist/css/style.min.css" rel="stylesheet">

</head>

<body>
    <div class="main-wrapper">

        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center mt-20">
                        <span class="db"><img src="<?= base_url("assets/backend/"); ?>assets/images/logo.png" alt="logo" /></span>
                    </div>
                    <!-- Form -->

                    <form class="form-horizontal mt-5" id="submit-form" action="<?= base_url('auth/check') ?>">
                        <div id="form-info"></div>
                        <?= csrf_field("csrf_protection"); ?>
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" name="username" id="username" class="form-control form-control-lg" placeholder="Username" aria-label="Username">
                                    <div class="invalid-feedback" id="feedusername"></div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="password" id="password" placeholder="Password" aria-label="Password">
                                    <div class=" invalid-feedback" id="feedpassword">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="mt-3">
                                        <button class="btn btn-success float-right" id="btn-submit" type="submit">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="<?= base_url("assets/backend/"); ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url("assets/backend/"); ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url("assets/backend/"); ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/js/sweetalert2/sweetalert2.all.min.js'); ?>"></script>

    <script>
        $(document).ready(function() {
            $(".preloader").fadeOut();

            $("#btn-submit").prop("disabled", false);
            $("#submit-form").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $("#btn-submit").addClass("disabled btn-progress");
                    },
                    complete: function() {
                        $("#btn-submit").removeClass("disabled btn-progress");
                    },
                    success: function(response) {

                        if (response.csrf) {
                            $("#csrf_protection").val(response.csrf);
                        }

                        if (response.success) {
                            $("#form-submit").removeClass("is-invalid");

                            Swal.fire("Berhasil..", response.success.pesan, "success").then(() => {
                                window.location = response.success.url;
                            });
                        }

                        if (response.error) {

                            if (response.error.username) {
                                $('#username').addClass('is-invalid');
                                $('#feedusername').html(response.error.username);
                            } else {
                                $('#username').removeClass('is-invalid');
                                $('#feedusername').html("");
                            }

                            if (response.error.password) {
                                $('#password').addClass('is-invalid');
                                $('#feedpassword').html(response.error.password);
                            } else {
                                $('#password').removeClass('is-invalid');
                                $('#feedpassword').html("");
                            }

                            if (response.error.info) {
                                $("#form-info").html(response.error.info);
                            } else {
                                $("#form-info").empty();
                            }
                        }
                    }
                });

            });
        });
    </script>

</body>

</html>