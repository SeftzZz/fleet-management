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
            <h2>Setting Site Header
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
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertSiteSettingHeader') ?>" id="demo-form2" class="form-horizontal form-label-left">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusHeader">Status Menu <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="statusHeader" id="statusHeader" class="form-control">
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
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmHeader">Menu Name <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="nmHeader" name="nmHeader" class="form-control" required>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="linkHeader">Link</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" id="linkHeader" name="linkHeader" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusSubMenu">Sub Menu</label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="statusSubMenu" id="statusSubMenu" class="form-control" onchange="toggleJlmSubMenu()">
                            <option value="" disabled selected>-- Pilih status --</option>
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group" id="jlmSubMenuGroup" style="display: none;">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="jlmSubMenu">Jumlah Sub Menu</label>
                    <div class="col-md-6 col-sm-6">
                        <input type="number" id="jlmSubMenu" name="jlmSubMenu" class="form-control" oninput="generateSubMenuInputs()">
                    </div>
                </div>
                <div id="headerSub"></div>
                <script>
                    function toggleJlmSubMenu() {
                        var statusSubMenu = document.getElementById('statusSubMenu').value;
                        var jlmSubMenuGroup = document.getElementById('jlmSubMenuGroup');
                        if (statusSubMenu === '1') {
                            jlmSubMenuGroup.style.display = 'block'; // Tampilkan jlmSubMenu
                        } else {
                            jlmSubMenuGroup.style.display = 'none';  // Sembunyikan jlmSubMenu
                        }
                    }
                    function generateSubMenuInputs() {
                        const subMenuCount = document.getElementById('jlmSubMenu').value;
                        const headerSub = document.getElementById('headerSub');
                        headerSub.innerHTML = '';
                        for (let i = 1; i <= subMenuCount; i++) {
                            const subMenuGroup = document.createElement('div');
                            subMenuGroup.className = 'sub-header';
                            subMenuGroup.innerHTML = `
                                <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmHeaderSub${i}">Sub Menu ${i} <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="nmHeaderSub${i}" name="nmHeaderSub${i}" class="form-control" required placeholder="Nama Sub Menu">
                                </div>
                                </div>
                                <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="localeSub${i}">Locale ${i}</label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="localeSub${i}" id="localeSub${i}" class="form-control">
                                        <option value="en">English</option>
                                        <option value="id">Indonesian</option>
                                    </select>
                                </div>
                                </div>
                                <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="linkHeaderSub${i}">Link ${i}</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="linkHeaderSub${i}" name="linkHeaderSub${i}" class="form-control" required placeholder="Link Sub Menu">
                                </div>
                                </div>
                                <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusHeaderSub${i}">Status ${i}</label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="statusHeaderSub${i}" id="statusHeaderSub${i}" class="form-control" required>
                                        <option value="" disabled selected>-- Pilih status --</option>
                                        <option value="1">Active</option>
                                        <option value="0">Non Active</option>
                                    </select>
                                </div>
                                </div>
                                <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                                <div class="col-md-6 col-sm-6">
                                </div>
                                </div>
                            `;
                            headerSub.appendChild(subMenuGroup);
                        }
                    }
                </script>
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
            <h2>View Site Header
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
                  <th>Nama Menu</th>
                  <th>Status Menu</th>
                  <th>Sub Menu</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($header as $index => $row) {
                ?>
                <tr id="row-<?php echo $index; ?>">
                  <td><?php echo $row->locale; ?></td>
                  <td><?php echo $row->nmHeader; ?></td>
                  <td><?php echo $row->statusHeader ? 'Aktif' : 'Tidak Aktif'; ?></td>
                  <td><?php echo !empty($row->nmHeaderSub) ? $row->nmHeaderSub : '-'; ?></td>
                  <td><button type="button" class="btn btn-primary editBtn" data-toggle="modal" data-target="#headerModal" data-index="<?php echo $index; ?>" id-header="<?php echo $row->idHeader; ?>">Edit</button></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="modal fade" id="headerModal" tabindex="-1" role="dialog" aria-labelledby="headerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="headerModalLabel">Edit Header</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateSiteSettingHeader') ?>" id="demo-form2" class="form-horizontal form-label-left">
                      <input type="hidden" readonly id="idHeaderModal" name="idHeader" class="form-control">
                      <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusHeaderModal">Status Menu <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 ">
                              <select name="statusHeader" id="statusHeaderModal" class="form-control">
                                  <option value="" disabled selected>-- Pilih status --</option>
                                  <option value="1">Active</option>
                                  <option value="0">Non Active</option>
                              </select>
                          </div>
                      </div>

                      <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="localeModal">Locale <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6">
                              <select name="locale" id="localeModal" class="form-control">
                                  <option value="en">English</option>
                                  <option value="id">Indonesian</option>
                              </select>
                          </div>
                      </div>
                      <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmHeaderModal">Menu Name <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6">
                              <input type="text" id="nmHeaderModal" name="nmHeader" class="form-control" required>
                          </div>
                      </div>
                      <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="linkHeaderModal">Link</label>
                          <div class="col-md-6 col-sm-6">
                              <input type="text" id="linkHeaderModal" name="linkHeader" class="form-control">
                          </div>
                      </div>
                      <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusSubMenuModal">Sub Menu</label>
                          <div class="col-md-6 col-sm-6 ">
                              <select name="statusSubMenu" id="statusSubMenuModal" class="form-control">
                                  <option value="" disabled selected>-- Pilih status --</option>
                                  <option value="1">Active</option>
                                  <option value="0">Non Active</option>
                              </select>
                          </div>
                      </div>
                      <div class="item form-group" id="jlmSubMenuGroupModal" style="display: none;">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="jlmSubMenuModal">Jumlah Sub Menu</label>
                          <div class="col-md-6 col-sm-6">
                              <input type="number" id="jlmSubMenuModal" name="jlmSubMenu" class="form-control" oninput="generateSubMenuInputsModal()">
                          </div>
                      </div>
                      <div id="headerSubModal"></div>
                      <script>
                          document.addEventListener('DOMContentLoaded', function () {
                              const editButtons = document.querySelectorAll('.editBtn');

                              editButtons.forEach(button => {
                                  console.log(button);
                                  button.addEventListener('click', function () {
                                      const index = this.getAttribute('data-index');
                                      const idHeader = this.getAttribute('id-header');
                                      document.getElementById('idHeaderModal').value = idHeader;
                                      const row = document.getElementById(`row-${index}`);
                                      console.log('row', row);
                                      const localeModal = row.children[0].innerText;
                                      const nmHeaderModal = row.children[1].innerText;
                                      const statusHeaderModal = row.children[2].innerText === 'Aktif' ? '1' : '0';
                                      const nmHeaderSubModal = row.children[3].innerText;
                                      // Isi form dengan data dari baris yang dipilih
                                      document.getElementById('localeModal').value = localeModal;
                                      document.getElementById('nmHeaderModal').value = nmHeaderModal;
                                      document.getElementById('statusHeaderModal').value = statusHeaderModal;
                                      // Jika ada sub-menu, isikan ke form sub-menu
                                      if (nmHeaderSubModal !== '-') {
                                          document.getElementById('statusSubMenuModal').value = '1';
                                          document.getElementById('jlmSubMenuGroupModal').style.display = 'block';

                                          const subMenusModal = nmHeaderSubModal.split(','); // Memisahkan sub-menu berdasarkan koma
                                          const subMenuCountModal = subMenusModal.length;
                                          document.getElementById('jlmSubMenuModal').value = subMenuCountModal;
                                          generateSubMenuInputsExistsModal(idHeader, subMenuCountModal, subMenusModal, localeModal);
                                          const linkHeaderModal = document.getElementById('linkHeaderModal');
                                          linkHeaderModal.setAttribute('readonly', true);
                                      } else {
                                          document.getElementById('statusSubMenuModal').value = '0';
                                          document.getElementById('jlmSubMenuGroupModal').style.display = 'none';
                                          document.getElementById('headerSubModal').innerHTML = ''; // Kosongkan sub-menu jika tidak ada
                                      }
                                  });
                              });
                          });
                          function toggleJlmSubMenuModal() {
                              var statusSubMenuModal = document.getElementById('statusSubMenuModal').value;
                              var jlmSubMenuGroupModal = document.getElementById('jlmSubMenuGroupModal');
                              var headerSubModal = document.getElementById('headerSubModal');
                              if (statusSubMenuModal === '1') {
                                  jlmSubMenuGroupModal.style.display = 'block'; // Tampilkan jlmSubMenuModal
                                  headerSubModal.style.display = 'block';
                                  const linkHeaderModal = document.getElementById('linkHeaderModal');
                                  linkHeaderModal.setAttribute('readonly', true);
                              } else {
                                  jlmSubMenuGroupModal.style.display = 'none';  // Sembunyikan jlmSubMenuModal
                                  headerSubModal.style.display = 'none';
                                  const linkHeaderModal = document.getElementById('linkHeaderModal');
                                  linkHeaderModal.removeAttribute('readonly');
                              }
                          }
                          function generateSubMenuInputsModal() {
                              const subMenuCountModal = document.getElementById('jlmSubMenuModal').value;
                              const headerSubModal = document.getElementById('headerSubModal');
                              headerSubModal.innerHTML = '';
                              for (let i = 1; i <= subMenuCountModal; i++) {
                                  const subMenuGroupModal = document.createElement('div');
                                  subMenuGroupModal.className = 'sub-header';
                                  subMenuGroupModal.innerHTML = `
                                      <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmHeaderSubModal${i}">Sub Menu ${i} <span class="required">*</span></label>
                                      <div class="col-md-6 col-sm-6">
                                          <input type="text" id="nmHeaderSubModal${i}" name="nmHeaderSub${i}" class="form-control" required placeholder="Nama Sub Menu">
                                      </div>
                                      </div>
                                      <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="localeSubModal${i}">Locale ${i}</label>
                                      <div class="col-md-6 col-sm-6">
                                          <select name="localeSub${i}" id="localeSubModal${i}" class="form-control">
                                              <option value="en">English</option>
                                              <option value="id">Indonesian</option>
                                          </select>
                                      </div>
                                      </div>
                                      <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="linkHeaderSubModal${i}">Link ${i}</label>
                                      <div class="col-md-6 col-sm-6">
                                          <input type="text" id="linkHeaderSubModal${i}" name="linkHeaderSub${i}" class="form-control" required placeholder="Link Sub Menu">
                                      </div>
                                      </div>
                                      <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusHeaderSubModal${i}">Status ${i}</label>
                                      <div class="col-md-6 col-sm-6">
                                          <select name="statusHeaderSub${i}" id="statusHeaderSubModal${i}" class="form-control" required>
                                              <option value="" disabled selected>-- Pilih status --</option>
                                              <option value="1">Active</option>
                                              <option value="0">Non Active</option>
                                          </select>
                                      </div>
                                      </div>
                                      <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                                      <div class="col-md-6 col-sm-6">
                                      </div>
                                      </div>
                                  `;
                                  headerSubModal.appendChild(subMenuGroupModal);
                              }
                          }
                          function generateSubMenuInputsExistsModal(idHeader, subMenuCountModal, subMenusModal, localeSubModal) {
                              const headerSubModal = document.getElementById('headerSubModal');
                              console.log(idHeader, subMenuCountModal, subMenusModal, localeSubModal);
                              headerSubModal.innerHTML = '';
                              for (let i = 1; i <= subMenuCountModal; i++) {
                                  const subMenuGroupModal = document.createElement('div');
                                  subMenuGroupModal.className = 'sub-header';
                                  subMenuGroupModal.innerHTML = `
                                      <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                                      <div class="col-md-6 col-sm-6">
                                      </div>
                                      </div>
                                      <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="idHeader">Id Header <span class="required">*</span></label>
                                      <div class="col-md-6 col-sm-6">
                                          <input type="text" readonly id="idHeader" name="idHeader" class="form-control" required placeholder="Nama Sub Menu" value="${idHeader}">
                                      </div>
                                      </div>
                                      <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="nmHeaderSubModal${i}">Sub Menu ${i} <span class="required">*</span></label>
                                      <div class="col-md-6 col-sm-6">
                                          <input type="text" id="nmHeaderSubModal${i}" name="nmHeaderSub${i}" class="form-control" required placeholder="Nama Sub Menu" value="${subMenusModal[i-1].trim()}">
                                      </div>
                                      </div>
                                      <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="localeSubModal${i}">Locale ${i}</label>
                                      <div class="col-md-6 col-sm-6">
                                          <select name="localeSub${i}" id="localeSubModal${i}" class="form-control">
                                              <option selected value="${localeSubModal}">${localeSubModal}</option>
                                          </select>
                                      </div>
                                      </div>
                                      <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="statusHeaderSubModal${i}">Status ${i}</label>
                                      <div class="col-md-6 col-sm-6">
                                          <select name="statusHeaderSub${i}" id="statusHeaderSubModal${i}" class="form-control">
                                              <option value="1">Active</option>
                                              <option value="0">Non Active</option>
                                          </select>
                                      </div>
                                      </div>
                                      <div class="item form-group">
                                      <label class="col-form-label col-md-3 col-sm-3 label-align">Action</label>
                                      <div class="col-md-6 col-sm-6">
                                          <a class="btn btn-danger" onclick="deleteSubMenu(${i}, ${idHeader})">Delete Sub Menu ${i}</a>
                                      </div>
                                      </div>
                                  `;
                                  headerSubModal.appendChild(subMenuGroupModal);
                              }
                          }
                          function deleteSubMenu(index, idHeader) {
                            const subMenuInput = document.getElementById(`nmHeaderSubModal${index}`);
                            if (subMenuInput) {
                                const subMenuName = subMenuInput.value;
                                console.log(`Deleting Sub Menu: ${subMenuName}`);
                                // Here, you can implement the actual delete logic, e.g., sending a request to the server or updating the UI.

                                // AJAX request to delete sub-menu in the backend
                                $.ajax({
                                    url: '<?php echo base_url('cms/home/deleteSiteSettingSubHeader') ?>', // Ganti dengan URL yang sesuai
                                    type: 'POST',
                                    data: {
                                        idHeader: idHeader,
                                        subMenuName: subMenuName // Kirim nama sub-menu atau data yang diperlukan ke server
                                    },
                                    success: function(response) {
                                        alert(`Sub Menu "${subMenuName}" deleted.`);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error:', error);
                                        alert('An error occurred while deleting the sub-menu.');
                                    }
                                });
                              }
                          } 
                      </script>
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
        </div>
      </div>
    </div>
  </div>
</div>