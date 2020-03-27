$(document).ready(function(){
    $(document).on("click",".remove",function(){
        let url = $(this).prev('a').attr('href');
        $('#wrapper').css('opacity',0.5);
        $('.modal').css('display','block');
        $('#btnAgree').prev('a').attr('href',url);
    });
    
    $(document).on("click","#closeConfirm",function(){
        $('#wrapper').css('opacity',1);
        $('.modal').fadeOut(300);
    });

    $(document).on("click","#btnAgree",function(){
        $('#wrapper').css('opacity',1);
        $('.modal').fadeOut(100);
        let url = $(this).prev('a').attr('href');
        document.location.href=url;                
    });
});