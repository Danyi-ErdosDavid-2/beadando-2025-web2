<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ExamDataSeeder extends Seeder
{
    public function run(): void
    {
        $dataPath = database_path('data');

        $students = $this->readCsv($dataPath . '/students.csv');
        $subjects = $this->readCsv($dataPath . '/subjects.csv');
        $exams = $this->readCsv($dataPath . '/exams.csv');

        Exam::query()->truncate();
        Student::query()->truncate();
        Subject::query()->truncate();

        Student::query()->upsert($students, ['id'], ['name', 'classroom']);
        Subject::query()->upsert($subjects, ['id'], ['name', 'oral_max', 'written_max']);
        Exam::query()->upsert($exams, ['id'], ['student_id', 'subject_id', 'oral_score', 'written_score']);
    }

    protected function readCsv(string $path): array
    {
        if (! File::exists($path)) {
            return [];
        }

        $rows = [];
        if (($handle = fopen($path, 'r')) !== false) {
            $header = fgetcsv($handle);
            $id = 1;
            while (($data = fgetcsv($handle)) !== false) {
                $rows[] = array_merge(
                    ['id' => $header[0] === 'id' ? (int) $data[0] : $id++],
                    $this->combineRow($header, $data)
                );
            }
            fclose($handle);
        }

        return $rows;
    }

    protected function combineRow(array $header, array $data): array
    {
        $row = [];

        foreach ($header as $index => $key) {
            if ($key === 'id') {
                continue;
            }
            $row[$key] = is_numeric($data[$index]) ? (int) $data[$index] : $data[$index];
        }

        return $row;
    }
}
