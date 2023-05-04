function compute(i) {
    const n1 = parseInt(document.getElementById("test1" + i).value);
    const n2 = parseFloat(document.getElementById("num2" + i).value);
    const x = parseInt(document.getElementById("vouch" + i).value);
    const voucherOption = document.getElementById("vouch" + i);
    const voucherText = document.getElementById("voucherText" + i);
    if (n1 > -1) {

        var total = n1 * n2;
        if (n1 * n2 > x) {
            var computed = total - x;
            voucherText.innerHTML = "<i class='bx bx-check-circle'></i>";
            if (computed >= 0) {
                document.getElementById("totalAmount" + i).innerHTML = computed;
                document.getElementById("num3" + i).value = computed;
            } else {
                document.getElementById("totalAmount" + i).innerHTML = 0;
                document.getElementById("num3" + i).value = 0;
            }
        } else {
            for (var i = 0; i < voucherOption.length; i++) {
                voucherOption[i].selected = false;
            }
                voucherText.innerHTML = "Total amount must be atleast or above ₱ " + x;
            if (total > 0) {
                document.getElementById("totalAmount" + i).innerHTML = total;
                document.getElementById("num3" + i).value = total;
            } else {
                document.getElementById("totalAmount" + i).innerHTML = 0;
                document.getElementById("num3" + i).value = 0;
            }
        }
    }
}