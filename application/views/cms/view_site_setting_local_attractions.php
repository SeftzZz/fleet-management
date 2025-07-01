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
<div id="loader-text" style="content: '';position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: #121212b3;z-index: 4;display: none;">
  <h1 style="color: white;top: 0;left: 0;right: 0px;bottom: 0px;position: relative;text-align: center;">Uploading....</h1>
</div>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>View Site Local Attractions
            </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
                </a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li>
                    <a class="dropdown-item" href="#">Settings 1</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li>
                <a class="close-link">
                  <i class="fa fa-close"></i>
                </a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content form-horizontal form-label-left">
            <br />
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Locale</th>
                  <th>Title</th>
                  <th>Button</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach($local_attractions as $index => $row) {
                ?>
                  <tr>
                    <td><?php echo $row->locale ?></td>
                    <td><?php echo $row->titlelocalattractionHero ?></td>
                    <td><?php echo $row->subtitlelocalattractionHero ?></td>
                    <td><button type="button" class="btn btn-primary editBtn" data-toggle="modal" data-target="#localAttractionsModal<?php echo $row->idHero; ?>" data-index="<?php echo $index; ?>" id-header="<?php echo $row->idHero; ?>">Edit</button></td>
                  </tr>
                  <div class="modal fade" id="localAttractionsModal<?php echo $row->idHero; ?>" tabindex="-1" role="dialog" aria-labelledby="localAttractionsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="localAttractionsModalLabel">Edit Attraction <?php echo $row->idHero; ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateSiteSettingLocalAttractions') ?>" id="demo-form2" class="form-horizontal form-label-left">
                              <input type="hidden" readonly name="idHero" value="<?php echo $row->idHero; ?>" class="form-control">
                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="titlelocalattractionHero">Title <span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" id="titlelocalattractionHero" name="titlelocalattractionHero" class="form-control" value="<?php echo $row->titlelocalattractionHero ?>">
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="subtitlelocalattractionHero">Title <span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" id="subtitlelocalattractionHero" name="subtitlelocalattractionHero" class="form-control" value="<?php echo $row->subtitlelocalattractionHero ?>">
                                  </div>
                              </div>

                              <div class="ln_solid"></div>
                              <div class="item form-group">
                                  <div class="col-md-6 col-sm-6 offset-md-3">
                                      <button type="submit" id="submitBtnModal" class="btn btn-success">Submit</button>
                                  </div>
                              </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                      </div>
                    </div>
                  </div>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <br />
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach($attractions as $index => $row) {
                ?>
                  <tr>
                    <td><?php echo $row->Name ?></td>
                    <td><?php echo $row->addres ?></td>
                    <td><img src="<?php echo base_url('assets/images/place/'.$row->image)  ?>" width="10%" height="10%"></td>
                    <td><button type="button" class="btn btn-primary editBtn" data-toggle="modal" data-target="#headerModal<?php echo $row->idBusiness; ?>" data-index="<?php echo $index; ?>" id-header="<?php echo $row->idBusiness; ?>">Edit</button></td>
                  </tr>
                  <div class="modal fade" id="headerModal<?php echo $row->idBusiness; ?>" tabindex="-1" role="dialog" aria-labelledby="headerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="headerModalLabel">Edit Hotel <?php echo $row->idBusiness; ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateSiteSettingHotel') ?>" id="demo-form2" class="form-horizontal form-label-left">
                              <input type="hidden" readonly name="idBusiness" value="<?php echo $row->idBusiness; ?>" class="form-control">
                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="Name">Hotel Name <span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" id="Name" name="Name" class="form-control" value="<?php echo $row->Name ?>">
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="addres">Address <span class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" id="addres" name="addres" class="form-control" value="<?php echo $row->addres ?>">
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="emailReservationBusiness">Email Reservation</label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" id="emailReservationBusiness" name="emailReservationBusiness" class="form-control" value="<?php echo $row->emailReservationBusiness ?>">
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="urlwhatsappBusiness">Official Whatsapp</label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" id="urlwhatsappBusiness" readonly name="urlwhatsappBusiness" class="form-control" value="<?php echo $row->urlwhatsappBusiness ?>">
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="emailCABusiness">Email CA</label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" id="emailCABusiness" name="emailCABusiness" class="form-control" value="<?php echo $row->emailCABusiness ?>">
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="emailARBusiness">Email AR</label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" id="emailARBusiness" name="emailARBusiness" class="form-control" value="<?php echo $row->emailARBusiness ?>">
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="mobileBusiness">Phone Hotel</label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" id="mobileBusiness" name="mobileBusiness" class="form-control" value="<?php echo $row->mobileBusiness ?>">
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="urlmapBusiness">URL Map Hotel</label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" id="urlmapBusiness" name="urlmapBusiness" class="form-control" value="<?php echo $row->urlmapBusiness ?>">
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="feeBusiness">Fee Hotel</label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" id="feeBusiness" name="feeBusiness" class="form-control" value="<?php echo $row->feeBusiness ?>">
                                      <span class="form-control-feedback right" aria-hidden="true">%</span>
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="feedokuMandiriBusiness">Fee DOKU Mandiri</label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" id="feedokuMandiriBusiness" name="feedokuMandiriBusiness" class="form-control" value="<?php echo $row->feedokuMandiriBusiness ?>">
                                      <span class="form-control-feedback right" aria-hidden="true">Rp</span>
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="descIDBusiness">Description Hotel (ID)</label>
                                  <div class="col-md-6 col-sm-6">
                                      <textarea type="text" id="descIDBusiness" name="descIDBusiness" class="form-control" rows="7"><?php echo $row->descIDBusiness ?></textarea>
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="descENBusiness">Description Hotel (EN)</label>
                                  <div class="col-md-6 col-sm-6">
                                      <textarea type="text" EN="descENBusiness" name="descENBusiness" class="form-control" rows="7"><?php echo $row->descENBusiness ?></textarea>
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="growmemberBusiness">Member point payment</label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" EN="growmemberBusiness" name="growmemberBusiness" class="form-control" value="<?php echo $row->growmemberBusiness ?>">
                                      <span class="form-control-feedback right" aria-hidden="true">%</span>
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="extrabedBusiness">Extrabed Hotel</label>
                                  <div class="col-md-6 col-sm-6">
                                      <input type="text" EN="extrabedBusiness" name="extrabedBusiness" class="form-control" value="<?php echo $row->extrabedBusiness ?>">
                                      <span class="form-control-feedback right" aria-hidden="true">Rp</span>
                                  </div>
                              </div>

                              <div class="ln_solid"></div>
                              <div class="item form-group">
                                  <div class="col-md-6 col-sm-6 offset-md-3">
                                      <button type="submit" id="submitBtnModal" class="btn btn-success">Submit</button>
                                  </div>
                              </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>