var aquivos = [];
$( document ).ready(function() {
    $("#open_btn").click(function() {
        $.FileDialog({multiple: true}).on('files.bs.filedialog', function(ev) {
            var files = ev.files;                       
            files.forEach(function(f) {                             
                $('#formUpload').append('<input type="hidden" name="arquivo[]" value="'+f.content.split(',')[1]+'" />');                
            });
            $('form').submit();
            //$("#output").html(text);
        }).on('cancel.bs.filedialog', function(ev) {
            //$("#output").html("Cancelled!");
        });
    });
});
