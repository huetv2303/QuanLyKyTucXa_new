function updateDataDV(data) {
    let newData = JSON.parse(data);
    console.log(newData)
    // Target the specific modal by ID and update the input values
    document.getElementById('txtMaDV').value = newData.id_service;
    document.getElementById('txtTenDV').value = newData.name_service;
    document.getElementById('txtGia').value = newData.price;
    document.getElementById('txtDonVi').value = newData.unit;
    document.getElementById('txtGhiChu').value = newData.note;
    ;
    
}

function updateDataDN(data) {
    let newData = JSON.parse(data);
    console.log(newData)
    // Target the specific modal by ID and update the input values
    document.getElementById('txtMaDV').value = newData.id_service;
    document.getElementById('txtTenDV').value = newData.name_service;
    document.getElementById('txtGia').value = newData.price;
    document.getElementById('txtDonVi').value = newData.unit;
    ;
    
}

function updateDataPDV(data) {
    let newData = JSON.parse(data);
    // Target the specific modal by ID and update the input values
    document.getElementById('txtID').value = newData.id;
    document.getElementById('txtMaPhong').value = newData.id_room;
    document.getElementById('txtMaDV').value = newData.id_service;
    document.getElementById('txtThang').value = newData.month;
    document.getElementById('txtNam').value = newData.year;
    document.getElementById('txtMaToa').value = newData.maToa;

    console.log(newData);
    
}

function updateDataHDDV(data) {
    let newData = JSON.parse(data);
    // Target the specific modal by ID and update the input values
    document.getElementById('txtMaHD').value = newData.id_invoice;
    document.getElementById('txtMaPhong').value = newData.id_room;
    document.getElementById('txtDien').value = newData.electricity;
    document.getElementById('txtNuoc').value = newData.water;
    document.getElementById('txtNgayTao').value = newData.created_day;
    document.getElementById('txtNgayKT').value = newData.ended_day;
    document.getElementById('txtTrangThai').value = newData.status;
    document.getElementById('Thang').value = newData.month;
    document.getElementById('Nam').value = newData.year;
    document.getElementById('txtDienBD').value = newData.soDien;
    document.getElementById('txtNuocBD').value = newData.khoiNuoc;
    document.getElementById('txtMaToa').value = newData.maToa;
    // document.getElementById('TienCoc').value = newData.advance_deposit;

    console.log(newData);

}

function updateDataExportHDDV(data) {
    let newData = JSON.parse(data);

    document.getElementById('MaHD').innerText = `Mã hóa đơn: ${newData.id_invoice}`;
    document.getElementById('MaPhong').innerText = `Mã phòng: ${newData.id_room}`;
    document.getElementById('Dien').innerText = `${newData.electricity_usage} kWh`;
    document.getElementById('Nuoc').innerText = `${newData.water_usage} m3`;
    document.getElementById('TrangThai').innerText = newData.status;
    document.getElementById('TongDN').innerText = `${newData.total_electricity_water_cost} VND`;
    // document.getElementById('TienCoc2').innerText = `${newData.advance_deposit} VND`;
    document.getElementById('TongDV').innerText = `${newData.total_service_cost} VND`;
    document.getElementById('Tong').innerText = `Tổng: ${newData.total_cost} VND`;
    // document.getElementById('month').innerText = newData.month;
    document.getElementById('year').innerText =`Tháng ${newData.month} Năm ${newData.year}` ;
    document.getElementById('MaHD1').value = newData.id_invoice;
    document.getElementById('MaPhong1').value = newData.id_room;
    document.getElementById('month1').value = newData.month;
    document.getElementById('year1').value = newData.year;

    console.log(newData);
}



