<?php
//==================================== HOME ====================================
if ($page == 'home') {
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo  $judul; ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $jml_topic; ?></h3>

                            <p>Jumlah Topic</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-people"></i>
                        </div>
                        <a href="<?php echo base_url('admin/topic') ?>" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $jml_device; ?></h3>

                            <p>Jumlah Id Device</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="<?php echo base_url('admin/device_id') ?>" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<?php
}

//==================================== DEVICE_ID ====================================
else if ($page == 'device_id') {
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo  $judul; ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <a href=<?php echo base_url("admin/device_tambah") ?> class="btn btn-primary"
                    style="margin-bottom:15px">
                    Tambah Device_id</a>
                <table id="manualTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th id="device_" onclick="sortTable(0)">Device_Id</th>
                            <th id="device_" onclick="sortTable(1)">Greenhouse</th>
                            <th id="device_" onclick="sortTable(2)">Node_Id</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php
                        foreach ($device_id as $d) {?>
                    <tr>
                        <td><?php echo $d['device_id'] ?></td>
                        <td><?php echo $d['gh_number'] ?></td>
                        <td><?php echo $d['node_id'] ?></td>
                        <td>
                            <a href=<?php echo base_url("admin/device_edit/") . $d['device_id']; ?>> <i
                                    class="fas fa-pencil-alt"></i> </a>
                            <a href=<?php echo base_url("admin/device_hapus/") . $d['device_id']; ?>
                                onclick="return confirm('Yakin menghapus Device: <?php echo $d['device_id']; ?> ?');"
                                ;><i class="fas fa-trash-alt"></i></a>
                            <a href=<?php echo base_url("admin/data_hapus/") . $d['device_id']; ?>
                                onclick="return confirm('Yakin menghapus Data: <?php echo $d['device_id']; ?> ?');"
                                ;><i class="bi bi-x-square-fill"></i></a>
                        </td>
                    </tr>
                    <?php
                        }
                        ?>
                </table>

            </div>
    </section>
</div>

<?php

//--------------------------------- Tambah ---------------------------------
} else if ($page == 'device_tambah') {
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo  $judul; ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">

                <form method="POST" action="<?php echo base_url('admin/device_tambah'); ?>" class="form-horizontal">

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="device_id" class="col-sm-2 col-form-label">Device_Id</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="device_id" id="device_id"
                                    value="<?php echo set_value('device_id'); ?>" placeholder="Masukkan Device Id">
                                <span
                                    class="badge badge-warning"><?php echo strip_tags(form_error('device_id')); ?></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gh_number" class="col-sm-2 col-form-label">Pilih Greenhouse</label>
                            <div class="col-sm-10">
                                <?php echo form_dropdown('gh_number', $ddgh, set_value('Greenhouse')); ?>
                                <span
                                    class="badge badge-warning"><?php echo strip_tags(form_error('id_guru')); ?></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="node_id" class="col-sm-2 col-form-label">Pilih Kelas</label>
                            <div class="col-sm-10">
                                <?php echo form_dropdown('node_id', $ddnode, set_value('node_id')); ?>
                                <span
                                    class="badge badge-warning"><?php echo strip_tags(form_error('noed_id')); ?></span>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>


            </div>
    </section>
</div>
<?php

    //--------------------------------- Edit ---------------------------------
} else if ($page == 'device_edit') {
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo  $judul; ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">

                <form method="POST" action="<?php echo base_url('admin/device_edit/' . $d['device_id']); ?>"
                    class="form-horizontal">

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="device_id" class="col-sm-2 col-form-label">Nama Santri</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="device_id" id="device_id"
                                    value="<?php echo set_value('device_id', $d['device_id']); ?>"
                                    placeholder="Device Id">
                                <span
                                    class="badge badge-warning"><?php echo strip_tags(form_error('device_id')); ?></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gh_number" class="col-sm-2 col-form-label">Pilih Greenhouse</label>
                            <div class="col-sm-10">
                                <?php echo form_dropdown('gh_number', $ddgh, set_value('Greenhouse', $d['gh_number'])); ?>
                                <span
                                    class="badge badge-warning"><?php echo strip_tags(form_error('device_id')); ?></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="node_id" class="col-sm-2 col-form-label">Pilih Kelas</label>
                            <div class="col-sm-10">
                                <?php echo form_dropdown('node_id', $ddnode, set_value('node_id', $d['node_id'])); ?>
                                <span
                                    class="badge badge-warning"><?php echo strip_tags(form_error('noed_id')); ?></span>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>


            </div>
    </section>
</div>
<?php
}

//==================================== TOPIK ====================================
else if ($page == 'topic') {
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo  $judul; ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <a href=<?php echo base_url("admin/tambah_topik") ?> class="btn btn-primary"
                    style="margin-bottom:15px">New Topik</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No </th>
                            <th>Nama Topik</th>
                            <!-- <th>Keterangan</th> -->
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <?php
                        $i=0; 
                        foreach ($topic as $d) { $i++;?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $d['topic_name'] ?></td>
                        <td>
                            <a href=<?php echo base_url("admin/topik_edit/") . $d['id']; ?>><i
                            class="fas fa-pencil-alt"></i></a>
                            <a href=<?php echo base_url("admin/topik_hapus/") . $d['id']; ?>
                                onclick="return confirm('Yakin menghapus data Topik : <?php echo $d['topic_name']; ?> ?');" ;><i class="fas fa-trash-alt"></i></a>

                        </td>
                    </tr>
                    <?php
                        }
                        ?>
                </table>

            </div>
        </div>
    </section>
</div>

<?php
}

//--------------------------------- TAMBAH ---------------------------------
else if ($page == 'tambah_topik') {
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo  $judul; ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Isikan Data Dengan Benar</h3>
            </div>
            <div class="card-body">

                <?php echo validation_errors(); ?>

                <form method="POST" action="<?php echo base_url('admin/tambah_topik'); ?>" class="form-horizontal">

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="topic_name" class="col-sm-2 col-form-label">Topic Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="topic_name" id="topic_name"
                                    value="<?php echo set_value('topic_name'); ?>" placeholder="Input Topic Name">
                                <span
                                    class="badge badge-warning"><?php echo strip_tags(form_error('topic_name')); ?></span>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>

<?php
}

//--------------------------------- EDIT ---------------------------------
else if ($page == 'topik_edit') {
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo  $judul; ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Isikan Data Dengan Benar</h3>
            </div>
            <div class="card-body">

                <?php echo validation_errors(); ?>

                <form method="POST" action="<?php echo base_url('admin/topik_edit/' . $d['id']); ?>"
                    class="form-horizontal">

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="topic_name" class="col-sm-2 col-form-label">Topic Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="topic_name" id="topic_name"
                                    value="<?php echo set_value('topic_name', $d['topic_name']); ?>"
                                    placeholder="Masukkan Nama Topic">
                                <span
                                    class="badge badge-warning"><?php echo strip_tags(form_error('topic_name')); ?></span>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>

<?php
}

//================================ SENSOR DATA LOGGING ================================
else if ($page == 'data_logging') {
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo  $judul; ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    
                    <div class="row">
                        <div class="col-sm-2">
                            Pilih Device_Id
                        </div>
                        <div class="col-sm-2">
                            <?php echo form_dropdown('device_id', $dddevice, set_value('device_id'), 'id="pd_kelas" class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="col-sm-8">
                    </div>
                </div>            
                
                <table id="datatable_01" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Device Id</th>
                            <th>Sensor Value</th>
                            <th>Greenhouse</th>
                            <th>Node_Id</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($sensor as $d) { ?>
                    <tr>
                        <td><?php echo $d['device_id'] ?></td>
                        <td><?php echo $d['value_sensor'] ?></td>
                        <td><?php echo $d['greenhouse'] ?></td>
                        <td><?php echo $d['node_id'] ?></td>
                        <td><?php echo $d['timestamp'] ?></td>
                    </tr>
                    <?php
                        }
                        ?>
                </table>

            </div>
    </section>
</div>

<?php
}
?>