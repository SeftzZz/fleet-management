<?php
function doku_log($class, $log_msg, $invoice_number = '')
{
  $log_filename = "doku_log";
  $log_header = date(DATE_ATOM, time()) . ' ' . 'Data ' . '---> ' . $invoice_number . " : ";
  if (!file_exists($log_filename)) {
    // create directory/folder uploads.
    mkdir($log_filename, 0777, true);
  }
  $log_file_data = $log_filename . '/log_' . date('d-M-Y') . '.log';
  // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
  file_put_contents($log_file_data, $log_header . $log_msg . "\n", FILE_APPEND);
}
