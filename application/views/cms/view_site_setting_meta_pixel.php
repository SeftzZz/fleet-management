<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>List Data Meta Pixel</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="collapse-link">
                  <i class="fa fa-chevron-up" style="color: red;"></i>
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
          <div class="x_content">
            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
              <li class="nav-item active">
                <a class="nav-link active" id="page-wiew-tab" data-toggle="tab" href="#page-wiew" role="tab" aria-controls="page-wiew" aria-selected="true">Page view</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="add-to-cart-tab" data-toggle="tab" href="#add-to-cart" role="tab" aria-controls="add-to-cart" aria-selected="true">Add to cart</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="purchase-tab" data-toggle="tab" href="#purchase" role="tab" aria-controls="purchase" aria-selected="true">Transactions</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade active in" id="page-wiew" role="tabpanel" aria-labelledby="page-wiew-tab">
                <!-- Diagram Data ADP FIT ACCUMULATION -->
                <div id="chart_plot_meta_pixel" class="demo-placeholder"></div>

                <!-- Tabel untuk menampilkan data dari ajaxMetPixelCart -->
                <table id="meta_pixel_table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Start Time</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari AJAX akan ditampilkan di sini -->
                    </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="add-to-cart" role="tabpanel" aria-labelledby="add-to-cart-tab">
                <!-- Diagram Data ADP FIT ACCUMULATION -->
                <div id="chart_plot_meta_pixel_cart" class="demo-placeholder"></div>

                <!-- Tabel untuk menampilkan data dari ajaxMetPixelCart -->
                <table id="meta_pixel_cart_table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Start Time</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari AJAX akan ditampilkan di sini -->
                    </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="purchase" role="tabpanel" aria-labelledby="purchase-tab">
                <!-- Diagram Data ADP FIT ACCUMULATION -->
                <div id="chart_plot_meta_pixel_purchase" class="demo-placeholder"></div>

                <!-- Tabel untuk menampilkan data dari ajaxMetPixelpurchase -->
                <table id="meta_pixel_purchase_table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Start Time</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari AJAX akan ditampilkan di sini -->
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