<!DOCTYPE html>

<html>
<head>

<meta name="csrf-token" content="{{ csrf_token() }}">



<title>View Student Records</title>
<style>

#time{
  height: 50px;
  width: 100px;
  margin-bottom: 50px;

}

table, th, td {
    border: 1px solid black;
    padding:3px;
    border-spacing:5px;
}



#submit{

   position: absolute;
margin-top: 20px;
margin-left: 670px;
}

#nextlink{

    position: absolute;
margin-top: 20px;
margin-left: 780px;


}

.td1{

  width: 20px;
}




</style>
</head>
<body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/timer.js" ></script>


<script>

  

  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


    $(document).on('click','#nextlink',function(e){

                e.preventDefault();

               //var getanswer = $("input[name='choice']:checked").html();
             //   var getanswer = $('td input[name = choice]:checked').parents('.tr').find('#first').html();
 var getanswer = $('td input[name = choice]:checked').parents('.tr').find('td:nth-child(2)').html();

               var getid = $('#question_id').html();
                 
               //  console.log(getanswer);
                  //  console.log(getid);
          

                $.ajax({
                                              url: "/jsquiz20",
                                             type: "POST",
                                             data: {
                                                     getanswer: getanswer,
                                                     getid :getid
                                                   },
                                             datatype: 'json'
            
                                          }).done(function (data) {        
                                                                        
                                       getdata(getid);
                             
                                          }).fail(function (error) {
                                            console.log(error);

                                         });       



     ////////////$('input[type="submit"], input[type="button"], button').disable(false);

    });
    function getdata(getid){

          var getqid = ++getid;

          console.log(getqid);
      
     //   console.log("Question ID:"+ getqid);


                $.ajax({

                                             url: "/jsquizNext",
                                             type: "post",
                                             data: {
                                                     getqid :getqid
                                                   },
                                             datatype: 'json'
            
                                          }).done(function (data) { 
                                        //   console.log(data[0].question_id);
                                          
                        $("#question_id").html("");
                        $("#question").html("");
                        $("#option1").html("");
                        $("#option2").html("");
                        $("#option3").html("");
                        $("#option4").html("");
                        $('input[type="radio"]').prop('checked', false); 
                                                                                     
                        $("#question_id").html(data[0].question_id);
                        $("#question").html(data[0].question);

                        $("#option1").html(data[0].choice1);
                        $("#option2").html(data[0].choice2);
                        $("#option3").html(data[0].choice3);
                        $("#option4").html(data[0].choice4);

         
                        
                                                                
                                          }).fail(function (error) {
                                            console.log(error);

                                         });
       
    }

///////////////////////////////submit button 

         $(document).on('click','#submit',function(e){

           var getanswer = $('td input[name = choice]:checked').parents('.tr').find('td:nth-child(2)').html();
           var getid = $('#question_id').html();

                               $.ajax({
                                             url: "/submitjsquiz20",
                                             type: "POST",
                                             data: {
                                                     getanswer: getanswer,
                                                     getid :getid
                                                   },
                                             datatype: 'json'
            
                                          }).done(function (data) {        
                                            console.log(data);
                                         
                                     
                             
                                          }).fail(function (error) {
                                            console.log(error);

                                          });
                       

  });





 </script>
<div class="quizquestions">

Start time :<div id="time" ></div>
      <div class="content">
          @include('jsajax')
      </div>

</div>



</body>
</html>















