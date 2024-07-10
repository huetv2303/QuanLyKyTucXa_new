<?php
class TKNuoc_m extends connectDB
{


    
    public function getMonthlyWaterUsage($room_id = null, $month = null, $year = null, $maToa = null)
    {
        $sql = "SELECT
                    hdv.month,
                    hdv.year,
                    hdv.id_room,
                    hdv.maToa,
                    SUM((hdv.water - hdv.KhoiNuoc) * dvn.price) AS tong_chi_phi_nuoc
                FROM
                    hoa_don_dich_vu hdv
                JOIN
                    dich_vu_dien_nuoc dvn ON dvn.id_service = 'Nuoc'
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

    // public function getid_room()
    // {
    //     $sql = "SELECT maPhong FROM phong  ";
    //     return mysqli_query($this->conn, $sql);
    // }

    // public function get_all_toa()
    // {
    //     $sql = "SELECT maToa FROM toa";
        
    //     return mysqli_query($this->conn, $sql);
    // }

    public function hopdong_idP()
    {
        $sql = "SELECT maPhong FROM hopdong";
        return mysqli_query($this->conn, $sql);
    }

    public function get_phong_by_toa_hopdong($maToa)
    {
        $sql = "SELECT maPhong FROM hopdong WHERE maToa = '$maToa'";
        return mysqli_query($this->conn, $sql);
    }

    public function get_all_toa_hopdong()
    {
        $sql = "SELECT maToa FROM toa";
        return mysqli_query($this->conn, $sql);
    }

}
