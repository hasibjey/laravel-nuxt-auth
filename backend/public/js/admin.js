const items = document.querySelectorAll(".zb-nav-item");
const subNavGroup = document.querySelectorAll(".zb-sub-nav-group");

items.forEach((item, i) => {
    item.addEventListener("click", (e) => {
        console.log('ok')
        const navLink = e.target;
        const arrow = e.target.children[2];
        const subNav = e.target.nextElementSibling;

        // Lick active
        if (navLink) {
            if (navLink.classList.contains("active")) {
                navLink.classList.remove("active");
                if (arrow) arrow.classList.remove("after:!-rotate-0");
            } else {
                items.forEach((item) => {
                    item.children[0].classList.remove("active");
                    if (item.children[0].children[2])
                        if (item.children[0].children[2])
                            item.children[0].children[2].classList.remove("after:!-rotate-0");
                });
                navLink.classList.add("active");
                if (arrow) arrow.classList.add("after:!-rotate-0");
            }
        }

        // Sub navigation toggle
        if (subNav) {

            if (subNav.classList.contains("sub-active")) {
                subNav.classList.remove("sub-active", "flex");
                subNav.classList.add("hidden");
            } else {
                subNavGroup.forEach((sub) => {
                    sub.classList.remove("sub-active", "flex");
                    sub.classList.add("hidden");
                });
                subNav.classList.add("sub-active", "flex");
                subNav.classList.remove("hidden");
            }
        }
    });
});

/**
 * sub navigation item active
 **/
const subNabItems = document.querySelectorAll(".zb-sub-nav-item");
if (subNabItems) {
    subNabItems.forEach((subItem) => {
        subItem.addEventListener("click", (e) => {
            e.stopPropagation();

            const subNavLink = e.target;

            if (subNavLink.classList.contains("active")) {
                subNavLink.classList.remove("active");
            } else {
                subNabItems.forEach((sub) => {
                    sub.children[0].classList.remove("active");
                });
                subNavLink.classList.add("active");
            }
        });
    });
}

/**
 * Aside toggle
 */
const navBar = document.querySelector(".nav-bar");
const aside = document.querySelector(".aside");
const asideBlank = document.querySelector(".aside-blank");
let windowWidth = window.innerWidth;
window.addEventListener("resize", () => {
    windowWidth = window.innerWidth;
});

if (navBar) {
    navBar.addEventListener("click", (e) => {
        if (windowWidth <= 1279) {
            aside.classList.toggle("active-sm");
        } else {
            aside.classList.toggle("active");
            asideBlank.classList.toggle("!w-0");
        }
    });
}

/**
 * Custom upload file
 */
const inputFile = document.querySelector(".custom-file-upload");
const textFile = document.querySelector(".custom-file-upload p");
const fileButton = document.querySelector(".custom-file-upload button");

if (fileButton) {
    fileButton.addEventListener("click", (e) => {
        e.preventDefault();
        e.target.previousElementSibling.previousElementSibling.click();
    });
}

if (inputFile) {
    inputFile.addEventListener("change", (e) => {
        let fileName =
            e.target.files.length > 0 ? e.target.files[0].name : "Choose file";
        e.target.nextElementSibling.textContent = fileName;
    });
}

/**
 * Full screen the browser window
 */
const toggleFullScreen = () => {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen().catch((err) => {
            alert(`Error: ${err.message}`);
        });
    } else {
        document.exitFullscreen();
    }
};
