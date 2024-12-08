import './bootstrap';

import Swal from 'sweetalert2';

import { importPlugin } from './utils/plugin.js';

/**
 * A function to toggle the side bar
 */
function toggleSideBar() {
    const sideBar = document.getElementById("sideBar");

    const sideNavItems = sideBar?.querySelectorAll(".side-nav-item");
    const sideBarMenus = document.querySelectorAll(".menu-text");

    if (sideBar?.classList.contains("-translate-x-full") || sideBar?.classList.contains("min-w-24")) {
        sideBar.classList.replace("-translate-x-full", "translate-x-0");
        sideBar.classList.replace("min-w-24", "w-full");
        sideBar.classList.add("xl:min-w-72");

        sideBarMenus.forEach((e) => {
            e.classList.remove("hidden");
        });
        
        sideNavItems?.forEach((e) => {
            e.classList.add("ps-3");
        });

        document.querySelectorAll(".sideOpenIcon").forEach(icon => icon.classList.add("hidden"));
        document.querySelectorAll(".sideCloseIcon").forEach(icon => icon.classList.remove("hidden"));

        document.body.classList.add("overflow-y-hidden", "md:overflow-y-auto");
    } else {
        sideBar?.classList.replace("translate-x-0", "-translate-x-full");
        sideBar?.classList.replace("w-full", "min-w-24");
        sideBar?.classList.remove("xl:min-w-72");

        sideBarMenus.forEach((e) => {
            e.classList.add("hidden");
        });

        sideNavItems?.forEach((e) => {
            e.classList.remove("ps-3");
        });

        document.querySelectorAll(".sideOpenIcon").forEach(icon => icon.classList.remove("hidden"));
        document.querySelectorAll(".sideCloseIcon").forEach(icon => icon.classList.add("hidden"));

        document.body.classList.remove("overflow-y-hidden", "md:overflow-y-auto");
    }
}

/**
 * Shows a modal upon an event being triggered
 * 
 * @param {CustomEvent<any>} event 
 */
function triggerModal(event) {
    if (!(event.target instanceof Element)) {
        console.error(`Issued event target ${event} was not an element!`);
        return;
    }

    if (event.target.matches('[delete-confirmation]')) {
        event.preventDefault();

        Swal.fire({
            title: "Konfirmasi",
            text: `Apakah anda yakin untuk menghapus ${event.detail.question} ini?`,
            icon: "question",
            showCancelButton: true,
            showConfirmButton: true,
            timer: 5000,
            timerProgressBar: true,
            backdrop: true,
            allowOutsideClick: false,
        }).then(response => {
            if (response.isConfirmed) {
                event.detail.issueRequest(true);

                Swal.fire({
                    title: "Berhasil!",
                    text: `Berhasil menghapus sebuah ${event.detail.question}!`,
                    icon: "success",
                    timer: 5000,
                    timerProgressBar: true,
                });
            }
        })

        return;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    'use strict';

    const sideBarToggles = document.querySelectorAll(".side-bar-toggle");
    sideBarToggles.forEach((e) => {
        e.addEventListener("click", toggleSideBar);
    });

    document.addEventListener("htmx:confirm", function(e) {
        const event = /** @type {CustomEvent<any>} */ (e);

        triggerModal(event);
    });

    importPlugin('exam', async () => {
        const mod = await import('./exams/index.js')
        mod.default();
    });
    
    importPlugin('question-editor', async () => {
        const mod = await import('./questionEditor/index.js');
        mod.default();
    });

    importPlugin('admin-charts-home', async () => {
        const mod = await import('./admin.js');
        mod.setupHomeCharts();
    });
    
    importPlugin('tabs', async () => {
        const mod = await import('./utils/tabs.js');
        mod.default();
    });

    importPlugin('image-preview', async () => {
        const mod = await import('./utils/forms.js');
        mod.setupPreviewImage();
    });

    importPlugin('timezone', async () => {
        const mod = await import('./utils/time.js');
        mod.setupAutoTimezone();
    });
});