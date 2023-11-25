
<div class="slideshow-container">
<a href="gravely/index">
  <div class="mySlides fade">
    <img src="core/imagens/carousel1.jpg" style="width:100%">
  </div>
</a>
<a href="spider/index">
  <div class="mySlides fade">
    <img src="core/imagens/carousel2.jpg" style="width:100%">
  </div>
</a>
<a href="stihl/index">
  <div class="mySlides fade">
    <img src="core/imagens/carousel3.jpg" style="width:100%">
  </div>
</a>
<div style="padding-right: 6%; text-align: right; position: relative;  margin-top: -25px;">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>

</div>
<br>


<script>
var myIndex = 0;
    carousel();

    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);

    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dots");
      if (n > slides.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";  
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }

      slides[slideIndex-1].style.display = "block";  
      dots[slideIndex-1].className += " active";
    }

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dots");
        for (i = 0; i < x.length; i++) {
           x[i].style.display = "none";  
        }
        for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace("active", "");
        }

        myIndex++;
        if (myIndex > x.length) {myIndex = 1}    
        x[myIndex-1].style.display = "block";  
        setTimeout(carousel, 4000); // Change image every 5 seconds
    }
</script>
