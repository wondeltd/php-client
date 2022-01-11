# Wonde PHP Client

Documentation https://wonde.com/docs/api/1.0/

## Installation

Requires PHP 7.2.5+ (including PHP 8.0)

Using Composer:

```json
{
  "require": {
    "wondeltd/php-client": "3.*"
  }
}
```

or

```bash
composer require wondeltd/php-client
```

## Early Release

If you wish to get early access to new endpoints / improvements please set your package version to `dev-master`.

**Important Note:** Wonde strongly recommends locking to a stable version on production.

## Endpoints

### Client

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');
```

### Schools

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

// Loop through the schools your account has access to
foreach ($client->schools->all() as $school) {
    // Display school name
    echo $school->name . PHP_EOL;
}
```

### Single School

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

// Get single school
$school = $client->schools->get('SCHOOL_ID_GOES_HERE');
```

### Pending Schools

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

foreach ($client->schools->pending() as $school) {
    // Display school name
    echo $school->name . PHP_EOL;
}
```

### Search Schools

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

// Search for schools with a postcode starting CB21
foreach ($client->schools->search([], ['postcode' => 'CB21']) as $school) {
    // Display school name
    echo $school->name . PHP_EOL;
}

// Search for schools with the establishment number = 6006
foreach ($client->schools->search([], ['establishment_number' => '6006']) as $school) {
    // Display school name
    echo $school->name . PHP_EOL;
}
```

### Request Access

Provide the school ID to request access to a school's data.

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');
$client->requestAccess('A0000000000');
```

### Revoke Access

Provide the school ID to access already approve or pending approval.

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');
$client->revokeAccess('A0000000000');
```

### Students

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get students
foreach ($school->students->all() as $student) {
    echo $student->forename . ' ' . $student->surname . PHP_EOL;
}

// Get single student
$student = $school->students->get('STUDENT_ID_GOES_HERE');

// Get students and include contact_details object
foreach ($school->students->all(['contact_details']) as $student) {
    echo $student->forename . ' ' . $student->surname . PHP_EOL;
}

// Get students and include contacts array
foreach ($school->students->all(['contacts']) as $student) {
    echo $student->forename . ' ' . $student->surname . PHP_EOL;
}

// Get students, include contact_details object, include extended_details object and filter by updated after date
foreach ($school->students->all(['contact_details', 'extended_details'], ['updated_after' => '2016-06-24 00:00:00']) as $student) {
    echo $student->forename . ' ' . $student->surname . PHP_EOL;
}
```

### Pre Admission Students

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get students
foreach ($school->studentsPreAdmission->all() as $studentPreAdmission) {
    echo $studentPreAdmission->forename . ' ' . $studentPreAdmission->surname . PHP_EOL;
}

// Get single student
$student = $school->studentsPreAdmission->get('STUDENT_ID_GOES_HERE');
```

### Achievements

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get achievements
foreach ($school->achievements->all() as $achievement) {
    echo $achievement->comment . PHP_EOL;
}
```

### POST Achievements

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');
$school = $client->school('SCHOOL_ID_GOES_HERE');

$array = [
    'students'      => [
        [
            'student_id' => 'A1039521228',
            'points'     => 200,
            'award'      => 'TROP',
            'award_date' => '2016-04-05',
        ],
    ],
    'employee_id'   => 'A1375078684',
    'date'          => '2016-04-04',
    'type'          => 'NYPA',
    'comment'       => 'A4',
    'activity_type' => 'RE',
];

try {
    $response = $school->achievements->create($array);
} catch (\Wonde\Exceptions\ValidationError $error) {
    $errors = $error->getErrors();
}
```

### DELETE Achievements

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

$school->achievements->delete('WONDE_ACHIEVEMENTS_ID_HERE');
```

### Achievements Attributes

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get achievement attributes
foreach ($school->achievementsAttributes->all() as $achievement) {
    echo $achievement->id . PHP_EOL;
}
```

### Assessment - (BETA)

This endpoint is included in the stable release but is likely to change in the future. Please contact support for more information.

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get aspects
foreach ($school->assessment->aspects->all() as $aspect) {
    echo $aspect->id . PHP_EOL;
}

// Get templates
foreach ($school->assessment->templates->all() as $templates) {
    echo $templates->id . PHP_EOL;
}

// Get result sets
foreach ($school->assessment->templates->all() as $resultsets) {
    echo $resultsets->id . PHP_EOL;
}

// Get results
foreach ($school->assessment->results->all() as $results) {
    echo $results->id . PHP_EOL;
}

// Get marksheets
foreach ($school->assessment->marksheets->all() as $marksheets) {
    echo $marksheets->id . PHP_EOL;
}
```

### Attendance

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get attendance
foreach ($school->attendance->all() as $attendance) {
    echo $attendance->comment . PHP_EOL;
}
```

### POST Attendance

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

// Initiate a new register
$register = new \Wonde\Writeback\SessionRegister();

// Initiate a new attendance record
$attendance = new \Wonde\Writeback\SessionAttendanceRecord();

// Set fields
$attendance->setStudentId('STUDENT_ID_GOES_HERE');
$attendance->setDate('2017-01-01');
$attendance->setSession('AM'); // AM or PM
$attendance->setAttendanceCodeId('ATTENDANCE_CODE_ID_GOES_HERE');
$attendance->setComment('Comment here.');
$attendance->setMinutesLate(10);

// Add attendance mark to register
$register->add($attendance);

// Save the session register
$result = $school->attendance()->sessionRegister($register);

// Writeback id is part of the response
echo $result->writeback_id;
```

### Attendance Codes

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

// Get attendance codes
foreach ($client->attendanceCodes->all() as $attendanceCode) {
    echo $attendanceCode->code . PHP_EOL;
}

// Get school attendance codes
$school = $client->school('SCHOOL_ID_GOES_HERE');
foreach ($school->attendanceCodes->all() as $attendanceCode) {
    echo $attendanceCode->code . PHP_EOL;
}
```

### Attendance Summaries

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get attendance summaries
foreach ($school->attendanceSummaries->all() as $attendanceSummary) {
    echo $attendance->possible_marks . PHP_EOL;
}
```

### Behaviours

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get behaviours
foreach ($school->behaviours->all() as $behaviour) {
    echo $behaviour->incident . PHP_EOL;
}
```

### POST Behaviours

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');
$school = $client->school('SCHOOL_ID_GOES_HERE');

$array = [
    'students'      => [
        [
            'student_id'  => 'A1039521228',
            'role'        => 'AG',
            'action'      => 'COOL',
            'action_date' => '2016-04-01',
            'points'      => 200,
        ],
        [
            'student_id' => 'A870869351',
            'role'       => 'TA',
            'points'     => 2,
        ],
    ],
    'employee_id'   => 'A1375078684',
    'date'          => '2016-03-31',
    'status'        => 'REV2',
    'type'          => 'BULL',
    'bullying_type' => 'B_INT',
    'comment'       => 'Bulling incident',
    'activity_type' => 'RE',
    'location'      => 'CORR',
    'time'          => 'LUN',
];

try {
    $response = $school->behaviours->create($array);
} catch (\Wonde\Exceptions\ValidationError $error) {
    $errors = $error->getErrors();
}
```

### DELETE Behaviours

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

$school->behaviours->delete('WONDE_BEHAVIOUR_ID_HERE');
```

### Behaviours Attributes

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get behaviours
foreach ($school->behavioursAttributes->all() as $behaviour) {
    echo $behaviour->id . PHP_EOL;
}
```

### Classes

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get classes
foreach ($school->classes->all() as $class) {
    echo $class->name . PHP_EOL;
}
```

### Contacts

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get contacts
foreach ($school->contacts->all() as $contacts) {
    echo $contacts->forename . ' ' . $contacts->surname . PHP_EOL;
}
```

### Counts

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get counts
$counts = $school->counts->all(['students','contacts']);
echo $counts->array->students->data->count . PHP_EOL;
echo $counts->array->contacts->data->count . PHP_EOL;
```

### Deletions

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get deletions
foreach ($school->deletions->all() as $deletions) {
    echo $deletions->id;
}
```

### Employees

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get employees
foreach ($school->employees->all() as $employee) {
    echo $employee->forename . ' ' . $employee->surname . PHP_EOL;
}
```

### Employee Absences

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get employee absences
foreach ($school->employeeAbsences->all() as $employeeAbsence) {
    echo $employeeAbsence->employee . ' ' . $employeeAbsence->absence_type . PHP_EOL;
}
```

### Events

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get events
foreach ($school->events->all() as $event) {
    echo $event->id . PHP_EOL;
}
```

### Groups

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get groups
foreach ($school->groups->all() as $group) {
    echo $group->name . PHP_EOL;
}
```

### Lessons

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get lessons
foreach ($school->lessons->all() as $lesson) {
    echo $lesson->period_id . '-' . $lesson->class_id . PHP_EOL;
}
```

### Lesson Attendance

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get lesson attendance
foreach ($school->lessonAttendance->all() as $lessonAttendance) {
    echo $lessonAttendance->comment . PHP_EOL;
}
```

### POST Lesson Attendance

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

// Initiate a new register
$register = new \Wonde\Writeback\LessonRegister();

// Initiate a new attendance record
$attendance = new \Wonde\Writeback\LessonAttendanceRecord();

// Set fields
$attendance->setStudentId('STUDENT_ID_GOES_HERE');
$attendance->setLessonId('LESSON_ID_GOES_HERE');
$attendance->setAttendanceCodeId('ATTENDANCE_CODE_ID_GOES_HERE');

// Add attendance mark to register
$register->add($attendance);

// Save the lesson register
$result = $school->lessonAttendance()->lessonRegister($register);

// Writeback id is part of the response
echo $result->writeback_id;
```

### Medical Conditions

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get medical conditions
foreach ($school->medicalConditions->all() as $medicalCondition) {
    echo $medicalCondition->description . PHP_EOL;
}
```

### Medical Events

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get medical events
foreach ($school->medicalEvents->all() as $medicalEvent) {
    echo $medicalEvent->description . PHP_EOL;
}
```

### Doctors

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get doctors
foreach ($school->doctors->all() as $doctor) {
    echo $doctor->surname . PHP_EOL;
    echo $doctor->practice_name . PHP_EOL;
    echo $doctor->telephone . PHP_EOL;
}
```

### Periods

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get periods
foreach ($school->periods->all() as $period) {
    echo $period->name . PHP_EOL;
}
```

### Photos

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get photos
foreach ($school->photos->all() as $photo) {
    echo $photo->hash . PHP_EOL;
}
```

### Rooms

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get rooms
foreach ($school->rooms->all() as $room) {
    echo $room->name . PHP_EOL;
}
```

### Subjects

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$school = $client->school('SCHOOL_ID_GOES_HERE');

// Get subjects
foreach ($school->subjects->all() as $subject) {
    echo $subject->name . PHP_EOL;
}
```

### Meta

```php
$client = new \Wonde\Client('TOKEN_GOES_HERE');

$metaObject = $client->meta->get('SCHOOL_ID_GOES_HERE');
```
