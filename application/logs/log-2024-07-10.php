ERROR - 2024-07-10 13:59:58 --> 404 Page Not Found: ApiDataController/employee
ERROR - 2024-07-10 14:01:34 --> Severity: error --> Exception: Call to undefined function returnResponse() D:\xampp\htdocs\payroll_v1_update\application\controllers\ApiDataController.php 21
ERROR - 2024-07-10 14:03:07 --> Severity: error --> Exception: Call to undefined method ApiDataController::returnResponse() D:\xampp\htdocs\payroll_v1_update\application\controllers\ApiDataController.php 21
ERROR - 2024-07-10 14:43:09 --> Severity: Notice --> Array to string conversion D:\xampp\htdocs\payroll_v1_update\system\database\DB_query_builder.php 2442
ERROR - 2024-07-10 14:43:09 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '40 = ''
WHERE `users_id` = Array' at line 1 - Invalid query: UPDATE `c1202_users` SET 40 = ''
WHERE `users_id` = Array
ERROR - 2024-07-10 14:44:30 --> Severity: error --> Exception: Too few arguments to function Common_model::update_table(), 2 passed in D:\xampp\htdocs\payroll_v1_update\application\controllers\ApiDataController.php on line 54 and exactly 3 expected D:\xampp\htdocs\payroll_v1_update\application\models\common_model.php 108
ERROR - 2024-07-10 14:45:22 --> Query error: Unknown column 'users_id' in 'where clause' - Invalid query: UPDATE `c1202_users` SET `is_mlogin` = 1, `mlogin_token` = 'azFOODZOMGZqeHd6YWNZWitQa3ZPdz09'
WHERE `users_id` = '40'
ERROR - 2024-07-10 14:47:01 --> Query error: Unknown column 'id' in 'where clause' - Invalid query: UPDATE `c1202_users` SET `is_mlogin` = 1, `mlogin_token` = 'Z2YwSUZMUys2Tk9JNDBuQXdWM0NoUT09'
WHERE `id` = '40'
ERROR - 2024-07-10 14:47:37 --> Severity: error --> Exception: Call to undefined method CI_DB_mysqli_driver::_error_message() D:\xampp\htdocs\payroll_v1_update\application\models\common_model.php 125
ERROR - 2024-07-10 14:51:02 --> Severity: error --> Exception: Call to undefined function returnResponse() D:\xampp\htdocs\payroll_v1_update\application\controllers\ApiDataController.php 80
