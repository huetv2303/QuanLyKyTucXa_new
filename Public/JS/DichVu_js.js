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
    console.log(newData);

}

function updateDataExportHDDV(data) {
    let newData = JSON.parse(data);

    document.getElementById('MaHD').innerText = `Mã hóa đơn: ${newData.id_invoice}`;
    document.getElementById('MaPhong').innerText = `Mã phòng: ${newData.id_room}`;
    document.getElementById('Dien').innerText = `${newData.electricity} kWh`;
    document.getElementById('Nuoc').innerText = `${newData.water} m3`;
    document.getElementById('TrangThai').innerText = newData.status;
    document.getElementById('TongDN').innerText = `${newData.tong_dien_nuoc} VND`;
    document.getElementById('TongDV').innerText = `${newData.tong_dich_vu_khac} VND`;
    document.getElementById('Tong').innerText = `Tổng: ${newData.tong_tat_ca} VND`;
    document.getElementById('MaHD1').value = newData.id_invoice;
    document.getElementById('MaPhong1').value = newData.id_room;

    console.log(newData);
}



