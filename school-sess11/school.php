<?php

class Human {
    public $full_name;
    public $age;
    public $iq;

    function __construct($full_name, $age, $iq){
        $this->full_name = $full_name;
        $this->age = $age;
        $this->iq = $iq;
    }    

    function introduce(){
        echo 'Hello!I am "'.$this->full_name.'". I am "'.$this->age.'"years old.my IQ rate is "'.$this->iq.'"';
    }
}

class Teacher extends Human{
    public $level;
    public $course;

    function __construct($full_name, $age, $iq , $level, $course){
        $this->full_name = $full_name;
        $this->age = $age;
        $this->iq = $iq;
        $this->level = $level;
        $this->course = $course;
    }
    
    function introduce_teacher(){
        echo 'Hello!I am "'.$this->full_name.'". I am "'.$this->age.'"years old.my IQ rate is "'.$this->iq.'".the level i teach is "'.$this->level.'" and my experties is "'.$this->course.'"';
    }
    
    function take_exam($students){
        foreach($students as $student){
            if($this->level == $student->grade){
                echo "your level match to your teacher level";
                if($this->course == $student->lesson){
                    echo "this student can take an exam";
                    $student -> give_exam($this->course,$student->iq ,$this->level);
                }else{
                    echo "your course does not match with this exam how ever your level does";
                }
            }else{
                echo "your level does not match to your teacher level";
            }
        }
    }
}

class Student extends Human{
    public $grade;
    public $lesson;
    public $score;

    function __construct($full_name, $age, $iq , $grade, $lesson , $score){
        $this->full_name = $full_name;
        $this->age = $age;
        $this->iq = $iq;
        $this->grade = $grade;
        $this->lesson = $lesson;
        $this->score = $score;
    }

    function introduce_student(){
        echo 'Hello!I am "'.$this->full_name.'". I am "'.$this->age.'" years old.My IQ rate is "'.$this->iq.'".the level i study is "'.$this->grade.'" and my lessons are "'.$this->lesson[0].'" and here is my last "'.$this->score[0].'" list!!';
    }
    
    function give_exam($exams,$iq ,$exam_hardness){
        $scores = [];
        foreach($exams as $exam){
            $exam -> cal_marks($exam_hardness , $iq);
            array_push($scores,$exam);
        }
        return $scores;
    }
    
    function print_marks(){
        // i dont know whatto do here
    }
}

class Exam{
    public $exam_level;
    public $exam_course;
    public $exam_hardness;

    function __construct($exam_level, $exam_course, $exam_hardness){
        $this->exam_level = $exam_level;
        $this->exam_course = $exam_course;
        $this->exam_hardness = $exam_hardness;
    }

    function cal_marks($exam_hardness , $iq){
        $marks = $iq + ( 1 - $exam_hardness) * 100 ;
        return $marks;
    }
}

$human1 = new Human("mina mina", 20, 0.5);

$teachers = [
    new Teacher("teacher1", 30, 1,4,"math"),
    new Teacher("teacher2", 35, 0.9,3,"physics"),
    new Teacher("teacher3", 40, 0.8,2,"sience"),
    new Teacher("teacher4", 45, 0.7,1,"litrature")
];

$students = [
    new Student("student1", 20, 0.8 , 2,["math", "english" , "physics"  , "sience"],[]),
    new Student("student2", 20, 0.6 , 1,["math", "english" , "physics" , "sience"],[]),
    new Student("student3", 20, 0.5 , 3,["math", "english" , "physics" , "sience"],[]),
    new Student("student4", 20, 0.7 , 4,["math", "english" , "physics" , "sience"],[])
];

$exams = [
    new Human(1, "math", 0.4),
    new Human(2, "litrature", 0.1),
    new Human(3, "physics", 0.7),
    new Human(4, "sience", 1)
];

echo $human1->introduce();
echo "<Br/>";
echo $teachers[1]->introduce_teacher();
echo "<Br/>";
echo $students[1]->introduce_student();
echo "<Br/>";
echo $teachers[1]->take_exam($students[3]);
echo "<Br/>";
?>