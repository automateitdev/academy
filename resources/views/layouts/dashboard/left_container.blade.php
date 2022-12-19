 <!-- Brand Logo -->
 <a href="#" class="brand-link" style="border:none">
     <img src="{{ asset('images/com/Academy Logo Final.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 1">
     <!-- <span class="brand-text font-weight-light">Academy</span> -->
 </a>

 <!-- Sidebar -->
 <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

     <!-- SidebarSearch Form -->
     <div class="form-inline">
         <div class="input-group" data-widget="sidebar-search">
             <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
             <div class="input-group-append">
                 <button class="btn btn-sidebar">
                     <i class="fas fa-search fa-fw" style="font-size:.875em"></i>
                 </button>
             </div>
         </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2 text-md">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
             <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
             <li class="nav-item menu-open">
                 <a href="{{ route('dashboard.index') }}" class="nav-link active">
                     <i class="nav-icon fa fa-xs fa-tachometer-alt" style="font-size:.875em"></i>
                     <p>
                         Dashboard
                     </p>
                 </a>
             </li>

             <!-- student management start -->
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-graduation-cap" style="font-size:.875em"></i>
                     <p>
                         Student
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em; line-height:1.5em"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Registration</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="{{ route('enrollment.auto.index') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Enrollment Form</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('enrollment.excel.index') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Excel Form</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Update</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Promotion</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Report</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Custom Field Setup</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                     </li>
                 </ul>
             </li>
             <!-- student management end -->

             <!-- HR management start -->
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-users" style="font-size:.875em"></i>
                     <p>
                         Teacher/Staff
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em; line-height:1.5em"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Registration</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Upadate</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Assign</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Report</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                     </li>
                 </ul>
             </li>
             <!-- HR management end -->

             <!-- attendance start -->
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-id-badge" style="font-size:.875em"></i>
                     <p>
                         Attendance
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em; line-height:1.5em"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Student Attendance</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>HR Attendance</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                     </li>
                 </ul>
             </li>
             <!-- attendance end -->



             <!-- Exam Management start -->
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-solid fa-feather" style="font-size:.875em"></i>
                     <p>
                         Exam Management
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Settings</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="{{ route('examstartup') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Exam Startup</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('markconfig') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Mark Config</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Mark Input</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="{{route('markinput')}}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Section Wise</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Mark Update</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="{{route('markupdate')}}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Section Wise</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Mark Delete</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Mark Process</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Result Process</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Reports</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                     </li>
                 </ul>
             </li>
             <!-- Exam Management end -->

             <!-- Fees management start -->
             <li class="nav-item ">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-solid fa-receipt" style="font-size:.875em"></i>
                     <p>
                         Fees Management
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="{{ route('fee.startup.index') }}" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Fee Startup</p>
                             <!-- <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i> -->
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('fee.maping.index') }}" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Fee Mapping</p>
                             <!-- <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i> -->
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('amount.index') }}" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Amount Set</p>
                             <!-- <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i> -->
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('date.index') }}" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Date Setup</p>
                             <!-- <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i> -->
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('waiver.index') }}" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Waiver Setup</p>
                             <!-- <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i> -->
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Fee Remove</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="{{ route('fee.remove.index') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Fee Head</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('feesub.remove.index') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Fee Subhead</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Fee Collection</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="{{ route('feecollection.index') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Quick Collection</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="#" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Bulk Collection</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Payslip</p>
                             <!-- <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i> -->
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Delete</p>
                             <!-- <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i> -->
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Report</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="{{ route('ops.index') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>OPS Collection</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                 </ul>
             </li>
             <!-- Fees management end -->

             <!-- Payroll Management start -->
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-solid fa-file-invoice-dollar" style="font-size:.875em"></i>
                     <p>
                         Payroll
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em; line-height:1.5em"></i>
                     </p>
                 </a>
             </li>
             <!-- Payroll Management end -->

             <!-- Inventory Management start -->
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-sharp fa-solid fa-box" style="font-size:.875em"></i>
                     <p>
                         Inventory
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em; line-height:1.5em"></i>
                     </p>
                 </a>
             </li>
             <!-- Inventory Management end -->

             <!-- Accounts Management start -->
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-sharp fa-solid fa-bookmark" style="font-size:.875em"></i>
                     <p>
                         General Accounts
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em; line-height:1.5em"></i>
                     </p>
                 </a>
             </li>
             <!-- Accounts Management end -->

             <!-- Routine Management start -->
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-solid fa-clipboard-list" style="font-size:.875em"></i>
                     <p>
                         Routine
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em; line-height:1.5em"></i>
                     </p>
                 </a>
             </li>
             <!-- Routine Management end -->

             <!-- Massege & Notification start -->
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-solid fa-envelope" style="font-size:.875em"></i>
                     <i class=""></i>
                     <p>
                         SMS/Notification
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em; line-height:1.5em"></i>
                     </p>
                 </a>
             </li>
             <!-- Massege & Notification end -->

             <!-- layout & certificate start -->
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-solid fa-layer-group" style="font-size:.875em"></i>
                     <p>
                         Layout & Certificate
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Settings</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Field One</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Download</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>ID Card</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('exam.card.index') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Exam Essentials</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                 </ul>
             </li>
             <!-- layout & certificate end -->

             <!-- Online Admission start -->
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-solid fa-list" style="font-size:.875em"></i>
                     <i class=""></i>
                     <p>
                         Online Admission
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em; line-height:1.5em"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>OA Setting</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Application Config</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Approval</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Report</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Applicant</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Payment Info</p>
                         </a>
                     </li>
                 </ul>
             </li>
             <!-- Online Admission end -->

             <!-- Master Setting start -->
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-solid fa-wrench" style="font-size:.875em"></i>
                     <p>
                         Master Setting
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <!-- Institute Setup start -->
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Institute Setup</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="{{ route('startup.index') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Startup</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('basic.index') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Basic Setup</p>
                                 </a>
                             </li>
                             <!-- Class Setup start -->
                             <li class="nav-item">
                                 <a href="{{ route('class.index') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Class Setup</p>
                                     <!-- <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i> -->
                                 </a>
                             </li>
                             <!-- Class Setup end -->
                         </ul>
                     </li>
                     <!-- Institute Setup end -->
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Subject Setup</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="{{ route('subject.index') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Subject Configure</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('fourthsubject.index') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>4th Subject Configure</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>User Setup</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('signature.index') }}" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Signature</p>
                             <!-- <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i> -->
                         </a>
                     </li>
                 </ul>
             </li>
             <!-- Master Setting end -->

             <!-- Website Maintenance start -->
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-solid fa-globe" style="font-size:.875em"></i>
                     <i class="" style="font-size:.875em"></i>
                     <p>
                         Website Management
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Configuration</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="{{ route('menu') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Menu</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Content Management</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="#" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Home Page</p>
                                     <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                                 </a>
                                 <ul class="nav nav-treeview">
                                     <li class="nav-item">
                                         <a href="{{ route('slider.index') }}" class="nav-link active">
                                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                             <p>Slider</p>
                                         </a>
                                     </li>
                                     <li class="nav-item">
                                         <a href="{{ route('speech.index') }}" class="nav-link active">
                                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                             <p>Speech Info</p>
                                         </a>
                                     </li>
                                     <li class="nav-item">
                                         <a href="{{ route('gallery.index') }}" class="nav-link active">
                                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                             <p>Gallery</p>
                                         </a>
                                     </li>
                                     <li class="nav-item">
                                         <a href="{{ route('notice.index') }}" class="nav-link active">
                                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                             <p>Notice</p>
                                         </a>
                                     </li>
                                     <li class="nav-item">
                                         <a href="{{ route('aboutinstitute.index') }}" class="nav-link active">
                                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                             <p>About Institute</p>
                                         </a>
                                     </li>
                                 </ul>
                             </li>
                             <li class="nav-item">
                                 <a href="#" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Menu</p>
                                     <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                                 </a>
                                 <ul class="nav nav-treeview">
                                     <li class="nav-item">
                                         <a href="{{ route('about.index') }}" class="nav-link active">
                                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                             <p>About</p>
                                         </a>
                                     </li>
                                     <li class="nav-item">
                                         <a href="{{ route('admns.index') }}" class="nav-link active">
                                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                             <p>Administration</p>
                                         </a>
                                     </li>
                                 </ul>
                             </li>
                         </ul>
                     </li>
                 </ul>
             </li>
             <!-- Website Maintenance end -->

             <!-- Help Line start -->
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xs fa-solid fa-headset" style="font-size:.875em"></i>
                     <i class=""></i>
                     <p>
                         Help Line
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em; line-height:1.5em"></i>
                     </p>
                 </a>
             </li>
             <!-- Help Line end -->

             <br>

             <!-- Administrator part -->
             @foreach (Auth::user()->roles as $role)
             @if ($role->id == 1)
             <li class="nav-header">Maintenance</li>
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fa fa-xss fa-tachometer-alt" style="font-size:.875em"></i>
                     <p>
                         Global Management
                         <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Institute</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="{{ route('institute.view') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Users</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('domain.view') }}" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Domain Assign</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Global Field</p>
                             <i class="right fas fa-angle-left" style="font-size:.875em; line-height:1.5em"></i>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Field One</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="" class="nav-link active">
                                     <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                                     <p>Field Two</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('bankinfo.view') }}" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>
                                 Bank Info
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('role.view') }}" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>
                                 Role Assign
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('menu') }}" class="nav-link active">
                             <i class="far fa-circle nav-icon" style="font-size:.875em"></i>
                             <p>Menu</p>
                         </a>
                     </li>
                 </ul>
             </li>
             <li class="nav-header">Customer Support</li>
             @endif
             @endforeach
             <!-- Administrator part -->
         </ul>
     </nav>
     <!-- /.sidebar-menu -->
 </div>
 <!-- /.sidebar -->