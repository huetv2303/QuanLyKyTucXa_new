<?php
class HDDV_m extends connectDB
{


    public function hddv_ins($id_invoice, $maToa, $id_room, $soDien, $khoiNuoc, $electricity, $water, $month, $year, $ended_day, $status)
    {
        $sql = "INSERT INTO hoa_don_dich_vu(id_invoice, maToa ,id_room, soDien , khoiNuoc, electricity, water, month, year, created_day, ended_day, status) 
        
        VALUES ('$id_invoice','$maToa','$id_room','$soDien', '$khoiNuoc', '$electricity','$water',' $month','$year',CURRENT_DATE,'$ended_day','$status')";

        return mysqli_query($this->conn, $sql);
    }


    function hddv_upd($id_invoice, $maToa, $id_room, $soDien, $khoiNuoc, $electricity, $water, $month, $year,  $ended_day, $status)
    {
        $sql = "UPDATE hoa_don_dich_vu SET id_room ='$id_room', maToa  = '$maToa',soDien = '$soDien' , khoiNuoc = '$khoiNuoc' , electricity ='$electricity', water ='$water'  , month = '$month', year = '$year', ended_day ='$ended_day'  , status ='$status' WHERE id_invoice ='$id_invoice'";
        return mysqli_query($this->conn, $sql);
    }



    public function hddv_invoice($page, $limit)
    {
        $offset = ($page - 1) * $limit;

        $sql = "WITH service_prices AS (
            SELECT 
                id_service,
                price
            FROM 
                dich_vu_dien_nuoc dn
            WHERE 
                id_service IN ('Dien', 'Nuoc') -- Giả sử id_service = 'Dien' là điện và id_service = 'Nuoc' là nước
        ),
        
        -- Tính lượng điện và nước tiêu thụ trong tháng
        electricity_water_usage AS (
            SELECT 
                hd.id_invoice,
                hd.id_room,
                (hd.electricity - hd.SoDien) AS electricity_usage,
                (hd.water - hd.KhoiNuoc) AS water_usage,
                hd.month,
                hd.year,
                hd.status,
                hd.electricity,
                hd.water,
                hd.created_day,
                hd.ended_day,
                hd.soDien,
                hd.khoiNuoc,
                hd.maToa,
                CASE 
                    WHEN ended_day < CURDATE() AND status != 'Đã thanh toán' THEN 'Hóa đơn quá hạn'
                    WHEN status = 'Đã thanh toán' THEN 'Đã thanh toán'
                    ELSE 'Chưa thanh toán'
                END AS notifications
            FROM 
                hoa_don_dich_vu hd
        ),
        
        -- Tính tiền điện và nước
        electric_water_cost AS (
            SELECT 
                e.id_room,
                e.month,
                e.year,
                ROUND(COALESCE(e.electricity_usage, 0) * sp1.price, 2) AS electricity_cost,
                ROUND(COALESCE(e.water_usage, 0) * sp2.price, 2) AS water_cost
            FROM 
                electricity_water_usage e
            JOIN 
                service_prices sp1 ON sp1.id_service = 'Dien' -- Giả sử id_service = 'Dien' là điện
            JOIN 
                service_prices sp2 ON sp2.id_service = 'Nuoc' -- Giả sử id_service = 'Nuoc' là nước
        ),
        
        -- Tính tổng tiền dịch vụ đã đăng ký
        service_cost AS (
            SELECT 
                r.id_room,
                r.month,
                r.year,
                ROUND(COALESCE(SUM(dv.price), 0), 2) AS total_service_cost
            FROM 
                dang_ky_dich_vu r
            JOIN 
                dich_vu_khac dv ON r.id_service = dv.id_service
            GROUP BY 
                r.id_room, r.month, r.year
        )
        
        -- Tổng hợp tất cả lại để tính tổng tiền phải trả cho mỗi phòng
        SELECT 
            ec.id_room,
            ec.month,
            ec.year,
            ROUND(COALESCE(ec.electricity_cost, 0), 2) AS electricity_cost,
            ROUND(COALESCE(ec.water_cost, 0), 2) AS water_cost,
            ROUND(COALESCE(ec.electricity_cost, 0) + COALESCE(ec.water_cost, 0))  AS total_electricity_water_cost,
            ROUND(COALESCE(sc.total_service_cost, 0)) AS total_service_cost,
            ROUND((COALESCE(ec.electricity_cost, 0) + COALESCE(ec.water_cost, 0) + COALESCE(sc.total_service_cost, 0))) AS total_cost,
            ewu.id_invoice,
            ewu.status,
            ewu.electricity,
            ewu.water,
            ewu.created_day,
            ewu.ended_day,
            ewu.soDien,
            ewu.khoiNuoc,
            ewu.electricity_usage,
            ewu.water_usage,
            ewu.maToa,
            ewu.notifications
        
        FROM 
            electric_water_cost ec
        LEFT JOIN 
            service_cost sc ON ec.id_room = sc.id_room AND ec.month = sc.month AND ec.year = sc.year
        LEFT JOIN 
            electricity_water_usage ewu ON ec.id_room = ewu.id_room AND ec.month = ewu.month AND ec.year = ewu.year
        LIMIT $offset, $limit;";

        return mysqli_query($this->conn, $sql);
    }


    public function get_total_service_cost($maPhong, $thang, $nam)
    {
        $sql = "SELECT ROUND(COALESCE(SUM(dv.price), 0), 0) AS total_service_cost
                FROM dang_ky_dich_vu r
                JOIN dich_vu_khac dv ON r.id_service = dv.id_service
                WHERE r.id_room = ? AND r.month = ? AND r.year = ?
                GROUP BY r.id_room";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sii', $maPhong, $thang, $nam);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['total_service_cost'];
        } else {
            return 0;
        }
    }
    function count()
    {
        $sql = "SELECT COUNT(*) as total FROM hoa_don_dich_vu";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
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

    function check_trung_thangnam($month, $year)
    {
        $sql = "SELECT * FROM hoa_don_dich_vu WHERE  month ='$month' and  year ='$year' ";

        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true;  //trùng mã
        }
        return $kq;
    }

    public function hddv_idP()
    {
        $sql = "SELECT maPhong FROM phong";
        return mysqli_query($this->conn, $sql);
    }

    function hddv_all()
    {
        $sql = "SELECT * FROM hoa_don_dich_vu";
        return mysqli_query($this->conn, $sql);
    }

    function hddv_find($id_invoice, $id_room, $month, $year, $notifications)
    {

        $sql = "WITH service_prices AS (
            SELECT 
                id_service,
                price
            FROM 
                dich_vu_dien_nuoc
            WHERE 
                id_service IN ('Dien', 'Nuoc') -- Giả sử id_service = 'Dien' là điện và id_service = 'Nuoc' là nước
            ),
        
            -- Tính lượng điện và nước tiêu thụ trong tháng
            electricity_water_usage AS (
                SELECT 
                    hd.id_invoice,
                    hd.id_room,
                    (hd.electricity - hd.SoDien) AS electricity_usage,
                    (hd.water - hd.KhoiNuoc) AS water_usage,
                    hd.month,
                    hd.year,
                    hd.status,
                    hd.electricity,
                    hd.water,
                    hd.created_day,
                    hd.ended_day,
                    hd.soDien,
                    hd.khoiNuoc,
                    hd.maToa,
                      CASE 
                    WHEN ended_day < CURDATE() AND status != 'Đã thanh toán' THEN 'Hóa đơn quá hạn'
                    WHEN status = 'Đã thanh toán' THEN 'Đã thanh toán'
                    ELSE 'Chưa thanh toán'
                    END AS notifications
                    
                FROM 
                    hoa_don_dich_vu hd
            ),
        
            -- Tính tiền điện và nước
            electric_water_cost AS (
                SELECT 
                    e.id_room,
                    e.month,
                    e.year,
                    ROUND(COALESCE(e.electricity_usage, 0) * sp1.price, 2) AS electricity_cost,
                    ROUND(COALESCE(e.water_usage, 0) * sp2.price, 2) AS water_cost
                FROM 
                    electricity_water_usage e
                JOIN 
                    service_prices sp1 ON sp1.id_service = 'Dien' -- Giả sử id_service = 'Dien' là điện
                JOIN 
                    service_prices sp2 ON sp2.id_service = 'Nuoc' -- Giả sử id_service = 'Nuoc' là nước
            ),
        
            -- Tính tổng tiền dịch vụ đã đăng ký
            service_cost AS (
                SELECT 
                    r.id_room,
                    r.month,
                    r.year,
                    ROUND(COALESCE(SUM(dv.price), 0)) AS total_service_cost
                FROM 
                    dang_ky_dich_vu r
                JOIN 
                    dich_vu_khac dv ON r.id_service = dv.id_service
                GROUP BY 
                    r.id_room, r.month, r.year
            )
        
            -- Tổng hợp tất cả lại để tính tổng tiền phải trả cho mỗi phòng
            SELECT 
                ec.id_room,
                ec.month,
                ec.year,
                ROUND(COALESCE(ec.electricity_cost, 0)) AS electricity_cost,
                ROUND(COALESCE(ec.water_cost, 0), 2) AS water_cost,
                ROUND(COALESCE(ec.electricity_cost, 0) + COALESCE(ec.water_cost, 0))  AS total_electricity_water_cost,
                ROUND(COALESCE(sc.total_service_cost, 0)) AS total_service_cost,
                ROUND((COALESCE(ec.electricity_cost, 0) + COALESCE(ec.water_cost, 0) + COALESCE(sc.total_service_cost, 0))) AS total_cost,
                ewu.id_invoice,
                ewu.status,
                ewu.electricity,
                ewu.water,
                ewu.created_day,
                ewu.ended_day,
                ewu.soDien,
                ewu.khoiNuoc,
                ewu.electricity_usage,
                ewu.water_usage,
                ewu.maToa,
                ewu.notifications
              
            FROM 
                electric_water_cost ec
            LEFT JOIN 
                service_cost sc ON ec.id_room = sc.id_room AND ec.month = sc.month AND ec.year = sc.year
            LEFT JOIN 
                electricity_water_usage ewu ON ec.id_room = ewu.id_room AND ec.month = ewu.month AND ec.year = ewu.year
              Where 
                        ewu.id_invoice LIKE '%$id_invoice%'
                       AND ewu.id_room LIKE '%$id_room%'
                       AnD   ewu.month LIKE '%$month%'
                       AND ewu.year LIKE '%$year%'
                       AND ewu.notifications LIKE '%$notifications%' ";

        // var_dump($sql);

        return mysqli_query($this->conn, $sql);
    }



    function hddv_del($id_invoice)
    {
        $sql = "DELETE FROM hoa_don_dich_vu WHERE id_invoice ='$id_invoice'";

        return mysqli_query($this->conn, $sql);
    }

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
