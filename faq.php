<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
        <?php 
            if (!isset($_GET['page']))
                echo "FAQ Page";
        ?>
    </title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/justified-nav.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="faq_area section_padding_130" id="faq">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-lg-6">
                    <!-- Section Heading-->
                    <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <h3><span>Frequently</span> Asked Questions</h3>
                        <p>Discover a captivating world of visual storytelling at our photo and canvas gallery website. Immerse yourself in stunning imagery across various categories, from landscapes to portraits, and bring the beauty of art into your space with our premium canvas prints.</p>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <!-- FAQ Area-->
                <div class="col-12 col-sm-10 col-lg-8">
                    <div class="accordion faq-accordian" id="faqAccordion">
                        <div class="card border-0 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            <div class="card-header" id="headingOne">
                                <h6 class="mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">How do I create an account on the website?<span class="lni-chevron-up"></span></h6>
                            </div>
                            <div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto quidem facere deserunt sint animi sapiente vitae suscipit.</p>
                                    <p>Appland is completely creative, lightweight, clean &amp; super responsive app landing page.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 wow fadeInUp" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                            <div class="card-header" id="headingTwo">
                                <h6 class="mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Are the photos I purchase watermarked?<span class="lni-chevron-up"></span></h6>
                            </div>
                            <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto quidem facere deserunt sint animi sapiente vitae suscipit.</p>
                                    <p>Appland is completely creative, lightweight, clean &amp; super responsive app landing page.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                            <div
