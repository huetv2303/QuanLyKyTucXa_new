function updateDataP(data) {
    let newData = JSON.parse(data);

    // Target the specific modal by ID and update the input values
    document.getElementById('txtMaphong').value = newData.maPhong;
    document.getElementById('txtMatoa').value = newData.maToa;
    document.getElementById('txtSonguoi').value = newData.soNguoi;
    document.getElementById('txtTienphong').value = newData.tienPhong;
    document.getElementById('txtTrangthai').value = newData.trangThai;
    
}
function updateDataT(data) {
    let newData = JSON.parse(data);

    // Target the specific modal by ID and update the input values
   
    document.getElementById('txtMatoa').value = newData.maToa;
    document.getElementById('txtSophong').value = newData.soPhong;
   
}
function updateDataNV(data) {
    let newData = JSON.parse(data);

    // Target the specific modal by ID and update the input values
  
    document.getElementById('txtMatoa').value = newData.maToa;

    document.getElementById('txtTennv').value = newData.TenNhanVien;
    document.getElementById('txtSDT').value = newData.SoDienThoai;
  
    
}