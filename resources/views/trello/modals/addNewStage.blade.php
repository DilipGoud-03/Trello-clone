<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create board </title>
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
    <div class="modal" id="createBoardModel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <h4>Create Board</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body"></div>
                <div id="container" class="container">
                    <form id="multi-step-form">
                        @csrf
                        <div class="mb-3">
                            <label for="boardName" class="form-label">Board Name:</label>
                            <input type="hidden" name="id" value=" {{Auth::user()->id}}">
                            <input type=" text" class="form-control @error('boardName') is-invalid @enderror" id="boardName" name="boardName">
                            @if ($errors->has('boardName'))
                            <small class="text-danger">{{ $errors->first('boardName')}}</small>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="decription" class="form-label">Board Description:</label>
                            <input type=" text" class="form-control @error('decription') is-invalid @enderror" id="decription" name="decription">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>