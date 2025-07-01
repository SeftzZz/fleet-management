<?php if ($this->session->flashdata('pesanerror')) { ?>
    <script language="javascript" type="text/javascript">
        window.onload = function(){
            swal({
                title: "Failed!",
                text: "<?php echo $this->session->flashdata('pesanerror');?>",
                type: "error",
                confirmButtonText: "Close"
            });
        }
    </script>
<?php } ?>
<?php if ($this->session->flashdata('pesansukses')) { ?>
    <script language="javascript" type="text/javascript">
        window.onload = function(){
            swal({
                title: "Success",
                text: "<?php echo $this->session->flashdata('pesansukses');?>",
                type: "success",
                confirmButtonText: "Close"
            });
        }
    </script>
<?php } ?>

<div class="right_col">
    <form method="post" title="starter-plan" action="<?php echo base_url('cms/home/insertFnbSchedule') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
        <div class="col-md-3 col-sm-3">
            Date
            <input type="date" id="arrival" name="date" class="form-control" value="" required="required"">
        </div>
        <div class="col-md-3 col-sm-3">
            Open Time
            <input type="time" id="arrival" name="openTime" class="form-control" value="" required="required">
        </div>
        <div class="col-md-3 col-sm-3">
            Close Time
            <input type="time" id="arrival" name="closeTime" class="form-control" value="" required="required">
        </div>
        <div class="col-md-3 col-sm-3">
            Close Time
            <input type="checkbox" id="arrival" name="close" class="form-control" value="" required="required">
        </div>

        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>

    <table id="datatable-fnb" class="table table-striped table-bordered asc-sort-4">
        <thead>
        <tr>
            <th>Taggal diubah</th>
            <th>Nama Menu</th>
            <th>Keterangan</th>
            <th>Harga</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $displayed_numberroom = array();
        foreach($fnbSchedule as $row) {
            $dateNow = date('Y-m-d');
            ?>
            <tr>
                <td><?php echo $row->date ?></td>
                <td><?php echo $row->openTime ?></td>
                <td><?php echo $row->closeTime ?></td>
                <td><?php echo $row->close ?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>