<!DOCTYPE html>
<html>

<head>
    @include ('home.css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
      .box{
        max-height: 315px;
      }
      .title{
        max-width: 120px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      .price{
      }
    </style>
</head>

<body>
  <div class="hero_area">

    <!-- header section starts -->
    @include ('home.header')
    <!-- end header section -->

    <!-- slider section -->
    @include ('home.slider')
    <!-- end slider section -->
    
  </div>
  <!-- end hero area -->

  <!-- shop section -->
  @include ('home.product')
  <!-- end shop section -->



  <!-- contact section -->
  @include ('home.contact')
  <!-- end contact section -->

   

  <!-- info section -->
  @include ('home.footer')

  

</body>

</html>