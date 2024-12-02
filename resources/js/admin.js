'use strict';

import axios from "axios";
import toastr from "toastr";

import { CreateLineChart } from "./utils/chart.js";
import { request } from "./utils/network.js";

import { examAPIRoute } from "./variables.js";

export function setupHomeCharts() {
    request(async () => {
        const response = await axios.get(`${examAPIRoute}/statistics`);
        /** @type {Admin.ExamParticipationData} */
        const data = response.data;

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

            case 400:
                toastr.error(
                    "Oops! Terjadi kesalahan dalam permintaan data. Silakan periksa kembali input atau coba lagi.",
                    "Bad Request"
                );
                console.debug(
                    `Error fetching exam participation data | 400 Bad Request | Response:`,
                    response
                );
                break;

            case 500:
                toastr.error(
                    "Maaf, terjadi masalah saat mengambil data dari server. Mohon coba lagi nanti.",
                    "Server Error"
                );
                console.debug(
                    `Error fetching exam participation data | 500 Internal Server Error | Response:`,
                    response
                );
                break;

            default:
                break;
        }
    });
}
