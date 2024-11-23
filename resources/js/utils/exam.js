/**
 * Updates the corresponding question box to the given state
 * 
 * @param {number} questionId - The id of the question
 * @param {"idle"|"active"|"indertiminate"|"prev"} state - The state to toggle the box into
 */
export function updateQuestionBox(questionId, state) {
    const box = document.querySelector(`[question-id="${questionId}"]`);

    if (box === null) {
        console.error(`Question box with the id of ${questionId} does not exist!`);
        return;
    }

    const activeStyles = ["bg-primary", "text-white"];
    const idleStyles = ["bg-gray-100"];
    const indertiminateStyles = ["bg-caution"];

    if (state === "prev") {
        const prevState = box.getAttribute("data-prev-state");

        if (!prevState) {
            console.warn(`Box doesn't have a previous state to return to [id: ${questionId}]!`)
            updateQuestionBoxState(box, "idle");
            state = "idle";
        } else {
            const prev = /** @type {"idle"|"active"|"indertiminate"} */ (prevState)
            state = prev;
        }
    }

    switch (state) {
        case "active":
            box.classList.remove(...indertiminateStyles, ...idleStyles);
            box.classList.add(...activeStyles);

            updateQuestionBoxState(box, state);
            break;

        case "idle":
            box.classList.remove(...activeStyles, ...indertiminateStyles);
            box.classList.add(...idleStyles);

            updateQuestionBoxState(box, state);
            break;

        case "indertiminate":
            box.classList.remove(...activeStyles, ...idleStyles);
            box.classList.add(...indertiminateStyles);

            updateQuestionBoxState(box, state);
            break;
    
        default:
            console.error(`Invalid state for question box: ${state}!`);
            break;
    }
}

/**
 * Update the state of a question box
 * 
 * @param {Element} questionBox 
 * @param {"idle"|"active"|"indertiminate"} state 
 */
export function updateQuestionBoxState(questionBox, state) {
    const prev = questionBox.getAttribute("data-prev-state");
    const current = questionBox.getAttribute("data-state");

    if (!prev || !current) {
        console.error("Question box doesn't have the required prev-state & state attributes!");
        return;
    }

    questionBox.setAttribute("data-prev-state", current);
    questionBox.setAttribute("data-state", state);
}
