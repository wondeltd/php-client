<?php namespace Wonde\Endpoints;

class Schools extends BootstrapEndpoint
{
    /**
     * @var string
     */
    public $uri = 'schools/';

    /**
     * @var Achievements
     */
    public $achievements;

    /**
     * @var Attendance
     */
    public $attendance;

    /**
     * @var Behaviours
     */
    public $behaviours;

    /**
     * @var Classes
     */
    public $classes;

    /**
     * @var Contacts
     */
    public $contacts;

    /**
     * @var Counts
     */
    public $counts;

    /**
     * @var Employees
     */
    public $employees;

    /**
     * @var Groups
     */
    public $groups;

    /**
     * @var Lessons
     */
    public $lessons;

    /**
     * @var LessonAttendance
     */
    public $lessonAttendance;

    /**
     * @var MedicalConditions
     */
    public $medicalConditions;

    /**
     * @var MedicalEvents
     */
    public $medicalEvents;

    /**
     * @var Periods
     */
    public $periods;

    /**
     * @var Photos
     */
    public $photos;

    /**
     * @var Rooms
     */
    public $rooms;

    /**
     * @var Subjects
     */
    public $subjects;

    /**
     * @var Students
     */
    public $students;

    /**
     * @var Assessment
     */
    public $assessment;

    /**
     * @var Deletions
     */
    public $deletions;

    /**
     * Schools constructor.
     * @param string $uri
     */
    public function __construct($token, $id = false)
    {
        $this->token = $token;

        if ($id) {
            $this->uri = $this->uri . $id . '/';
        }

        $this->achievements      = new Achievements($token, $this->uri);
        $this->assessment        = new Assessment($token, $this->uri);
        $this->attendance        = new Attendance($token, $this->uri);
        $this->behaviours        = new Behaviours($token, $this->uri);
        $this->classes           = new Classes($token, $this->uri);
        $this->contacts          = new Contacts($token, $this->uri);
        $this->counts            = new Counts($token, $this->uri);
        $this->deletions         = new Deletions($token, $this->uri);
        $this->employees         = new Employees($token, $this->uri);
        $this->groups            = new Groups($token, $this->uri);
        $this->lessons           = new Lessons($token, $this->uri);
        $this->lessonAttendance  = new LessonAttendance($token, $this->uri);
        $this->medicalConditions = new MedicalConditions($token, $this->uri);
        $this->medicalEvents     = new MedicalEvents($token, $this->uri);
        $this->periods           = new Periods($token, $this->uri);
        $this->photos            = new Photos($token, $this->uri);
        $this->rooms             = new Rooms($token, $this->uri);
        $this->students          = new Students($token, $this->uri);
        $this->subjects          = new Subjects($token, $this->uri);
    }
}