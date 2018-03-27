

$(document).ready(function () {
    // Add scrollspy to <body>
    $('body').scrollspy({ target: ".navbar", offset: 50 });

    // Add smooth scrolling on all links inside the navbar
    $("#myNavbar a").on('click', function (event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (200) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 300, function () {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        }  // End if
    });
    $(".filter-button").click(function () {
        var value = $(this).attr('data-filter');

        if (value == "all") {
            //$('.filter').removeClass('hidden');
            $('.filter').show('500');
        }
        else {
            //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
            //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.' + value).hide('1000');
            $('.filter').filter('.' + value).show('1000');

        }
    });

    if ($(".filter-button").removeClass("active")) {
        $(this).removeClass("active");
    }
    $(this).addClass("active");

});
var myImage = document.getElementById("mainImage");

var imageArray = ["assets/img/gallery/1.jpg","assets/img/gallery/2.jpg","assets/img/gallery/3.jpg",
                  "assets/img/gallery/4.jpg","assets/img/gallery/5.jpg","assets/img/gallery/6.jpg"];
var imageIndex = 0;

function changeImage() {
    myImage.setAttribute("src",imageArray[imageIndex]);
    imageIndex++;
    if (imageIndex >= imageArray.length) {
        imageIndex = 0;
    }
}

// setInterval is also in milliseconds
var intervalHandle = setInterval(changeImage,2000);

myImage.onclick =  function() {
    clearInterval(intervalHandle);
};

$(document).ready(function($) {
    
    $.ajax({
        url:'API/api.php',
        type: 'GET',
        data:{method:"getFoodItems"},
        success: function (data) {
            console.log(data);
            if(data.status=='ok'){
                var key=data.data;
                for (var i=0;i<key.length;i++) {
                    //alert(key[i]);
                    html ='<div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter '+key[i].category_name+'">';
                    html +=     '<img src="'+key[i].imageUrl+'" class="img-responsive">';
                    html +=     '<h2>'+key[i].name+'</h2>';
                    html +=     '<p>'+key[i].description+'</p>';
                    html +=     '</div>';
                    $("#menu").append(html);
                }
               
            }
        },
        cache: false,
        contentType: false,
    });



});


