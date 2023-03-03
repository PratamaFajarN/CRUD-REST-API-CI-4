<?= $this->extend('admin/dashboard/index') ?>

<?= $this->section('konten') ?>
<div id="appgetdata">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <h3 class="font-weight-bold text-primary" style="color:#162847 !important">Get Data</h3>
        </div>
    </div>
   <div class="container">
     <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <table id="table_id" class="display expandable-table dataTable no-footer">
                                <thead>
                                    <tr style="background: #162847;color: white;">
                                        <th class="sorting">No</th>
                                        <th class="sorting">id</th>
                                        <th class="sorting">fullname</th>
                                        <th class="sorting">email</th>
                                        <th class="sorting">created_at</th>
                                        <th class="sorting">updated_at</th>
                                        <th class="sorting">action</th>

                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>

</div>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="iduser" class="form-control" type="text" placeholder="iduser" disabled="false">
            </div>

            <div class="modal-body">
                <input id="fullname" class="form-control" type="text" placeholder="fullname">
            </div>
            <div class="modal-body">
                <input id="email" class="form-control" type="text" placeholder="email">
            </div>
            <div class="modal-footer">
              
                <button type="button" onclick="update()" data-dismiss="modal" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<style>
    .rainbow {
        padding: 13px;
    }

    .bgs {
        background: #2f3f59;
    }

    .navbar-vertical .navbar-nav>.nav-item .nav-link.active .icon {
        background-image: linear-gradient(310deg, #110d10 0%, #2c6d86 100%);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('js') ?>


<script>
    var vmData = new Vue({
        el: "#appgetdata",
        data: {
            table: '',
            no: 1,
            filterForm: {
                startDate: '',
                endDate: '',
                timeZone: '',
                category: '0',
                outlet: [],
                limit: 30,
                offset: 0,
                dataType: '1',
                shift: [],
                dataCategory: 1,
            },
        },
        methods: {
            onApply() {
                if (vmData.filterForm.outlet == '0') {
                    Alert.confirm("Memilih Semua Outlet",
                        "Proses Ini Mungkin Membutuhkan Sedikit Waktu, Pastikan Koneksi Anda Dalam Keadaan Baik"
                    ).then(function (result) {
                        if (!result.value) {
                            return;
                        }


                        vmData.appendTable()
                    })
                } else {


                    this.appendTable()
                }

            },

            getDatatable() {
                $(function () {
                    vmData.table = $('#table_id').DataTable({
                        paging: true,
                        serverSide: false,
                        destroy: false,

                        dom: "<'row'<'col-sm-6'l><'col-sm-6'Bf>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                        responsive: true,
                        stateSave: true,
                        columnDefs: [{
                                type: 'formatted-num',
                                targets: [-1],
                                render: function (data, type, columns, metam, row) {
                                    data =
                                        '<div class="container"><div class="row"><div class="col-lg-6"><button type="button" class="btn btn-primary rainbow bgs" data-toggle="modal" data-target="#exampleModalLong">Edit</button></div><div class="col-lg-6"><a id="delete"    class="btn btn-danger rainbow" >delete</a></div><div></div>';


                                    return data;
                                },
                            },


                        ],
                    });
                    $('#table_id tbody').on('click', 'button', function () {
                        var data = vmData.table.row($(this).parents('tr')).data();
                        console.log(data[1]);
                        console.log(data[2]);
                        console.log(data[3]);
                        var pas = document.getElementById("iduser").value = data[1];
                        var pas = document.getElementById("fullname").value = data[2];
                        var b = document.getElementById("email").value = data[3];

                        $('#myModal').on('shown.bs.modal', function () {
                            $('#myInput').trigger('focus')
                        })

                        function update() {
                            const fullname = $('#fullname').val()
                            const id = $('#iduser').val()
                            const email = $('#email').val()


                            console.log(fullname);
                            console.log(email);

                            $.ajax({
                                url: "/updatedatauser",
                                type: 'post',
                                data: {
                                    id_user: id,
                                    fullnames: fullname,
                                    emails: email,
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
                                     Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Something went wrong!',

                                    })
                                }

                            });
                        }


                    });
                    $('#table_id tbody').on('click', 'a', function () {
                        var data = vmData.table.row($(this).parents('tr')).data();
                        var pas = document.getElementById("iduser").value = data[1];
                        const id = $('#iduser').val()

                        $.ajax({
                            url: "/deleteuser",
                            type: 'get',
                            data: {
                                id_user: id,

                            },
                            success: function (data, status) {
                                vmData.table.clear().draw();
                                 Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'Your work has been saved',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                vmData.appendTable();
                            },
                            error: function () {
                                Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Something went wrong!',

                                    })
                            }

                        });


                    });


                });
            },
            appendTable() {
                var data = {};
                $.ajax({
                    url: '/getdatauserpost',
                    type: 'POST',
                    data: data,
                    success(response) {
                        console.log(response);
                        $.each(response.data, function () {
                            vmData.table.row.add([
                                vmData.no++,
                                this.id,
                                this.fullname,
                                this.email,
                                this.created_at,
                                this.updated_at,


                            ]).draw();
                        }); //each end

                    },
                    error(response, textStatus, errorThrown) {

                        console.log("eror")
                    }
                })
            },

        },
        mounted() {
            $(function () {
                setTimeout(function () {
                    vmData.appendTable();
                    vmData.getDatatable();
                }, 100);

            });
        },
    });
</script>
<?= $this->endSection() ?>