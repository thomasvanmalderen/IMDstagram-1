function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageUpload').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#fileUpload").change(function(){
    readURL(this);
    $filter = $('#filterbox').value();
    $('.imageUpload').css('visibility', 'visible');
    $('.imageUploadFilter').className($filter);
});

$(".filterbox1").change(function(){
    alert("ok!");
    $filter = $('#filterbox').val();
    $('.imageUploadFilter').className = $filter;
});