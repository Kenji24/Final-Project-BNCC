document.addEventListener("DOMContentLoaded", function(){
    const hoverArea = document.getElementById('hoverArea');
    const userProfile = document.getElementById('userProfile');
    const overlay = document.getElementById('overlay');
    const close = document.getElementById('closeBtn');

    hoverArea.addEventListener('mouseenter', function(){
        userProfile.style.visibility = "visible";
        overlay.style.visibility = "visible";
        overlay.style.opacity = "1";
        document.body.style.overflow = "hidden";
        document.body.style.height = "100%";
        // document.body.style.margin = "0";
    });

    close.addEventListener("click", function(){
        userProfile.style.visibility = "hidden";
        overlay.style.visibility = "hidden";
        document.body.style.overflow = "";
        document.body.style.height = "";
    });
});

$(document).ready(function(){

    $(document).on('click', '.increaseBtn', function(){

        var $quantityInput = $(this).closest('.quantityBox').find('.quantityDisplay');
        var currentQuantity = parseInt($quantityInput.val());
        var Stock = $('.stock-display').text().trim();
        var maxStock = parseInt(Stock.split(':')[1].trim(), 10);


        if(!isNaN(currentQuantity) && currentQuantity < maxStock){
            var quantityVal = currentQuantity + 1;
            $quantityInput.val(quantityVal);
            $('#quantityInput').val(quantityVal);
        }
    });

    $(document).on('click', '.decreaseBtn', function(){

        var $quantityInput = $(this).closest('.quantityBox').find('.quantityDisplay');
        var currentQuantity = parseInt($quantityInput.val());

        if(!isNaN(currentQuantity) && currentQuantity > 1){
            var quantityVal = currentQuantity - 1;
            $quantityInput.val(quantityVal);
            $('#quantityInput').val(quantityVal);
        }
    });

});

$(document).on('click', '.confirm-delete', function(e){

    let form =  $(this).closest("form");
    e.preventDefault();

    Swal.fire({
        title: `Are you sure you want to delete this record?`,
        text: "If you delete this, it will be gone forever.",
        icon: "warning",
        buttons: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',

    }).then((result) => {

        if (result.isConfirmed) {
            form.submit();
        }
    });

});
