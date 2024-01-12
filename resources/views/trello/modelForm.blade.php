<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <style>
        #container {
            max-width: 550px;
        }

        .step-container {
            position: relative;
            text-align: center;
            transform: translateY(-43%);
        }

        .step-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #fff;
            border: 2px solid #007bff;
            line-height: 30px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            cursor: pointer;
            /* Added cursor pointer */
        }

        .step-line {
            position: absolute;
            top: 16px;
            left: 50px;
            width: calc(100% - 100px);
            height: 2px;
            background-color: #007bff;
            z-index: -1;
        }

        #multi-step-form {
            overflow-x: hidden;
        }
    </style>
    <script>
        var currentStep = 1;
        $(document).ready(function() {
            $('#multi-step-form').find('.step').slice(1).hide();

            $(".next-step").click(function() {
                if (currentStep < 3) {
                    $(".step-" + currentStep).addClass("animate__animated animate__fadeOutLeft");
                    currentStep++;
                    setTimeout(function() {
                        $(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
                        $(".step-" + currentStep).show().addClass("animate__animated animate__fadeInRight");
                    }, 500);
                }
            });
            $(".prev-step").click(function() {
                if (currentStep > 1) {
                    $(".step-" + currentStep).addClass("animate__animated animate__fadeOutRight");
                    currentStep--;
                    setTimeout(function() {
                        $(".step").removeClass("animate__animated animate__fadeOutRight").hide();
                        $(".step-" + currentStep).show().addClass("animate__animated animate__fadeInLeft");
                    }, 500);
                }
            });
        });
    </script>
</head>

<body>
    <!-- The Modal -->
    <div class="modal" id="myModal" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="container" class="container mt-1">
                        <form id="multi-step-form" action="{{route('modalData')}}" method="post">
                            <!--create board -->
                            @csrf
                            <div class="step step-1">
                                <h4> Create Board</h4>
                                <div class="mt-3">
                                    <label for="boardName" class="form-label">Board Name:</label>
                                    <input type="text" class="form-control @error('boardName') is-invalid @enderror" id="boardName" name="boardName">
                                    @if ($errors->has('boardName'))
                                    <small class="text-danger">{{ $errors->first('boardName')}}</small>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <label for="baordDescription" class="form-label">Board Description:</label>
                                    <textarea class="form-control @error('baordDescription') is-invalid @enderror" name="baordDescription" id="baordDescription"></textarea>
                                    @if ($errors->has('baordDescription'))
                                    <small class="text-danger">{{ $errors->first('baordDescription') }}</small>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-dark next-step" style="float: inline-end">Next</button>
                                </div>
                            </div>

                            <!-- Invite User -->
                            <div class="step step-2">
                                <h4>Invite User</h4>
                                <div class="mt-3">
                                    <label for="userEmail" class="form-label">User email:</label>
                                    <input type="email" class="form-control @error('userEmail') is-invalid @enderror" id="userEmail" name="userEmail">
                                    @if ($errors->has('userEmail'))
                                    <small class="text-danger">{{ $errors->first('userEmail') }}</small>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <label for="role" class="form-label">Select Role:</label>
                                    <select name="role" id="role" class="selectpicker form-control @error('role') is-invalid @enderror">
                                        <option>Select Role</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Project Manager">Project Manager</option>
                                        <option value="Developer">Developer</option>
                                    </select>
                                    @if ($errors->has('role'))
                                    <small class="text-danger">{{ $errors->first('role') }}</small>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-danger prev-step">Previous</button>
                                    <button type="button" class="btn btn-dark next-step" style="float: inline-end">Next</button>
                                </div>
                            </div>

                            <!-- Create Stages -->
                            <div class="step step-3">
                                <h4>Create Stages</h4>
                                <div class="mt-3">
                                    <label for="stageName" class="form-label">Stage Name:</label>
                                    <input type="text" class="form-control @error('stageName') is-invalid @enderror" id="stageName" name="stageName">
                                    @if ($errors->has('stageName'))
                                    <small class="text-danger">{{ $errors->first('stageName') }}</small>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <label for="stageDescription" class="form-label">Description:</label>
                                    <textarea class="form-control @error('stageDescription') is-invalid @enderror" id="stageDescription" name="stageDescription"></textarea>
                                    @if ($errors->has('stageDescription'))
                                    <small class="text-danger">{{ $errors->first('stageDescription') }}</small>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-danger prev-step">Previous</button>
                                    <button type="submit" class="btn btn-success" style="float: inline-end">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>