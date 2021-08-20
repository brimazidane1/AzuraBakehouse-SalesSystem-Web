<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Produk</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <?= $this->session->flashdata('message'); ?>
    <section class="content">
        <div class="row">
            <div class="col">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Produk</h3>
                        <button class="ml-2 btn btn-primary btn-xs" onclick="tambah_produk()">
                            <span class="fas fa-plus-square"></span> Tambah Produk
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="tabel_produk" class="table table-bordered table-striped responsive" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Form Tambah Produk Modal-->
<div class="modal fade" id="formTambahModal" tabindex="-1" role="dialog" aria-labelledby="formTambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formTambahModalLabel">Form Produk</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="formTambah" class="form-horizontal">
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk:</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="">
                        <span class="help-block text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="harga_produk">Harga Produk:</label>
                        <input type="text" class="form-control" id="harga_produk" name="harga_produk" placeholder="" onkeypress="return onlyNumberKey(event)">
                        <span class="help-block text-danger"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnAdd" onclick="add_produk()" class="btn btn-primary">Tambah</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<!--// Form Tambah Produk Modal-->

<!-- Form Edit Produk Modal-->
<div class="modal fade" id="formEditModal" tabindex="-1" role="dialog" aria-labelledby="formEditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditModalLabel">Form Produk</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="formEdit" class="form-horizontal">
                    <input type="hidden" value="" name="id_produk">

                    <div class="form-group">
                        <label for="kode_produk">Kode Produk:</label>
                        <input type="text" class="form-control" id="kode_produk" name="kode_produk" placeholder="" readonly>
                        <span class="help-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="nama_produk">Nama Produk:</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="">
                        <span class="help-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="harga_produk">Harga Produk:</label>
                        <input type="text" class="form-control" id="harga_produk" name="harga_produk" placeholder="" onkeypress="return onlyNumberKey(event)">
                        <span class="help-block text-danger"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnUpdate" onclick="update_produk()" class="btn btn-primary">Edit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<!--// Form Edit Produk Modal-->

<!-- Ajax Produk-->
<script>
    function onlyNumberKey(evt) {
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

    var save_method; //for save method string
    var table;

    //tabel produk ajax
    $(document).ready(function() {
        table = $('#tabel_produk').DataTable({
            "lengthChange": false,
            "processing": true,
            "serverSide": true,
            // "deferLoading": 0,
            "order": [], //Initial no order.
            "ajax": {
                "url": "<?= base_url($users['role'] . '/get_ajax_produk') ?>",
                "type": "POST",
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 4], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],
            "dom": "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-4'i><'col-sm-4 text-center'l><'col-sm-4'p>>",
            "lengthMenu": [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            "buttons": [
                'pageLength', 'excel', 'pdf'
            ]

        });

        $('.datepicker').each(function() {
            $(this).datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd'
            });
        });

        //set input/textarea/select event when change value, remove class error and remove text help block 
        $("input").change(function() {
            $(this).parent().removeClass('has-error');
            $(this).next().empty();
        });
        $(".datepicker").change(function() {
            $(this).parent().removeClass('has-error');
            $(this).parent().next().empty();
        });
        $("textarea").change(function() {
            $(this).parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function() {
            $(this).parent().removeClass('has-error');
            $(this).next().empty();
        });

        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(); //just reload table
        });
        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(); //just reload table
        });
    });

    //rupiah convert
    function convertToRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        return rupiah.split('', rupiah.length - 1).reverse().join('');
    }

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    function tambah_produk() {
        $('#formTambah')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#formTambahModal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Produk'); // Set Title to Bootstrap modal title
    }

    function edit_produk(id_produk) {
        $('#formEdit')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url($users['role'] . '/edit_produk_ajax') ?>/" + id_produk,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_produk"]').val(data.id_produk);
                $('[name="kode_produk"]').val(data.kode_produk);
                $('[name="nama_produk"]').val(data.nama_produk);
                $('[name="harga_produk"]').val(data.harga_produk);

                $('#formEditModal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Produk'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Mohon lengkapi seluruh data yang ada.', 'Error!');
            }
        });
    }

    function delete_produk(id_produk) {
        if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url($users['role'] . '/delete_produk_ajax') ?>/" + id_produk,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table
                    toastr.success('Produk telah berhasil dihapus.', 'Success!');
                    reload_table();

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        }
    }

    function add_produk() {
        $('#btnAdd').text('Menambahkan...'); //change button text
        $('#btnAdd').attr('disabled', true); //set button disable 

        // ajax adding data to database
        var formData = new FormData($('#formTambah')[0]);
        $.ajax({
            url: "<?php echo site_url($users['role'] . '/insert_produk_ajax') ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status) //if success close modal and reload ajax table
                {
                    $('#formTambahModal').modal('hide');
                    reload_table();
                    toastr.success('Produk telah berhasil ditambahkan.', 'Success!');
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        // if (data.inputerror[i] == 'tgl_inv_produk') {
                        //     $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent to select div form-group class and add has-error class
                        //     $('[name="' + data.inputerror[i] + '"]').parent().next().text(data.error_string[i]); //select span help-block class set text error string
                        // } else {
                        $('[name="' + data.inputerror[i] + '"]').parent().addClass('has-error'); //select parent to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        // }
                    }
                    toastr.error('Mohon lengkapi seluruh data yang ada.', 'Error!');
                }
                $('#btnAdd').text('Tambah'); //change button text
                $('#btnAdd').attr('disabled', false); //set button enable 
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding data!');
                $('#btnAdd').text('Tambah'); //change button text
                $('#btnAdd').attr('disabled', false); //set button enable 

            }
        });
    }

    function update_produk() {
        $('#btnUpdate').text('Mengedit...'); //change button text
        $('#btnUpdate').attr('disabled', true); //set button disable 

        // ajax adding data to database
        var formData = new FormData($('#formEdit')[0]);
        $.ajax({
            url: "<?php echo site_url($users['role'] . '/update_produk_ajax') ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status) //if success close modal and reload ajax table
                {
                    $('#formEditModal').modal('hide');
                    reload_table();
                    toastr.success('Produk telah berhasil diupdate.', 'Success!');
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        // if (data.inputerror[i] == 'tgl_inv_produk') {
                        //     $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent to select div form-group class and add has-error class
                        //     $('[name="' + data.inputerror[i] + '"]').parent().next().text(data.error_string[i]); //select span help-block class set text error string
                        // } else {
                        $('[name="' + data.inputerror[i] + '"]').parent().addClass('has-error'); //select parent to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        // }
                    }
                    toastr.error('Mohon lengkapi seluruh data yang ada.', 'Error!');
                }
                $('#btnUpdate').text('Edit'); //change button text
                $('#btnUpdate').attr('disabled', false); //set button enable 
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error updating data!');
                $('#btnUpdate').text('Edit'); //change button text
                $('#btnUpdate').attr('disabled', false); //set button enable 
            }
        });
    }
</script>