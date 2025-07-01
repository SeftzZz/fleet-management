<style type="text/css">
  a:hover {
    color: black;
  }
  @media only screen and (max-width: 720px) {
  #chat_view {
    width: 83vw;
  }
  .inbox-body {
    color: white;
    padding: 2px;
  }
  .replied-body {
    color: white;
    padding: 2px;
  }
}
.inbox-body {
  color: white;
  padding: 2px;
}
.replied-body {
  color: white;
  padding: 2px;
}
</style>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Chats</small>
            </h2>
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
          <?php
          if($this->session->userdata('dep') == 9) {
          ?>
          <div class="x_content">
            <div class="row">
              <div class="col-4 col-sm-4 col-md-4 mail_list_column">
                <div id="chat-container">
                  <!-- Chat messages will be displayed here -->
                </div>
              </div>
              <div class="col-4 col-sm-4 col-md-4 mail_list_column" style="background-color: #dedede;padding: 10px;">
                <div id="chat-container-business">
                  <!-- Chat messages will be displayed here -->
                </div>
              </div>
              <div class="col-4 col-sm-4 col-md-4 mail_list_column" style="background-color: #385645;padding: 10px;">
                <div id="chat_view" style="display: none;">
                </div>
              </div>
            </div>
          </div>
          <?php
          }
          ?>
          <?php
          if($this->session->userdata('dep') == 8) {
          ?>
          <div class="x_content">
            <div class="row">
              <div class="col-4 col-sm-4 col-md-4 mail_list_column">
                <div id="chat-container">
                  <!-- Chat messages will be displayed here -->
                </div>
              </div>
              <div class="col-4 col-sm-4 col-md-4 mail_list_column" style="background-color: #dedede;padding: 10px;">
                <div id="chat-container-business">
                  <!-- Chat messages will be displayed here -->
                </div>
              </div>
              <div class="col-4 col-sm-4 col-md-4 mail_list_column" style="background-color: #385645;padding: 10px;">
                <div id="chat_view" style="display: none;">
                </div>
              </div>
            </div>
          </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>