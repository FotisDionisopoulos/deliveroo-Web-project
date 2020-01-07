function endShift() {
    $.post("./includes/endShift.inc.php").done(function(resp){
        alert(resp);
        //window.location.href = window.location.href;

    });
    return;
}