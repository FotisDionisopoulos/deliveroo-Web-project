mycart = {};

function AddtoCart(button) {
    id = button.id;
    quantity = parseInt($(button).parent().find('input').val());

    if (quantity <1) return;
    if (id in mycart) {
        mycart[id] = parseInt(mycart[id]) + quantity;
    } else {
        mycart[id] = quantity;
    }
    //console.log(mycart);
    updateCart();
}

function submitCart() {

    var data = {
        items : mycart,
        location: marker.getPosition().toJSON()
    };
    console.log(data);
    $.post("./includes/order.inc.php", data).done(function(resp){
       //alert(resp);
        window.location.href = 'success.php';

    });
    return false;
}

function updateCart() {
    list = "";
    for(item in mycart) {
        list += '<div>' + item + ', ' + mycart[item] + '</div>';
    }

    list += '<button id="so" class="btn btn-primary btn-x1" onClick="submitCart()">Submit order</button>'
    $('#mycart').html(list);
}



