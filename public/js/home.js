$(document).ready(function(){

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    $('.comment_insert').on('submit',function(e){
     e.preventDefault();
     var url = $(this).attr('action');
     var post = $(this).attr('method');
     var data = $(this).serialize();

     console.log(url);
     
        $.ajax({
            type : post,
            url: url, 
            data :data,
            // dataType:  'json', 
            success:function(data, status)
            {

                console.log(data);
                
            }
        });

        // $.post(url, data, function(data, status){

        //     console.log(status);

        // });

         
 });



    });



    


    // $('#comment_insert').on('submit',function(e){
    // e.preventDefault();
    // var data = $this.serialize();
    // var url = $(this).attr('action');
    //     var post =  $(this).attr('method');
    //     $.ajax({
    //     type : post,
    //     url: url,
    //     data :data,
    //     dataType:  'json',
    //     Success:function(data)
    //     {

    //         console.log(data);
            
    //     }
    //     });
    // });
