<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-07-11 06:35:26 --> Severity: Notice --> Trying to access array offset on value of type bool D:\xampp\htdocs\payroll_v1_update\application\views\side_menu_admin.php 30
ERROR - 2024-07-11 06:37:27 --> Severity: Notice --> Trying to access array offset on value of type bool D:\xampp\htdocs\payroll_v1_update\application\views\side_menu_admin.php 30
ERROR - 2024-07-11 06:38:03 --> Severity: Notice --> Trying to access array offset on value of type bool D:\xampp\htdocs\payroll_v1_update\application\views\side_menu_admin.php 30
ERROR - 2024-07-11 06:38:20 --> Severity: Notice --> Trying to access array offset on value of type bool D:\xampp\htdocs\payroll_v1_update\application\views\side_menu_admin.php 30
ERROR - 2024-07-11 06:54:31 --> 404 Page Not Found: ApiDataController/checkcurrentuser
ERROR - 2024-07-11 06:54:58 --> 404 Page Not Found: ApiDataController/checkcurrentuser
ERROR - 2024-07-11 06:58:31 --> Severity: Notice --> Trying to access array offset on value of type bool D:\xampp\htdocs\payroll_v1_update\application\views\side_menu_admin.php 30
ERROR - 2024-07-11 07:15:36 --> Severity: Warning --> A non-numeric value encountered D:\xampp\htdocs\payroll_v1_update\application\controllers\jobsheet.php 250
ERROR - 2024-07-11 07:15:36 --> Severity: Warning --> A non-numeric value encountered D:\xampp\htdocs\payroll_v1_update\application\controllers\jobsheet.php 250
ERROR - 2024-07-11 07:15:36 --> Severity: Warning --> A non-numeric value encountered D:\xampp\htdocs\payroll_v1_update\application\controllers\jobsheet.php 250
ERROR - 2024-07-11 07:15:36 --> Severity: Warning --> A non-numeric value encountered D:\xampp\htdocs\payroll_v1_update\application\controllers\jobsheet.php 250
ERROR - 2024-07-11 07:15:36 --> Severity: Warning --> A non-numeric value encountered D:\xampp\htdocs\payroll_v1_update\application\controllers\jobsheet.php 250
ERROR - 2024-07-11 07:15:36 --> Severity: Warning --> A non-numeric value encountered D:\xampp\htdocs\payroll_v1_update\application\controllers\jobsheet.php 250
ERROR - 2024-07-11 07:15:36 --> Severity: Warning --> A non-numeric value encountered D:\xampp\htdocs\payroll_v1_update\application\controllers\jobsheet.php 250
ERROR - 2024-07-11 07:15:36 --> Severity: Warning --> A non-numeric value encountered D:\xampp\htdocs\payroll_v1_update\application\controllers\jobsheet.php 250
ERROR - 2024-07-11 07:15:36 --> Severity: Warning --> A non-numeric value encountered D:\xampp\htdocs\payroll_v1_update\application\controllers\jobsheet.php 250
ERROR - 2024-07-11 07:20:00 --> Severity: Notice --> Undefined variable: date D:\xampp\htdocs\payroll_v1_update\application\models\jobsheet_model.php 39
ERROR - 2024-07-11 07:20:00 --> Severity: Notice --> Undefined variable: date D:\xampp\htdocs\payroll_v1_update\application\models\jobsheet_model.php 40
ERROR - 2024-07-11 07:20:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`NULL`
AND `d`.`emp_job_end_date` > `IS` `NULL`
AND `a`.`employee_deleted` = ...' at line 6 - Invalid query: SELECT `a`.*, `b`.*, `a`.`employee_id` as `emp_id`
FROM `c1202_employee` as `a`
LEFT JOIN `c1202_employee_salary` as `b` ON `a`.`employee_id` = `b`.`employee_id`
LEFT JOIN `c1202_users` as `c` ON `c`.`employee_id` = `b`.`employee_id`
JOIN `c1202_employee_job_details` as `d` ON `d`.`employee_id` = `b`.`employee_id`
WHERE `d`.`emp_job_start_date` < `IS` `NULL`
AND `d`.`emp_job_end_date` > `IS` `NULL`
AND `a`.`employee_deleted` = '0'
AND `c`.`user_id` = '40'
