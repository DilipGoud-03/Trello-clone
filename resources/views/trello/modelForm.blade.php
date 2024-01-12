<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="container" class="container mt-5">
                        <div class="progress px-1" style="height: 3px;">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="step-container d-flex justify-content-between">
                            <div class="step-circle" onclick="displayStep(1)">1</div>
                            <div class="step-circle" onclick="displayStep(2)">2</div>
                            <div class="step-circle" onclick="displayStep(3)">3</div>
                        </div>
                        <form id="multi-step-form">

                            <!--create board -->

                            <div class="step step-1">
                                <h4> Create Board</h4>
                                <div class="mt-3">
                                    <label for="name" class="form-label">Board Name:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="mt-3">
                                    <label for="name" class="form-label">Description:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Invite User -->

                            <div class="step step-2">
                                <h4>Invite User</h4>
                                <div class="mb-3">
                                    <label for="email" class="form-label">User Email Address:</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Select Role:</label>
                                    <select name="role" id="role" class="selectpicker form-control">
                                        <option>Select Role</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Project Manager">Project Manager</option>
                                        <option value="Developer">Developer</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-primary prev-step">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Create Stages -->

                            <div class="step step-3">
                                <h4>Create Stages</h4>
                                <div class="mb-3">
                                    <label for="field3" class="form-label">Field 3:</label>
                                    <input type="text" class="form-control" id="field3" name="field3">
                                </div>
                                <button type="button" class="btn btn-primary prev-step">Previous</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>