<form class="form-horizontal my-rows">
    <div class="col-sm-6 my-rows" style="border-right:dotted 0.3px;"><!-- left form column -->
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-2 sr-only" for="first_name">First Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
                        <span id="first_name_help" class="text-primary"> Invalid Name </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-2 sr-only" for="last_name">Last Name:</label>
                    <div class="col-sm-10 ">
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                        <span id="last_name_help" class="text-danger"> Invalid Name </span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="control-label col-sm-1 sr-only" for="email">Email:</label>
                    <div class="col-sm-11">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                        <span id="email_help" class="text-success"> Email Available </span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-2 sr-only" for="password">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                        <span id="password_help" class="text-warning"> Invalid Password </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-2 sr-only" for="confirm_password">Confirm Password:</label>
                    <div class="col-sm-10 ">
                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                        <span id="confirm_password_help" class="text-info"> Incorrect Password </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="gender">Gender</label>
                    <div class="col-sm-8">
                        <div class="radio">
                            <label><input type="radio" name="gender" id="gender" value="male">Male</label>
                        </div>
                        <span id="password_help" class="text-warning"> Invalid Password </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="col-sm-10 ">
                        <label><input type="radio" name="gender" value="female">Female</label>
                        <span id="confirm_password_help" class="text-info"> Incorrect Password </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="col-sm-10 ">
                        <label><input type="radio" name="gender" value="other">Other</label>
                        <span id="confirm_password_help" class="text-info"> Incorrect Password </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-2 sr-only" for="password">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                        <span id="password_help" class="text-warning"> Invalid Password </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-2 sr-only" for="confirm_password">Confirm Password:</label>
                    <div class="col-sm-10 ">
                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                        <span id="confirm_password_help" class="text-info"> Incorrect Password </span>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end of left form column -->

    <div class="col-sm-6 my-rows"> <!-- right for column -->

    </div>  <!-- end of right for column -->

</form>
