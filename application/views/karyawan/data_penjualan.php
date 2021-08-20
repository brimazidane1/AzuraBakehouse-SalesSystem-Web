<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Penjualan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Penjualan</li>
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
                        <h3 class="card-title">Data Penjualan</h3>
                        <button class="ml-2 btn btn-primary btn-xs" onclick="tambah_penjualan()">
                            <span class="fas fa-plus-square"></span> Tambah Penjualan
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- custom-filter tanggal rekap -->
                        <div class="container">
                            <form class="form-inline justify-content-center" id="form-filter">
                                <div class="form-group">
                                    <label for="pilih_tanggal">Pilih Periode:</label>
                                    <input id="pilih_tanggal" class="form-control date-picker" name="pilih_tanggal" placeholder="yyyy-mm">
                                </div>

                                <div class="form-group">
                                    <button type="button" id="btn-filter" class="btn btn-primary btn-sm">Cari</button>
                                    <button type="button" id="btn-reset" class="btn btn-default btn-sm">Reset</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.custom-filter tanggal rekap -->

                        <div class="table-responsive">
                            <table id="tabel_penjualan" class="table table-bordered table-striped responsive" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Penjualan</th>
                                        <th>Konsinyi</th>
                                        <th>Tanggal</th>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Status</th>
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

<!-- Form Tambah Penjualan Modal-->
<div class="modal fade" id="formTambahModal" tabindex="-1" role="dialog" aria-labelledby="formTambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formTambahModalLabel">Form Penjualan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="formTambah" class="form-horizontal">
                    <div class="form-group">
                        <label for="id_konsinyi">Konsinyi:</label>
                        <select class="form-control" id="id_konsinyi" name="id_konsinyi">
                            <option value=""> -- Pilih Konsinyi -- </option>
                            <?php foreach ($daftar_konsinyi as $d) : ?>
                                <option value="<?= $d['id_konsinyi'] ?>"><?= $d['nama_konsinyi'] . " - " . $d['kode_konsinyi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-block text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_penjualan">Tgl Penjualan:</label>
                        <input id="tanggal_penjualan" class="form-control datepicker" name="tanggal_penjualan" placeholder="yyyy-mm-dd">
                        <span class="help-block text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="id_produk">Produk:</label>
                        <select class="form-control" id="id_produk" name="id_produk">
                            <option value=""> -- Pilih Produk -- </option>
                            <?php foreach ($daftar_produk as $d) : ?>
                                <option value="<?= $d['id_produk'] ?>"><?= $d['nama_produk'] . " - " . $d['kode_produk'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-block text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_penjualan">Jumlah:</label>
                        <input type="text" class="form-control" id="jumlah_penjualan" name="jumlah_penjualan" placeholder="" onkeypress="return onlyNumberKey(event)">
                        <span class="help-block text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="status_penjualan">Status:</label>
                        <select class="form-control" id="status_penjualan" name="status_penjualan">
                            <option value=""> -- Pilih Status -- </option>
                            <option value="0">Belum Lunas</option>
                            <option value="1">Lunas</option>
                        </select>
                        <span class="help-block text-danger"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnAdd" onclick="add_penjualan()" class="btn btn-primary">Tambah</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<!--// Form Tambah Penjualan Modal-->

<!-- Form Edit Penjualan Modal-->
<div class="modal fade" id="formEditModal" tabindex="-1" role="dialog" aria-labelledby="formEditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditModalLabel">Form Penjualan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="formEdit" class="form-horizontal">
                    <input type="hidden" value="" name="id_penjualan">

                    <div class="form-group">
                        <label for="kode_penjualan">Kode Penjualan:</label>
                        <input type="text" class="form-control" id="kode_penjualan" name="kode_penjualan" placeholder="" readonly>
                        <span class="help-block text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="nama_konsinyi">Konsinyi:</label>
                        <input type="text" class="form-control" id="nama_konsinyi" name="nama_konsinyi" placeholder="" readonly>
                        <span class="help-block text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="status_penjualan">Status:</label>
                        <select class="form-control" id="status_penjualan" name="status_penjualan">
                            <option value=""> -- Pilih Status -- </option>
                            <option value="0">Belum Lunas</option>
                            <option value="1">Lunas</option>
                        </select>
                        <span class="help-block text-danger"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnUpdate" onclick="update_penjualan()" class="btn btn-primary">Edit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<!--// Form Edit Penjualan Modal-->

<!-- Ajax Penjualan-->
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

    //tabel penjualan ajax
    $(document).ready(function() {
        table = $('#tabel_penjualan').DataTable({
            "processing": true,
            "serverSide": true,
            // "deferLoading": 0,
            "order": [], //Initial no order.
            "ajax": {
                "url": "<?= base_url($users['role'] . '/get_ajax_penjualan') ?>",
                "type": "POST",
                "data": function(data) {
                    data.pilih_tanggal = $('#pilih_tanggal').val();
                }
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 4, 5, 9], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

        $(function() {
            $('.date-picker').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm',
                width: '130'
            });
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

    function tambah_penjualan() {
        $('#formTambah')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#formTambahModal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Penjualan'); // Set Title to Bootstrap modal title
    }

    function edit_penjualan(id_penjualan) {
        $('#formEdit')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url($users['role'] . '/edit_penjualan_ajax') ?>/" + id_penjualan,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_penjualan"]').val(data.id_penjualan);
                $('[name="kode_penjualan"]').val(data.kode_penjualan);
                $('[name="nama_konsinyi"]').val(data.nama_konsinyi);
                $('[name="tanggal_penjualan"]').val(data.tanggal_penjualan);
                $('[name="status_penjualan"]').val(data.status_penjualan);

                $('#formEditModal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Penjualan'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Mohon lengkapi seluruh data yang ada.', 'Error!');
            }
        });
    }

    function delete_penjualan(id_penjualan) {
        if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url($users['role'] . '/delete_penjualan_ajax') ?>/" + id_penjualan,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table
                    toastr.success('Penjualan telah berhasil dihapus.', 'Success!');
                    reload_table();

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        }
    }

    function add_penjualan() {
        $('#btnAdd').text('Menambahkan...'); //change button text
        $('#btnAdd').attr('disabled', true); //set button disable 

        // ajax adding data to database
        var formData = new FormData($('#formTambah')[0]);
        $.ajax({
            url: "<?php echo site_url($users['role'] . '/insert_penjualan_ajax') ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status) //if success close modal and reload ajax table
                {
                    if (data.persediaan) {
                        $('#formTambahModal').modal('hide');
                        reload_table();
                        toastr.success('Penjualan telah berhasil ditambahkan.', 'Success!');
                    } else {
                        toastr.error('Persediaan produk tidak mencukupi!', 'Error!');
                    }
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        if (data.inputerror[i] == 'tanggal_penjualan') {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').parent().next().text(data.error_string[i]); //select span help-block class set text error string
                        } else {
                            $('[name="' + data.inputerror[i] + '"]').parent().addClass('has-error'); //select parent to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
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

    function update_penjualan() {
        $('#btnUpdate').text('Mengedit...'); //change button text
        $('#btnUpdate').attr('disabled', true); //set button disable 

        // ajax adding data to database
        var formData = new FormData($('#formEdit')[0]);
        $.ajax({
            url: "<?php echo site_url($users['role'] . '/update_penjualan_ajax') ?>",
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
                    toastr.success('Penjualan telah berhasil diupdate.', 'Success!');
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        if (data.inputerror[i] == 'tanggal_penjualan') {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').parent().next().text(data.error_string[i]); //select span help-block class set text error string
                        } else {
                            $('[name="' + data.inputerror[i] + '"]').parent().addClass('has-error'); //select parent to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
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