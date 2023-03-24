INSERT INTO
    `teacher` (`id`, `name`, `firstname`, `email`, `password`)
VALUES
    (
        NULL,
        'Lecoin',
        'Thomas',
        'thomasLecoin@riri.fr',
        '$2y$10$3DDhQOnjaztzldyUJvJAVOXPnUqRLfcIucXql2QKgJa563QYMZEbe'
    ),
    (
        NULL,
        'Plénet',
        'Théo',
        'theoplenet@riri.fr',
        '$2y$10$3DDhQOnjaztzldyUJvJAVOXPnUqRLfcIucXql2QKgJa563QYMZEbe'
    ),
    (
        NULL,
        'Daniere',
        'Mathieu',
        'mathieudaniere@riri.fr',
        '$2y$10$3DDhQOnjaztzldyUJvJAVOXPnUqRLfcIucXql2QKgJa563QYMZEbe'
    );

INSERT INTO
    classroom (name)
VALUES
    ('Mathematics');

INSERT INTO
    student (name, firstname, email, password, classroom)
VALUES
    (
        'Jane',
        'Doe',
        'janedoe@example.com',
        '$2y$10$3DDhQOnjaztzldyUJvJAVOXPnUqRLfcIucXql2QKgJa563QYMZEbe',
        1
    );

INSERT INTO
    task (mark, name, description, deadline)
VALUES
    (
        80,
        'Homework',
        'Complete exercises 1-10',
        '2023-03-31 23:59:59'
    );

INSERT INTO
    course_module (name, classroom)
VALUES
    ('Algebra', 1);

INSERT INTO
    classroom_teacher (classroom, teacher)
VALUES
    (1, 1);

INSERT INTO
    course_module_student (course_module, student)
VALUES
    (1, 1);

INSERT INTO
    course_module_teacher (course_module, teacher)
VALUES
    (1, 1);

INSERT INTO
    task_teacher (task, teacher)
VALUES
    (1, 1);

INSERT INTO
    task_student (task, student, mark, is_finish, comment)
VALUES
    (1, 1, 75, true, 'Well done!');

INSERT INTO
    task_course_module (task, course_module)
VALUES
    (1, 1);