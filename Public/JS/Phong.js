function updateData(data) {
    let newData = JSON.parse(data);

    // Target the specific modal by ID and update the input values
    document.getElementById('txtMaphong').value = newData.maPhong;
    document.getElementById('txtMatoa').value = newData.maToa;
    document.getElementById('txtSonguoi').value = newData.soNguoi;
    document.getElementById('txtTienphong').value = newData.tienPhong;
    document.getElementById('txtTrangthai').value = newData.trangThai;
    
}
