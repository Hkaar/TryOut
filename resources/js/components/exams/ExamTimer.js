/**
 * The component responsible for displaying the current exam time
 * 
 * @returns HTMLSpanElement
 */
export default function ExamTimer() {
    const root = document.createElement("span");
    root.className = "font-semibold px-3 py-2 lg:px-4 lg:py-3 rounded-full bg-primary text-white w-28 lg:w-32 text-center";
    root.id = "examTimer";
    root.textContent = "00:00:00";

    return root
}