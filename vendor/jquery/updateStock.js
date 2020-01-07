mycart = {};

function AddStock(button) {
    id = button.id;
    quantity = parseInt($(button).parent().find('input').val());

    if (quantity <1) return;
    if (id in mycart) {
        mycart[id] = parseInt(mycart[id]) + quantity;
    } else {
        mycart[id] = quantity;
    }
    //console.log(mycart);
    updateStock();
}

function submitStock() {

    var data = {
        items : mycart
    };
    console.log(data);
    $.post("./includes/insertNewStock.inc.php", data).done(function(resp){
        //alert(resp);
        window.location.replace(window.location.href);
    });

    ajaxCall();
    return false;
}
function ajaxCall() {
    //do your AJAX stuff here
    //alert("aaaaa");
}


function updateStock() {
    list = "";
    for(item in mycart) {
        list += '<div>' + item + ', ' + mycart[item] + '</div>';
    }

    list += '<div align="center"><button id="so" class="btn btn-primary btn-x1" onClick="submitStock()">Insert</button></div>'

    $('#mycart').html(list);
}



