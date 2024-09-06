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
        .then((response) => response.text())
        .then((data) => {
            // Insert the HTML content into the modal body
            document.querySelector("#accountModal .modal-body").innerHTML =
                data;
        });
}

// Profile Modal Script
document.addEventListener("DOMContentLoaded", function () {
    const profileModalEl = document.getElementById("profileModal");
    const profileModal = new bootstrap.Modal(profileModalEl);
    const profileForm = document.getElementById("profileForm");

    // Store the original form values when the page loads
    const originalValues = {
        username: document.getElementById("username").value,
        first_name: document.getElementById("first_name").value,
        last_name: document.getElementById("last_name").value,
        contact_number: document.getElementById("contact_number").value,
        email: document.getElementById("email").value,
    };

    // Reset form and clear errors when the modal is closed
    profileModalEl.addEventListener("hidden.bs.modal", function () {
        // Restore original form values
        document.getElementById("username").value = originalValues.username;
        document.getElementById("first_name").value = originalValues.first_name;
        document.getElementById("last_name").value = originalValues.last_name;
        document.getElementById("contact_number").value =
            originalValues.contact_number;
        document.getElementById("email").value = originalValues.email;

        // Clear password fields
        document.getElementById("password").value = "";
        document.getElementById("password_confirmation").value = "";

        // Clear error messages
        document
            .querySelectorAll(".text-danger")
            .forEach((el) => (el.innerHTML = ""));

        // Remove slide-down class after modal is hidden
        profileModalEl
            .querySelector(".modal-dialog")
            .classList.remove("slide-down");
    });

    // Add slide-down effect when the modal is being closed
    profileModalEl.addEventListener("hide.bs.modal", function () {
        profileModalEl
            .querySelector(".modal-dialog")
            .classList.add("slide-down");
    });

    // Keep the modal open if there are validation errors
    if (window.validationErrors) {
        profileModal.show();
    }
});


// Side Navbar Hamburger
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const hamburger = document.getElementById('hamburgerToggle');
    const mainContent = document.querySelector('.main-content');
    const dropdownMenus = document.querySelectorAll('.dropdown-menu');

    function updateSidebarState() {
        if (window.innerWidth > 992) {
            sidebar.classList.remove('active');
            mainContent.style.marginLeft = '250px'; // Set margin-left when sidebar is visible
            hamburger.style.display = 'none'; // Hide hamburger icon on large screens
        } else {
            sidebar.classList.remove('active');
            mainContent.style.marginLeft = '0'; // Remove margin-left when sidebar is hidden
            hamburger.style.display = 'block'; // Show hamburger icon on small screens
        }
    }

    // Initial check
    updateSidebarState();

    // Toggle sidebar when the hamburger icon is clicked
    hamburger.addEventListener('click', function() {
        sidebar.classList.toggle('active');

        if (sidebar.classList.contains('active')) {
            mainContent.style.marginLeft = '0'; // Remove margin-left when sidebar is active
        } else {
            mainContent.style.marginLeft = '0'; // Keep margin-left when sidebar is hidden
        }
    });

    // Update sidebar state on window resize
    window.addEventListener('resize', updateSidebarState);

    // Optional: Close sidebar when clicking outside of it, excluding dropdowns and sidebar
    document.addEventListener('click', function(event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickInsideHamburger = hamburger.contains(event.target);
        const isClickInsideDropdown = Array.from(dropdownMenus).some(dropdownMenu =>
            dropdownMenu.contains(event.target)
        );

        if (!isClickInsideSidebar && !isClickInsideHamburger && !isClickInsideDropdown) {
            sidebar.classList.remove('active');
            if (window.innerWidth > 992) {
                mainContent.style.marginLeft = '250px'; // Set margin-left when the sidebar is hidden on large screens
            } else {
                mainContent.style.marginLeft = '0'; // Reset margin-left on small screens
            }
        }
    });
});
