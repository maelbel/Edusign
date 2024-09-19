function generateRandomString() {
    const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let result= '';
    const charactersLength = characters.length;
    for ( let i = 0; i < 10; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    
    return result;
}

function generateQrCode(course_id){
    let token = generateRandomString();

    $.ajax({
        method: "POST",
        url: "/course/qrcode",
        data: { course_id: course_id, token: token }
      })
        .done(function(res) {
            $('#link-qrcode').attr("href", res);
            $('#qrcode').attr("src", "./src/img/tmp/qrcode/qrcode-" + token + ".png");
            $('#qrcode').show();
            console.log( "success", res );
        })
        .fail(function() {
            console.log( "error" );
        })
        .always(function() {
            console.log( "complete" );
        }
    );
}