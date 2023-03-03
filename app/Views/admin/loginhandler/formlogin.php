<?= $this->extend('admin/loginhandler/index') ?>

<?= $this->section('content') ?>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div id="modal-content" class="modal-content" style="background:#01102a">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle" style="color:#45bdd9">Sing Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 mb-4" style="border-radius:10px">
                            <input id="fullname" class="form-control" type="text" placeholder="Full Name">
                        </div>
                        <div class="col lg-12 mt4" style="border-radius:10px">
                            <input id="email" class="form-control" type="email" placeholder="email">
                        </div>
                        <div class="col-lg-12 mt-4" style="border-radius:10px">
                            <input id="password" class="form-control" type="password" placeholder="password">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input id="tag-form-submit" data-dismiss="modal" type="submit" onclick="register()"
                    class="btn btn-primary" value="submit">
            </div>
        </div>
    </div>
</div>
</div>
<div class="container vh-100 d-flex align-items-center" style="margin-top:5%;">
    <div id="innerPage">
        <div class="row align-items-center justify-content-center">
            <div class="col-sm-6 col-xs-12 d-sm-block d-none">
                <div id="imgBgn">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12 text-white p-5">
                <div class="lead">
                    <h3>Welcome Back</h3>
                    <p class="fs-6 mb-4">
                        <small>Login to continue to your valuable services. Crud Rest API With CodeEigniter-4
                            By pratama Fajar N
                        </small>
                    </p>
                </div>
                <form method="POST" action="<?= base_url('login'); ?>">


                    <input id="email" class="form-control rounded-0 mb-3" type="Email" name="email"
                        placeholder="Enter Email" />
                    <input id="password" class="form-control rounded-0 mb-3" type="password" name="password"
                        placeholder="Enter Password" />
                    <div>
                        <input type="checkbox" value="" class="me-2" id="flexCheckDefault">
                        <label for="flexCheckDefault">Remember me</label>
                    </div>
                    <button class="btn btn-info mt-4 w-100" type="submit">Sing In</button>
                    <a class="btn btn-info mt-4 w-100" href="#" data-toggle="modal" data-target="#exampleModalCenter"
                        style="background:#f000">Sing Up</a>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    body {
        background: #162847
    }

    #innerPage {
        width: 100%;
        max-width: 840px;
        margin: 0 auto;
        border-radius: 12px;
        background: #01102a;
        box-shadow: 7px 7px 13px 1px #010b1e,
            -10px -9px 11px 1px #1d335a;
    }

    .form-control {
        background: none;
        border: none;
        border-bottom: 1px solid #45bdd9;
        color: #fff;
    }

    #imgBgn {
        background: url('https://img.freepik.com/free-photo/fun-illustration-3d-cartoon-backpacker_183364-80063.jpg?w=740&t=st=1677828989~exp=1677829589~hmac=80733f0d9a69f2425ecd840c86ab7763250fcf8e853ac55d3676c74b41c5ba9c') no-repeat;
        background-size: cover;
        background-position: center;
        min-height: 75vh;
        width: 100%;
        border-radius: 12px 0px 0px 12px;
    }
</style>

<?= $this->section('script') ?>
<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')


    })

    function register() {

        const fullname = $('#fullname').val()
        const email = $('#email').val()
        const password = $('#password').val()

        console.log(fullname);
        console.log(email);
        console.log(password);

        $.ajax({
            url: "/register",
            type: 'post',
            data: {
                fullnamesend: fullname,
                emailsend: email,
                passwordsend: password

            },
            success: function (data, status) {

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
            },
            error: function () {
                    title: 'Oops...',
                    text: 'Something went wrong!',

                })
            }

        });
    }
</script>

<?= $this->endSection() ?>

<?= $this->endSection() ?>