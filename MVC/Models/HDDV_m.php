<?php
class HDDV_m extends connectDB
{
    public function hddv_ins($id_invoice, $id_room, $electricity, $water, $created_day,$ended_day, $status)
    {
        $sql = "INSERT INTO hoa_don_dich_vu(id_invoice, id_room, electricity, water, created_day, ended_day, status) VALUES ('$id_invoice','$id_room','$electricity','$water','$created_day','$ended_day','$status')";

        return mysqli_query($this->conn, $sql);
    }

    public function hddv_invoice()
    {
        $sql = " SELECT
    hdv.id_invoice,
    hdv.status,
    hdv.electricity,
    hdv.water,
    hdv.created_day,
    hdv.ended_day,
    dien_nuoc.id_room,
     FLOOR(dien_nuoc.tong_dien_nuoc) AS tong_dien_nuoc,
    FLOOR(COALESCE(dich_vu_khac.tong_dich_vu_khac, 0)) AS tong_dich_vu_khac,
    FLOOR(dien_nuoc.tong_dien_nuoc + COALESCE(dich_vu_khac.tong_dich_vu_khac, 0)) AS tong_tat_ca
    FROM
    hoa_don_dich_vu hdv
    JOIN
    (SELECT
        hdv.id_room,
        SUM(hdv.electricity * dv_dien.price + hdv.water * dv_nuoc.price) AS tong_dien_nuoc
    FROM
        hoa_don_dich_vu hdv
    JOIN
        dich_vu_dien_nuoc dv_dien ON dv_dien.id_service = 'Dien'
    JOIN
        dich_vu_dien_nuoc dv_nuoc ON dv_nuoc.id_service = 'Nuoc'
    GROUP BY
        id_room) AS dien_nuoc ON hdv.id_room = dien_nuoc.id_room
    LEFT JOIN
    (SELECT
        id_room,
        COALESCE(SUM(dvk.price), 0) AS tong_dich_vu_khac
    FROM
        phong_dich_vu
    LEFT JOIN
        dich_vu_khac dvk ON dvk.id_service = phong_dich_vu.id_service
    GROUP BY
        id_room) AS dich_vu_khac ON hdv.id_room = dich_vu_khac.id_room";

        return mysqli_query($this->conn, $sql);
    }

    function check_trung_ma($id_invoice)
    {
        $sql = "SELECT * FROM hoa_don_dich_vu WHERE id_invoice ='$id_invoice' ";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true;  //trùng mã
        }
        return $kq;
    }

    public function hddv_idP()
    {
        $sql = "SELECT id_room FROM phong_ky_tuc_xa";
        return mysqli_query($this->conn, $sql);
    }

    function hddv_all()
    {
        $sql = "SELECT * FROM hoa_don_dich_vu";
        return mysqli_query($this->conn, $sql);
    }

    function hddv_find($id_invoice, $id_room)
    {
        $sql = "SELECT
               hdv.id_invoice,
                hdv.status,
                hdv.electricity,
                hdv.water,
                hdv.created_day,
                hdv.ended_day,
                dien_nuoc.id_room,
                FLOOR(dien_nuoc.tong_dien_nuoc) AS tong_dien_nuoc,
                FLOOR(COALESCE(dich_vu_khac.tong_dich_vu_khac, 0)) AS tong_dich_vu_khac,
                FLOOR(dien_nuoc.tong_dien_nuoc + COALESCE(dich_vu_khac.tong_dich_vu_khac, 0)) AS tong_tat_ca
            FROM
                hoa_don_dich_vu hdv
            JOIN
                (SELECT
                    hdv.id_room,
                    SUM(hdv.electricity * dv_dien.price + hdv.water * dv_nuoc.price) AS tong_dien_nuoc
                 FROM
                    hoa_don_dich_vu hdv
                 JOIN
                    dich_vu_dien_nuoc dv_dien ON dv_dien.id_service = 'Dien'
                 JOIN
                    dich_vu_dien_nuoc dv_nuoc ON dv_nuoc.id_service = 'Nuoc'
                 GROUP BY
                    id_room) AS dien_nuoc ON hdv.id_room = dien_nuoc.id_room
            LEFT JOIN
                (SELECT
                    id_room,
                    COALESCE(SUM(dvk.price), 0) AS tong_dich_vu_khac
                 FROM
                    phong_dich_vu
                 LEFT JOIN
                    dich_vu_khac dvk ON dvk.id_service = phong_dich_vu.id_service
                 GROUP BY
                    id_room) AS dich_vu_khac ON hdv.id_room = dich_vu_khac.id_room
            WHERE
                hdv.id_invoice LIKE '%$id_invoice%'
                AND hdv.id_room LIKE '%$id_room%'";

        return mysqli_query($this->conn, $sql);
    }



    function hddv_del($id_invoice)
    {
        $sql = "DELETE FROM hoa_don_dich_vu WHERE id_invoice ='$id_invoice'";

        return mysqli_query($this->conn, $sql);
    }

    function hddv_upd($id_invoice, $id_room, $electricity, $water, $created_day, $ended_day, $status)
    {
        $sql = "UPDATE hoa_don_dich_vu SET id_room ='$id_room', electricity ='$electricity', water ='$water'  , created_day ='$created_day', ended_day ='$ended_day'  , status ='$status' WHERE id_invoice ='$id_invoice'";

        return mysqli_query($this->conn, $sql);
    }
}
