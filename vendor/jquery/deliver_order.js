function deliver( order) {
    console.log(order);
    var data = {
        order_ID : order
    };

    $.post("./includes/deliver_order.inc.php", data).done(function(resp){
        //alert(resp);
        window.location.href = window.location.href;

    });
    return;
}