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

    $('.imageUpload').css('visibility', 'visible');
    //$('.imageUploadFilter').className($filter);
});

$("#filterselect").change(function(){
    //alert($('#filterselect').val());
    //$filter = $('#filterselect').val();
    //$('#imageUploadFilter1').className="";
    $('#imageUploadFilter1').attr('class', '');
    $('#imageUploadFilter1').addClass($('#filterselect').val());
});