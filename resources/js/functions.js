export function showMenu(e) {
    e.stopPropagation();
    let menu = e.currentTarget.querySelector(".al-menu");
    let menuData = e.currentTarget.closest(".al-menu-data");
    let height = menuData.offsetHeight;

    menu.classList.toggle("al-menu-visible");
    menu.style.top = `${height}px`;
}

export function removeMenusHandler() {
    let menus = document.getElementsByClassName("al-menu");

    for (let i = 0; i < menus.length; i++)
        menus[i].classList.remove("al-menu-visible");
}

export function resizeSidebar() {
    let topbar = document.getElementsByTagName("header")[0];
    let sidebar = document.getElementsByTagName("aside")[0];
    let sidebarResizer = document.getElementsByClassName("sidebar-resizer")[0];
    let sidebarResizerChevron = sidebarResizer.querySelector("i");
    let links = sidebar.querySelectorAll("a");
    let dropMasters = sidebar.querySelectorAll(".drop-master-data");

    window.Var.resized = !window.Var.resized;

    if (window.Var.resized) { //Ingrandisco la sidebar
        topbar.classList.add("topbar-resized");
        sidebar.classList.add("sidebar-resized");

        links.forEach(function (link) {
            let span = link.querySelector("span");
            span.classList.remove("d-none");
        });

        dropMasters.forEach(function (dropMaster) {
            let span = dropMaster.querySelector("span");
            span.classList.remove("d-none");
        });

        sidebarResizerChevron.classList.remove("fa-chevron-right");
        sidebarResizerChevron.classList.add("fa-chevron-left");
    }
    else { //Rimpicciolisco la sidebar
        topbar.classList.remove("topbar-resized");
        sidebar.classList.remove("sidebar-resized");

        links.forEach(function (link) {
            let span = link.querySelector("span");
            span.classList.add("d-none");
        });

        dropMasters.forEach(function (dropMaster) {
            let span = dropMaster.querySelector("span");
            span.classList.add("d-none");
        });

        sidebarResizerChevron.classList.remove("fa-chevron-left");
        sidebarResizerChevron.classList.add("fa-chevron-right");
    }
}

export function toggleMenu(event){
    let dropMenuData = event.currentTarget;
    let dropMenu = dropMenuData.querySelector(".drop-menu");
    let dropArrow = dropMenuData.querySelector(".drop-size");

    dropMenu.classList.toggle("drop-menu-grow");

    if(dropArrow.classList.contains("fa-chevron-left")){
        dropArrow.classList.remove("fa-chevron-left");
        dropArrow.classList.add("fa-chevron-down");
    }
    else{
        dropArrow.classList.remove("fa-chevron-down");
        dropArrow.classList.add("fa-chevron-left");
    }
}