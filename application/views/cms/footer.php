  <!-- jQuery -->
  <script src="<?php echo base_url() ?>/vendors/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url() ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() ?>/vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="<?php echo base_url() ?>/vendors/nprogress/nprogress.js"></script>
  <!-- Chart.js -->
  <script src="<?php echo base_url() ?>/vendors/Chart.js/dist/Chart.min.js"></script>
  <!-- gauge.js -->
  <script src="<?php echo base_url() ?>/vendors/gauge.js/dist/gauge.min.js"></script>
  <!-- bootstrap-progressbar -->
  <script src="<?php echo base_url() ?>/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url() ?>/vendors/iCheck/icheck.min.js"></script>
  <!-- Skycons -->
  <script src="<?php echo base_url() ?>/vendors/skycons/skycons.js"></script>
  <!-- Flot -->
  <script src="<?php echo base_url() ?>/vendors/Flot/jquery.flot.js"></script>
  <script src="<?php echo base_url() ?>/vendors/Flot/jquery.flot.pie.js"></script>
  <script src="<?php echo base_url() ?>/vendors/Flot/jquery.flot.time.js"></script>
  <script src="<?php echo base_url() ?>/vendors/Flot/jquery.flot.stack.js"></script>
  <script src="<?php echo base_url() ?>/vendors/Flot/jquery.flot.resize.js"></script>
  <!-- Flot plugins -->
  <script src="<?php echo base_url() ?>/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
  <script src="<?php echo base_url() ?>/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/flot.curvedlines/curvedLines.js"></script>
  <!-- DateJS -->
  <script src="<?php echo base_url() ?>/vendors/DateJS/build/date.js"></script>
  <!-- JQVMap -->
  <script src="<?php echo base_url() ?>/vendors/jqvmap/dist/jquery.vmap.js"></script>
  <script src="<?php echo base_url() ?>/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="<?php echo base_url() ?>/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="<?php echo base_url() ?>/vendors/moment/min/moment.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="<?php echo base_url() ?>/build/js/custom.min.js"></script>

  <!-- Datatables -->
  <script src="<?php echo base_url() ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="<?php echo base_url() ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/jszip/dist/jszip.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/pdfmake/build/vfs_fonts.js"></script>
  <!-- Dropzone.js -->
  <script src="<?php echo base_url() ?>/vendors/dropzone/dist/min/dropzone.min.js"></script>
  <!-- Sweetalert -->
  <script src="<?php echo base_url() ?>assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js"></script>
  <script src="<?php echo base_url() ?>vendors/fullcalendar/dist/fullcalendar.min.js"></script>
  <script src="<?php echo base_url() ?>vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
  <script src="https://www.forkalim.or.id/assets/ckeditor/ckeditor.js"></script>
  <!--CK EDITOR-->


  <!-- Link ke CSS Select2 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <!-- Link ke JS Select2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <audio id="notificationSound" src="<?php echo base_url('assets/audio/nadaorderan_n1nc1372.mp3'); ?>"></audio>
  <script>
    $(document).ready(function () {
        console.log("Sortable element:", $("#sortable")); // Debugging
        if ($("#sortable").length > 0) { // Pastikan elemen ada
            $("#sortable").sortable({
                update: function (event, ui) {
                    var order = [];
                    $("#sortable tr").each(function () {
                        var id = $(this).attr("id").split("_")[1];
                        order.push(id);
                    });

                    $.ajax({
                        url: "<?php echo base_url('cms/home/updateMenuOrder'); ?>",
                        type: "POST",
                        data: { order: order },
                        success: function (response) {
                            console.log(response);
                        },
                        error: function () {
                            alert("Gagal memperbarui urutan");
                        }
                    });
                }
            });
            $("#sortable").disableSelection();
        } else {
            console.error("Elemen #sortable tidak ditemukan!");
        }
    });
    function updateIsActive(idMenuType) {
        $.ajax({
            url: "<?php echo base_url('cms/home/updateIsActive'); ?>",
            type: "POST",
            data: { idMenuType: idMenuType },
            success: function(response) {
                console.log("Status isActive berhasil diperbarui.");
            },
            error: function(error) {
                console.error("Gagal memperbarui isActive:", error);
            }
        });
    }
  </script>
  <script>
    $(function () {
      CKEDITOR.replace(
        'cktextarea',{ 
          height: '400px',
          filebrowserBrowseUrl : 'https://www.forkalim.or.id/assets/ckeditor/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
          filebrowserUploadUrl : 'https://www.forkalim.or.id/assets/ckeditor/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
          filebrowserImageBrowseUrl : 'https://www.forkalim.or.id/assets/ckeditor/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
        }
      );
    })
  </script>
  <?php if ($this->session->flashdata('pesanerror')) { ?>
    <script language="javascript" type="text/javascript">
      window.onload = function(){
        Swal.fire({
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
      Swal.fire({
        title: "Success",
        text: "Berhasil",
        type: "success",
        confirmButtonText: null
      });
    </script>
  <?php } ?>
  <script type="text/javascript">
    /* AUTOCOMPLETE */
    function init_autocomplete_fnb() {
      if (typeof ($.fn.autocomplete) === 'undefined') { return; }
      console.log('init_autocomplete_fnb');
      var data = {
        <?php 
          $data = array();
          $this->db->from('fnb_menu');
          $query = $this->db->get();
          if ($query->num_rows() > 0)
          {
            foreach ($query->result() as $row)
            {
              $data[] = $row;
            }
          }
          $query->free_result();
        ?>
        <?php 
          foreach($data as $row) {
        ?>
        <?php echo $row->idMenu ?>: "<?php echo $row->nmMenu ?>",
        <?php } ?>
      };
      var dataArray = $.map(data, function (value, key) {
          return {
              value: value,
              data: key
          };
      });
      // initialize autocomplete with custom appendTo
      $('#autocomplete-custom-append-fnb').autocomplete({
          lookup: dataArray
      });
    };
    init_autocomplete_fnb();
  </script>
  
  <!-- <script src="https://www.gstatic.com/firebasejs/7.3.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.3.0/firebase-firestore.js"></script>
  <script type="text/javascript">
    // Initialize Firebase
    var config = {
      apiKey: "AIzaSyAoj4LEUsXjy_jbIA3qV1KJ2k-AXIPT2JQ",
      authDomain: "sahira-hotels.firebaseapp.com",
      projectId: "sahira-hotels",
      storageBucket: "sahira-hotels.appspot.com",
      messagingSenderId: "696853318422",
      appId: "1:696853318422:web:6c0d40b9cb82309a471e37",
      measurementId: "G-V601MGELKJ",
      vapidKey: "BLiwxCPXurhlDC0imZXp29yh8CGv9Gful419-cD47iP7YoWkwOSe0mZxJdDuGBjyevx5UYfl8SMue5NGJCyoysE"
    };
    firebase.initializeApp(config);
    const database = firebase.firestore();
    const chatsCollection = database.collection('chats');
  </script> -->
  <script type="text/javascript">
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('<?php echo base_url() ?>firebase-messaging-sw.js')
      .then(function(registration) {
        console.log('Service Worker registered successfully:', registration);
      });
    } else {
      console.warn('Service Worker is not supported in this browser');
    }
  </script>
  <script type="module">
    // import { initializeApp } from "https://www.gstatic.com/firebasejs/9.7.0/firebase-app.js";
    // import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/9.7.0/firebase-messaging.js";

    // // Konfigurasi Firebase
    // const firebaseConfig = {
    //   apiKey: "AIzaSyAoj4LEUsXjy_jbIA3qV1KJ2k-AXIPT2JQ",
    //   authDomain: "sahira-hotels.firebaseapp.com",
    //   projectId: "sahira-hotels",
    //   storageBucket: "sahira-hotels.appspot.com",
    //   messagingSenderId: "696853318422",
    //   appId: "1:696853318422:web:6c0d40b9cb82309a471e37",
    //   measurementId: "G-V601MGELKJ",
    //   vapidKey: "BLiwxCPXurhlDC0imZXp29yh8CGv9Gful419-cD47iP7YoWkwOSe0mZxJdDuGBjyevx5UYfl8SMue5NGJCyoysE",
    // };

    // // Inisialisasi Firebase
    // const firebaseApp = initializeApp(firebaseConfig);

    // // Dapatkan instance Messaging
    // const messaging = getMessaging(firebaseApp);

    // // Minta izin untuk notifikasi
    // Notification.requestPermission()
    //   .then((result) => {
    //     if (result === "granted") {
    //       console.log("Notification permission granted.");

    //       // Dapatkan token FCM
    //       getToken(messaging, { vapidKey: firebaseConfig.vapidKey })
    //         .then((tokenPushNotification) => {
    //           if (tokenPushNotification) {
    //             console.log("Token berhasil diperoleh:", tokenPushNotification);

    //             // Kirim token ke server
    //             $.ajax({
    //               url: "<?php echo base_url('cms/home/ajaxtokenPushNotification'); ?>",
    //               type: "POST",
    //               data: {
    //                 tokenPushNotification: tokenPushNotification,
    //                 idUser: "<?php echo $this->session->userdata('idUser'); ?>",
    //               },
    //               success: function () {
    //                 console.log("Token berhasil didaftarkan ke server.");
    //               },
    //               error: function (error) {
    //                 console.error("Gagal mendaftarkan token:", error);
    //               },
    //             });
    //           } else {
    //             console.log("Token FCM tidak tersedia.");
    //           }
    //         })
    //         .catch((err) => {
    //           console.error("Gagal mendapatkan token FCM:", err);
    //         });

    //       // Tangani pesan saat aplikasi aktif (foreground)
    //       onMessage(messaging, (payload) => {
    //         console.log("Pesan diterima di foreground:", payload);

    //         const { transaction, notification } = payload.data || {};

    //         switch (transaction) {
    //           case "reservation":
    //             handleReservation(notification, payload);
    //             break;
    //           case "fnb-room":
    //             handleFnbOrder(notification, payload, "Room Number");
    //             break;
    //           case "fnb-table":
    //             handleFnbOrder(notification, payload, "Table Number");
    //             break;
    //           case "payment":
    //             handlePayment(notification, payload);
    //             break;
    //           case "livechat":
    //             handleLiveChat();
    //             break;
    //           default:
    //             console.warn("Jenis transaksi tidak dikenal:", transaction);
    //         }
    //       });
    //     } else {
    //       console.warn("Izin notifikasi tidak diberikan.");
    //     }
    //   })
    //   .catch((err) => {
    //     console.error("Gagal meminta izin notifikasi:", err);
    //   });

    // Fungsi penanganan pesan berdasarkan jenis transaksi
    function handleReservation(notification, payload) {
      const arrayPayload = JSON.parse(payload.data.value);
      Swal.fire({
        title: `New Reservation<br>${notification.title} a/n ${arrayPayload.customerName}`,
        html: `<h4>Type Room: ${notification.body}</h4>
               <h5>Arrival: ${arrayPayload.arrivalDate} & Departure: ${arrayPayload.departureDate}</h5>`,
        icon: "info",
        confirmButtonText: "Close",
        willClose: () => location.reload(),
      });
    }
    function handleFnbOrder(notification, payload, typeLabel) {
      const audio = document.getElementById("notificationSound");
      // WebSocket terima pesan
      socket.onmessage = (event) => {
        const data = JSON.parse(event.data);
        audio.play();
        showNotification(data.title, data.body);
      };
      
      const arrayPayload = JSON.parse(payload.data.value);
      let menuItemsHTML = "";
      arrayPayload.forEach((menuItem) => {
        menuItemsHTML += `${menuItem.menuName}: ${menuItem.updatedQty}<br>-note:(${menuItem.optional})<br><br>`;
      });

      Swal.fire({
        title: "New Order",
        html: `<h4>${typeLabel}</h4>
               <h5>${menuItemsHTML}</h5>`,
        icon: "info",
        confirmButtonText: "Close",
        didOpen: () => {
          const audio = document.getElementById("notificationSound");

          if (audio) {
            audio.loop = true; // Looping suara

            // Coba langsung play audio
            audio.play()
              .then(() => {
                console.log("Audio berhasil diputar otomatis.");
              })
              .catch((error) => {
                console.warn("Audio gagal diputar otomatis, menunggu interaksi pengguna.");
              });
          }
        },
        willClose: () => {
          const audio = document.getElementById("notificationSound");

          if (audio) {
            audio.pause(); // Hentikan audio
            audio.currentTime = 0; // Reset ke awal
          }

          location.reload(); // Refresh halaman
        }
      });
    }
    function handlePayment(notification, payload) {
      Swal.fire({
        title: `New Payment<br>${notification.title}`,
        html: `<h4>Room Number: ${notification.body}</h4>
               <h5><a target="_blank" href="${payload.data.url}">Click here to see payment</a></h5>`,
        icon: "info",
        confirmButtonText: "Close",
        willClose: () => location.reload(),
      });
    }
    function getLatestTimestamp(history) {
      if (!history || history.length === 0) {
        return 0;
      }
      const timestamps = history
        .map(message => {
          // Assuming to_created_at is either a JavaScript Date object or a string representing a date
          if (typeof message.to_created_at === 'object' && message.to_created_at instanceof Date) {
            return message.to_created_at.getTime(); // Convert Date object to milliseconds
          } else if (typeof message.to_created_at === 'string') {
            return new Date(message.to_created_at).getTime(); // Convert date string to milliseconds
          } else {
            return null; // Handle invalid or undefined timestamps
          }
        })
        .filter(timestamp => timestamp !== null);
      if (timestamps.length === 0) {
        return 0;
      }
      return Math.max(...timestamps); // Return the maximum timestamp
    }
    function transformDate(timestamp) {
      const currentDate = new Date();
      const date = new Date(timestamp);
      const diffInDays = Math.floor((currentDate.getTime() - date.getTime()) / (1000 * 60 * 60 * 24));
      // const options: Intl.DateTimeFormatOptions = { hour: '2-digit', minute: '2-digit' };
      if (diffInDays === 0) {
        return `Today at ${date.toLocaleTimeString(undefined)}`;
      } else if (diffInDays === 1) {
        return `Yesterday at ${date.toLocaleTimeString(undefined)}`;
      } else if (diffInDays < 7) {
        return `${getDayName(date.getDay())} at ${date.toLocaleTimeString(undefined)}`;
      } else if (diffInDays < 30) {
        const weeks = Math.floor(diffInDays / 7);
        return `${weeks} week${weeks > 1 ? 's' : ''} ago`;
      } else if (diffInDays < 90) {
        const months = Math.floor(diffInDays / 30);
        return `${months} month${months > 1 ? 's' : ''} ago`;
      } else {
        return date.toLocaleDateString();
      }
    }
    function getDayName(dayIndex) {
      const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      return daysOfWeek[dayIndex];
    }

    const socket = new WebSocket('wss://cms.sahirahotelsgroup.com/ws');

    socket.onopen = function () {
      console.log("WebSocket connected");
    };

    // Global event listener dari server
    socket.onmessage = function(event) {
      console.log("Data dari server:", event.data);

      try {
        const data = JSON.parse(event.data);

        // Mainkan suara jika ada elemen audio
        const audio = document.getElementById("notificationSound");
        if (audio) audio.play();

        // Minta izin notifikasi
        if (Notification.permission !== "granted") {
          Notification.requestPermission();
        }

        // Tampilkan notifikasi browser
        if (Notification.permission === "granted") {
          new Notification(data.notification?.title || "Notifikasi", {
            body: data.notification?.body || "",
            icon: "/favicon.png"
          });
        }

        // Tentukan handler berdasarkan tipe
        switch (data.type) {
          case "reservation":
            handleReservation(data.notification, data.payload);
            break;
          case "fnb":
            handleFnbOrder(data.notification, data.payload, "F&B Order");
            break;
          case "payment":
            handlePayment(data.notification, data.payload);
            break;
          default:
            console.warn("Tipe notifikasi tidak dikenali:", data.type);
        }

      } catch (e) {
        console.error("Gagal parsing notifikasi:", e);
      }
    };

    socket.onerror = function(error) {
      console.error("WebSocket error:", error);
    };

    // Minta izin notifikasi saat halaman dimuat
    if (Notification.permission !== "granted") {
      Notification.requestPermission();
    }

  </script>
  <script type="text/javascript">
    (function($) {
      'use strict';

      // Mengambil nama folder dari input
      let folderName = '';
      
      // Konfigurasi Dropzone dengan jQuery
      console.log("Initializing Dropzone...");
      $('.folder > a').on('click', function(e) {
          e.preventDefault();
          $(this).parent().toggleClass('open');
      });
      
      $("#my-awesome-dropzone").dropzone({
        url: "<?php echo base_url('process-upload'); ?>",  // Gunakan PHP base_url untuk menentukan endpoint
        autoProcessQueue: false, // Jangan upload secara otomatis
        uploadMultiple: true, // Izinkan upload multiple files
        parallelUploads: 10, // Jumlah maksimum file yang di-upload bersamaan
        maxFiles: 1, // Maksimum file yang bisa di-upload
        acceptedFiles: 'image/*,.pdf,.docx,.txt', // Batasi tipe file
        addRemoveLinks: true, // Tampilkan link untuk menghapus file
        dictRemoveFile: "Remove", // Teks untuk remove link
        
        init: function() {
          var myDropzone = this;
          console.log("Dropzone initialized with config:", myDropzone.options);

          // Function to check file-name and uploaded file name
          function validateFileName(file) {
              const inputFileName = document.getElementById("file-name").value;
              const fileNameWithoutExtension = file.name.replace(/\.[^/.]+$/, "");

              if (inputFileName !== fileNameWithoutExtension) {
                  alert("Keterangan: Input nama file harus sama dengan file yang diunggah.");
                  return false;
              }
              return true;
          }

          // Menangani tombol submit untuk upload file
          $("#submit-all").on("click", function(e) {
              e.preventDefault();
              e.stopPropagation();

              // kode data
              const kodeUploads = document.getElementById('training-number').textContent;
              // Ambil nama folder yang dipilih
              const folderName = 'uploads';
              const fileName = $("#file-name").val().trim();

              // Tambahkan folderName ke formData setiap file
              myDropzone.on('sending', function(file, xhr, formData) {
                  formData.append('folderName', folderName); // Menambahkan folderName ke data
                  formData.append('kodeUploads', kodeUploads); // Menambahkan kodeUploads ke data
              });

              const files = myDropzone.getAcceptedFiles(); // Get all accepted files

              if (files.length === 0) {
                  alert("Keterangan: Tidak ada file yang diunggah.");
                  return;
              }

              // Validate file name
              const isValid = validateFileName(files[0]); // Assuming only one file due to maxFiles: 1
              if (!isValid) {
                  return; // Stop submission if the file name does not match
              }

              console.log("Submit button clicked. File name matches. Processing queue...");
              myDropzone.processQueue(); // Proses semua file
          });

          // Tambahkan informasi tambahan saat mengirimkan file
          myDropzone.on("sending", function(file, xhr, formData) {
            console.log("Sending file:", file.name);
            formData.append("someKey", "someValue"); // Data tambahan jika diperlukan
          });

          // Callback saat semua file berhasil di-upload
          myDropzone.on("successmultiple", function(files, response) {
            const res = JSON.parse(response);
            Swal.fire({
              title: "Success!",
              text: res.message,
              icon: "success",
              confirmButtonText: "Close"
            }).then((result) => {
              if (result.isConfirmed) {
                  location.reload(); // Reload halaman ketika tombol "Close" diklik
              }
            });
          });

          // Callback saat terjadi error selama upload
          myDropzone.on("errormultiple", function(files, response) {
            console.error("Upload failed for files:");
            files.forEach(file => console.error(file.name));
            console.error("Server response:", response);
          });

          // Log untuk file yang ditambahkan ke Dropzone
          myDropzone.on("addedfile", function(file) {
              console.log("File added:", file.name);

              // Remove the file extension from the file name
              const fileNameWithoutExtension = file.name.replace(/\.[^/.]+$/, "");

              // Set the processed file name to the #file-name input
              document.getElementById("file-name").value = fileNameWithoutExtension;
          });

          // Log saat file dihapus
          myDropzone.on("removedfile", function(file) {
            console.log("File removed:", file.name);

            // Clear the #file-name field when the file is removed
            document.getElementById("file-name").value = "";
          });
        }
      });
    })(jQuery);
  </script>
  <!-- Script untuk mengaktifkan Select2 dan tooltip -->
  <script>
    $(document).ready(function(){
      // Mengaktifkan Select2
      $('#category-select').select2();

      // Mengaktifkan tooltip untuk combo box
      $('#category-select').on('select2:open', function () {
        // Tooltip akan muncul saat elemen dibuka
        $('[title]').tooltip({ placement: 'top', trigger: 'hover' });
      });
    });
  </script>
  <script type="text/javascript">
    $(document).on('click', '.btn-submit-status', function () {
        const id = $(this).data('id');

        // Optional: konfirmasi dulu
        if (!confirm('Apakah Anda yakin ingin update status?')) return;

        // Kirim data ke backend
        $.ajax({
            url: '<?= base_url("your_controller/update_status") ?>', // ganti dengan URL update kamu
            type: 'POST',
            data: { id: id },
            success: function (response) {
                alert('Status berhasil diupdate!');
                // Bisa reload table atau refresh halaman
                location.reload();
            },
            error: function (xhr, status, error) {
                alert('Gagal update status');
                console.error(error);
            }
        });
    });
  </script>
</body>
</html>