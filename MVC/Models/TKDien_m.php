<?php
class TKDien_m extends connectDB
{


    
    public function getMonthlyElectricityUsage($room_id = null, $month = null, $year = null, $maToa = null)
    {
        $sql = "SELECT
                    hdv.month,
                    hdv.year,
                    hdv.id_room,
                    hdv.maToa,
                    SUM((hdv.electricity - hdv.soDien) * dvd.price) AS tong_chi_phi_dien
                FROM
                    hoa_don_dich_vu hdv
                JOIN
                    dich_vu_dien_nuoc dvd ON dvd.id_service = 'Dien'
                WHERE 1=1";

       
        
        if($maToa){
            $sql .= " AND hdv.maToa = '$maToa'";
        }
        if ($room_id) {
            $sql .= " AND hdv.id_room = '$room_id'";
        }

        if ($month) {

            $sql .= "  AND hdv.month = '$month'   ";
        }
        if ($year) {

            $sql .= " AND hdv.year = '$year'";
        }
        

        $sql .= " GROUP BY  hdv.month, hdv.year";

        // if ($room_id) {
        //     $sql .= ", hdv.id_room";
        // }

        return mysqli_query($this->conn, $sql);
    }

    public function getid_room()
    {
        $sql = "SELECT maPhong FROM phong  ";
        return mysqli_query($this->conn, $sql);
    }

    public function get_all_toa()
    {
        $sql = "SELECT maToa FROM toa";
        
        return mysqli_query($this->conn, $sql);
    }
}
