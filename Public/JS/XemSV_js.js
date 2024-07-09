function xemSV(data) {
    let newData = JSON.parse(data);
    console.log(newData)
    // Target the specific modal by ID and update the input values
    document.getElementById('txtMaTruongNhom').value = newData.maTruongNhom;
    ;
    
}
