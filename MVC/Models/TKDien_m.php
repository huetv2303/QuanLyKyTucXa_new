<?php
class TKDien_m extends connectDB
{

    public function tkdien($room_id)
    {
        $sql = "SELECT
                    hdv.id_room,
                    DATE_FORMAT(created_day, '%Y-%m') AS month,
                    SUM(hdv.electricity * dvd.price) AS tong_chi_phi_dien
                FROM
                    hoa_don_dich_vu hdv
                JOIN
                    dich_vu_dien_nuoc dvd ON dvd.id_service = 'Dien'
                WHERE
                    hdv.id_room LIKE '%$room_id%'
                GROUP BY
                    month";

        return  mysqli_query($this->conn, $sql);
    }

    public function getid_room()
    {
        $sql = "SELECT maPhong FROM phong";
        return mysqli_query($this->conn, $sql);
    }
}
