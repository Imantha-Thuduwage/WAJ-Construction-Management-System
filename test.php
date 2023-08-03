<div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <div class="input-field">
                                <label for="emp_id" class="mb-1">Employee ID</label>
                                <select class="bg-body" id="empId" name="empId">
                                    <option value="" selected disabled hidden>Pick Employee ID</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT employee_id FROM tbl_employee";
                                    $db = dbConn();
                                    $result = $db->query($sql);

                                    // Display options in dropdown list
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['employee_id'] . "'>" . $row['employee_id'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>



                    // Output the calculated values
        $output = '<div class="pay-sheet">';
        $output .= '<h2>Pay Sheet</h2>';
        $output .= '<table class = "table table-strips">';
        $output .= '<tr>
                    <th>Employee ID</th>
                    <td>' . $employeeId . '</td>
                </tr>';
        $output .= '<tr>
                    <th>Employee Name</th>
                    <td>' . $employeeName . '</td>
                </tr>';
        $output .= '<tr>
                    <th>Attendance Count</th>
                    <td>' . $attendanceCount . '</td>
                </tr>';
        $output .= '<tr>
                    <th>Basic Salary</th>
                    <td>' . $basicSalary . '</td>
                </tr>';
        $output .= '<tr>
                    <th>Company Allowance</th>
                    <td>' . $companyAllowance . '</td>
                </tr>';
        $output .= '<tr>
                    <th>Monthly Salary</th>
                    <td>' . $monthlySalary . '</td>
                </tr>';
        $output .= '<tr>
                    <th rowspan="3">Deduction</th>
                </tr>';

        $output .= '<tr>
                    <th>Total Advance</th>
                    <td>' . $totalAdvance . '</td>
                </tr>';
        $output .= '<tr>
                    <th>E.P.F (8%)</th>
                    <td>' . $employeeEpfContri . '</td>
                </tr>';
        $output .= '<tr>
                    <th>Total Deduction</th>
                    <td>' . $totalDeduction . '</td>
                </tr>';
        $output .= '<tr>
                    <th>Net Salary</th>
                    <td>' . $netSalary . '</td>
                </tr>';
        $output .= '<tr>
                    <th rowspan="3">Company Contributions</th>
                </tr>';
        $output .= '<tr>
                    <th>E.P.F (12%)</th>
                    <td>' . $employerEpfContri . '</td>
                </tr>';
        $output .= '<tr>
                    <th>E.T.F (3%)</th>
                    <td>' . $employerEtfContri . '</td>
                </tr>';
        $output .= '<tr>
                    <th>Total Company Contribution</th>
                    <td>' . $totalContribution . '</td>
                </tr>';
        $output .= '</table>';
        $output .= '</div>';

        echo $output;