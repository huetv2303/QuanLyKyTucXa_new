<?php
class TKNuoc_m extends connectDB
{
    public function getMonthlyWaterUsage($room_id, $month = null)
    {
        $sql = "SELECT
                    hdv.id_room,
                    -- Định dạng lại cột created_day thành chuỗi năm-tháng .
                    DATE_FORMAT(created_day, '%Y-%m') AS month,
                    SUM(hdv.water * dvn.price) AS tong_chi_phi_nuoc
                FROM
                    hoa_don_dich_vu hdv
                JOIN
                    dich_vu_dien_nuoc dvn ON dvn.id_service = 'Nuoc'
                WHERE
                    hdv.id_room LIKE '%$room_id%'";

        if ($month) {
            $sql .= " AND DATE_FORMAT(created_day, '%Y-%m') = '$month'";
        }

        $sql .= " GROUP BY month";

        return mysqli_query($this->conn, $sql);
    }

    public function getid_room()
    {
        $sql = "SELECT maPhong FROM phong";
        return mysqli_query($this->conn, $sql);
    }
}

