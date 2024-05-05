<?php

class Portfolio extends Controller
{
   function portfolio($data)
   {
      $port['saldo'] = 0;
      $port['fee_dc'] = 0;
      $port['fee_dw'] = 0;
      if (isset($_SESSION['log'])) {
         if (isset($data['port_id'])) {
            $port['saldo'] = $this->db(0)->get_cols_where("balance", "SUM(amount) as amount", "user_id = '" . $data['user_id'] . "' AND balance_type = 10 AND flow = 2 AND ref = '" . $data['port_id'] . "' AND tr_status <> 2", 0)['amount'];
            $port['fee_dc'] = $this->db(0)->get_cols_where("daily_checkin", "SUM(fee) as amount", "user_id = '" . $data['user_id'] . "' AND ref = '" . $data['port_id'] . "'", 0)['amount'];
            $port['fee_dw'] = $this->db(0)->get_cols_where("daily_watch", "SUM(fee) as amount", "user_id = '" . $data['user_id'] . "' AND ref = '" . $data['port_id'] . "'", 0)['amount'];
         }
      }
      $port['data'] = $data;
      return $port;
   }


   function daily_checkin_today($data) // portfolio data
   {
      $c = [];

      $hari_ini = date("Y-m-d");
      if (isset($data['data']['port_id'])) {
         $c = $this->db(0)->get_where_row("daily_checkin", "ref = '" . $data['data']['port_id'] . "' AND insertTime LIKE '%" . $hari_ini . "%'");
      }
      return $c;
   }

   function daily_watch_today($data) // portfolio data
   {
      $c = [];
      if (isset($_SESSION['log'])) {
         $hari_ini = date("Y-m-d");
         $c = [];
         if (isset($data['data']['port_id'])) {
            $c = $this->db(0)->get_where("daily_watch", "ref = '" . $data['data']['port_id'] . "' AND insertTime LIKE '%" . $hari_ini . "%'");
         }
      }
      return $c;
   }

   function cek_expired($expired_date)
   {
      $hari_ini = date("Y-m-d");
      $start_date = new DateTime($hari_ini);
      $end_date = $start_date->diff(new DateTime($expired_date));
      if ($end_date->days > 0) {
         return 1;
      } else {
         return 0;
      }
   }

   function close($data)
   {
      $msg = "";
      $up = $this->db(0)->update("portfolio", "port_status = 1, done_date = '" . $GLOBALS['now'] . "'", "user_id = '" . $data['data']['user_id'] . "' AND port_id = '" . $data['data']['port_id'] . "'");
      if ($up['errno'] == 0) {
         $cols = "flow, balance_type, user_id, ref, amount, tr_status, insertTime";
         $vals = "1,10,'" . $data['data']['user_id'] . "','" . $data['data']['port_id'] . "'," . $data['saldo'] + $data['fee_dc'] + $data['fee_dw'] . ",1,'" . $GLOBALS['now'] . "'";
         $in = $this->db(0)->insertCols("balance", $cols, $vals);
         if ($in['errno'] <> 0) {
            $up = $this->db(0)->update("portfolio", "port_status = 0, done_date = ''", "user_id = '" . $data['data']['user_id'] . "' AND port_id = '" . $data['data']['level'] . "'");
            $this->model('Log')->write($in['error']);
            $msg = "Error transfer portfolio to main balance";
         }
      } else {
         $this->model('Log')->write($up['error']);
         $msg = "Error portfolio update to closed";
      }

      return $msg;
   }
}
