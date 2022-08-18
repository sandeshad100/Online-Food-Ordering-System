


$(document).ready(function(e){
    $('.del').on('click',function(e){
        e.preventDefault();//prevent default action
        var me = $(this);
        var href = me.attr('href');
        if(confirm("Confirm delete?"))
        {
            window.location.assign(href);
        }
       

    });

   });

   $(document).ready(function(e){
    $('.pop').on('click',function(e){
        e.preventDefault();//prevent default action
        var me = $(this);
        var href = me.attr('href');
        if(confirm("Are you sure,do you want to log out?"))
        {
            window.location.assign(href);
        }
       

    });

   });