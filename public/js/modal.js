var currentStep = 1;
$(document).ready(function () {
    $('#mymodal').on('hidden.bs.modal', function () {
        this.modal('show');
    });
    $('#multi_step_form').find('.step').slice(1).hide();

    $(".next-step").click(function () {
        if (currentStep < 3) {
            $(".step-" + currentStep).addClass("animate__animated animate__fadeOutLeft");
            currentStep++;
            setTimeout(function () {
                $(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
                $(".step-" + currentStep).show().addClass("animate__animated animate__fadeInRight");
            }, 500);
        }
    });
    $(".prev-step").click(function () {
        if (currentStep > 1) {
            $(".step-" + currentStep).addClass("animate__animated animate__fadeOutRight");
            currentStep--;
            setTimeout(function () {
                $(".step").removeClass("animate__animated animate__fadeOutRight").hide();
                $(".step-" + currentStep).show().addClass("animate__animated animate__fadeInLeft");
            }, 500);
        }
    });
});