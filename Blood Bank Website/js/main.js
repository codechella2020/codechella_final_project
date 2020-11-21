 $(document).ready(function(){

      $(document).scroll(function () {
          var $nav = $(".fixed-top");
          $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
      });
      
      $('#newblood').click(function(){
          window.location.href = 'availability.php';
      });
});