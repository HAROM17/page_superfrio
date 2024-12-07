document.addEventListener("DOMContentLoaded", function () {
    const accountLink = document.getElementById("accountLinkMovil");
    const wishlistLink = document.getElementById("wishlistLink");

    if (accountLink) {
        accountLink.addEventListener("click", function (event) {
            event.preventDefault();
            const loginModal = new bootstrap.Modal(document.getElementById("authModal"));
            loginModal.show();
        });
    }

    if (wishlistLink) {
        wishlistLink.addEventListener("click", function (event) {
            event.preventDefault();
            if (isAuthenticated) {
                window.location.href = "favoritos.php";
            } else {
                const authModal = new bootstrap.Modal(document.getElementById("authModal"));
                authModal.show();
            }
        });
    }
});
