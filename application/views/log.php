            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"><h1 class="m-0">Log</h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Log</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="card" style="z-index:99;">
                            <div class="card-header">
                                <h3 class="card-title">Filter Data Log</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                  </button>
                                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                  </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama User</label>
                                            <input type="text" name="nmUser" id="nmUser" value="<?php echo set_value('nmUser')?>" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <div class="input-group date" id="tglFilter" data-target-input="nearest">
                                                <input type="text" name="tglLog" id="tglLog" value="<?php echo set_value('tglLog')?>" class="form-control" maxlength="10" placeholder="DD-MM-YYYY" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text" data-target="#tglFilter" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            <button id="btnReset" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button id="btnFilter" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;Filter&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                        </center>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Log</h3>
                            </div>
                            <div class="card-body">
                                <table id="tbl_log" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama User</th>
                                            <th>Aktifitas</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama User</th>
                                            <th>Aktifitas</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">&nbsp;</div>
                </section>
                <!-- /.Main content -->
            </div>
            <!-- /.content-wrapper -->