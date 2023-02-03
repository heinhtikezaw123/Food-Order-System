$(document).ready(function(){
    //when plus button clicked
    $('.btn-plus').click(function() {
        $parentNode = $(this).parents('tr');
        $price = Number($parentNode.find('#pizzaPrice').text().replace("Kyats",""));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price*$qty;
        $parentNode.find('#total').html($total + "Kyats");

        summaryCalculation();
    })

    //when minus button clicked
    $('.btn-minus').click(function() {
        $parentNode = $(this).parents('tr');
        $price = Number($parentNode.find('#pizzaPrice').text().replace("Kyats",""));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price*$qty;
        $parentNode.find('#total').html($total + "Kyats");

        summaryCalculation();
    })

    

    //final calculation common function
    function summaryCalculation() {
        $totalPrice = 0;
        $('#dataTable tbody tr').each(function(index,row) {
            $totalPrice += Number($(row).find('#total').text().replace("Kyats",""));
        });
        $('#subTotal').html(`${$totalPrice} Kyats`)
        $('#finalTotal').html(`${$totalPrice + 3000} Kyats`)
    }
})
