var aquivos = [];
$( document ).ready(function() {
    $("#open_btn").click(function() {
        $.FileDialog({multiple: true}).on('files.bs.filedialog', function(ev) {
            var files = ev.files; 
            var isValid = true;    
            var msg = "<b>Upload não realizado.</b> <br/>Arquivos inválidos:  <br/>";

            files.forEach(function(f) { 
                if(f.type != "text/xml"){
                    isValid = false;
                    msg += " - " + f.name + " <br/>";
                }                    
            });
            if(isValid){
                files.forEach(function(f) { 
                    $('#formUpload').append('<input type="hidden" name="arquivo[]" value="'+f.content.split(',')[1]+'" />');                
                });
                $('form').submit();
            } else {
                $("#mensagens").show();
                $("#mensagens").html(msg);
                return false;
            }                       
        }).on('cancel.bs.filedialog', function(ev) {
            //$("#output").html("Cancelled!");
        });
    });
});
