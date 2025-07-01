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
            <h2>Setting Press Release
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
             <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertpressrelease') ?>" id="demo-form2" class="form-horizontal form-label-left">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusPressrelease">Status Menu <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="statusPressrelease" id="statusPressrelease" class="form-control">
                            <option value="" disabled selected>-- Pilih status --</option>
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                </div>
            
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="locale">Locale <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select name="locale" id="locale" class="form-control">
                            <option value="en">English</option>
                            <option value="id">Indonesian</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmPressrelease">Press Release <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="nmPressrelease" name="nmPressrelease" class="form-control" required>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="ketPressrelease">Keterangan</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="ketPressrelease" name="ketPressrelease" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgPressrelease">URL Image</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="file" id="imgPressrelease" name="imgPressrelease" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="urlPressrelease">URL Web</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="urlPressrelease" name="urlPressrelease" class="form-control">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                    </div>
                </div>
              </form>
              
              <!-- BATAS BUAT FORM BARU --> 
                           <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertcareer') ?>" id="demo-form2" class="form-horizontal form-label-left">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusCarrer">Status Career <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="statusCarrer" id="statusCarrer" class="form-control">
                            <option value="" disabled selected>-- Pilih status --</option>
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                </div>
            
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="locale">Locale <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select name="locale" id="locale" class="form-control">
                            <option value="en">English</option>
                            <option value="id">Indonesian</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmCarrer">Career <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="nmCarrer" name="nmCarrer" class="form-control" required>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="ketCarrer">Keterangan</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="ketCarrer" name="ketCarrer" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="locationCarrer">Lokasi Career</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="locationCarrer" name="locationCarrer" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="timeCarrer">Waktu Career</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="timeCarrer" name="timeCarrer" class="form-control">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                    </div>
                </div>
                
              </form>
              <!---->
               <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertjoinmember') ?>" id="demo-form2" class="form-horizontal form-label-left">
                   <input type="hidden" name="idBusiness">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusjoinmemberHero">Status Join Member Hero <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="statusjoinmemberHero" id="statusjoinmemberHero" class="form-control">
                            <option value="" disabled selected>-- Pilih status --</option>
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="locale">Locale <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select name="locale" id="locale" class="form-control">
                            <option value="en">English</option>
                            <option value="id">Indonesian</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgHero">Image</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="file" id="imgHero" name="imgHero" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="titlehomeHero">Title <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="titlehomeHero" name="titlehomeHero" class="form-control" required>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="titlejoinmemberHero">Title Join</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="titlejoinmemberHero" name="titlejoinmemberHero" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="subtitlejoinmemberHero">Subtitle</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="subtitlejoinmemberHero" name="subtitlejoinmemberHero" class="form-control">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                    </div>
                </div>
              </form>
              <!---->
              <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertstaymember') ?>" id="demo-form2" class="form-horizontal form-label-left">
                   <input type="hidden" name="idBusiness">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusStay">Status Stay<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="statusStay" id="statusStay" class="form-control">
                            <option value="" disabled selected>-- Pilih status --</option>
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="locale">Locale <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select name="locale" id="locale" class="form-control">
                            <option value="en">English</option>
                            <option value="id">Indonesian</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgHero">Image</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="file" id="imgHero" name="imgHero" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="titlehomeHero">Title <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="titlehomeHero" name="titlehomeHero" class="form-control" required>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="titlestayintouchHero">Title Stay</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="titlestayintouchHero" name="titlestayintouchHero" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="subtitlestayintouchHero">Subtitle Stay</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="subtitlestayintouchHero" name="subtitlestayintouchHero" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="textstayintouchHero">Text Stay</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="textstayintouchHero" name="textstayintouchHero" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="titlejoinmemberHero">Title Join</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="titlejoinmemberHero" name="titlejoinmemberHero" class="form-control">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                    </div>
                </div>
              </form>
              <!---->
              <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertfacilities') ?>" id="demo-form2" class="form-horizontal form-label-left">
                   <input type="hidden" name="idBusiness">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusFacilities">Status Fasilitas<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="statusFacilities" id="statusFacilities" class="form-control">
                            <option value="" disabled selected>-- Pilih status --</option>
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="locale">Locale <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select name="locale" id="locale" class="form-control">
                            <option value="en">English</option>
                            <option value="id">Indonesian</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="imgFacilities">Image</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="file" id="imgFacilities" name="imgFacilities" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="img2Facilities">Image2</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="file" id="img2Facilities" name="img2Facilities" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="img3Facilities">Image3</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="file" id="img3Facilities" name="img3Facilities" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmFacilities">Nama Fasilitas <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="nmFacilities" name="nmFacilities" class="form-control" required>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="ketFacilities">Keterangan Fasilitas</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="ketFacilities" name="ketFacilities" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="openFacilities">Jam Buka</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="openFacilities" name="openFacilities" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="floorFacilities">Fasilitas Lokasi</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="floorFacilities" name="floorFacilities" class="form-control">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                    </div>
                </div>
              </form>
              <!---->
              <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertgallery') ?>" id="demo-form2" class="form-horizontal form-label-left">
                   <input type="hidden" name="idBusiness">
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
                            <option value="dining">Restoran</option>
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
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="typeGallery">Nama Fasilitas <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="typeGallery" name="typeGallery" class="form-control" required>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="ketGallery">Keterangan Fasilitas</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="ketGallery" name="ketGallery" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="kategoriGallery">Jam Buka</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="kategoriGallery" name="kategoriGallery" class="form-control">
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
    </div>
  </div>
</div>