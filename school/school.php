<?php

class Human
{
    public $full_name;
    public $age;
    public $iq;

    function __construct($full_name, $age, $iq)
    {
        $this->full_name = $full_name;
        $this->age = $age;
        $this->iq = $iq;
    }

    function introduce()
    {
        echo 'Hello!I am "' . $this->full_name . '". I am "' . $this->age . '"years old.my IQ rate is "' . $this->iq . '"';
    }
}

class Student extends Human
{
    public $grade;
    public $lesson; //array
    public $score; //array

    function __construct($full_name, $age, $iq, $grade, $lesson, $score)
    {
        $this->full_name = $full_name;
        $this->age = $age;
        $this->iq = $iq;
        $this->grade = $grade;
        $this->lesson = $lesson;
        $this->score = [];
    }

    function introduce_student()
    {
        echo 'Hello!I am "' . $this->full_name . '". I am "' . $this->age . '" years old.My IQ rate is "' . $this->iq . '".the level i study is "' . $this->grade . '" and my lessons are "' . $this->lesson . '" and here is my last "' . $this->score . '" list!!';
    }
    // function give_exam($students , $exams){
    //     foreach($students as $student){
    //         foreach($exams as $exam){
    //             $result = take_exam($student , $exam);
    //             return $result;
    //         }
    //     }
    // }
}

class Teacher extends Human
{
    public $level;
    public $course;

    function __construct($full_name, $age, $iq, $level, $course)
    {
        $this->full_name = $full_name;
        $this->age = $age;
        $this->iq = $iq;
        $this->level = $level;
        $this->course = $course;
    }

    function introduce_teacher()
    {
        echo 'Hello!I am "' . $this->full_name . '". I am "' . $this->age . '"years old.my IQ rate is "' . $this->iq . '".the level i teach is "' . $this->level . '" and my experties is "' . $this->course . '"';
    }

    function take_exam($exam1, $student1)
    {

        $choosen_exam = [];
        foreach ($exam1 as $exam) {
            if ($exam->exam_level == $this->level) {
                echo "your exam level matches to your teacher level";
                echo "<Br/>";
                if ($this->course == $exam->exam_course) {
                    echo "this is an exam you can take";
                    echo "<Br/>";
                    array_push($choosen_exam, $exam);
                } else {
                    echo "your exam course does not match with this exam how ever your level does";
                    echo "<Br/>";
                }
            } else {
                echo "your exam level does not match to your teacher";
                echo "<Br/>";
            }
        }

        $choosen_student = [];
        foreach ($student1 as $student) {
            if ($this->level == $student->grade) {
                echo "your grade match to your teacher level";
                foreach ($student->lesson as $course) {
                    if ($course == $this->course) {
                        array_push($choosen_student, $student);
                        echo "your course is match with teacher course";
                        echo "<Br/>";
                    } else {
                        echo "your course does not match to your teacher how ever your level does";
                        echo "<Br/>";
                    }
                }
            } else {
                echo "your grade does not match to your teacher level";
                echo "<Br/>";
            }
        }

        foreach ($choosen_exam as $exam) {
            foreach ($choosen_student as $student) {
                print_r($student);
                $exam->cal_marks($student);
            }
        }

    }
}

class Exam
{
    public $exam_level;
    public $exam_course;
    public $exam_hardness;

    function __construct($exam_level, $exam_course, $exam_hardness)
    {
        $this->exam_level = $exam_level;
        $this->exam_course = $exam_course;
        $this->exam_hardness = $exam_hardness;
    }

    function cal_marks($students)
    {
        foreach ($students as $student) {
            $marks = $student->iq + (1 - $this->exam_hardness) * 100;
            array_push($student->score, $marks);
            return $marks;
        }
    }
}

$human1 = new Human("mina mina", 20, 0.5);

$teachers = [
    new Teacher("teacher1", 30, 1, 4, "math"),
    new Teacher("teacher2", 35, 0.9, 3, "physics"),
    new Teacher("teacher3", 40, 0.8, 2, "sience"),
    new Teacher("teacher4", 45, 0.7, 1, "litrature")
];

$students = [
    new Student("student1", 20, 0.8, 2, ["math", "english", "physics", "sience"], []),
    new Student("student2", 20, 0.6, 1, ["math", "english", "physics", "sience"], []),
    new Student("student3", 20, 0.5, 3, ["math", "english", "physics", "sience"], []),
    new Student("student4", 20, 0.7, 4, ["math", "english", "physics", "sience"], [])
];

$exams = [
    new Exam(1, "sience", 0.4),
    new Exam(2, "litrature", 0.1),
    new Exam(3, "physics", 0.7),
    new Exam(4, "math", 1)
];

// echo $human1->introduce();
// echo "<Br/>";
// echo $teachers[1]->introduce_teacher();
// echo "<Br/>";
// echo $students[1]->introduce_student();
// echo "<Br/>";
// echo $teachers[1]->take_exam($students);
// echo "<Br/>";

foreach ($teachers as  $teacher) {
     print_r($teacher);
    echo "<br/>";

    echo "<h1>$teacher->full_name</h1>";
    $teacher->take_exam($exams, $students);
    echo "<hr/>";
}

foreach ($students as $student) {
    echo "<h1>$student->full_name</h1>";

    foreach ($student->score as $score) {
        print_r($score);
        echo "<br/>";
    }
    echo "<hr/>";
}
?>