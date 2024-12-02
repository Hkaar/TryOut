'use strict';

/**
 * Setup preview functionality for images
 */
export function setupPreviewImage() {
    document.addEventListener("change", (event) => {
        if (!(event.target instanceof Element)) {
            console.error(`Element target of event change ${event} doesnt exist!`);
            return;
        }

        if (event.target.matches("[preview-target]")) {
            if (!(event.target instanceof HTMLInputElement)) {
                console.error("Element forpreview input must be a input element!");
                return;
            }
            
            updatePreviewImage(event.target);
        }
    });
}

/**
 * Updates the preview image based on the image input
 * 
 * @param {HTMLInputElement} element - The form input for images
 */
function updatePreviewImage(element) {
    let file = element.files ? element.files[0] : null;
    const previewTarget = element.getAttribute('preview-target');
    const previewClasses = element.getAttribute('preview-classes');

    if (previewTarget === null) {
        console.error(`Input element doesn't have a valid preview target!`);
        return;
    }

    let preview = document.querySelector(previewTarget);

    if (preview === null) {
        console.error(`Preview element ${previewTarget} doesn't exist!`);
        return;
    }

    if (file && preview) {
        let reader = new FileReader();
        
        reader.onload = (e) => {
            let result = e.target?.result;

            if (result && file.type.startsWith("image") && typeof result === "string") {
                let img = document.createElement("img");
                img.setAttribute("src", result);
                img.classList.add("block", "w-2/3", "aspect-square", "bg-cover");

                if (previewClasses !== null) {
                    previewClasses.split(' ').forEach(styleClass => {
                        img.classList.add(styleClass);
                    });
                }
            
                while (preview.firstChild) {
                    preview.removeChild(preview.firstChild);
                }
            
                preview.appendChild(img);
            } else {
                preview.textContent = "Gambar tidak tersedia";
            }
        }

        reader.readAsDataURL(file);
    }
}