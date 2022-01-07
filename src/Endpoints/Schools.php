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
     * @var AchievementsAttributes
     */
    public $achievementsAttributes;

    /**
     * @var Attendance
     */
    public $attendance;

    /**
     * @var AttendanceCodes
     */
    public $attendanceCodes;

    /**
     * @var AttendanceSummaries
     */
    public $attendanceSummaries;

    /**
     * @var Behaviours
     */
    public $behaviours;

    /**
     * @var BehavioursAttributes
     */
    public $behavioursAttributes;

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
     * @var EmployeeAbsences
     */
    public $employeeAbsences;

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
     * @var StudentsPreAdmission
     */
    public $studentsPreAdmission;

    /**
     * @var Assessment
     */
    public $assessment;

    /**
     * @var Deletions
     */
    public $deletions;

    /**
     * @var Events
     */
    public $events;
    
    /**
     * @var Doctors
     */
    public $doctors;
    
    /**
     * @var Exclusions
     */
    public $exclusions;

    /**
     * Schools constructor.
     *
     * @param string $uri
     */
    public function __construct($token, $id = false)
    {
        $this->token = $token;

        if ($id) {
            $this->uri = $this->uri . $id . '/';
        }

        $this->achievements           = new Achievements($token, $this->uri);
        $this->achievementsAttributes = new AchievementsAttributes($token, $this->uri);
        $this->assessment             = new Assessment($token, $this->uri);
        $this->attendance             = new Attendance($token, $this->uri);
        $this->attendanceCodes        = new AttendanceCodes($token, $this->uri);
        $this->attendanceSummaries    = new AttendanceSummaries($token, $this->uri);
        $this->behaviours             = new Behaviours($token, $this->uri);
        $this->behavioursAttributes   = new BehavioursAttributes($token, $this->uri);
        $this->classes                = new Classes($token, $this->uri);
        $this->contacts               = new Contacts($token, $this->uri);
        $this->counts                 = new Counts($token, $this->uri);
        $this->deletions              = new Deletions($token, $this->uri);
        $this->doctors                = new Doctors($token, $this->uri);
        $this->employees              = new Employees($token, $this->uri);
        $this->employeeAbsences       = new EmployeeAbsences($token, $this->uri);
        $this->events                 = new Events($token, $this->uri);
        $this->exclusions             = new Exclusions($token, $this->uri);
        $this->groups                 = new Groups($token, $this->uri);
        $this->lessons                = new Lessons($token, $this->uri);
        $this->lessonAttendance       = new LessonAttendance($token, $this->uri);
        $this->medicalConditions      = new MedicalConditions($token, $this->uri);
        $this->medicalEvents          = new MedicalEvents($token, $this->uri);
        $this->periods                = new Periods($token, $this->uri);
        $this->photos                 = new Photos($token, $this->uri);
        $this->rooms                  = new Rooms($token, $this->uri);
        $this->students               = new Students($token, $this->uri);
        $this->studentsPreAdmission   = new StudentsPreAdmission($token, $this->uri);
        $this->subjects               = new Subjects($token, $this->uri);
    }

    public function updateDomain($domain)
    {
        $this->achievements->domain = $domain;
        $this->achievementsAttributes->domain = $domain;
        $this->assessment->domain = $domain;
        $this->attendance->domain = $domain;
        $this->attendanceCodes->domain = $domain;
        $this->attendanceSummaries->domain = $domain;
        $this->behaviours->domain = $domain;
        $this->behavioursAttributes->domain = $domain;
        $this->classes->domain = $domain;
        $this->contacts->domain = $domain;
        $this->counts->domain = $domain;
        $this->deletions->domain = $domain;
        $this->doctors->domain = $domain;
        $this->employees->domain = $domain;
        $this->employeeAbsences->domain = $domain;
        $this->events->domain = $domain;
        $this->exclusions->domain = $domain;
        $this->groups->domain = $domain;
        $this->lessons->domain = $domain;
        $this->lessonAttendance->domain = $domain;
        $this->medicalConditions->domain = $domain;
        $this->medicalEvents->domain = $domain;
        $this->periods->domain = $domain;
        $this->photos->domain = $domain;
        $this->rooms->domain = $domain;
        $this->students->domain = $domain;
        $this->studentsPreAdmission->domain = $domain;
        $this->subjects->domain = $domain;
    }

    /**
     * Return all pending schools
     *
     * @param array $includes
     * @param array $parameters
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function pending($includes = [], $parameters = [])
    {
        $this->uri = $this->uri . 'pending/';
        return $this->all($includes, $parameters);
    }

    /**
     * Return all audited schools
     *
     * @param array $includes
     * @param array $parameters
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function audited($includes = [], $parameters = [])
    {
        $this->uri = $this->uri . 'audited/';
        return $this->all($includes, $parameters);
    }

    /**
     * Search available schools
     *
     * @param array $includes
     * @param array $parameters
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function search($includes = [], $parameters = [])
    {
        $this->uri = $this->uri . 'all/';
        return $this->all($includes, $parameters);
    }

    /**
     * Override the get method for single school fetch
     *
     * @param       $id
     * @param array $includes
     * @param array $parameters
     * @return mixed
     */
    public function get($id, $includes = [], $parameters = [])
    {
        $this->uri = 'schools/';
        return parent::get($id, $includes, $parameters);
    }


    /**
     * Init attendance record
     *
     * @return Attendance
     */
    public function attendance()
    {
        return $this->attendance;
    }

    /**
     * Init attendance record
     *
     * @return LessonAttendance
     */
    public function lessonAttendance()
    {
        return $this->lessonAttendance;
    }
}
