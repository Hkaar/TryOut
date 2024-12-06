<?php

namespace App\Exports;

use App\Models\ExamResult;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExamResultExport implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnWidths, WithColumnFormatting, WithStyles
{
    public function __construct(
        private ?int $examId = null,
        private ?int $groupId = null,
        private ?int $userId = null,
    ) {
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $dataset = ExamResult::query();

        if ($this->examId) {
            $dataset->byExamId($this->examId);
        }

        if ($this->groupId) {
            $dataset->byGroupId($this->groupId);
        }

        if ($this->userId) {
            $dataset->byUserId($this->userId);
        }

        $results = $dataset->with(['exam', 'user'])->get();

        return $results->map(function ($result, $key) {
            return [
                $key + 1,
                $result->user->name,
                $result->exam->name,
                Date::dateTimeToExcel(Carbon::parse($result->start_date)),
                Date::dateTimeToExcel(Carbon::parse($result->last_date)),
                $result->finished ? 'Selesai' : 'Belum selesai',
                $result->grade > 0 ? $result->grade : '0',
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No.',
            'Nama peserta',
            'Nama ujian',
            'Tanggal mulai',
            'Tanggal terakhir',
            'Status',
            'Nilai',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 23,
            'C' => 35,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'protection' => [
                    'locked' => true,
                ]
            ],
            'A' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            ],
            'B' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ]
            ],
            'C' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ]
            ],
            'D' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            ],
            'E' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            ],
            'F' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            ],
            'G' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            ]
        ];
    }
}
