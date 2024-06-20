<?php
class TKNuoc_m extends connectDB
{

    public function getMonthlyWaterUsage($room_id)
    {
        $sql = "SELECT
                    hdv.id_room,
                    DATE_FORMAT(created_day, '%Y-%m') AS month,
                    SUM(hdv.water * dvn.price) AS tong_chi_phi_nuoc
                FROM
                    hoa_don_dich_vu hdv
                JOIN
                    dich_vu_dien_nuoc dvn ON dvn.id_service = 'Nuoc'
                WHERE
                    hdv.id_room LIKE '%$room_id%'
                GROUP BY
                    month";

        return  mysqli_query($this->conn, $sql);
    }

    public function getid_room()
    {
        $sql = "SELECT id_room FROM phong_ky_tuc_xa";
        return mysqli_query($this->conn, $sql);
    }
}
