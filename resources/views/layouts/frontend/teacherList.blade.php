<div class="container">
    <h5 class="pt-5">
        <i class="fa fa-clone" aria-hidden="true"></i>
        Teachers
    </h5>
    <div id="example_wrapper">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div id="example_filter" class="dataTables_filter"><label>Show Per Page:
                        <select name="example_length" aria-controls="example" class="form-control form-control-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div id="example_filter" class="dataTables_filter"><label>Search:<input type="search"
                            class="form-control form-control-sm" placeholder="" aria-controls="example"></label>
                </div>
            </div>
        </div>
        <br>
        <div class="row table-responsive">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th align="left" valign="top" class="sorting_desc" tabindex="0" aria-controls="example"
                            rowspan="1" colspan="1" style="width: 77.2px;" aria-sort="descending"
                            aria-label="Id No: activate to sort column ascending">Id
                            No</th>
                        <th align="left" valign="top" class="sorting" tabindex="0" aria-controls="example"
                            rowspan="1" colspan="1" style="width: 262.2px;"
                            aria-label="Full Name: activate to sort column ascending">Full Name</th>
                        <th align="left" valign="top" class="sorting" tabindex="0" aria-controls="example"
                            rowspan="1" colspan="1" style="width: 94.2px;"
                            aria-label="Designation: activate to sort column ascending">Designation</th>
                        <th align="left" valign="top" class="sorting" tabindex="0" aria-controls="example"
                            rowspan="1" colspan="1" style="width: 63.2px;"
                            aria-label="Joining: activate to sort column ascending">Joining</th>
                        <th align="left" valign="top" class="sorting" tabindex="0" aria-controls="example"
                            rowspan="1" colspan="1" style="width: 95.2px;"
                            aria-label="Department: activate to sort column ascending">Department</th>
                        <th align="left" valign="top" class="PTtable sorting" tabindex="0" aria-controls="example"
                            rowspan="1" colspan="1" style="width: 246.2px;"
                            aria-label="&amp;nbsp;: activate to sort column ascending">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr role="row" class="even">
                        <td align="left" class="sorting_1" tabindex="0">18136142061</td>
                        <td align="left">মোহাম্মদ আবদুল কাদের চৌধুরী</td>
                        <td align="left">03/09/2018</td>
                        <td align="left">05/01/1986</td>
                        <td align="left">Political Science </td>
                        <td align="right" nowrap="nowrap" class="PTtable"><button class="btn btn-sm btn-info"
                                onclick="window.location.href='teacher_staff_profile.php?id=62' "><i class="fa fa-eye"
                                    aria-hidden="true"></i> Profile</button>
                        </td>
                    </tr>
                    <tr role="row" class="odd">
                        <td align="left" class="sorting_1" tabindex="0">18136134058</td>
                        <td align="left">মো: মনজুর আহমেদ ভূইয়া</td>
                        <td align="left">03-09-2018</td>
                        <td align="left">01-01-1990</td>
                        <td align="left">Management</td>
                        <td align="right" nowrap="nowrap" class=""><button class="btn btn-sm btn-info"
                                onclick="window.location.href='teacher_staff_profile.php?id=62' "><i class="fa fa-eye"
                                    aria-hidden="true"></i> Profile</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="row">
            <div class="col-sm-12 col-md-5"> Showing {{ $categories->perPage() }} of total
                {{ $categories->total() }}</div>
            <div class="col-sm-12 col-md-7" style="text-align: left">
                {{ $categories->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
