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
<div class="right_col" role="main">
  <div class>
    <div class="page-title">
      <div class="title_left">
        <h3>Detail Kamar :: <?php echo $kamar->ketKamar ?></h3>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Detail Kamar :: <?php echo $kamar->ketKamar ?> <?php echo $this->session->userdata('business') ?></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
                </a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <i class="fa fa-wrench"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Settings 1</a>
                  <a class="dropdown-item" href="#">Settings 2</a>
                </div>
              </li>
              <li>
                <a class="close-link">
                  <i class="fa fa-close"></i>
                </a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertNumberKamar//'.$this->session->userdata('idBusiness').'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
              <input type="hidden" name="idBusiness" value="<?php echo $kamar->ketKamar ?>">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nomorkamar">Nomor Kamar <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="number" id="nomorkamar" required="required" name="nmNumber" class="form-control" min="1" placeholder="1">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nomorkamar">Status Kamar <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <select id="keterangankamar" name="ketNumber" class="form-control" required>
                    <option value>Choose..</option>
                    <option value="VD">Vacant Dirty</option>
                    <option value="VC">Vacant Clean</option>
                    <option value="VR">Vacant Ready</option>
                    <option value="OD">Occupied Dirty</option>
                    <option value="OC">Occupied Clean</option>
                    <option value="ED">Extend Departure</option>
                    <option value="OOO">Out Of Order</option>
                  </select>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button class="btn btn-primary" type="button">Cancel</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
          </div>
          <div class="x_content">
            <div class="col-md-7 col-sm-7">
              <div class="card-body">
                <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertgambarkamar1/'.$idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                  <input type="hidden" name="ketKamar" value="<?php echo $kamar->ketKamar ?>" class="form-control">
                  <div style="display:grid;gap: 10px;">
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">input Photo 1<span class="required">*</span>
                      </label>
                      <div id="fileInputsContainer">
                        <div id="img" class="col-md-6 col-sm-6 form-group has-feedback">
                          <input type="file" name="imgKamardetail" class="form-control">
                          <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                 </div>
                </form>
                <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertgambarkamar3/'.$idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                  <input type="hidden" name="ketKamar" value="<?php echo $kamar->ketKamar ?>" class="form-control">
                  <div style="display:grid;gap: 10px;">
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">input Photo 3<span class="required">*</span>
                      </label>
                      <div id="fileInputsContainer">
                        <div id="img" class="col-md-6 col-sm-6 form-group has-feedback">
                          <input type="file" name="img3Kamardetail" class="form-control">
                          <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                      </div>
                    </div>
                </form>
                <div style="display:flex;">
                  <div style="grid">
                 <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertgambarkamar2/'.$idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                  <input type="hidden" name="ketKamar" value="<?php echo $kamar->ketKamar ?>" class="form-control">
                  <div style="display:grid;gap: 10px;">
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">input Photo 2<span class="required">*</span>
                      </label>
                      <div id="fileInputsContainer">
                        <div id="img" class="col-md-6 col-sm-6 form-group has-feedback">
                          <input type="file" name="img2Kamardetail" class="form-control">
                          <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <h4>Hotel view</h4>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th style="text-align: center;">gambar1</th>
                          <th style="text-align: center;">gambar2</th>
                          <th style="text-align: center;">gambar3</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><img class="img-responsive" src="<?php echo '/assets/images/kamar/' .$kamar->imgKamardetail; ?>"/></td>
                          <td><img class="img-responsive" src="<?php echo '/assets/images/kamar/' .$kamar->img2Kamardetail; ?>"/></td>
                          <td><img class="img-responsive" src="<?php echo '/assets/images/kamar/' .$kamar->img3Kamardetail; ?>"/></td>
                        </tr>
                      </tbody>
                    </table>
                    <script
                      src="https://code.jquery.com/jquery-3.6.0.min.js"
                      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
                      crossorigin="anonymous"
                    ></script>
                    <script>
                      var selDiv = "";
                      var storedFiles = [];
                      $(document).ready(function () {
                        $("#img").on("change", handleFileSelect);
                        selDiv = $("#selectedBanner");
                      });

                      $(document).ready(function () {
                        $("#img2").on("change", handleFileSelect(2));
                        selDiv = $("#selectedBanner2");
                      });

                      $(document).ready(function () {
                        $("#img3").on("change", handleFileSelect(3));
                        selDiv = $("#selectedBanner3");
                      });

                      function handleFileSelect(e) {
                        var files = e.target.files;
                        var filesArr = Array.prototype.slice.call(files);
                        filesArr.forEach(function (f) {
                          if (!f.type.match("image.*")) {
                            return;
                          }
                      
                          storedFiles.push(f);

                          var reader = new FileReader();
                          reader.onload = function (e) {
                            var html =
                              '<img src="' +
                              e.target.result +
                              "\" data-file='" +
                              f.name +
                              "alt='Category Image' height='200px' width='200px'>";
                            selDiv.html(html);
                          };
                          reader.readAsDataURL(f);
                        });
                      }
                    </script>
                  </div>
                </div>
                <div style="grid">
                <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertgambarkamar4/'.$idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                  <input type="hidden" name="ketKamar" value="<?php echo $kamar->ketKamar ?>" class="form-control">
                  <div style="display:grid;gap: 10px;">
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">input Photo 4<span class="required">*</span>
                      </label>
                      <div id="fileInputsContainer">
                        <div id="img" class="col-md-6 col-sm-6 form-group has-feedback">
                          <input type="file" name="img4Kamardetail" class="form-control">
                          <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                      </div>
                    </div>
                </form>
                <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertgambarkamar5/'.$idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                  <input type="hidden" name="ketKamar" value="<?php echo $kamar->ketKamar ?>" class="form-control">
                  <div style="display:grid;gap: 10px;">
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">input Photo 5<span class="required">*</span>
                      </label>
                      <div id="fileInputsContainer">
                        <div id="img" class="col-md-6 col-sm-6 form-group has-feedback">
                          <input type="file" name="img5Kamardetail" class="form-control">
                          <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                      </div>
                    </div>
                </form>
                <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertgambarkamar6/'.$idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                  <input type="hidden" name="ketKamar" value="<?php echo $kamar->ketKamar ?>" class="form-control">
                  <div style="display:grid;gap: 10px;">
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">input Photo 6<span class="required">*</span>
                      </label>
                      <div id="fileInputsContainer">
                        <div id="img" class="col-md-6 col-sm-6 form-group has-feedback">
                          <input type="file" name="img6Kamardetail" class="form-control">
                          <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                      </div>
                    </div>
                    <div style="grid">
                </form>
                <hr>
                    <h4>guest room</h4>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th style="text-align: center;">gambar4</th>
                          <th style="text-align: center;">gambar5</th>
                          <th style="text-align: center;">gambar6</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><img class="img-responsive" src="<?php echo '/assets/images/kamar/' .$kamar->img4Kamardetail; ?>"/></td>
                          <td><img class="img-responsive" src="<?php echo '/assets/images/kamar/' .$kamar->img5Kamardetail; ?>"/></td>
                          <td><img class="img-responsive" src="<?php echo '/assets/images/kamar/' .$kamar->img6Kamardetail; ?>"/></td>
                        </tr>
                      </tbody>
                    </table>
                    <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertgambarkamar7/'.$idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                  <input type="hidden" name="ketKamar" value="<?php echo $kamar->ketKamar ?>" class="form-control">
                  <div style="display:grid;gap: 10px;">
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">input adult pool view<span class="required">*</span>
                      </label>
                      <div id="fileInputsContainer">
                        <div id="img" class="col-md-6 col-sm-6 form-group has-feedback">
                          <input type="file" name="img7Kamardetail" class="form-control">
                          <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertgambarkamar8/'.$idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                  <input type="hidden" name="ketKamar" value="<?php echo $kamar->ketKamar ?>" class="form-control">
                  <div style="display:grid;gap: 10px;">
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">input kids pool view<span class="required">*</span>
                      </label>
                      <div id="fileInputsContainer">
                        <div id="img" class="col-md-6 col-sm-6 form-group has-feedback">
                          <input type="file" name="img8Kamardetail" class="form-control">
                          <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertgambarkamar9/'.$idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                  <input type="hidden" name="ketKamar" value="<?php echo $kamar->ketKamar ?>" class="form-control">
                  <div style="display:grid;gap: 10px;">
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">input pool view<span class="required">*</span>
                      </label>
                      <div id="fileInputsContainer">
                        <div id="img" class="col-md-6 col-sm-6 form-group has-feedback">
                          <input type="file" name="img9Kamardetail" class="form-control">
                          <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                      </div>
                    </div>
                </form>
                <div style="grid">
                    <hr>
                    <h4>swimming pool view</h4>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th style="text-align: center;">adult pool view</th>
                          <th style="text-align: center;">kids pool view</th>
                          <th style="text-align: center;">pool view</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><img class="img-responsive" src="<?php echo '/assets/images/kamar/' .$kamar->img7Kamardetail; ?>"/></td>
                          <td><img class="img-responsive" src="<?php echo '/assets/images/kamar/' .$kamar->img8Kamardetail; ?>"/></td>
                          <td><img class="img-responsive" src="<?php echo '/assets/images/kamar/' .$kamar->img9Kamardetail; ?>"/></td>
                        </tr>
                      </tbody>
                    </table>
                    <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertgambarkamar10/'.$idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                      <input type="hidden" name="ketKamar" value="<?php echo $kamar->ketKamar ?>" class="form-control">
                      <div style="display:grid;gap: 10px;">
                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align">input kids zone view<span class="required">*</span>
                         </label>
                          <div id="fileInputsContainer">
                            <div id="img" class="col-md-6 col-sm-6 form-group has-feedback">
                              <input type="file" name="img10Kamardetail" class="form-control">
                              <button type="submit" class="btn btn-success">Upload</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertgambarkamar11/'.$idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                    <input type="hidden" name="ketKamar" value="<?php echo $kamar->ketKamar ?>" class="form-control">
                    <div style="display:grid;gap: 10px;">
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">input kids zone view2<span class="required">*</span>
                        </label>
                        <div id="fileInputsContainer">
                          <div id="img" class="col-md-6 col-sm-6 form-group has-feedback">
                            <input type="file" name="img11Kamardetail" class="form-control">
                            <button type="submit" class="btn btn-success">Upload</button>
                          </div>
                        </div>
                      </div>
                  </form>
                  <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertgambarkamar12/'.$idBusiness.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                    <input type="hidden" name="ketKamar" value="<?php echo $kamar->ketKamar ?>" class="form-control">
                    <div style="display:grid;gap: 10px;">
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">input kids zone view3<span class="required">*</span>
                        </label>
                        <div id="fileInputsContainer">
                          <div id="img" class="col-md-6 col-sm-6 form-group has-feedback">
                            <input type="file" name="img12Kamardetail" class="form-control">
                            <button type="submit" class="btn btn-success">Upload</button>
                          </div>
                        </div>
                      </div>
                  </form>
                  <div style="grid">
                    <hr>
                    <h4>swimming pool view</h4>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th style="text-align: center;">kids zone view</th>
                          <th style="text-align: center;">kids zone view2</th>
                          <th style="text-align: center;">kids zone view3</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><img class="img-responsive" src="<?php echo '/assets/images/kamar/' .$kamar->img10Kamardetail; ?>"/></td>
                          <td><img class="img-responsive" src="<?php echo '/assets/images/kamar/' .$kamar->img11Kamardetail; ?>"/></td>
                          <td><img class="img-responsive" src="<?php echo '/assets/images/kamar/' .$kamar->img12Kamardetail; ?>"/></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              </div>
              </div>
              </div>
              </div>   
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
  <div class="col-md-5 col-sm-5 " style="border:0px solid #e5e5e5;float: inline-end !important;margin-top: -2070px;">
          <h3 class="prod_title"><?php echo $kamar->ketKamar ?> <?php echo $this->session->userdata('business') ?></h3>
          <h4>Keterangan Kamar</h4>
          <p><?php echo $kamar->ketKamar ?></p>
          <div class>
            <h2>Nomor Kamar</h2>
            <ul class="list-inline prod_size display-layout">
              <?php
                foreach($nomorkamar as $row) {
              ?>
              <li>
                <div class="btn btn-success" id="fc_create" data-toggle="modal" data-target="#editnomorModal<?php echo $row->nmNumber ?>"><?php echo $row->nmNumber ?></div>
              </li>
              <div class="modal fade" id="editnomorModal<?php echo $row->nmNumber ?>" tabindex="-1" role="dialog" aria-labelledby="editnomorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editnomorModalLabel">Room Number <?php echo $row->nmNumber ?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/editNumberKamar/'.$idBusiness.'/'.$row->idKamar.'/'.$row->nmNumber.'/'.$row->idNumber.'/') ?>" id="demo-form2" id="demo-form2" class="form-horizontal form-label-left">
                        <input type="hidden" name="idBusiness" value="<?php echo $this->session->userdata('idBusiness') ?>">
                        <input type="hidden" name="idType" value="<?php echo $row->idType ?>">
                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="nomorkamar">Nomor Kamar
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <input type="number" id="nomorkamar" name="nmNumber" value="<?php echo $row->nmNumber ?>" class="form-control" min="1" placeholder="1">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="nomorkamar">Features Kamar
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="featureskamar" name="featuresNumber" value="<?php echo $row->featuresNumber ?>" class="form-control" placeholder="1">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="idType">Type Kamar
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <select id="idType" name="idTypeAfter" class="form-control">
                              <option value>Choose..</option>
                              <?php
                                foreach($nomor_edit as $row) {
                              ?>
                                <option value="<?php echo $row->idKamar ?>"><?php echo $row->ketKamar ?></option>
                              <?php
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                          <div class="col-md-6 col-sm-6 offset-md-3">
                            <button class="btn btn-primary" type="button">Cancel</button>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
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
                <script type="text/javascript">
                var modalID = document.getElementById('editnomorModal');
                modalID.setAttribute('data-toggle', 'modal');
                modalID.setAttribute('data-target', '#editnomorModal');
                modalID.click();
                </script>
              </ul>
            </div>
            <br />
            <div class>
              <div class="product_price">
              <h1 class="price">Rp <?php echo number_format($kamar->hargaROKamar) ?></h1>
              <span class="price-tax">1 Night</span>
              <br>
              </div>
            </div>
          </div>
        
</div>