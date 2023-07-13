import { forEach } from "lodash";
import * as Chart from "./charts.js";

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
    let main = document.getElementsByTagName("main")[0];
    let sidebar = document.getElementsByTagName("aside")[0];
    let sidebarResizer = document.getElementsByClassName("sidebar-resizer")[0];
    let sidebarResizerChevron = sidebarResizer.querySelector("i");
    let links = sidebar.querySelectorAll("a");
    let dropMasters = sidebar.querySelectorAll(".drop-master-data");
    window.Var.resized = !window.Var.resized;

    if (window.Var.resized) { //Ingrandisco la sidebar
        topbar.classList.add("topbar-resized");
        sidebar.classList.add("sidebar-resized");
        main.classList.add("main-resized");

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
        main.classList.remove("main-resized");

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

export function drawChart(){
    let chartContainers = document.getElementsByClassName("chart-container-data");

    if(chartContainers.length > 0){
        for(let i = 0; i < chartContainers.length; i++){
            let chartId = chartContainers[i].dataset.chartId;
            let chartType = chartContainers[i].dataset.chartType;
            let chartTitle = chartContainers[i].dataset.chartTitle;
            let chartData = JSON.parse(chartContainers[i].dataset.chartData);
            let chartLabel = chartContainers[i].dataset.chartLabel;
            let chartYLabel = chartContainers[i].dataset.chartYLabel;
            let chartXLabel = chartContainers[i].dataset.chartXLabel;
            let chartYParam = chartContainers[i].dataset.chartYParam;
            let chartTooltipExtra = chartContainers[i].dataset.chartTooltipExtra;

            if(chartTitle == undefined)
                chartTitle = "";
            if(chartYLabel == undefined)
                chartYLabel = "";
            if(chartXLabel == undefined)
                chartXLabel = "";
            if(chartYParam == undefined)
                chartYParam = "";

            switch(chartType){
                case "line-chart":
                    Chart.lineChart(chartId, chartData, chartTitle, chartLabel, chartYLabel, chartXLabel, chartYParam, chartTooltipExtra);
                    break;
                case "bar-chart":
                    Chart.barChart(chartId, chartData, chartTitle, chartLabel, chartYLabel, chartXLabel, chartYParam, chartTooltipExtra);
                    break;
            }
        }
    }
}

export function askConfirm(e) {
    console.log(e);
    e.preventDefault();
    e.stopPropagation();
    let confirmElement = document.getElementsByClassName("al-confirm")[0];
    confirmElement.classList.remove("d-none");
}

export function removeConfirmElementHandler(e) {
    let needToRemove = false;
    let confirmElement = document.getElementsByClassName("al-confirm")[0];

    if (confirmElement != null) {
        if (!confirmElement.classList.contains("d-none")) {
            let confirmElementLeft = confirmElement.getBoundingClientRect().x;
            let confirmElementRight = confirmElementLeft + confirmElement.getBoundingClientRect().width;
            let confirmElementTop = confirmElement.getBoundingClientRect().y;
            let confirmElementBottom = confirmElementTop + confirmElement.getBoundingClientRect().height;

            if ((e.clientX < confirmElementLeft || e.clientX > confirmElementRight) || (e.clientY < confirmElementTop || e.clientY > confirmElementBottom))
                needToRemove = true;
        }
    }

    if (needToRemove)
        confirmElement.classList.add("d-none");
}

export function removeConfirmElement() {
    let confirmElement = document.getElementsByClassName("al-confirm")[0];
    confirmElement.classList.add("d-none");
}

export function submitForm(e) {
    let parent = e.currentTarget.closest(".al-confirm");
    let form = parent.querySelector("form");

    form.submit();
}

export function submitExternalForm() {
    let form = document.getElementsByTagName("form");
    form.submit();
}

export function submitFormIndex(e, index){
    e.preventDefault();

    let form = document.getElementsByTagName("form")[index];
    form.submit();
}

export function validateEqualFields(event, firstElementId, secondElementId, errorElementId, errorMex) {
    event.preventDefault();

    let result = false;
    let firstElement = document.getElementById(firstElementId);
    let secondElement = document.getElementById(secondElementId);
    let errorElement = document.getElementById(errorElementId);

    if(firstElement.value == secondElement.value)
        result = true;
    else{
        firstElement.classList.add("is-invalid");
        firstElement.value = "";
        secondElement.value = "";
        errorElement.classList.add("d-block");
        let strong = errorElement.querySelector("strong");
        strong.textContent = errorMex;
    }

    return result;

}


