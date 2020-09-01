require('./bootstrap');

$(document).ready(function() {
    $("#btnCapturar").click(function() {
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/capturar/store',
            data: {
                _token: $('#csrf-token-id').attr('content'),
                textoDigitado: $('#textoDigitado').val()
            },
            dataType: 'json',
            beforeSend: function() {
                Notiflix.Loading.Dots('Buscando...');
            },
            complete: function() {
                Notiflix.Loading.Remove();
            },
            success: function(data) {

                if(data){
                    Notiflix.Report.Success(
                        'Sucesso',
                        'Carros capturados com sucesso!!!',
                        'Ok',
                        function(){
                            window.location = BASE_URL;
                        }
                    );
                }else{
                    Notiflix.Report.Failure('Opsss','Houve uma falha, tente novamente.','Ok');
                }
            },
            fail: function() {}
        });
    });
});
