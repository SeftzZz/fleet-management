<!-- page content -->
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <table class="table table-bordered">
      <thead>              
        <tr>
          <style type="text/css">
            body {
              background: #f7f7f7;
            }
          </style>
          <th>SEGMENT</th>
          <th>JANUARI</th>
          <th>FEBRUARI</th>
          <th>MARET</th>
          <th>APRIL</th>
          <th>MEI</th>
          <th>JUNI</th>
          <th>JULI</th>
          <th>AGUSTUS</th>
          <th>SEPTEMBER</th>
          <th>OKTOBER</th>
          <th>NOVEMBER</th>
          <th>DESEMBER</th>
        </tr>
      </thead>
      <tbody>
        <tr></tr>
        <tr>
          <td>FIT</td>
          <?php
            $fit = array();
            $this->db->from('budget');
            $this->db->where('nmSegment', 'FIT');
            $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $fit = $query->row();
            }
            $query->free_result();            
          ?>
          <td>
            <div class="input-group">
              <?php
                if(!$fit) {
              ?>
                <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
                  <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="text" name="janBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                } else {
              ?>
                <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateMonthlyBudget') ?>" class="form-horizontal form-label-left">
                <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="text" name="janBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->janBudget; ?>">
                  <input type="hidden" name="febBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->febBudget; ?>">
                  <input type="hidden" name="marBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->marBudget; ?>">
                  <input type="hidden" name="aprBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->aprBudget; ?>">
                  <input type="hidden" name="mayBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->mayBudget; ?>">
                  <input type="hidden" name="junBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->junBudget; ?>">
                  <input type="hidden" name="julBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->julBudget; ?>">
                  <input type="hidden" name="augBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->augBudget; ?>">
                  <input type="hidden" name="sepBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->sepBudget; ?>">
                  <input type="hidden" name="octBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->octBudget; ?>">
                  <input type="hidden" name="novBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->novBudget; ?>">
                  <input type="hidden" name="decBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->decBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                }
              ?>
            </div>
          </td>
          <td>
            <div class="input-group">
              <?php
                if(!$fit) {
              ?>
                <form id="form-type-feb" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
                  <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="text" name="febBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                } else {
              ?>
                <form id="form-type-feb" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateMonthlyBudget') ?>" class="form-horizontal form-label-left">
                <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="hidden" name="janBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->janBudget; ?>">
                  <input type="text" name="febBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->febBudget; ?>">
                  <input type="hidden" name="marBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->marBudget; ?>">
                  <input type="hidden" name="aprBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->aprBudget; ?>">
                  <input type="hidden" name="mayBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->mayBudget; ?>">
                  <input type="hidden" name="junBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->junBudget; ?>">
                  <input type="hidden" name="julBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->julBudget; ?>">
                  <input type="hidden" name="augBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->augBudget; ?>">
                  <input type="hidden" name="sepBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->sepBudget; ?>">
                  <input type="hidden" name="octBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->octBudget; ?>">
                  <input type="hidden" name="novBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->novBudget; ?>">
                  <input type="hidden" name="decBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->decBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                }
              ?>
            </div>
          </td>
          <td>
            <div class="input-group">
              <?php
                if(!$fit) {
              ?>
                <form id="form-type-mar" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
                  <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="text" name="marBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                } else {
              ?>
                <form id="form-type-mar" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateMonthlyBudget') ?>" class="form-horizontal form-label-left">
                <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="hidden" name="janBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->janBudget; ?>">
                  <input type="hidden" name="febBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->febBudget; ?>">
                  <input type="text" name="marBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->marBudget; ?>">
                  <input type="hidden" name="aprBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->aprBudget; ?>">
                  <input type="hidden" name="mayBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->mayBudget; ?>">
                  <input type="hidden" name="junBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->junBudget; ?>">
                  <input type="hidden" name="julBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->julBudget; ?>">
                  <input type="hidden" name="augBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->augBudget; ?>">
                  <input type="hidden" name="sepBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->sepBudget; ?>">
                  <input type="hidden" name="octBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->octBudget; ?>">
                  <input type="hidden" name="novBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->novBudget; ?>">
                  <input type="hidden" name="decBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->decBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                }
              ?>
            </div>
          </td>
          <td>
            <div class="input-group">
              <?php
                if(!$fit) {
              ?>
                <form id="form-type-apr" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
                  <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="text" name="aprBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                } else {
              ?>
                <form id="form-type-apr" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateMonthlyBudget') ?>" class="form-horizontal form-label-left">
                <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="hidden" name="janBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->janBudget; ?>">
                  <input type="hidden" name="febBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->febBudget; ?>">
                  <input type="hidden" name="marBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->marBudget; ?>">
                  <input type="text" name="aprBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->aprBudget; ?>">
                  <input type="hidden" name="mayBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->mayBudget; ?>">
                  <input type="hidden" name="junBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->junBudget; ?>">
                  <input type="hidden" name="julBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->julBudget; ?>">
                  <input type="hidden" name="augBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->augBudget; ?>">
                  <input type="hidden" name="sepBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->sepBudget; ?>">
                  <input type="hidden" name="octBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->octBudget; ?>">
                  <input type="hidden" name="novBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->novBudget; ?>">
                  <input type="hidden" name="decBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->decBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                }
              ?>
            </div>
          </td>
          <td>
            <div class="input-group">
              <?php
                if(!$fit) {
              ?>
                <form id="form-type-may" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
                  <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="text" name="mayBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                } else {
              ?>
                <form id="form-type-may" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateMonthlyBudget') ?>" class="form-horizontal form-label-left">
                <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="hidden" name="janBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->janBudget; ?>">
                  <input type="hidden" name="febBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->febBudget; ?>">
                  <input type="hidden" name="marBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->marBudget; ?>">
                  <input type="hidden" name="aprBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->aprBudget; ?>">
                  <input type="text" name="mayBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->mayBudget; ?>">
                  <input type="hidden" name="junBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->junBudget; ?>">
                  <input type="hidden" name="julBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->julBudget; ?>">
                  <input type="hidden" name="augBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->augBudget; ?>">
                  <input type="hidden" name="sepBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->sepBudget; ?>">
                  <input type="hidden" name="octBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->octBudget; ?>">
                  <input type="hidden" name="novBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->novBudget; ?>">
                  <input type="hidden" name="decBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->decBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                }
              ?>
            </div>
          </td>
          <td>
            <div class="input-group">
              <?php
                if(!$fit) {
              ?>
                <form id="form-type-jun" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
                  <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="text" name="junBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                } else {
              ?>
                <form id="form-type-jun" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateMonthlyBudget') ?>" class="form-horizontal form-label-left">
                <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="hidden" name="janBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->janBudget; ?>">
                  <input type="hidden" name="febBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->febBudget; ?>">
                  <input type="hidden" name="marBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->marBudget; ?>">
                  <input type="hidden" name="aprBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->aprBudget; ?>">
                  <input type="hidden" name="mayBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->mayBudget; ?>">
                  <input type="text" name="junBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->junBudget; ?>">
                  <input type="hidden" name="julBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->julBudget; ?>">
                  <input type="hidden" name="augBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->augBudget; ?>">
                  <input type="hidden" name="sepBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->sepBudget; ?>">
                  <input type="hidden" name="octBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->octBudget; ?>">
                  <input type="hidden" name="novBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->novBudget; ?>">
                  <input type="hidden" name="decBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->decBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                }
              ?>
            </div>
          </td>
          <td>
            <div class="input-group">
              <?php
                if(!$fit) {
              ?>
                <form id="form-type-jul" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
                  <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="text" name="julBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                } else {
              ?>
                <form id="form-type-jul" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateMonthlyBudget') ?>" class="form-horizontal form-label-left">
                <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="hidden" name="janBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->janBudget; ?>">
                  <input type="hidden" name="febBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->febBudget; ?>">
                  <input type="hidden" name="marBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->marBudget; ?>">
                  <input type="hidden" name="aprBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->aprBudget; ?>">
                  <input type="hidden" name="mayBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->mayBudget; ?>">
                  <input type="hidden" name="junBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->junBudget; ?>">
                  <input type="text" name="julBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->julBudget; ?>">
                  <input type="hidden" name="augBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->augBudget; ?>">
                  <input type="hidden" name="sepBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->sepBudget; ?>">
                  <input type="hidden" name="octBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->octBudget; ?>">
                  <input type="hidden" name="novBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->novBudget; ?>">
                  <input type="hidden" name="decBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->decBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                }
              ?>
            </div>
          </td>
          <td>
            <div class="input-group">
              <?php
                if(!$fit) {
              ?>
                <form id="form-type-aug" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
                  <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="text" name="augBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                } else {
              ?>
                <form id="form-type-aug" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateMonthlyBudget') ?>" class="form-horizontal form-label-left">
                <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="hidden" name="janBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->janBudget; ?>">
                  <input type="hidden" name="febBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->febBudget; ?>">
                  <input type="hidden" name="marBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->marBudget; ?>">
                  <input type="hidden" name="aprBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->aprBudget; ?>">
                  <input type="hidden" name="mayBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->mayBudget; ?>">
                  <input type="hidden" name="junBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->junBudget; ?>">
                  <input type="hidden" name="julBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->julBudget; ?>">
                  <input type="text" name="augBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->augBudget; ?>">
                  <input type="hidden" name="sepBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->sepBudget; ?>">
                  <input type="hidden" name="octBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->octBudget; ?>">
                  <input type="hidden" name="novBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->novBudget; ?>">
                  <input type="hidden" name="decBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->decBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                }
              ?>
            </div>
          </td>
          <td>
            <div class="input-group">
              <?php
                if(!$fit) {
              ?>
                <form id="form-type-sep" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
                  <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="text" name="sepBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                } else {
              ?>
                <form id="form-type-sep" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateMonthlyBudget') ?>" class="form-horizontal form-label-left">
                <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="hidden" name="janBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->janBudget; ?>">
                  <input type="hidden" name="febBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->febBudget; ?>">
                  <input type="hidden" name="marBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->marBudget; ?>">
                  <input type="hidden" name="aprBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->aprBudget; ?>">
                  <input type="hidden" name="mayBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->mayBudget; ?>">
                  <input type="hidden" name="junBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->junBudget; ?>">
                  <input type="hidden" name="julBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->julBudget; ?>">
                  <input type="hidden" name="augBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->augBudget; ?>">
                  <input type="text" name="sepBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->sepBudget; ?>">
                  <input type="hidden" name="octBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->octBudget; ?>">
                  <input type="hidden" name="novBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->novBudget; ?>">
                  <input type="hidden" name="decBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->decBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                }
              ?>
            </div>
          </td>
          <td>
            <div class="input-group">
              <?php
                if(!$fit) {
              ?>
                <form id="form-type-oct" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
                  <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="text" name="octBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                } else {
              ?>
                <form id="form-type-oct" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateMonthlyBudget') ?>" class="form-horizontal form-label-left">
                <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="hidden" name="janBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->janBudget; ?>">
                  <input type="hidden" name="febBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->febBudget; ?>">
                  <input type="hidden" name="marBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->marBudget; ?>">
                  <input type="hidden" name="aprBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->aprBudget; ?>">
                  <input type="hidden" name="mayBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->mayBudget; ?>">
                  <input type="hidden" name="junBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->junBudget; ?>">
                  <input type="hidden" name="julBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->julBudget; ?>">
                  <input type="hidden" name="augBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->augBudget; ?>">
                  <input type="hidden" name="sepBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->sepBudget; ?>">
                  <input type="text" name="octBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->octBudget; ?>">
                  <input type="hidden" name="novBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->novBudget; ?>">
                  <input type="hidden" name="decBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->decBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                }
              ?>
            </div>
          </td>
          <td>
            <div class="input-group">
              <?php
                if(!$fit) {
              ?>
                <form id="form-type-nov" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
                  <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="text" name="novBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                } else {
              ?>
                <form id="form-type-nov" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateMonthlyBudget') ?>" class="form-horizontal form-label-left">
                <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="hidden" name="janBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->janBudget; ?>">
                  <input type="hidden" name="febBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->febBudget; ?>">
                  <input type="hidden" name="marBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->marBudget; ?>">
                  <input type="hidden" name="aprBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->aprBudget; ?>">
                  <input type="hidden" name="mayBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->mayBudget; ?>">
                  <input type="hidden" name="junBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->junBudget; ?>">
                  <input type="hidden" name="julBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->julBudget; ?>">
                  <input type="hidden" name="augBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->augBudget; ?>">
                  <input type="hidden" name="sepBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->sepBudget; ?>">
                  <input type="hidden" name="octBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->octBudget; ?>">
                  <input type="text" name="novBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->novBudget; ?>">
                  <input type="hidden" name="decBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->decBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                }
              ?>
            </div>
          </td>
          <td>
            <div class="input-group">
              <?php
                if(!$fit) {
              ?>
                <form id="form-type-dec" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
                  <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="text" name="decBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                } else {
              ?>
                <form id="form-type-dec" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/updateMonthlyBudget') ?>" class="form-horizontal form-label-left">
                <input type="hidden" name="segmentBudget" value="FIT">
                  <input type="hidden" name="janBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->janBudget; ?>">
                  <input type="hidden" name="febBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->febBudget; ?>">
                  <input type="hidden" name="marBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->marBudget; ?>">
                  <input type="hidden" name="aprBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->aprBudget; ?>">
                  <input type="hidden" name="mayBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->mayBudget; ?>">
                  <input type="hidden" name="junBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->junBudget; ?>">
                  <input type="hidden" name="julBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->julBudget; ?>">
                  <input type="hidden" name="augBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->augBudget; ?>">
                  <input type="hidden" name="sepBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->sepBudget; ?>">
                  <input type="hidden" name="octBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->octBudget; ?>">
                  <input type="hidden" name="novBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->novBudget; ?>">
                  <input type="text" name="decBudget" style="width: 20vh;" class="form-control" value="<?php echo $fit->decBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                </form>
              <?php
                }
              ?>
            </div>
          </td>
        </tr>
        <tr>
          <td>HOTEL PACKAGE</td>
          <?php
            $hp = array();
            $this->db->from('budget');
            $this->db->where('nmSegment', 'HP');
            $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $hp = $query->row();
            }
            $query->free_result();            
          ?>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="HP">
              <div class="input-group">
                <?php
                  if(!$hp) {
                ?>
                  <input type="text" name="janBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="janBudget" style="width: 20vh;" class="form-control" value="<?php echo $hp->janBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="HP">
              <div class="input-group">
                <?php
                  if(!$hp) {
                ?>
                  <input type="text" name="febBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="febBudget" style="width: 20vh;" class="form-control" value="<?php echo $hp->febBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="HP">
              <div class="input-group">
                <?php
                  if(!$hp) {
                ?>
                  <input type="text" name="marBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="marBudget" style="width: 20vh;" class="form-control" value="<?php echo $hp->marBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="HP">
              <div class="input-group">
                <?php
                  if(!$hp) {
                ?>
                  <input type="text" name="aprBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="aprBudget" style="width: 20vh;" class="form-control" value="<?php echo $hp->aprBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="HP">
              <div class="input-group">
                <?php
                  if(!$hp) {
                ?>
                  <input type="text" name="mayBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="mayBudget" style="width: 20vh;" class="form-control" value="<?php echo $hp->mayBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="HP">
              <div class="input-group">
                <?php
                  if(!$hp) {
                ?>
                  <input type="text" name="junBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="junBudget" style="width: 20vh;" class="form-control" value="<?php echo $hp->junBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="HP">
              <div class="input-group">
                <?php
                  if(!$hp) {
                ?>
                  <input type="text" name="julBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="julBudget" style="width: 20vh;" class="form-control" value="<?php echo $hp->julBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="HP">
              <div class="input-group">
                <?php
                  if(!$hp) {
                ?>
                  <input type="text" name="augBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="augBudget" style="width: 20vh;" class="form-control" value="<?php echo $hp->augBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="HP">
              <div class="input-group">
                <?php
                  if(!$hp) {
                ?>
                  <input type="text" name="sepBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="sepBudget" style="width: 20vh;" class="form-control" value="<?php echo $hp->sepBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="HP">
              <div class="input-group">
                <?php
                  if(!$hp) {
                ?>
                  <input type="text" name="octBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="octBudget" style="width: 20vh;" class="form-control" value="<?php echo $hp->octBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="HP">
              <div class="input-group">
                <?php
                  if(!$hp) {
                ?>
                  <input type="text" name="novBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="novBudget" style="width: 20vh;" class="form-control" value="<?php echo $hp->novBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="HP">
              <div class="input-group">
                <?php
                  if(!$hp) {
                ?>
                  <input type="text" name="decBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="decBudget" style="width: 20vh;" class="form-control" value="<?php echo $hp->decBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
        </tr>
        <tr>
          <td>OTA</td>
          <?php
            $ota = array();
            $this->db->from('budget');
            $this->db->where('nmSegment', 'OTA');
            $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $ota = $query->row();
            }
            $query->free_result();            
          ?>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="OTA">
              <div class="input-group">
                <?php
                  if(!$ota) {
                ?>
                  <input type="text" name="janBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="janBudget" style="width: 20vh;" class="form-control" value="<?php echo $ota->janBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="OTA">
              <div class="input-group">
                <?php
                  if(!$ota) {
                ?>
                  <input type="text" name="febBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="febBudget" style="width: 20vh;" class="form-control" value="<?php echo $ota->febBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="OTA">
              <div class="input-group">
                <?php
                  if(!$ota) {
                ?>
                  <input type="text" name="marBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="marBudget" style="width: 20vh;" class="form-control" value="<?php echo $ota->marBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="OTA">
              <div class="input-group">
                <?php
                  if(!$ota) {
                ?>
                  <input type="text" name="aprBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="aprBudget" style="width: 20vh;" class="form-control" value="<?php echo $ota->aprBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="OTA">
              <div class="input-group">
                <?php
                  if(!$ota) {
                ?>
                  <input type="text" name="mayBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="mayBudget" style="width: 20vh;" class="form-control" value="<?php echo $ota->mayBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="OTA">
              <div class="input-group">
                <?php
                  if(!$ota) {
                ?>
                  <input type="text" name="junBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="junBudget" style="width: 20vh;" class="form-control" value="<?php echo $ota->junBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="OTA">
              <div class="input-group">
                <?php
                  if(!$ota) {
                ?>
                  <input type="text" name="julBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="julBudget" style="width: 20vh;" class="form-control" value="<?php echo $ota->julBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="OTA">
              <div class="input-group">
                <?php
                  if(!$ota) {
                ?>
                  <input type="text" name="augBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="augBudget" style="width: 20vh;" class="form-control" value="<?php echo $ota->augBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="OTA">
              <div class="input-group">
                <?php
                  if(!$ota) {
                ?>
                  <input type="text" name="sepBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="sepBudget" style="width: 20vh;" class="form-control" value="<?php echo $ota->sepBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="OTA">
              <div class="input-group">
                <?php
                  if(!$ota) {
                ?>
                  <input type="text" name="octBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="octBudget" style="width: 20vh;" class="form-control" value="<?php echo $ota->octBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="OTA">
              <div class="input-group">
                <?php
                  if(!$ota) {
                ?>
                  <input type="text" name="novBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="novBudget" style="width: 20vh;" class="form-control" value="<?php echo $ota->novBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="OTA">
              <div class="input-group">
                <?php
                  if(!$ota) {
                ?>
                  <input type="text" name="decBudget" style="width: 20vh;" class="form-control" value="0">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  } else {
                ?>
                  <input type="text" name="decBudget" style="width: 20vh;" class="form-control" value="<?php echo $ota->decBudget; ?>">
                  <span class="input-group-btn">
                    <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                  </span>
                <?php
                  }
                ?>
              </div>
            </form>
          </td>
        </tr>
        <tr>
          <td>TRAVEL AGENT</td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="4">
              <div class="input-group">
                <input type="text" name="janBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="4">
              <div class="input-group">
                <input type="text" name="febBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="4">
              <div class="input-group">
                <input type="text" name="marBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="4">
              <div class="input-group">
                <input type="text" name="aprBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="4">
              <div class="input-group">
                <input type="text" name="mayBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="4">
              <div class="input-group">
                <input type="text" name="junBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="4">
              <div class="input-group">
                <input type="text" name="julBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="4">
              <div class="input-group">
                <input type="text" name="augBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="4">
              <div class="input-group">
                <input type="text" name="sepBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="4">
              <div class="input-group">
                <input type="text" name="octBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="4">
              <div class="input-group">
                <input type="text" name="novBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="4">
              <div class="input-group">
                <input type="text" name="decBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
        </tr>
        <tr>
          <td>WEBSITE</td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="5">
              <div class="input-group">
                <input type="text" name="janBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="5">
              <div class="input-group">
                <input type="text" name="febBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="5">
              <div class="input-group">
                <input type="text" name="marBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="5">
              <div class="input-group">
                <input type="text" name="aprBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="5">
              <div class="input-group">
                <input type="text" name="mayBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="5">
              <div class="input-group">
                <input type="text" name="junBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="5">
              <div class="input-group">
                <input type="text" name="julBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="5">
              <div class="input-group">
                <input type="text" name="augBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="5">
              <div class="input-group">
                <input type="text" name="sepBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="5">
              <div class="input-group">
                <input type="text" name="octBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="5">
              <div class="input-group">
                <input type="text" name="novBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="5">
              <div class="input-group">
                <input type="text" name="decBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
        </tr>
        <tr>
          <td>MICE</td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="6">
              <div class="input-group">
                <input type="text" name="janBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="6">
              <div class="input-group">
                <input type="text" name="febBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="6">
              <div class="input-group">
                <input type="text" name="marBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="6">
              <div class="input-group">
                <input type="text" name="aprBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="6">
              <div class="input-group">
                <input type="text" name="mayBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="6">
              <div class="input-group">
                <input type="text" name="junBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="6">
              <div class="input-group">
                <input type="text" name="julBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="6">
              <div class="input-group">
                <input type="text" name="augBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="6">
              <div class="input-group">
                <input type="text" name="sepBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="6">
              <div class="input-group">
                <input type="text" name="octBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="6">
              <div class="input-group">
                <input type="text" name="novBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="6">
              <div class="input-group">
                <input type="text" name="decBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
        </tr>
        <tr>
          <td>WEDDING</td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="7">
              <div class="input-group">
                <input type="text" name="janBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="7">
              <div class="input-group">
                <input type="text" name="febBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="7">
              <div class="input-group">
                <input type="text" name="marBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="7">
              <div class="input-group">
                <input type="text" name="aprBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="7">
              <div class="input-group">
                <input type="text" name="mayBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="7">
              <div class="input-group">
                <input type="text" name="junBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="7">
              <div class="input-group">
                <input type="text" name="julBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="7">
              <div class="input-group">
                <input type="text" name="augBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="7">
              <div class="input-group">
                <input type="text" name="sepBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="7">
              <div class="input-group">
                <input type="text" name="octBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="7">
              <div class="input-group">
                <input type="text" name="novBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="7">
              <div class="input-group">
                <input type="text" name="decBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
        </tr>
        <tr>
          <td>SOCIAL EVENT</td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="8">
              <div class="input-group">
                <input type="text" name="janBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="8">
              <div class="input-group">
                <input type="text" name="febBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="8">
              <div class="input-group">
                <input type="text" name="marBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="8">
              <div class="input-group">
                <input type="text" name="aprBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="8">
              <div class="input-group">
                <input type="text" name="mayBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="8">
              <div class="input-group">
                <input type="text" name="junBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="8">
              <div class="input-group">
                <input type="text" name="julBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="8">
              <div class="input-group">
                <input type="text" name="augBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="8">
              <div class="input-group">
                <input type="text" name="sepBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="8">
              <div class="input-group">
                <input type="text" name="octBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="8">
              <div class="input-group">
                <input type="text" name="novBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="8">
              <div class="input-group">
                <input type="text" name="decBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
        </tr>
        <tr>
          <td>EXTRA BED</td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="9">
              <div class="input-group">
                <input type="text" name="janBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="9">
              <div class="input-group">
                <input type="text" name="febBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="9">
              <div class="input-group">
                <input type="text" name="marBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="9">
              <div class="input-group">
                <input type="text" name="aprBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="9">
              <div class="input-group">
                <input type="text" name="mayBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="9">
              <div class="input-group">
                <input type="text" name="junBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="9">
              <div class="input-group">
                <input type="text" name="julBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="9">
              <div class="input-group">
                <input type="text" name="augBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="9">
              <div class="input-group">
                <input type="text" name="sepBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="9">
              <div class="input-group">
                <input type="text" name="octBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="9">
              <div class="input-group">
                <input type="text" name="novBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="9">
              <div class="input-group">
                <input type="text" name="decBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
        </tr>
        <tr>
          <td>OTHER ROOM REVENUE</td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="10">
              <div class="input-group">
                <input type="text" name="janBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="10">
              <div class="input-group">
                <input type="text" name="febBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="10">
              <div class="input-group">
                <input type="text" name="marBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="10">
              <div class="input-group">
                <input type="text" name="aprBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="10">
              <div class="input-group">
                <input type="text" name="mayBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="10">
              <div class="input-group">
                <input type="text" name="junBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="10">
              <div class="input-group">
                <input type="text" name="julBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="10">
              <div class="input-group">
                <input type="text" name="augBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="10">
              <div class="input-group">
                <input type="text" name="sepBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="10">
              <div class="input-group">
                <input type="text" name="octBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="10">
              <div class="input-group">
                <input type="text" name="novBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="10">
              <div class="input-group">
                <input type="text" name="decBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
        </tr>
        <tr>
          <td><strong>TOTAL BUDGET</strong></td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="FIT">
              <div class="input-group">
                <input type="text" name="janBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="HP">
              <div class="input-group">
                <input type="text" name="febBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="OTA">
              <div class="input-group">
                <input type="text" name="marBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="4">
              <div class="input-group">
                <input type="text" name="aprBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="5">
              <div class="input-group">
                <input type="text" name="mayBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="6">
              <div class="input-group">
                <input type="text" name="junBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="7">
              <div class="input-group">
                <input type="text" name="julBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="8">
              <div class="input-group">
                <input type="text" name="augBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="9">
              <div class="input-group">
                <input type="text" name="sepBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="10">
              <div class="input-group">
                <input type="text" name="octBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="11">
              <div class="input-group">
                <input type="text" name="novBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
          <td>
            <form id="form-type-januari" method="post" title="starter-plan" enctype="multipart/form-data" action="<?php echo base_url('cms/home/insertMonthlyBudget') ?>" class="form-horizontal form-label-left">
              <input type="hidden" name="segmentBudget" value="12">
              <div class="input-group">
                <input type="text" name="decBudget" style="width: 20vh;" class="form-control">
                <span class="input-group-btn">
                  <input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="save">
                </span>
              </div>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
</div>
<!-- /page content -->