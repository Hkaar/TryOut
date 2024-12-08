'use strict';

import { save, toggleChoiceBox, updateQuestionList } from "./core.js";

export default function setupQuestionEditor() {
    const typeSelect = document.querySelector('select[name="question_type_id"]');
    const questionForm = document.getElementById('questionForm');
    const questionList = document.getElementById('questionList');

    if (!(typeSelect instanceof HTMLSelectElement)) {
        console.error("Select element with the name question_type_id doesn't exist!");
        return;
    }

    if (!(questionForm instanceof HTMLFormElement)) {
        console.error("question form must be a form element!");
        return;
    }

    if (questionList === null) {
        console.error("question list does not exist!");
        return;
    }

    typeSelect.addEventListener("change", () => {
        const selected = typeSelect.options[typeSelect.selectedIndex];

        if (selected.text.toLowerCase() === 'pilihan ganda' ) {
            toggleChoiceBox(true);
        } else {
            toggleChoiceBox(false);
        }
    });

    questionForm.addEventListener("submit", function (e) {
        save(e, this);
        updateQuestionList(questionList);
    });

    updateQuestionList(questionList);
}