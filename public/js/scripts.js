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

// Account View
function fetchAccountDetails(id) {
    // Fetch account details via AJAX
    fetch(`/accountShow/${id}`)
        .then(response => response.text())
        .then(data => {
            // Insert the HTML content into the modal body
            document.querySelector('#accountModal .modal-body').innerHTML = data;
        });
}

// Profile Modal Script
document.addEventListener('DOMContentLoaded', function() {
    const profileModalEl = document.getElementById('profileModal');
    const profileModal = new bootstrap.Modal(profileModalEl);
    const profileForm = document.getElementById('profileForm');

    // Store the original form values when the page loads
    const originalValues = {
        username: document.getElementById('original-username').value,
        first_name: document.getElementById('original-first_name').value,
        last_name: document.getElementById('original-last_name').value,
        contact_number: document.getElementById('original-contact_number').value,
        email: document.getElementById('original-email').value
    };

    console.log('Original Values:', originalValues); // Debug log

    // Reset form, clear errors, and restore original values when the modal is closed
    profileModalEl.addEventListener('hidden.bs.modal', function() {
        console.log('Modal closed, resetting values'); // Debug log
        // Reset form fields to their original values
        document.getElementById('username').value = originalValues.username;
        document.getElementById('first_name').value = originalValues.first_name;
        document.getElementById('last_name').value = originalValues.last_name;
        document.getElementById('contact_number').value = originalValues.contact_number;
        document.getElementById('email').value = originalValues.email;

        // Clear password fields
        document.getElementById('password').value = '';
        document.getElementById('password_confirmation').value = '';

        // Clear error messages
        profileForm.reset();
        document.querySelectorAll('.text-danger').forEach(el => el.innerHTML = '');

        // Remove slide-down class after modal is hidden
        profileModalEl.querySelector('.modal-dialog').classList.remove('slide-down');
    });

    // Add slide-down effect when the modal is being closed
    profileModalEl.addEventListener('hide.bs.modal', function() {
        profileModalEl.querySelector('.modal-dialog').classList.add('slide-down');
    });

    // Show the modal if there are validation errors
    if (window.validationErrors) {
        profileModal.show();
    }
});
