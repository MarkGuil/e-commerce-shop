function compute() {
    const n1 = parseInt(document.getElementById("test1").value);
    const n2 = parseFloat(document.getElementById("num2").value);
    const n3 = parseInt(document.getElementById("totalAmount").innerHTML);
    const x = parseInt(document.getElementById("vouch").value);
    const voucherOption = document.getElementById("vouch");
    const voucherText = document.getElementById("voucherText");
    if (n1 > -1) {

        var total = n1 * n2;
        if (n1 * n2 > x) {
            var computed = total - x;
            voucherText.innerHTML = "";
            if (computed >= 0) {
                document.getElementById("totalAmount").innerHTML = computed;
                document.getElementById("num3").value = computed;
            } else {
                document.getElementById("totalAmount").innerHTML = 0;
                document.getElementById("num3").value = 0;
            }
        } else {
            for (var i = 0; i < voucherOption.length; i++) {
                voucherOption[i].selected = false;
            }
            voucherText.innerHTML = "Total amount must be atleast or above ₱ " + x;
            if (total >= 0) {
                document.getElementById("totalAmount").innerHTML = total;
                document.getElementById("num3").value = total;
            } else {
                document.getElementById("totalAmount").innerHTML = 0;
                document.getElementById("num3").value = 0;
            } 
        }
    }
}