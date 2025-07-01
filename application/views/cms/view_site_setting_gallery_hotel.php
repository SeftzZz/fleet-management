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
            <h2>Setting Gallery
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
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertgallery/'.$idBusiness.'/') ?>" id="demo-form2" class="form-horizontal form-label-left">
                <input type="hidden" name="idBusiness" value="<?php echo $idBusiness ?>">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="typeGallery">Tipe Galeri<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="typeGallery" id="typeGallery" class="form-control">
                            <option value="" disabled selected>-- Pilih status --</option>
                            <option value="image">Gambar</option>
                            <option value="video">Vidio</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="kategoriGallery">Kategori Galeri <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select name="kategoriGallery" id="kategoriGallery" class="form-control">
                            <option value="facilites">Fasilitas</option>
                            <option value="rooms">Ruangan</option>
                            <option value="dinings">Restoran</option>
                            <option value="videos">Vidio</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgGallery">Image</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="file" id="imgGallery" name="imgGallery" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="ketGallery">Keterangan</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="ketGallery" name="ketGallery" class="form-control">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>View Site Slider
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
                  <th>Keterangan</th>
                  <th>Image</th>
                  <th>Kategori Galeri</th>
                  <th>Tipe Galeri</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($gallery as $index => $row) {
                ?>
                <tr id="row-<?php echo $index; ?>">
                  <td><?php echo $row->ketGallery; ?></td>
                  <td width="20%">
                    <?php if ($row->typeGallery == 'image'): ?>
                      <!-- Jika typeGallery adalah gambar, tampilkan elemen img -->
                      <img src="https://cms.sahirahotelsgroup.com/assets/images/gallery/<?php echo $row->imgGallery; ?>" alt="Gallery Image" width="100%">
                    <?php else: ?>
                      <!-- Jika typeGallery adalah video, tampilkan elemen video -->
                      <video width="100%" controls>
                        <source src="https://cms.sahirahotelsgroup.com/assets/images/swiper/<?php echo $row->imgGallery; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                      </video>
                    <?php endif; ?>
                  </td>
                  <td><?php echo $row->kategoriGallery; ?></td>
                  <td><?php echo $row->typeGallery; ?></td>
                  <td><button type="button" class="btn btn-primary editBtn" data-toggle="modal" data-target="#swiperModal<?php echo $row->idGallery; ?>" data-index="<?php echo $index; ?>" id-swiper="<?php echo $row->idGallery; ?>">Edit</button></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>