import axios from "axios";
import SingleLineChart from "./chart.js";

import { examAPIRoute } from "../variables.js";

/**
 * Sets up the required admin home charts
 */
function setupAdminHomeCharts() {
    axios.get(`${examAPIRoute}/statistics`)
        .then(response => {
            const { daily_user_counts, dates } = response.data;
            console.log(daily_user_counts, dates)

            SingleLineChart('.hs-single-area-chart', {
                labels: dates,
                chartTitle: 'Jumlah Ujian',
                data: daily_user_counts,
                toolTipFormatX: "MMMM dd DD"
            });
        })
        .catch(error => {
            console.error("Error fetching exam statistics:", error);
        });
}

/**
 * Convinient setup wrapper for all the admin setup functions
 */
export default function setupAdminCharts() {
    setupAdminHomeCharts();
}