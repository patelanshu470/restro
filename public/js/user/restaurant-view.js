// category wise data..
$(document).ready(function(){
    $(".page-content")
    .hide()
    .first()
    .show();
});
$(".category-button").click(function() {
    $(".category-button").removeClass("active");
    $(this).addClass("active");
});
// Makes variables for button and page content
var $categoryButton = $(".category-button");
var $pageContent = $(".page-content");

// Hide all page content shows first one
$(".page-content")
    .hide()
    // .second()
    .show();
// When button is clicked, show content
$categoryButton.on("click", function(e) {
    var $category = $(this).data("target");
    $pageContent
        .hide()
        .find('img').hide()
        .end()
        .filter("." + $category)
        .show()
        .find('img').fadeIn();
});

// gallary image popup..
const images = [...document.querySelectorAll('.image')];
const popup = document.querySelector('.popup');
const closeBtn = document.querySelector('.close-btn');
const imageName = document.querySelector('.image-name');
const largeImage = document.querySelector('.large-image');
const imageIndex = document.querySelector('.index');
const leftArrow = document.querySelector('.left-arrow');
const rightArrow = document.querySelector('.right-arrow');
let index = 0;
images.forEach((item, i) => {
    item.addEventListener('click', () => {
        updateImage(i);
        popup.classList.toggle('active');
    })
})
const updateImage = (i) => {
    imageName.innerHTML = 'Gallary';
    index = i;
}
closeBtn.addEventListener('click', () => {
    popup.classList.toggle('active');
})

$('#book_tables').validate({
    rules: {
        first_name: {
          required: true
        },
        last_name: {
            required: true
        },
        email: {
            required: true
        },
        phone_number: {
            required: true
        },
        res_date: {
            required: true
        },
        guest_number: {
            required: true
        },
        tables: {
            required: true
        },
        to_time: {
            required: true
        },
        from_time: {
            required: true
        },
    },
    messages: {
        first_name: {
            required: "This first name field is required",
        },
        last_name: {
            required: "This last name field is required",
        },
        email: {
            required: "This email field is required",
        },
        phone_number: {
            required: "This phone number field is required",
        },
        res_date: {
            required: "This reservation date field is required",
        },
        guest_number: {
            required: "This no. of guest field is required",
        },
        tables: {
            required: "This table field is required",
        },


    }
});
