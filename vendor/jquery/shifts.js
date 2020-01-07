function setShift() {
    $.post("./includes/setShift.inc.php").done(function(resp){
        alert(resp);
        //window.location.href = window.location.href;

    });
    return;
}