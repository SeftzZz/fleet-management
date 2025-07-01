<style type="text/css">
  .layout-template .x_content {
    position: relative;
  }

  /* Atur overlay defaultnya hidden */
  .layout-template .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Warna overlay semi-transparan */
    opacity: 0;
    transition: opacity 0.3s ease; /* Smooth transition */
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .layout-template .overlay .text {
    color: white;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
  }

  /* Efek hover pada .layout-template */
  .layout-template:hover .overlay {
    opacity: 1; /* Tampilkan overlay saat di-hover */
  }

  .template-image {
    display: block;
    width: 100%;
    height: auto;
    border-radius: 8px;
  }

  .modal-lg {
    width: 100%;
  }

  .modal-dialog {
    width: 100%;
    margin: 0px;
  }

  .modal-full {
    padding-left: 0px!important;
  }

</style>
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
            <h2>Setting Site Pages
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
            <div class="item form-group">
              <div class="row">
                <div class="col-md-12">
                  <?php foreach($page_template as $row) { ?>
                      <div class="col-md-4 col-sm-4">
                          <div class="x_panel layout-template">
                              <div class="x_title">
                                  <h4><?php echo $row->titlePagetemplate; ?></h4>
                                  <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                                  <img src="<?php echo base_url('assets/images/page-template/') . $row->imgPagetemplate ?>" alt="Template Image" class="template-image">
                                  <div class="overlay" onclick='selectTemplate(<?php echo $row->idPagetemplate; ?>)'>
                                      <div class="btn btn-primary text" data-toggle="modal" data-target="#templateModal">Choose Template</div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  <?php } ?>
                  <!-- Modal -->
                  <div class="modal fade modal-full" id="templateModal" tabindex="-1" role="dialog" aria-labelledby="templateModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="templateModalLabel">Memuat Template</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <form method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertSiteSettingPage/') ?>" id="demo-form2" class="form-horizontal form-label-left">
                                  <input type="hidden" id="idPagetemplate" name="idPagetemplate" class="form-control" required>
                                  <input type="hidden" id="codePagetemplate" name="codePagetemplate" class="form-control" required>
                                  <input type="hidden" id="Name" name="Name" class="form-control" required>
                                  <input type="hidden" id="title" name="title" class="form-control" required>
                                  <input type="hidden" id="title2" name="title2" class="form-control" required>
                                  <input type="hidden" id="subtitle" name="subtitle" class="form-control" required>
                                  <input type="hidden" id="image" name="image" class="form-control" required>
                                  <input type="hidden" id="image2" name="image2" class="form-control" required>
                                  <input type="hidden" id="image3" name="image3" class="form-control" required>
                                  <input type="hidden" id="addres" name="addres" class="form-control" required>
                                  <input type="hidden" id="descENBusiness" name="descENBusiness" class="form-control" required>
                                  <!-- <input type="hidden" id="descIDBusiness" name="descIDBusiness" class="form-control" required> -->
                                  <input type="hidden" id="urlmapBusiness" name="urlmapBusiness" class="form-control" required>
                                  <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusContent">Status Page <span class="required">*</span></label>
                                      <div class="col-md-6 col-sm-6">
                                          <select name="statusContent" id="statusContent" class="form-control">
                                              <option value="" disabled selected>-- Pilih status --</option>
                                              <option value="1">Active</option>
                                              <option value="0">Non Active</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="locale">Locale <span class="required">*</span></label>
                                      <div class="col-md-6 col-sm-6">
                                          <select name="locale" id="locale" class="form-control" onchange="filterHeaders()">
                                              <option value="en">English</option>
                                              <option value="id">Indonesian</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="locale">Header Menu <span class="required">*</span></label>
                                      <div class="col-md-6 col-sm-6">
                                          <select name="idHeader" id="idHeader" class="form-control">
                                              <!-- Options akan diisi oleh JavaScript -->
                                          </select>
                                      </div>
                                  </div>
                                  <script type="text/javascript">
                                    function filterHeaders() {
                                      // Ambil locale yang dipilih dari dropdown
                                      const selectedLocale = document.getElementById('locale').value;
                                      const headerMenuDropdown = document.getElementById('idHeader');

                                      // Bersihkan dropdown idHeader
                                      headerMenuDropdown.innerHTML = '';

                                      // Lakukan AJAX request ke server
                                      $.ajax({
                                          url: '<?php echo base_url('cms/home/getHeadersByLocale'); ?>',
                                          type: 'GET',
                                          data: { locale: selectedLocale },
                                          dataType: 'json',
                                          success: function(data) {
                                              // Tambahkan options ke dropdown berdasarkan hasil response
                                              data.forEach(header => {
                                                  const option = document.createElement('option');
                                                  option.value = header.idHeader;
                                                  option.textContent = header.nmHeader;
                                                  headerMenuDropdown.appendChild(option);
                                              });
                                          },
                                          error: function(xhr, status, error) {
                                              console.error('Error fetching headers:', error);
                                          }
                                      });
                                  }

                                  // Panggil filterHeaders saat halaman pertama kali dimuat
                                  document.addEventListener('DOMContentLoaded', filterHeaders);

                                  </script>
                                  <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="titleContent">Page Name <span class="required">*</span></label>
                                      <div class="col-md-6 col-sm-6">
                                          <input type="text" id="titleContent" name="titleContent" class="form-control" required>
                                          <!-- <div id="error-message" style="color: red; display: none;">Invalid input! Only underscores "_" are allowed in place of spaces, and no hyphens "-".</div> -->
                                      </div>
                                  </div>
                                  
                                  <div id="templateContent" class="mt-3"></div> <!-- Placeholder for template HTML -->

                                  <div class="ln_solid"></div>
                                  <div class="item form-group">
                                      <div class="col-md-12 col-sm-12">
                                          <button type="submit" id="submitBtn" class="btn btn-success btn-block">Submit</button>
                                      </div>
                                  </div>
                                </form>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <script>
              function selectTemplate(idPagetemplate) {
                  fetch(`<?php echo base_url('cms/home/getTemplate'); ?>?code=${idPagetemplate}`)
                    .then(response => response.text())
                    .then(templateHTML => {
                        // Insert HTML into a shadow DOM to isolate CSS and JS
                        const templateContainer = document.getElementById('templateContent');
                        const idPage = document.getElementById('idPagetemplate');
                        idPage.value = idPagetemplate;
                        const shadowRoot = templateContainer.attachShadow({ mode: 'open' });
                        shadowRoot.innerHTML = templateHTML;
                        console.log('Shadow Root:', shadowRoot);

                        const formContent = document.getElementById('templateContent').shadowRoot; // Get the shadow root
                        console.log('formContent: ', formContent);
                        const formElements = formContent.querySelectorAll('input, textarea')
                        formElements.forEach(element => {
                          element.addEventListener('input', generateFormData);
                        });

                        function generateFormData() {
                          const titleContent = formContent.querySelector('#titleContent'); // Adjust this selector
                          document.getElementById('titleContent').value = titleContent;
                          const Name = formContent.querySelector('#Name'); // Adjust this selector
                          document.getElementById('Name').value = Name.value;
                          const title = formContent.querySelector('#title'); // Adjust this selector
                          document.getElementById('title').value = title.value;
                          const title2 = formContent.querySelector('#title2'); // Adjust this selector
                          document.getElementById('title2').value = title2.value;
                          const subtitle = formContent.querySelector('#subtitle'); // Adjust this selector
                          document.getElementById('subtitle').value = subtitle.value;
                          const addres = formContent.querySelector('#addres'); // Adjust this selector
                          document.getElementById('addres').value = addres.value;
                          const descENBusiness = formContent.querySelector('#descENBusiness'); // Adjust this selector
                          document.getElementById('descENBusiness').value = descENBusiness.value;
                          const urlmapBusiness = formContent.querySelector('#urlmapBusiness'); // Adjust this selector
                          document.getElementById('urlmapBusiness').value = urlmapBusiness.value;
                          console.log('Name: ', document.getElementById('Name').value);

                          formData = {
                            titleContent: document.getElementById('titleContent').value,
                            Name: Name.value,
                            title: title.value,
                            title2: title2.value,
                            subtitle: subtitle.value,
                            addres: addres.value,
                            descENBusiness: descENBusiness.value,
                            urlmapBusiness: urlmapBusiness.value,
                          };

                          // Simpan formData ke localStorage
                          localStorage.setItem('template-form', JSON.stringify(formData));

                          // console.log('Form Data:', JSON.stringify(formData));  // Log data untuk debugging
                        }
                        generateFormData();

                        $('#templateModal').modal('show');
                        fetch(`<?php echo base_url('cms/home/getContent'); ?>?code=${idPagetemplate}`)
                          .then(response => response.text())
                          .then(contentHTML => {
                              const codePagetemplate = document.getElementById('codePagetemplate').value = contentHTML;
                          })
                          .catch(error => {
                              console.error('Error fetching content:', error);
                              document.getElementById('templateContent').innerHTML = '<div>Content not found!</div>';
                              $('#templateModal').modal('show');
                          });
                    })
                    .catch(error => {
                        console.error('Error fetching template:', error);
                        document.getElementById('templateContent').innerHTML = '<div>Template not found!</div>';
                        $('#templateModal').modal('show');
                    });
              }
            </script>
            <script type="text/javascript">
                document.addEventListener('DOMContentLoaded', function () {
                    // Fungsi untuk memuat gambar yang diunggah
                    window.loadImage = function(event) {
                      const file = event.target.files[0];
                      const reader = new FileReader();

                      reader.onload = function(e) {
                          console.log(e); // This will show the FileReader event

                          // Now, you can access the input element correctly
                          const inputElement = event.target; // Get the input element
                          const shadowRoot = document.getElementById('templateContent').shadowRoot; // Get the shadow root
                          const imgElement = shadowRoot.querySelector('#backgroundImage'); // Adjust this selector

                          if (imgElement) {
                              imgElement.src = e.target.result; // Update the image source
                              const image = document.getElementById('image').value = e.target.result;
                          } else {
                              console.error('Image element not found in shadow DOM.');
                          }
                      };

                      if (file) {
                          reader.readAsDataURL(file); // Read the file as Data URL
                      }
                    };

                    window.loadImage2 = function(event) {
                      const file = event.target.files[0];
                      const reader = new FileReader();

                      reader.onload = function(e) {
                          console.log(e); // This will show the FileReader event

                          // Now, you can access the input element correctly
                          const inputElement = event.target; // Get the input element
                          const shadowRoot = document.getElementById('templateContent').shadowRoot; // Get the shadow root
                          const imgElement = shadowRoot.querySelector('#backgroundImage2'); // Adjust this selector

                          if (imgElement) {
                              imgElement.src = e.target.result; // Update the image source
                              const image2 = document.getElementById('image2').value = e.target.result;
                          } else {
                              console.error('Image element not found in shadow DOM.');
                          }
                      };

                      if (file) {
                          reader.readAsDataURL(file); // Read the file as Data URL
                      }
                    };

                    window.loadImage3 = function(event) {
                      const file = event.target.files[0];
                      const reader = new FileReader();

                      reader.onload = function(e) {
                          console.log(e); // This will show the FileReader event

                          // Now, you can access the input element correctly
                          const inputElement = event.target; // Get the input element
                          const shadowRoot = document.getElementById('templateContent').shadowRoot; // Get the shadow root
                          const imgElement = shadowRoot.querySelector('#backgroundImage3'); // Adjust this selector

                          if (imgElement) {
                              imgElement.src = e.target.result; // Update the image source
                              const image3 = document.getElementById('image3').value = e.target.result;
                          } else {
                              console.error('Image element not found in shadow DOM.');
                          }
                      };

                      if (file) {
                          reader.readAsDataURL(file); // Read the file as Data URL
                      }
                    };
                });
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>