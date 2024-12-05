'use strict';

import axios from "axios";

import { CreateLineChart } from "./utils/chart.js";
import { request } from "./utils/network.js";

import { examAPIRoute } from "./variables.js";

export function setupHomeCharts() {
    request(async () => {
        const response = await axios.get(`${examAPIRoute}/statistics`);
        const data = /** @type {Admin.ExamParticipationData} */ (response.data);

        switch (response.status) {
            case 200:
                CreateLineChart(
                    "#examParticipationChart",
                    [
                        {
                            name: "Jumlah pengerjaan",
                            data: data.examAmount,
                        },
                        {
                            name: "Jumlah penyelesaian",
                            data: data.finished,
                        },
                    ],
                    {
                        labels: [
                            "Senin",
                            "Selasa",
                            "Rabu",
                            "Kamis",
                            "Jumat",
                            "Sabtu",
                            "Minggu",
                        ],
                    }
                );
                break;

            default:
                break;
        }
    });
}
