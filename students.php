<?php

/**
 * Set of PHP functions that fetches students from an endpoint, sorts them and returns a student at a given position
 *
 * @return array
 */
function getStudents(): array
{
    $curl = curl_init('https://d68b3d3a-38f9-4da4-9acf-5b4a29ccc098.mock.pstmn.io/students');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = json_decode(curl_exec($curl), true);
    return $response['data'];
}

function sortStudents(array $students): array
{
    // edit the code below
    usort($students, function ($a_student, $b_student) {
        return $a_student['averageScore'] < $b_student['averageScore'];
    });

    $position = 1;

    foreach ($students as $key => $value) {
        if ($key > 0 && $value['averageScore'] < $students[$key - 1]['averageScore']) {
            $position += 1;
        }
        // $position += 1;
        $students[$key]['position'] = $position;
    }

    return $students;
}

function findStudentByPosition(array $students, int $position): array
{
    // edit the code below

    // print_r($students);

    return $students[array_search($position, array_column($students, 'position'))];
}

$students = getStudents();

$sortedStudents = sortStudents($students);

print_r(findStudentByPosition($sortedStudents, 1));
print_r(findStudentByPosition($sortedStudents, 2));
print_r(findStudentByPosition($sortedStudents, 12));
