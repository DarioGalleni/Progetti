document.addEventListener("DOMContentLoaded", function () {
    function generateReceiptNumber(length) {
        const charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        let result = "";
        for (let i = 0; i < length; i++) {
            result += charset.charAt(Math.floor(Math.random() * charset.length));
        }
        return result;
    }

    const receiptSpan = document.getElementById('receipt-number');
    if (receiptSpan) {
        receiptSpan.textContent += generateReceiptNumber(8);
    }

    window.print();
});
