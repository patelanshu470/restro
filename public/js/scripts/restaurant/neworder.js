// new order alert..
function getData() {
    $.ajax({
      url: checkneworder,
      type: "GET",
      success: function(data) {
        // update your page with the new data
        if (data) {
            Swal.fire({
          title: "You have new order, check please.",
          icon: "non",
          showCancelButton: false,
          confirmButtonColor: "#EA6A12",
          confirmButtonText: "Ok, let me check",
          onOpen: function () {
            var audplay = new Audio(assetBaseUrl)
            audplay.play();
        }
      }).then((result) => {
          if (result.isConfirmed) {
              document.getElementById('index_page').click();
          } else
              return false;
      });
      document.getElementById('check').click();
      document.getElementById('audio').play();
        }
      }
    });
  }
  setInterval(getData, 5000); // 1000 milliseconds = 1 second

//   new order update...
  $('#check').on('click',function() {
    var status = 1;
    $.ajax({
        type: "GET",
        dataType: "json",
        url: readneworder,
        data: {'status': status},
        success: function(data){
        }
    });
});
