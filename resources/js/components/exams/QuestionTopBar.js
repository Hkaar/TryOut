import ExamTimer from "./ExamTimer.js";

/**
 * The question top bar of the container
 * 
 * @param {number} questionNumber 
 */
export default function QuestionTopBar(questionNumber) {
    const root = document.createElement("div");
    root.className = "rounded-t-lg bg-gradient-to-r from-accent to-secondary px-4 py-3 text-white line-clamp-1 flex items-center justify-between gap-2";

    const titleElement = document.createElement("h3");
    titleElement.className = "text-xl font-bold line-clamp-1";

    titleElement.textContent = `Soal ${questionNumber}`;

    root.appendChild(titleElement);
    root.appendChild(ExamTimer());

    return root;
}