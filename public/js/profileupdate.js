$(document).ready(function(){

    // image preview
    $("#profile_image").change(function(){
        let reader = new FileReader();

        reader.onload = (e) => {
            $("#image_preview_container").attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    })

    $("#profile_setup_frm").submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#btn").attr("disabled", true);
        $("#btn").html("Updating...");
        $.ajax({
            type:"POST",
            url: this.action,
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.code == 400) {
                    let error = '<span class="alert alert-danger">'+response.msg+'</span>';
                    $("#res").html(error);
                    $("#btn").attr("disabled", false);
                    $("#btn").html("Save Profile");
                }else if(response.code == 200){
                    let success = '<span class="alert alert-success">'+response.msg+'</span>';
                    $("#res").html(success);
                    $("#btn").attr("disabled", false);
                    $("#btn").html("Save Profile");
                }
            }
        })
    })
})
