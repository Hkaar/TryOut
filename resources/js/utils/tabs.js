/**
 * The setup function for enabling the tab plugin util
 */
export default function setupTabs() {
    document.querySelectorAll("[data-tab]").forEach(element => {
        const tab = /** @type {HTMLElement} */ (element);

        const targetSelector = tab.getAttribute("data-tab-target");
        const tabGroup = tab.getAttribute("data-tab");

        if (!targetSelector || !tabGroup) {
            console.error("Tab widget is missing required 'data-tab-target' or 'data-tab' attributes!");
            return;
        }

        const targetElement = document.querySelector(targetSelector);

        if (!targetElement) {
            console.error(`Target element ${targetSelector} not found!`);
            return;
        }

        tab.classList.contains("active")
            ? targetElement.classList.remove("hidden")
            : targetElement.classList.add("hidden");

        tab.addEventListener("click", () => {
            const targetElement = document.querySelector(targetSelector);

            if (!targetElement) {
                console.error(`Target element ${targetSelector} not found!`);
                return;
            }

            document.querySelectorAll(`[data-tab-group=${tabGroup}]`).forEach(tab => tab.classList.remove("active"));
            tab.classList.add("active");

            switchPanel(targetElement, tabGroup);
        });
    });
}

/**
 * Switches to the selected tab panel and hides all other panels in the same group.
 * 
 * @param {Element} target 
 * @param {string} group
 */
function switchPanel(target, group) {
    document.querySelectorAll(`[data-panel-group=${group}]`).forEach(panel => {
        panel.classList.add("hidden");
    });

    target.classList.remove("hidden");
}
