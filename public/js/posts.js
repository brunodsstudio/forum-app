$(function(){
    var postActions   = $( '#list_PostActions' );
    var currentAction = $( '#list_PostActions li.active' );
    if ( currentAction.length === 0 ) {
        postActions.find( 'li:first' ).addClass( 'active' );
    }
    postActions.find( 'li' ).on( 'click', function( e ) {
        e.preventDefault();
        var self = $( this );
        if ( self === currentAction ) {return;}
        // else
        currentAction.removeClass( 'active' );
        self.addClass( 'active' );
        currentAction = self;
    });
});

function fixedEncodeURI (str) {

    return encodeURI(str).replace(/%5B/g, '[').replace(/%5D/g, ']');

}

function myFunction(x) {
    x.classList.toggle("fa-thumbs-down");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    var POSTID = $(x).attr("PostId");
    var form_data = new FormData();
    form_data.append("POSTID", POSTID);

    $.ajax({
        type: "POST",
        url: "/likePost",
        data: form_data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            alert(data);
            $("#response2").html(data);
        },
        error: function (e) {
            //$("#result").text(e.responseText);
            console.log("ERROR : ", e);
          }
    });




  }
function showEditins(Id){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#modalContent").html("");
    var form_data = new FormData();
    form_data.append("post_id", Id);

    $.ajax({
        type: "POST",
        url: "/editHist",
        data: form_data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            //alert(data);
            
            $("#modalContent").html(data);
            $('#historicoEdicao').modal('show');
        },
        error: function (e) {
            //$("#result").text(e.responseText);
            console.log("ERROR : ", e);
          }
    });

    
}

function deletePost(id, type, id_div){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   
    var form_data2 = new FormData();
    form_data2.append("post_id", id);
    form_data2.append("type", type);

    $.ajax({
        type: "POST",
        url: "/deletePost",
        data: form_data2,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            alert(data);
            $('#'+ id_div).remove();
          
        },
        error: function (e) {
            //$("#result").text(e.responseText);
            console.log("ERROR : ", e);
          }
    });

}

function deleteComment(id){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   
    var form_data2 = new FormData();
    form_data2.append("id", id);
 
    $.ajax({
        type: "POST",
        url: "/deleteComment",
        data: form_data2,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            alert(data);
            $('#cm'+ id).html("Comment Deleted!");
          
        },
        error: function (e) {
            //$("#result").text(e.responseText);
            console.log("ERROR : ", e);
          }
    });

}

function addComment(text, id_user, id_post){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var descr = $("#"+text).val();
    alert(descr);
    var form_data2 = new FormData();
    form_data2.append("description", descr);
    form_data2.append("user_id", id_user);
    form_data2.append("post_id", id_post);
 
    $.ajax({
        type: "POST",
        url: "/addComment",
        data: form_data2,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
           // alert(data);
           $('#resultInserts').html(data);
           
          
        },
        error: function (e) {
            //$("#result").text(e.responseText);
            console.log("ERROR : ", e);
          }
    });

}

function updatePost(form){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var formx = $('#'+form)[0];
    var form_data = new FormData(formx);
    //form_data.append("post_id", Id);

    $.ajax({
        type: "POST",
        url: "/updatePost",
        data: form_data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            //alert(data);
     
        },
        error: function (e) {
            //$("#result").text(e.responseText);
            console.log("ERROR : ", e);
          }
    });

    
}


$("#btnSubmitFormProfile").click(function (event) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //stop submit the form, we will post it manually.
    //event.preventDefault();

    // Get form
    var formx = $('#fileUploadPostForm')[0];

    // Create an FormData object 
    var data = new FormData(formx);

    // If you want to add an extra field for the FormData
    data.append("CustomField", "This is some extra data, testing");

    // disabled the submit button
    //$("#btnSubmit").prop("disabled", true);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "/addPost",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {

            $("#resultInserts").html(data);
           console.log("SUCCESS : ", data);
            //$("#btnSubmit").prop("disabled", false);

        },
        error: function (e) {

            $("#result").text(e.responseText);
            console.log("ERROR : ", e);
            //$("#btnSubmit").prop("disabled", false);

        }
    });

});


$('#EdicaoPost').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) 
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id') // Extract info from data-* attributes
    //var posttype = button.data('posttype')
    //var postid = button.data('postid')
    var modal = $(this)

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var form_data2 = new FormData();
    form_data2.append("id", id);

    $.ajax({
        type: "POST",
        url: "/editPost",
        data: form_data2,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            modal.find('#modalContentPost').html(data);
           //$('#modalContent').html(data);
        },
        error: function (e) {
            //$("#result").text(e.responseText);
            console.log("ERROR : ", e);
          }
    });

  
    modal.find('#id').val(id);
    //modal.find('#posttype').val(posttype );
    //modal.find('#postid').val(postid);

    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    
   
  });

