// QR Show Script
function showQRCode(src) {
    const modal = document.getElementById("qrCodeModal");
    const modalImg = document.getElementById("qrCodeImage");
    modalImg.src = src; // Set the source of the image
    modal.style.display = "block"; // Display the modal
}

function closeQRCode() {
    document.getElementById("qrCodeModal").style.display = "none";
}

// QR Print Script
function printDerm(derm, qrCodeSrc) {
    // Inject content into the print area
    const printContent = document.getElementById("printContent");
    printContent.innerHTML = `
    <h1>${derm}</h1>
    <img src="${qrCodeSrc}" style="width:300px;height:300px;margin:20px 0;">
    <p>Scan the QR code above to access the details for ${derm}.</p>
`;

    // Show the print area and trigger the print dialog
    const printArea = document.getElementById("printArea");
    printArea.style.display = "block";
    window.print();

    // Hide the print area after printing
    printArea.style.display = "none";
}

// Account Delete
function confirmDelete(userId) {
    if (confirm("Are you sure you want to delete this account?")) {
        document.getElementById("delete-form-" + userId).submit();
    }
}

// Accont View
function fetchAccountDetails(id) {
    // Fetch account details via AJAX
    fetch(`/accountShow/${id}`)
        .then(response => response.text())
        .then(data => {
            // Insert the HTML content into the modal body
            document.querySelector('#accountModal .modal-body').innerHTML = data;
        });
}