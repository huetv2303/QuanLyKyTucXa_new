function myFunction(e)
{
    var e = document.getElementById("txtID");
    var Name = e.options[e.selectedIndex].getAttribute('valuea');
    document.getElementById('txtName').value = Name;

    var Type = e.options[e.selectedIndex].getAttribute('valueb');
    document.getElementById('txtType').value = Type;

    var Plate = e.options[e.selectedIndex].getAttribute('valuec');
    document.getElementById('txtPlate').value = Plate;
}