var vipAmount = 0;

function doVip() {
    const data = {
        announcementId: localStorage.getItem('announcementId'),
        amount: localStorage.getItem('vipPrice'),
        type: localStorage.getItem('orderType')
    }
    const pathArray = window.location.pathname.split("/");
    $.ajax({
        type: "POST",
        url: '/' + pathArray[1] + '/profile/add-order',
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        beforeSend: function (request) {
            request.setRequestHeader("X-CSRF-TOKEN", csrfToken);
        },
        complete: function (resp) {
            if (resp.status === 200) {
                window.location.href = '/az/profile/orders';
            } else if (resp.status === 400) {
                window.location.href = '/az/profile/balance';
            }
        }
    }, function (resp) {
        console.log(resp);
    })

}

function selectAmount(amount) {
    vipAmount = amount;
}
