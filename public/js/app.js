$(document).ready(function(){
    $(".image-block input[type='file']").change(function(){

        //console.log($(this)[0]);
        $(".files_names")/*.html("<p>Selected file name: </p>").append($(this)[0].files[0].name)*/.append("<br>").append("<div class='form-image'><img></div>");
        readURL($(this)[0], ".files_names img");
        //$(".files_names").html("Selected file name: ").append($(this)[0].files[0].name).append("<img src='"+$(this)[0].files[0].name+"'>");
    });

});

function readURL(input, img) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(img).attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
    $(".dropdown-toggle").dropdown();

    $("#myModalForm #deletePost").on("click", function(){
        var post_id = $("#myModalForm #delete_post_id").val();
        $.ajax({
            url: "/posts/deletePost/"+post_id,
            type: "get",
            success: function(data){
                $("#myModalForm").modal("hide");
               // $('.flash').fadeIn(1500).delay(4500).fadeOut(1500);
                $("#user_post_id_"+post_id).slideUp(1000, function(){
                    $(this).remove();
                });
                flashMessage("Post deleted!");
            }
        });
    });
});

$(document).ready(function() {
    $('.form').hide();
    showForm(".button", ".form");
});

function showForm(button, form){
    $(button).on("click", function(){
        $(form).stop().slideToggle(1000);
    });
}

function addLike(id){
    $.ajax({
        url: '/posts/addLike/'+id,
        type: "get",
        success: function(data){
            $("#post_likes_"+id).text(data);
            flashMessage("Like added!");
            //message("Like added!", "success");
       }
    }); 
}

function addDislike(id){
    $.ajax({
        url: '/posts/addDislike/'+id,
        type: "get",
        success: function(data){
            $("#post_dislikes_"+id).text(data);
            flashMessage("Dislike added!");
            //message("Dislike added!", "success");
        }
    }); 
}

function flashMessage(message){
    var block = document.createElement("div");
    $(block).addClass("flash").text(message);

    $("body").append(block);

    $(block).fadeIn(1000);
    setTimeout(function(){
        $(block).fadeOut(1000, function(){
            $("body").find(".message_block").remove();
        });
    }, 5000);
}

function message(message, type){
    var block = document.createElement("div");
    $(block).addClass("message_block");

    switch(type){
        case "error": 
           $(block).addClass("bg-error");
        break;
        case "success": 
           $(block).addClass("bg-success");
        break;
        case "warning": 
           $(block).addClass("bg-warning");
        break;
    }
   
    var header = document.createElement("h4");
    $(header).text("Message");

    var message_block = document.createElement("div");
    $(message_block).text(message);

    $(block).append(header).append(message_block);

    $("body").append(block);

    $(block).fadeIn(500);
    setTimeout(function(){
        $(block).fadeOut(1000, function(){
            $("body").find(".message_block").remove();
        });
    }, 5000);
}

function showDeleteForm(post_id){
    $("#myModalForm").find(".modal-title").text("Delete");
    $("#myModalForm").find(".modal-body").html("<p>Do you really want to delete ? &hellip;</p>");
    $("#myModalForm").find(".modal-body").append("<input id='delete_post_id' name='post_id' type='hidden' value='"+post_id+"'/>");
    $("#myModalForm").modal("show");
}

/*$(document).ready(function() {
     if ($('#files_browse').get(0).files[0].length === 0) {
                    console.log("No files selected.");
                }

   });
  */

  /*(function(){

    $.subscribe('form.submitted',function(){
        $('.flash').fadeIn(500).delay(2500).fadeOut(1500);
    });

})();*/