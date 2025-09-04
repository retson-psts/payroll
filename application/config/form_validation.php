<?php
$config = array(
    'add_employee_step1' => array(
        array(
            'field' => 'emp_firstname',
            'label' => 'First name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'emp_lastname',
            'label' => 'Last name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'emp_number',
            'label' => 'Employee Number / ID',
            'rules' => 'trim|required|alpha_dash|is_unique[employee.emp_number]'
        ),
        array(
            'field' => 'emp_dri_lice_exp',
            'label' => 'Licence Expiry Date',
            'rules' => 'trim'
        ),
        array(
            'field' => 'emp_gender',
            'label' => 'Gender',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'nation_code',
            'label' => 'Natioanality',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'emp_birthday',
            'label' => 'Birth day',
            'rules' => 'trim|required|callback_validate_age'
        )
    ),
    'login' => array
	(
		array(
		'field'   => 'username',
		'label'   => 'Username',
	    'rules'   => 'trim|required|alpha_numeric'					
	    ),
		array(
		'field'   => 'password',
		'label'   => 'Password',
	    'rules'   => 'trim|required'								
	    )
	),
    'add_employee_steplogin1' => array(
        array(
            'field' => 'emp_firstname',
            'label' => 'First name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'emp_lastname',
            'label' => 'Last name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'emp_number',
            'label' => 'Employee Number / ID',
            'rules' => 'trim|required|alpha_dash|is_unique[employee.emp_number]'
        ),
        array(
            'field' => 'emp_dri_lice_exp',
            'label' => 'Licence Expiry Date',
            'rules' => 'trim'
        ),
        array(
            'field' => 'emp_gender',
            'label' => 'Gender',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'nation_code',
            'label' => 'Natioanality',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'emp_birthday',
            'label' => 'Birth day',
            'rules' => 'trim|required|callback_validate_age'
        ),
        array(
            'field' => 'username',
            'label' => 'Employee Username',
            'rules' => 'trim|required|alpha_numeric|is_unique[users.username]'
        ),
        array(
            'field' => 'password',
            'label' => 'Employee Password',
            'rules' => 'trim|required|alpha_numeric'
        )
    ),
    'add_employee_step11' => array(
        array(
            'field' => 'emp_number',
            'label' => 'Employee Number / ID',
            'rules' => 'trim|required|alpha_dash'
        ),
        array(
            'field' => 'emp_firstname',
            'label' => 'First name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'emp_lastname',
            'label' => 'Last name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'emp_dri_lice_exp',
            'label' => 'Licence Expiry Date',
            'rules' => 'trim'
        ),
        array(
            'field' => 'nation_code',
            'label' => 'Natioanality',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'emp_gender',
            'label' => 'Gender',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'emp_birthday',
            'label' => 'Birth day',
            'rules' => 'trim|required|callback_validate_age'
        )
    ),
    'add_employee_steplogin11' => array(
        array(
            'field' => 'emp_firstname',
            'label' => 'First name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'emp_lastname',
            'label' => 'Last name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'emp_number',
            'label' => 'Employee Number / ID',
            'rules' => 'trim|required|alpha_dash'
        ),
        array(
            'field' => 'emp_dri_lice_exp',
            'label' => 'Licence Expiry Date',
            'rules' => 'trim'
        ),
        array(
            'field' => 'emp_gender',
            'label' => 'Gender',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'nation_code',
            'label' => 'Natioanality',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'emp_birthday',
            'label' => 'Birth day',
            'rules' => 'trim|required|callback_validate_age'
        ),
        array(
            'field' => 'username',
            'label' => 'Employee Username',
            'rules' => 'trim|required|alpha_numeric'
        ),
        array(
            'field' => 'password',
            'label' => 'Employee Password',
            'rules' => 'trim|alpha_numeric'
        )
    ),
    'add_employee_step2' => array(
        array(
            'field' => 'emp_hm_telephone',
            'label' => 'Home Phone',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'emp_mobile',
            'label' => 'Mobile',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'emp_work_telephone',
            'label' => 'Telephone',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'emp_work_email',
            'label' => 'Email',
            'rules' => 'trim|valid_email'
        ),
        array(
            'field' => 'emp_oth_email',
            'label' => 'Other Email',
            'rules' => 'trim|valid_email'
        ),
        array(
            'field' => 'emp_contact_temp_street1',
            'label' => 'Address Line1',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'emp_contact_temp_city',
            'label' => 'City',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'emp_contact_temp_country',
            'label' => 'Country',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'emp_contact_temp_provience',
            'label' => 'Province',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'emp_contact_temp_pincode',
            'label' => 'Pincode',
            'rules' => 'required|trim|min_length[4]|max_length[6]'
        )
    ),
    'add_employee_step3' => array(
        array(
            'field' => 'eec_name',
            'label' => 'Employee Relative Name',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'eec_relationship',
            'label' => 'Employee Relation',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'eec_home_no',
            'label' => 'Home No',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'eec_mobile_no',
            'label' => 'Mobile No',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'eec_office_no',
            'label' => 'Office No',
            'rules' => 'trim|numeric'
        )
    ),
    'add_employee_step4' => array(
        array(
            'field' => 'ed_name',
            'label' => 'Dependents Name',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'ed_relationship_type',
            'label' => 'Dependents Relationship',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'specify',
            'label' => 'Dependents Relationship',
            'rules' => 'trim|callback_ed_relation'
        )
    ),
    'add_employee_step5' => array(
        array(
            'field' => 'ei_permit_type',
            'label' => 'Permit Type',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'specify',
            'label' => 'Immigration Type',
            'rules' => 'trim|callback_ei_immigration'
        ),
        array(
            'field' => 'ei_permit_number',
            'label' => 'Permit Number',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'ei_permit_issuedate',
            'label' => 'Issue Date',
            'rules' => 'trim|required'
        )
    ),
    'add_employee_step5_1' => array(
        array(
            'field' => 'ep_passport_number',
            'label' => 'Permit Type',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'ep_permit_issuedate',
            'label' => 'Issued date',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'ep_permit_expirydate',
            'label' => 'Expiry date',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'ep_issued_by',
            'label' => 'Issued Country',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'ep_provience',
            'label' => 'Place Provided',
            'rules' => 'trim'
        )
    ),
    'add_employee_step6' => array(
        array(
            'field' => 'emp_joined_date',
            'label' => 'Permit Type',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'emp_job_title',
            'label' => 'Job Type',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'emp_sub_unit',
            'label' => 'Sub unit',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'emp_job_location',
            'label' => 'Location',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'annual_leave',
            'label' => 'Annual Leave',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'sick_leave',
            'label' => 'Sick Leave',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'emp_job_start_date',
            'label' => 'Job start date',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'emp_job_end_date',
            'label' => 'job end date',
            'rules' => 'trim|required'
        )
        
    ),
    'add_employee_step7_1' => array(
        array(
            'field' => 'emp_salary_amount',
            'label' => 'Salary Amount',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'emp_salary_pay_period',
            'label' => 'Pay Period',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'emp_salary_over_time',
            'label' => 'Type of over time',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'emp_salary_per_day_hour',
            'label' => 'Per day Hour',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'emp_salary_per_hour',
            'label' => 'Per Hour salary',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'emp_salary_weekly_hour',
            'label' => 'Weekly Hour',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'emp_salary_weekly_pay',
            'label' => 'Weekly Pay',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'emp_salary_levy_amt',
            'label' => 'Levy Amout',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'emp_salary_monthly_hour',
            'label' => 'Monthly hours',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'emp_ot_base_amount',
            'label' => 'OT Base Amoutn',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'emp_ot_per_hour_amount',
            'label' => 'OT Per Hour Amount',
            'rules' => 'trim|numeric'
        )
    ),
    'add_employee_step8_1' => array(
        array(
            'field' => 'emp_sub_id',
            'label' => 'Supervisor Name',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'emp_reporting_method',
            'label' => 'Reporting Method',
            'rules' => 'required|trim|numeric'
        )
    ),
    'add_employee_step9_1' => array(
        array(
            'field' => 'eexp_employer',
            'label' => 'Company Name',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'eexp_jobtit',
            'label' => 'Job Title',
            'rules' => 'required|trim'
        )
    ),
    'add_employee_step9_2' => array(
        array(
            'field' => 'emp_edu_institute',
            'label' => 'Institute Name',
            'rules' => 'required|trim'
        )
    ),
    'add_employee_step10' => array(
        array(
            'field' => 'esk_skill_id',
            'label' => 'Skill',
            'rules' => 'required|trim|numeric|callback_skillexist[0]'
        )
    ),
    'edit_employee_step10' => array(
        array(
            'field' => 'esk_skill_id',
            'label' => 'Skill',
            'rules' => 'required|trim|numeric|callback_skillexist[1]'
        )
    ),
    'absent' => array(
        array(
            'field' => 'employee_id',
            'label' => 'Employee Id',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'leave_type',
            'label' => 'Leave type',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'leave_reason',
            'label' => 'Reason for leave',
            'rules' => 'trim'
        )
    ),
    'allowance' => array(
        array(
            'field' => 'employee_id',
            'label' => 'Employee Id',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'allownce_type_id',
            'label' => 'Allowance Type',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'emp_allowance_amount',
            'label' => 'Amount',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'emp_allowance_month',
            'label' => 'Month',
            'rules' => 'trim|required'
        )
    ),
    'approve_allowance' => array(
        array(
            'field' => 'emp_allowance_id',
            'label' => 'allowance Id',
            'rules' => 'required|trim|alpha_numeric'
        ),
        array(
            'field' => 'allownce_type_id',
            'label' => 'Allowance Type',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'emp_allowance_amount',
            'label' => 'Amount',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'emp_allowance_month',
            'label' => 'Month',
            'rules' => 'trim|required'
        )
    ),
    'emp_allowance' => array(
        array(
            'field' => 'allownce_type_id',
            'label' => 'Allowance Type',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'emp_allowance_amount',
            'label' => 'Amount',
            'rules' => 'trim|required|numeric'
        )
    ),
    'ajax_leave' => array(
        array(
            'field' => 'leave_type',
            'label' => 'Leave Type',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'range',
            'label' => 'Date Range',
            'rules' => 'trim'
        ),
        array(
            'field' => 'month',
            'label' => 'Month',
            'rules' => 'trim'
        )
    ),
    'forget_password' => array(
        array(
            'field' => 'email',
            'label' => 'Email Id',
            'rules' => 'trim|valid_email|required|callback_existemail'
        )
    ),
    'reset_password' => array(
        array(
            'field' => 'password',
            'label' => 'New Password',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'cpassword',
            'label' => 'Confirm password',
            'rules' => 'trim|required|matches[password]'
        )
    ),
    'get_allowance' => array(
        array(
            'field' => 'id',
            'label' => 'Id Passing Value',
            'rules' => 'trim|numeric|required'
        )
    ),
    'request_leave' => array(
    	array(
            'field' => 'range',
            'label' => 'Range',
            'rules' => 'trim|required'
        )
    ),
    'request_fixed_leave' => array(
    	array(
            'field' => 'employee_id',
            'label' => 'Employee',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'range',
            'label' => 'Range',
            'rules' => 'trim|required'
        )
    ),
    'add_employee_step12' => array(
        array(
            'field' => 'employee_bank_name',
            'label' => 'Bank Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'employee_bank_branch',
            'label' => 'Branch name',
            'rules' => 'trim'
        ),
        array(
            'field' => 'employee_bank_city',
            'label' => 'City',
            'rules' => 'trim'
        ),
        array(
            'field' => 'employee_bank_acc',
            'label' => 'Account No',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'employee_bank_ifsc',
            'label' => 'IFSC code',
            'rules' => 'trim'
        ),
        array(
            'field' => 'employee_bank_code',
            'label' => 'Bank Code',
            'rules' => 'trim'
        )
    ),
    'emp_leave_add' => array(
        array(
            'field' => 'leave_types1[]',
            'label' => 'Leave type',
            'rules' => 'trim|alpha_numeric|required'
        ),
        array(
            'field' => 'dates[]',
            'label' => 'Dates',
            'rules' => 'trim|required|callback_validate_date'
        )
    ),
    'emp_fixed_leave_add' => array(
    	
        array(
            'field' => 'employee_id',
            'label' => 'Employee',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'leave_types1[]',
            'label' => 'Leave type',
            'rules' => 'trim|alpha_numeric|required'
        ),
        array(
            'field' => 'dates[]',
            'label' => 'Dates',
            'rules' => 'trim|required|callback_validate_date'
        )
    ),
    'company' => array(
        array(
            'field' => 'company_name',
            'label' => 'Company name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'company_registration_id',
            'label' => 'Registration Id',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'company_addressline1',
            'label' => 'Address Line 1',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'company_city',
            'label' => 'City',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'company_pincode',
            'label' => 'Pincode',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'company_email',
            'label' => 'Email id',
            'rules' => 'trim|required|valid_email'
        )
        
    ),
    'employer' => array(
        array(
            'field' => 'employer_firstname',
            'label' => 'First name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'employer_lastname',
            'label' => 'Last Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'employer_email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|is_unique[users.email]'
        ),
        array(
            'field' => 'employer_username',
            'label' => 'Username',
            'rules' => 'trim|required|is_unique[users.username]'
        ),
        array(
            'field' => 'employer_password',
            'label' => 'Password',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'employer_cpassword',
            'label' => 'Confirm Password',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'employer_designation',
            'label' => 'Designation',
            'rules' => 'trim|required'
        )
    ),
    'edit_employer' => array(
        array(
            'field' => 'employer_firstname',
            'label' => 'First name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'employer_lastname',
            'label' => 'Last Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'employer_email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|callback_emailmecheck'
        ),
        array(
            'field' => 'employer_username',
            'label' => 'Username',
            'rules' => 'trim|required|callback_usernamecheck'
        ),
        array(
            'field' => 'employer_password',
            'label' => 'Password',
            'rules' => 'trim|callback_passcheck'
        ),
        array(
            'field' => 'employer_cpassword',
            'label' => 'Confirm Password',
            'rules' => 'trim'
        ),
        array(
            'field' => 'employer_designation',
            'label' => 'Designation',
            'rules' => 'trim|required'
        )
    ),
    'check_leave' => array(
        array(
            'field' => 'id',
            'label' => 'Leave Type',
            'rules' => 'trim|required|numeric'
        )
        
    ),
    'check_leave_fixed' => array(
        array(
            'field' => 'employee_id',
            'label' => 'Employee',
            'rules' => 'trim|required|numeric'
        ),
        
        
    ),
    'salary_ajax' => array(
        array(
            'field' => 'month',
            'label' => 'Month ',
            'rules' => 'trim|required|callback_month_validate'
        )
        
    ),
    'dayleave_ajax' => array(
        array(
            'field' => 'month',
            'label' => 'Month field is',
            'rules' => 'trim|required|callback_validate_date_lessthantoday'
        )
        
    ),
    'otreport_ajax' => array(
        array(
            'field' => 'ot_type',
            'label' => 'Type Of OT',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'range',
            'label' => 'Range',
            'rules' => 'trim|callback_rangevalidate'
        ),
        array(
            'field' => 'month',
            'label' => 'Month',
            'rules' => 'trim|callback_month_validate'
        ),
        
    ),
    'project_ajax' => array(
        array(
            'field' => 'project',
            'label' => 'project',
            'rules' => 'trim|numeric|required'
        ),
        array(
            'field' => 'location',
            'label' => 'Location',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'range',
            'label' => 'Range',
            'rules' => 'trim|callback_rangevalidate'
        ),
        array(
            'field' => 'month',
            'label' => 'Month',
            'rules' => 'trim|callback_month_validate'
        ),
        
    ),
    'emp_leave_approve' => array(
        array(
            'field' => 'leave_types1[]',
            'label' => 'Leave type',
            'rules' => 'trim|alpha_numeric|required'
        ),
        array(
            'field' => 'leave_dates[]',
            'label' => 'Dates',
            'rules' => 'trim|required|callback_validate_date'
        ),
        array(
            'field' => 'leave_ids[]',
            'label' => 'Ids',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'employee_id',
            'label' => 'Employee Id',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'request_id',
            'label' => 'Request Id',
            'rules' => 'trim|required|numeric'
        )
    ),
    'emp_media' => array(
        array(
            'field' => 'filenames[]',
            'label' => 'Leave type',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'emp_id',
            'label' => 'Emp Details',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'screen',
            'label' => 'Type of page',
            'rules' => 'trim|required|alpha|max_length[3]'
        )
    ),
    'iras/download' => array(
        array(
            'field' => 'csn',
            'label' => 'Leave type',
            'rules' => 'trim|numeric|required'
        ),
        array(
            'field' => 'csn',
            'label' => 'CPF submit Number',
            'rules' => 'trim|numeric|required'
        ),
        array(
            'field' => 'fwl_late',
            'label' => 'FWL late amount',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'cpf_late',
            'label' => 'CPF late amount',
            'rules' => 'trim|numeric'
        )
    ),
    'company/giro_add' => array(
        array(
            'field' => 'giro_setup_bank',
            'label' => 'Bank',
            'rules' => 'trim|required|numeric|callback_existgiro[0]'
        ),
        array(
            'field' => 'giro_setup_valuedate',
            'label' => 'Value Date',
            'rules' => 'trim|required|numeric|less_than[30]|greater_than[0]'
        ),
        array(
            'field' => 'giro_setup_branch_code',
            'label' => 'Branch code',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'giro_setup_account',
            'label' => 'Account No',
            'rules' => 'trim|required|alpha_numeric'
        ),
        array(
            'field' => 'giro_setup_account_name',
            'label' => 'Name of account',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'giro_setup_company_code',
            'label' => 'Name of account',
            'rules' => 'trim'
        ),
        array(
            'field' => 'giro_setup_approver_code',
            'label' => 'Name of account',
            'rules' => 'trim'
        ),
        array(
            'field' => 'giro_setup_company_code',
            'label' => 'Name of account',
            'rules' => 'trim'
        )
        
       ),
    'company/giro_edit' => array(
        array(
            'field' => 'giro_setup_bank',
            'label' => 'Bank',
            'rules' => 'trim|required|numeric|callback_existgiro[1]'
        ),
        array(
            'field' => 'giro_setup_valuedate',
            'label' => 'Value Date',
            'rules' => 'trim|required|numeric|less_than[30]|greater_than[0]'
        ),
        array(
            'field' => 'giro_setup_branch_code',
            'label' => 'Branch code',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'giro_setup_account',
            'label' => 'Account No',
            'rules' => 'trim|required|alpha_numeric'
        ),
        array(
            'field' => 'giro_setup_account_name',
            'label' => 'Name of account',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'giro_setup_company_code',
            'label' => 'Name of account',
            'rules' => 'trim'
        ),
        array(
            'field' => 'giro_setup_approver_code',
            'label' => 'Name of account',
            'rules' => 'trim'
        ),
        array(
            'field' => 'giro_setup_company_code',
            'label' => 'Name of account',
            'rules' => 'trim'
        )
        
       ),
   	 'company/ir8a_add' => array(
        array(
            'field' => 'ir8a_authorised_person',
            'label' => 'Authorised Person',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'ir8a_authorised_designation',
            'label' => 'Authorised Designation',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'ir8a_authorised_email',
            'label' => 'Authorised Designation',
            'rules' => 'trim|required|valid_email'
        ),
        array(
            'field' => 'ir8a_authorised_roc',
            'label' => 'Authorised Designation',
            'rules' => 'trim|required|alpha_numeric'
        ),
        array(
            'field' => 'ir8a_authorised_company_type',
            'label' => 'Authorised Designation',
            'rules' => 'trim|required|numeric'
        ),
   	 
        
    ),
    'company/csn_add' => array(
        array(
            'field' => 'csn_roc',
            'label' => 'Company csn',
            'rules' => 'trim|required|alpha_numeric|callback_csnexist[0]'
        ),
        array(
            'field' => 'csn_type',
            'label' => 'Type',
            'rules' => 'trim|required|alpha|exact_length[3]'
        ),
        array(
            'field' => 'csn_sno',
            'label' => 'Csn sno',
            'rules' => 'trim|required|numeric'
        )
      ),
    'company/csn_edit' => array(
        array(
            'field' => 'csn_roc',
            'label' => 'Company csn',
            'rules' => 'trim|required|callback_csnexist[1]'
        ),
        array(
            'field' => 'csn_type',
            'label' => 'Type',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'csn_sno',
            'label' => 'Csn sno',
            'rules' => 'trim|required'
        )
      ),
    'iras/iras_display' => array(
        array(
            'field' => 'month',
            'label' => 'Company csn',
            'rules' => 'trim|required|callback_month_validate'
        ),
        array(
            'field' => 'CSN',
            'label' => 'CSN',
            'rules' => 'trim|required|numeric'
        )
      ),
      'add_country' =>array
 			(
					array(
					'field'   => 'country_name',
					'label'   => 'Country Name',
				    'rules'   => 'trim|required|callback_alpha_with_space'						
				    ),
				    array(
					'field'   => 'country_code',
					'label'   => 'Country code',
				    'rules'   => 'trim|callback_alpha_with_space'							
				    ),
				    array(
					'field'   => 'country_gov_code',
					'label'   => 'Country code',
				    'rules'   => 'trim|numeric'							
				    ),
				    array(
					'field'   => 'country_nationality',
					'label'   => 'Country code',
				    'rules'   => 'trim|alpha_numeric'							
				    ),
				     array(
					'field'   => 'country_id',
					'label'   => 'Country Id',
				    'rules'   => 'trim|numeric|max_lenth[0]'							
				    )
			    
 			 ),
			'add_state' => array
			(
					array(
 					'field'   => 'country_id',
 					'label'   => 'Country',
 				    'rules'   => 'trim|required|numeric'						
 				    ),
 				    array(
 					'field'   => 'state_name',
 					'label'   => 'State Name',
 				    'rules'   => 'trim|required|callback_alpha_with_space'						
 				    ),
 				    array(
					'field'   => 'state_id',
					'label'   => 'State Id',
				    'rules'   => 'trim|numeric|max_lenth[0]'							
				    )
			),
			'add_city' => array
			(
					array(
 					'field'   => 'state_id',
 					'label'   => 'State',
 				    'rules'   => 'trim|required|numeric'						
 				    ),
 				     array(
 					'field'   => 'city_name',
 					'label'   => 'City',
 				    'rules'   => 'trim|required|callback_alpha_with_space'						
 				    ),
 				    array(
					'field'   => 'city_id',
					'label'   => 'City Id',
				    'rules'   => 'trim|numeric|max_lenth[0]'							
				    )
			),
			'edit_country' =>array
 			(
 					array(
					'field'   => 'country_id',
					'label'   => 'Country Id',
				    'rules'   => 'trim|required|numeric'						
				    ),
					array(
					'field'   => 'country_name',
					'label'   => 'Country Name',
				    'rules'   => 'trim|required|callback_alpha_with_space'						
				    ),
				    array(
					'field'   => 'country_code',
					'label'   => 'Country code',
				    'rules'   => 'trim|numeric'							
				    ),
				    array(
					'field'   => 'country_nationality',
					'label'   => 'Country code',
				    'rules'   => 'trim|alpha_numeric'							
				    ),
				     array(
					'field'   => 'country_id',
					'label'   => 'Country Id',
				    'rules'   => 'trim|numeric|max_lenth[0]'							
				    )
			    
 			 ),
			'edit_state' => array
			(
					array(
					'field'   => 'state_id',
					'label'   => 'state Name',
				    'rules'   => 'trim|required|numeric'						
				    ),
					array(
 					'field'   => 'country_id',
 					'label'   => 'Country',
 				    'rules'   => 'trim|required|numeric'						
 				    ),
 				    array(
 					'field'   => 'state_name',
 					'label'   => 'State Name',
 				    'rules'   => 'trim|required|callback_alpha_with_space'			
 				    )
			),
			'edit_city' => array
			(
					array(
					'field'   => 'city_id',
					'label'   => 'City id',
				    'rules'   => 'trim|required|numeric'						
				    ),
					array(
 					'field'   => 'state_id',
 					'label'   => 'State',
 				    'rules'   => 'trim|required|numeric'						
 				    ),
 				     array(
 					'field'   => 'city_name',
 					'label'   => 'city name',
 				    'rules'   => 'trim|required|callback_alpha_with_space'
 				    )
 		    ),
			'add_skill' => array
			(
					array(
 					'field'   => 'skill_name',
 					'label'   => 'Skill',
 				    'rules'   => 'trim|required|callback_alpha_with_space|is_unique[skills.skill_name]'						
 				    ),
 				     array(
 					'field'   => 'skill_description',
 					'label'   => 'skill_descrption',
 				    'rules'   => 'trim|required'
 				    )
 		    ),
			'edit_skill' => array
			(
					array(
 					'field'   => 'skill_name',
 					'label'   => 'Skill',
 				    'rules'   => 'trim|required|callback_alpha_with_space'						
 				    ),
 				     array(
 					'field'   => 'skill_description',
 					'label'   => 'skill_descrption',
 				    'rules'   => 'trim|required'
 				    )
 		    ),
		    'user_profile' => array(
		        array(
		            'field' => 'opassword',
		            'label' => 'New Password',
		            'rules' => 'trim|required|callback_password_check'
		        ),
		        array(
		            'field' => 'npassword',
		            'label' => 'New password',
		            'rules' => 'trim|required'
		        ),
		        array(
		            'field' => 'cpassword',
		            'label' => 'Confirm password',
		            'rules' => 'trim|required|matches[npassword]'
		        )
		    ),
		    'job_category_add'=>array
		    (
				array(
		            'field' => 'job_category_name',
		            'label' => 'Job category Name',
		            'rules' => 'trim|required|is_unique[job_category.job_category_name]'
		        ),
		        array(
		            'field' => 'enable_login',
		            'label' => 'Enable Login',
		            'rules' => 'trim|numeric'
		        )
			),
		    'job_category_edit'=>array
		    (
				array(
		            'field' => 'job_category_name',
		            'label' => 'Job category Name',
		            'rules' => 'trim|required|callback_catexist'
		        ),
		        array(
		            'field' => 'enable_login',
		            'label' => 'Enable Login',
		            'rules' => 'trim|numeric'
		        ),
		        array(
		            'field' => 'id',
		            'label' => 'Details',
		            'rules' => 'trim|numeric|required'
		        )
			),
		    'job_title_add'=>array
		    (
				array(
		            'field' => 'job_title_name',
		            'label' => 'Job Title Name',
		            'rules' => 'trim|required|is_unique[job_titles.job_title_name]'
		        ),
		        array(
		            'field' => 'job_title_category',
		            'label' => 'Job title category',
		            'rules' => 'trim|numeric|required'
		        )
			),
		    'job_title_edit'=>array
		    (
				array(
		            'field' => 'job_title_name',
		            'label' => 'Job Title Name',
		            'rules' => 'trim|required|callback_catexist'
		        ),
		        array(
		            'field' => 'job_title_category',
		            'label' => 'Job Title Category',
		            'rules' => 'trim|numeric|required'
		        ),
		        array(
		            'field' => 'id',
		            'label' => 'Details',
		            'rules' => 'trim|numeric|required'
		        )
			),
		    'projects_add'=>array
		    (
				array(
		            'field' => 'project_title',
		            'label' => 'Projects Title',
		            'rules' => 'trim|required|is_unique[projects.project_title]'
		        ),
		        array(
		            'field' => 'project_description',
		            'label' => 'Project Description',
		            'rules' => 'trim|'
		        )
			),
		    'projects_edit'=>array
		    (
				array(
		            'field' => 'project_title',
		            'label' => 'Projects Title',
		            'rules' => 'trim|required|callback_catexist'
		        ),
		        array(
		            'field' => 'project_description',
		            'label' => 'Project Description',
		            'rules' => 'trim|'
		        ),
		        array(
		            'field' => 'id',
		            'label' => 'Details',
		            'rules' => 'trim|numeric|required'
		        )
			),
		    'locations_add'=>array
		    (
				array(
		            'field' => 'location_name',
		            'label' => 'Location Name',
		            'rules' => 'trim|required|is_unique[location.location_name]'
		        ),
		        array(
		            'field' => 'location_details',
		            'label' => 'Project Description',
		            'rules' => 'trim|'
		        ),
		        array(
		            'field' => 'project_id',
		            'label' => 'project',
		            'rules' => 'trim|numeric|required'
		        )
			),
		    'locations_edit'=>array
		    (
				array(
		            'field' => 'location_name',
		            'label' => 'Location Name',
		            'rules' => 'trim|required|callback_catexist'
		        ),
		        array(
		            'field' => 'location_details',
		            'label' => 'Project Description',
		            'rules' => 'trim|'
		        ),
		        array(
		            'field' => 'id',
		            'label' => 'Details',
		            'rules' => 'trim|numeric|required'
		        ),
		        array(
		            'field' => 'project_id',
		            'label' => 'project',
		            'rules' => 'trim|numeric|required'
		        )
			),
		    'event'=>array
		    (
				array(
		            'field' => 'id',
		            'label' => 'Required Field',
		            'rules' => 'trim|required|numeric'
		        ),
		        array(
		            'field' => 'title',
		            'label' => 'Event Title',
		            'rules' => 'trim|required'
		        ),
		        array(
		            'field' => 'description',
		            'label' => 'Description',
		            'rules' => 'trim'
		        ),
		        array(
		            'field' => 'start',
		            'label' => 'Start Date',
		            'rules' => 'trim|datevalidate[Y-m-d]|required'
		        )
			),
		    'event_fetch'=>array
		    (
				array(
		            'field' => 'id',
		            'label' => 'Required Field',
		            'rules' => 'trim|required|numeric'
		        )
			),
		    'add_dates_for_ot'=>array
		    (
				array(
		            'field' => 'month',
		            'label' => 'Month',
		            'rules' => 'trim|required|datevalidate[Y-m]'
		        ),
		        array(
		            'field' => 'employee_id',
		            'label' => 'Employee',
		            'rules' => 'trim|required|numeric|callback_emp_validate'
		        )
			),
		    'submit_ot'=>array
		    (
				array(
		            'field' => 'month1',
		            'label' => 'Month',
		            'rules' => 'trim|required|datevalidate[Y-m]'
		        ),
		        array(
		            'field' => 'emp_id1',
		            'label' => 'Employee',
		            'rules' => 'trim|required|numeric'
		        ),
		        array(
		            'field' => 'date[]',
		            'label' => 'Date',
		            'rules' => 'trim|callback_datechecked'
		        )
			),
		    'termination'=>array
		    (
				array(
		            'field' => 'termination_date',
		            'label' => 'Termination Date',
		            'rules' => 'trim|required|datevalidate[Y-m-d]'
		        ),
		        array(
		            'field' => 'termination_description',
		            'label' => 'Description',
		            'rules' => 'trim|required'
		        ),
		        array(
		            'field' => 'termination_emp_id',
		            'label' => 'Employee',
		            'rules' => 'trim|required|numeric'
		        )
			),
		    'total_salary_ajax'=>array
		    (
				array(
		            'field' => 'emp_salary_pay_period',
		            'label' => 'Pay Period Type',
		            'rules' => 'trim|required|numeric'
		        ),
		        array(
		            'field' => 'range',
		            'label' => 'Date Range',
		            'rules' => 'trim|date_range_validator[Y/m/d]|callback_rangeconfirm'
		        ),
		        array(
		            'field' => 'month',
		            'label' => 'Month',
		            'rules' => 'trim|callback_datevalidate[Y-m]' //Yuvi-Note
		        ),
		        array(
		            'field' => 'start_date',
		            'label' => 'Start Date',
		            'rules' => 'trim|datevalidate[Y-m-d]'
		        )
			)
);
?>
