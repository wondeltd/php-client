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
     * @var string
     */
    private $logPath = '';

    /**
     * Schools constructor.
     *
     * @param string $uri
     */
    public function __construct($token, $id = false, $logPath = '')
    {
        $this->token = $token;
        $this->logPath = $logPath;

        if ($id) {
            $this->uri = $this->uri . $id . '/';
        }

        $this->achievements           = new Achievements($token, $this->uri, $this->logPath);
        $this->achievementsAttributes = new AchievementsAttributes($token, $this->uri, $this->logPath);
        $this->assessment             = new Assessment($token, $this->uri, $this->logPath);
        $this->attendance             = new Attendance($token, $this->uri, $this->logPath);
        $this->attendanceCodes        = new AttendanceCodes($token, $this->uri, $this->logPath);
        $this->attendanceSummaries    = new AttendanceSummaries($token, $this->uri, $this->logPath);
        $this->behaviours             = new Behaviours($token, $this->uri, $this->logPath);
        $this->behavioursAttributes   = new BehavioursAttributes($token, $this->uri, $this->logPath);
        $this->classes                = new Classes($token, $this->uri, $this->logPath);
        $this->contacts               = new Contacts($token, $this->uri, $this->logPath);
        $this->counts                 = new Counts($token, $this->uri, $this->logPath);
        $this->deletions              = new Deletions($token, $this->uri, $this->logPath);
        $this->doctors                = new Doctors($token, $this->uri, $this->logPath);
        $this->employees              = new Employees($token, $this->uri, $this->logPath);
        $this->employeeAbsences       = new EmployeeAbsences($token, $this->uri, $this->logPath);
        $this->events                 = new Events($token, $this->uri, $this->logPath);
        $this->exclusions             = new Exclusions($token, $this->uri, $this->logPath);
        $this->groups                 = new Groups($token, $this->uri, $this->logPath);
        $this->lessons                = new Lessons($token, $this->uri, $this->logPath);
        $this->lessonAttendance       = new LessonAttendance($token, $this->uri, $this->logPath);
        $this->medicalConditions      = new MedicalConditions($token, $this->uri, $this->logPath);
        $this->medicalEvents          = new MedicalEvents($token, $this->uri, $this->logPath);
        $this->periods                = new Periods($token, $this->uri, $this->logPath);
        $this->photos                 = new Photos($token, $this->uri, $this->logPath);
        $this->rooms                  = new Rooms($token, $this->uri, $this->logPath);
        $this->students               = new Students($token, $this->uri, $this->logPath);
        $this->studentsPreAdmission   = new StudentsPreAdmission($token, $this->uri, $this->logPath);
        $this->subjects               = new Subjects($token, $this->uri, $this->logPath);
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
