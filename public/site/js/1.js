$(function(){
    $('.nut').click(function(){
       //xu ly class
       $('.noidung').addClass('noidunghienra');

       $('.mo').addClass('modira');

    });

    //nut close
   $('.nutdong').click(function(){
       $('.noidung').removeClass('noidunghienra');

       $('.mo').removeClass('modira');

   });
   //click ra ngoai van dong form
   $('.mo').click(function(){
       $('.noidung').removeClass('noidunghienra');

       $('.mo').removeClass('modira');
   });
})  
